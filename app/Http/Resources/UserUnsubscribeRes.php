<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserUnsubscribeRes extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'active'         => $this->active,

        ];
    }

}
