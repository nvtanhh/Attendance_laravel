<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = \Socialite::driver($provider)->user();  // get user information from provider
        $user = $this->createUser($getInfo, $provider);  // create user
        // auth()->login($user);
        Session::put('auth', $user); 
        return redirect('/');
    }

    function createUser($getInfo, $provider)
    {
        if (is_null($getInfo->email)) { // if information is null 
            return view('login')->withErrors(['mes' => 'resource is not available']);   // return view and show error
        }
        $user = User::where('email', $getInfo->email)->first();  // find user by email in DB
        if (!$user) {  // if user wasn't found
            $user = User::create([  // create new user
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
