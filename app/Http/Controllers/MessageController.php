<?php

namespace App\Http\Controllers;

use App\Events\Hello;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        broadcast(new Hello($request->message));
        return response()->json([], 200);
    }
}
