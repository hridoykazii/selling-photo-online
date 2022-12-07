<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class apiUserController extends Controller
{
    public function login()
    {
        $credentials = request()->only('name', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'status'=>'success',
            'token'=>$token
        ]);
    }
    public function logout()
    {
        JWTAuth::parseToken()->invalidate(\request()->bearerToken());
        return response()->json([
            'status'=>'logout success',

        ]);
    }
}
