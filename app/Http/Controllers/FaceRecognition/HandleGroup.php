<?php

namespace App\Http\Controllers\FaceRecognition;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Subsan\MicrosoftCognitiveFace\Client;
use Subsan\MicrosoftCognitiveFace\Entity\PersonGroup;
require_once 'vendor/autoload.php';
class HandleGroup extends Controller
{
    public function createGroup(Request $request){
        $group = Group::created([
            'name'=>$request->name,
            'identify'=>uniqid(),
            'description'=>$request->description,
            'owner'=>Session::get('auth')->id,
            'location_id'=>$request->location
        ]);
        $group->save();
    }
    public function createGroupAPI($group){
        $client= new Client(env('FACE_SERVER_KEY1',""),env('FACE_SERVER_LOCATION',""));
        $client->personGroup($group->identify)->create(new PersonGroup(null,$group->name,$group->description));
    }

}
