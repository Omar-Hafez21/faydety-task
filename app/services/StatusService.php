<?php

namespace App\Services;

use App\Status;
use App\User;
use Illuminate\Support\Facades\Auth;


class StatusService
{

    public function createStatus($request){
        $user = Auth::user();
        $user = Status::create([
            'user_id' => $user->id,
            'status' => $request->status,
        ]);
        return response()->json('status created successfully',201);
    }

}
