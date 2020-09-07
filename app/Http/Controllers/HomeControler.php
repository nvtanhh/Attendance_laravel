<?php

namespace App\Http\Controllers;

use App\Group;
use App\Location;
use Illuminate\Support\Facades\Session;

class HomeControler extends Controller
{
    //
    public function index()
    {
        if (Session::has('auth')) {
            $user = Session::get('auth');
            $groups = Group::where('owner', $user->id)->get();
            $locations =Location::select('*')->get();
            return view('home', ['user' => $user, 'groups' => $groups,'locations'=>$locations]);
        } else {
            return view('home');
        }
    }

}
