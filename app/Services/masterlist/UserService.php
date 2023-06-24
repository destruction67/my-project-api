<?php

namespace App\Services\masterlist;

use App\Http\Resources\UserRes;
use App\Http\Resources\UserUnsubscribeRes;
use App\Models\myapp\User;
use App\Traits\DateUtility;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService
{

    use DateUtility;

    public function getAllUsers(object $params)
    {
        $count = $params->count ?? 5;
        $searchValue = $params->searchValue ?? null;

        $user = User::query()
            ->when($searchValue != null, function ($query) use ($searchValue) {
                $query->where('first_name', 'like', '%'.$searchValue.'%')
                    ->orWhere('middle_name', 'like', '%'.$searchValue.'%')
                    ->orWhere('last_name', 'like', '%'.$searchValue.'%')
                    ->orWhere('username', 'like', '%'.$searchValue.'%');
            })
            ->paginate($count);

        $user->getCollection()->transform(function ($user) {
            return [
                'id'             => $user->id,
                'username'       => $user->username,
                'email'          => $user->email,
                'contact'        => $user->contact,
                'active'         => $user->active,
                'userPositionId' => $user->userPosition->id ?? null,
                'userPosition'   => $user->userPosition->name ?? null,
                'created_at'     => $this->parseDateFormat1($user->created_at),
            ];
        });


        return $user;
    }

    public function createUser(array $params)
    {
        try {
            $user = new User();
            $user->username = $params['username'] ?? null;
            $user->password = Hash::make($params['password']) ?? null;
            $user->email = $params['email'] ?? null;
            $user->user_position_id = $params['user_position_id'];
            $user->contact = $params['contact'];
            $user->active = $params['active'];
            $user->save();

            return $user;
        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());

            return false;
        }
    }

    public function findUser(int $userId)
    {
        try {
            $user = User::findOrFail($userId);

            return [
                'id'             => $user->id,
                'username'       => $user->username,
                'email'          => $user->email,
                'contact'        => $user->contact,
                'active'         => $user->active,
                'userPositionId' => $user->userPosition->id ?? null,
                'userPosition'   => $user->userPosition->name ?? null,
                'created_at'     => $this->parseDateFormat1($user->created_at),
            ];
        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());

            return false;
        }
    }

    public function updateUser(object $params, int $userId)
    {
        try {
            $user = User::find($userId);
            $user->username = $params->username;
            $user->email = $params->email;
            $user->user_position_id = $params->user_position_id;
            $user->contact = $params->contact;
            $user->active = $params->active;

            if ( ! empty($params->password)) {
                $user->password = Hash::make($params->password);
            }

            $user->save();
            $data['updatedUser'] = new UserRes($user);

//        Log::info('User updated', ['spiderman' => $user]);
            return $data;
        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());

            return false;
        }
    }

    public function userUnsubscribe(object $params)
    {
        try {
            $user = User::find($params->id);
            $user->active = $params->active;
            $user->save();
            $data['updatedUserUnsubscribe'] = new UserUnsubscribeRes($user);

            return $data;
        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());
            return false;
        }
    }

    public function deleteUser(int $signatoryId)
    {
        try {
            $data = User::findOrFail($signatoryId);
            $data->delete();

            return $data->toArray();
        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());

            return false;
        }
    }

}
