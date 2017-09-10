<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

class RegisterController extends Controller
{
    public function userRegistration(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $findUser = User::where('email', '=', $request->email)->select('*')->get()->first();
        if ($findUser){
            return response()->error('Email Already Registered', 401);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();

            $token = JWTAuth::fromUser($user);

            return response()->success(compact('user','token', 'role'));
        } catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
