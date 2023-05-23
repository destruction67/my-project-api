<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\masterlist\UserController;
use App\Http\Controllers\ObjKeysController;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'my-app'], function () {
    // Sign up guest
    Route::post('createUserFromSignUp', [SignUpController::class, 'createUserFromSignUp']);
    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {

        //api resource here
        Route::apiResources(
            [
                'user'              => UserController::class,  //GET. POST, PATCH, UPDATE , DELETE
            ]
        );
        Route::post('userUnsubscribe', [UserController::class, 'userUnsubscribe']);

        Route::get('getUserPositionKeys', [ObjKeysController::class, 'getUserPositionKeys']);

        Route::get('logout', [LoginController::class, 'logout']);


    });


});


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
