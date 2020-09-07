<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendance extends Controller
{
    //
    public function getListClass(){
        $user = Auth::user();
        $user = User::where('id',$user->id)->first();
        $classs[] = $user->groups;
        return response()->json($classs);
    }
}
