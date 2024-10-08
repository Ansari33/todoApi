<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
   

    public function register(Request $request){
        $result = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->username
        ]);

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 201,
                'mesage' => 'User Registered!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'status_code' => 500,
        'mesage' => 'User Register Failed!'],500);
    }
}