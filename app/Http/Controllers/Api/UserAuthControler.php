<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthControler extends Controller
{
    function login()
    {
        // kiem tra user trong database
        if (Auth::attempt(['email' => \request('email'), 'password' => \request('password')])) {
            // laays user tu database
            $user = Auth::user();
            // get accesstoken
            $accessToken = $user->createToken('AccessToken');
            // tra vee json chứa accesstoken
            $accessToken->token->save();
            return response()->json([
                'access_token' => $accessToken->accessToken,
                'is_trained' => $user->is_trained,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $accessToken->token->expires_at
                )->toDateTimeString()
            ]);
        } else {
            return response()->json(['mesage' => 'Unauthorized']);
        }
    }

    function logout()
    {
        // xoa token trong table user
        \request()->user()->token()->revoke();
        return response()->json([
            'status' => "200",
            'message' => 'Successfully logged out'
        ]);
    }

    function register()
    {
        request()->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        $user = new User([
            'email' => \request('email'),
            'password' => Hash::make(\request('password'))
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    // get thong tin user
    function user(Request $request)
    {
        return response()->json($request->user());
    }
}
