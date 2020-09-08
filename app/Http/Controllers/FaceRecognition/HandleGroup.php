<?php

namespace App\Http\Controllers\FaceRecognition;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HandleGroup extends Controller
{
    public function createGroup(Request $request)
    {
        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner' => Session::get('auth')->id,
            'location_id' => $request->location,
            'room' => $request->room
        ]);
        return redirect('/');
    }

    public function showGroup($id)
    {
        $group = Group::where('id',$id)->get();
        return view('class', ['group' => $group]);
    }


}
