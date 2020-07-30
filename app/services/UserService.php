<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{

    public function signUp($request){

        $request['password'] = bcrypt($request->password);
        $request['avatar'] = 'storage/'.Storage::Disk('local')->put('avatars',$request->file('avatar'));
        $user = User::create($request->toArray());
        return $user;
    }

    public function logIn($check){
        if ($check) {
            $user = Auth::user();
            $token = $user->createToken('faydety')->accessToken;
            return response()->json(['auth-token' => $token],201);
        }else{
            return response()->json('wrong phone number or password',401);
        }
    }

}
