<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //for the api

    public function index(){

        return response()->json([
            'status' => 'error',
            'message' => 'You are in API Auth, no parameter found',
            'code'=>'505'
        ]);
    }
}
