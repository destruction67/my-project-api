<?php

namespace App\Services;

use App\Http\Controllers\LoginController;
use App\Http\Requests\LoginRequest;
use App\Models\StringConst;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginService
{

    public function login($credentials)
    {

        if ( !Auth::attempt($credentials)) {
            return StringConst::INCORRECT_CREDENTIALS;
        }

        $user = Auth::user();

        if ( $user->active == 0) {
            return StringConst::INACTIVE_USER;
        }

        $isExpiry = null;
        $b4Expired = null;
        $token = Auth::user()->createToken('Personal Access Token')->accessToken;


        return [
            'id'          => $user->id,
            'name'          => $user->name,
//            'middle_name'   => $user->middle_name,
//            'username'      => $user->username,
//            'email'         => $user->email,
            'active'        => $user->active,
            'authUser'      => $user,
            'token'         => $token,
        ];

        return $credentials;

    }

    public function logout()
    {
        if (App::environment('local')) {
            Log::info('Deleting token of ::=>' . '' . Auth::user(), []);
        }


        Auth::user()->tokens->each(function ($token, $key) {
            if (App::environment('local')) {
                Log::info("Delete Token ::=>" . '' . $key, ['token' => $token]);
            }
            $token->delete();
        });
    }

}
