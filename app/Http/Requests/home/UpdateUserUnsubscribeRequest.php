<?php

namespace App\Http\Requests\home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserUnsubscribeRequest extends FormRequest
{
    public function authorize(){
        return Auth::check();
    }

    public function rules()
    {
        return [
            'id'                        => 'required|numeric|exists:users,id',
            'active'                    => 'required',
        ];
    }

}
