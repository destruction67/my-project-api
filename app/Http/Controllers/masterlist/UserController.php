<?php

namespace App\Http\Controllers\masterlist;

use App\Http\Controllers\Controller;
use App\Http\Requests\home\UpdateUserUnsubscribeRequest;
use App\Http\Requests\masterlist\AddUserRequest;
use App\Http\Requests\masterlist\UpdateUserRequest;
use App\Models\HttpCode;
use App\Services\masterlist\UserService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }

    public function index(Request $request)
    {
        try {
            $users = $this->userService->getAllUsers($request);
            return response()->json($users, HttpCode::SUCCESS_OK);

        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), HttpCode::SERVICE_UNAVAILABLE);

        }
    }

    public function store(AddUserRequest $request)
    {
        try {
            $validateData = $request->validated();
            $user = $this->userService->createUser($validateData);

            return response()->json($user, HttpCode::SUCCESS_OK);

        } catch (ValidationException $exception) {
            return response()->json($exception->getMessage(), HttpCode::SERVICE_UNAVAILABLE);
        }
    }

    public function show(int $userId)
    {
        try {
            $user = $this->userService->findUser($userId);
            return response()->json($user,HttpCode::SUCCESS_OK);

        }catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(),HttpCode::NOT_FOUND);

        }catch (Exception $exception){
            return response()->json($exception->getMessage(),HttpCode::SERVICE_UNAVAILABLE);

        }
    }

    public function update(UpdateUserRequest $request, int $userId)
    {
        $validateData = (object) $request->validated();
        $user = $this->userService->updateUser($validateData, $userId);

        return response()->json($user, HttpCode::SUCCESS_OK);
    }

    public function destroy(int $signatoryId)
    {
        try {
            $user = $this->userService->deleteUser($signatoryId);

            return response()->json($user,HttpCode::SUCCESS_OK);

        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), HttpCode::NOT_FOUND);

        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), HttpCode::SERVICE_UNAVAILABLE);
        }
    }

    public function userUnsubscribe(Request $request)
    {
//        $validateData = (object) $request->validated();
        $user = $this->userService->userUnsubscribe($request);

        return response()->json($user, HttpCode::SUCCESS_OK);
    }

}
