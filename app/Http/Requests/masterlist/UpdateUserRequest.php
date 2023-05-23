<?php

namespace App\Http\Requests\masterlist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    public function authorize(){
        return Auth::check();
    }

    public function rules()
    {
        return [
            'id'                        => 'required|numeric|exists:users,id',
            'username'                  => 'required',
            'password'                  => 'nullable|confirmed',
            'password_confirmation'     => 'nullable',
            'user_position_id'          => 'required',
            'email'                     => 'required|email',
            'contact'                   => 'required',
            'active'                   =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'user_position_id.required' => 'Please select user role',
        ];
    }
}
