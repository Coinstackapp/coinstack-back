<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

class RegisterController extends Controller
{
    public function userRegistration(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $findUser = User::where('email', '=', $request->email)->select('*')->get()->first();
        // dd($findUser);
        if ($findUser){
            return response()->error('Email Already Registered', 401);
        }

        $user = User::create([
            'name'              => $request->name,
            'email'          => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        $token = $user->createToken('My Token')->accessToken;

        return response()->success(compact('user', 'token'));
    }
}
