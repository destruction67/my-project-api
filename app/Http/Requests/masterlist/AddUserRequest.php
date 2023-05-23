<?php

namespace App\Http\Requests\masterlist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddUserRequest extends FormRequest
{

    public function authorize(){
        return Auth::check();
    }

    public function rules()
    {
        return [
            'username'                  => 'required',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
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
