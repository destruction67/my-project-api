<?php

namespace App\Services;

use App\Models\myapp\UserPosition;

class ObjKeysService
{

    public function getUserPositionKeys()
    {
        return UserPosition::query()
            ->where('active', 1)
            ->get()
            ->transform(function ($val) {
                return [
                    'id' => $val->id,
                    "name" => $val->name,
                ];
            });
    }

}
