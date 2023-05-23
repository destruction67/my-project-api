<?php

namespace App\Models\myapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasFactory;

    protected $fillable = MyAppFillable::USER_POSITION;
}
