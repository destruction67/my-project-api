<?php

namespace App\Http\Controllers;

use App\Services\ObjKeysService;
use Illuminate\Http\Request;

class ObjKeysController extends Controller
{
    protected $objKeysService;

    public function __construct(ObjKeysService  $objKeysService){
        $this->objKeysService = $objKeysService;
    }


    public function getUserPositionKeys(Request $request)
    {
        return $this->objKeysService->getUserPositionKeys($request);
    }

}
