<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthPostRequest;
use App\Http\Requests\LoginRequest;
use App\Models\HttpCode;
use App\Models\myapp\User;
use App\Models\StringConst;
use App\Services\LoginService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $validatedRequest = $request->validated();
            $authenticatedUser = $this->loginService->login($validatedRequest);

            if($authenticatedUser == StringConst::INCORRECT_CREDENTIALS){
                return response()->json(StringConst::ERROR_CONFLICT_AUTH_MSG,HttpCode::CONFLICT);
            }

            if($authenticatedUser == StringConst::INACTIVE_USER){
                return response()->json(StringConst::ERROR_INACTIVE_USER,HttpCode::CONFLICT);
            }

            return response()->json($authenticatedUser, HttpCode::SUCCESS_OK);

        } catch (ValidationException $exception) {
            Log::channel('local-dev')->debug($exception->getMessage());
            return response()->json($exception, HttpCode::NON_AUTHORITATIVE_INFORMATION);

        }
    }

    public static function attempt($credentials)
    {
        $users = User::where(['username' => $credentials['username']])->get();
        foreach ($users as $user) {
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::setUser($user);
                return $user;
            }
        }
        return false;
    }

    public function logout()
    {
        try {
            $this->loginService->logout();
            return response()->json(true, HttpCode::SUCCESS_OK);

        } catch (Exception $exception) {
            Log::channel('local-dev')->error($exception->getMessage());
            return response()->json($exception->getMessage(), HttpCode::SERVICE_UNAVAILABLE);

        }
    }



}
