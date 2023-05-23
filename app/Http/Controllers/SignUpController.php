<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\HttpCode;
use App\Services\SignUpService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;

class SignUpController extends Controller
{

    protected $signUpService;

    public function __construct(SignUpService $signUpService)
    {
        $this->signUpService = $signUpService;
    }

    public function createUserFromSignUp(SignUpRequest $request)
    {
        try {
            $validateData = $request->validated();
            $signUp = $this->signUpService->createUserFromSignUp($validateData);

            return response()->json($signUp, HttpCode::SUCCESS_OK);

        } catch (ValidationException $exception) {
            return response()->json($exception->getMessage(), HttpCode::SERVICE_UNAVAILABLE);
        }
    }

}
