<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function doLogin(Request $r)
    {
        // Check the session whether being locked or not
        if ($this->isNotLocked()) {

            if (Session::has('lockLogin') && !(Carbon::now()->subMinutes(5) > session('lockLogin'))) {
                session()->forget('loginAttempt');
                session()->forget('reCaptcha');
                session()->forget('lockLogin');
            }
            // validate
            $r->validate([
                'email' => 'required|email',
                'pass' => 'required|min:8',
            ]);
            // validate reCaptcha
            if (Session::has('reCaptcha')) {
                $token = $r->input('g-recaptcha-response');
                if ($token <= 0) {
                    return redirect()->back()->withInput($r->only('email'))->withErrors(['captcha' => 'Are you human?']);
                }
            }

            // create new user
            $user = User::where('email', $r->email)
                ->where('active', 1)
                ->first();
            // check
            if ($user && Hash::check($r->get('pass'), $user->password)) {
                Session::put('auth', $user);

                session()->forget('loginAttempt');
                session()->forget('reCaptcha');
                session()->forget('blockLogin');

                return redirect('/');
            } else {
                // count attempt failed
                $this->attemptsLoginFailed();
                return redirect()->back()
                    ->withInput($r->only('email'))
                    ->withErrors(['mes' => 'Your Email or Password is incorrect']);
            }
        } else {
            return redirect()->route('login')->withErrors(['lock' => true]);
        }
    }

    public function logout()
    {
        session()->forget('auth');
        return redirect('/');
    }



    private function attemptsLoginFailed()
    {
        // get loginAttempt form from session default value is 1
        $attempts = session('loginAttempt', 1);
        session(['loginAttempt' => $attempts + 1]);
        if ($attempts >= 3) {
            session(['reCaptcha' => true]);
        }
        if ($attempts >= 6) {
            // put current time to session
            session(['lockLogin' => Carbon::now()]);
            session()->forget('loginAttempt');
            session()->forget('reCaptcha');
        }
    }
    private function isNotLocked()
    {
        // lock for 5 minutes ??
        return (!Session::has('lockLogin')) || (Carbon::now()->subMinutes(5) > session('lockLogin'));
    }
}
