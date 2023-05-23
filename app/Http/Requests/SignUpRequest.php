<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SignUpRequest extends FormRequest
{
    public function authorize(){
//        return Auth::check();
        return true;
    }

    public function rules()
    {
        return [
            'username'                  => '',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
            'email'                     => 'required|email',
            'contact'                   => 'required',
        ];
    }

//    public function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            if ($this->input('password') !== $this->input('confirm_password')) {
//                $validator->errors()->add('confirm_password', 'The password confirmation does not match.');
//            }
//        });
//    }


}
