<?php

namespace App\Http\Resources;

use App\Models\myapp\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRes extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'username'       => $this->username,
            'email'          => $this->email,
            'contact'        => $this->contact,
            'active'         => $this->active,
            'userPositionId' => $this->userPosition->id ?? null,
            'userPosition'   => $this->userPosition->name ?? null,
            'created_at'     => Carbon::parse($this->created_at)->format('d, M Y') ?? null,
        ];
    }

}
