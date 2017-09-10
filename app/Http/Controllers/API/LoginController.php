<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json('Invalid Email or password', 401);
            }
        } catch (\JWTException $e) {
            return response()->json('Could not create token', 500);
        }

        $user = Auth::user();
        return response()->json(compact('user', 'token'));
    }

    public function refreshToken()
    {
        $token = Auth::refresh();

        return response()->success(compact('token'));
    }
}