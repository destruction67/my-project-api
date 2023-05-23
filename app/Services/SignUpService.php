<?php

namespace App\Services;

use App\Models\myapp\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class SignUpService
{

    public function createUserFromSignUp(array $params)
    {

        try {

            $signUpUser = new User();
            $signUpUser->username = $params['username'] ?? null;
            $signUpUser->password = Hash::make($params['password']);
            $signUpUser->email = $params['email'] ?? null;
            $signUpUser->user_position_id = 3;
            $signUpUser->contact = $params['contact'] ?? null;
            $signUpUser->active = true;
            $signUpUser->save();

            return $signUpUser;

        } catch (Throwable $exception) {
            Log::channel('local-dev')->error($exception->getMessage());
            return false;
        }
    }

}
