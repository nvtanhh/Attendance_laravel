<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Attendance;
use App\Jobs\UploadAvatarStudentToServer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Subsan\MicrosoftCognitiveFace\Client;

class StudentAttendance extends Controller
{
    // lay danh sach mon hoc
    public function getListClass()
    {
        $user = Auth::user();
        $user = User::where('id', $user->id)->first();
        $classs[] = $user->groups;
        return response()->json($classs);
    }

    //them sinh vien vao danh sach addface
    public function changeStatusAlreadyTrain()
    {
        $user = Auth::user();
        $folder = public_path('/storage/' . $user->studentid . '/');
        $files = File::allFiles($folder);
        if (sizeof($files) >= 8) {
            UploadAvatarStudentToServer::dispatch($user->id)->onQueue('addface');
        }
    }
    //
//    public function
    public function attendance(Request $request){
        $groupid= $request->groupid;
//        $time = $request->time;
//        $longtitude = $request->longtitude;
//        $latitude =$request->latitude;
        $avatar = $request->file('avatar');
        $user = Auth::user();
        if ($user->studentid == null) {
            return response()->json(['status' => 'false', 'mes' => 'StudentId not found']);
        }
        // tao record diem danh status =0 chua dc diem danh
        $attendrecord = \App\Attendance::create([
            'user_id'=>$user->id,
            'group_id'=>$groupid
        ]);
        // folder chua
        $folder = public_path('/storage/' . $user->studentid . '/');

        //tao folder neu chua ton tai
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775);
        }
        $folder = $folder.'avatar/';        //
        //tao folder neu chua ton tai
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775);
        }
        // kiem tra iamge null
        if (!empty($avatar)) {
            // luu file vao folder
            $avatar->move($folder, $avatar->getClientOriginalName() . $avatar->getExtension());
            Attendance::dispatch($attendrecord->id)->onQueue('addface');
            return response()->json(['status'=>'processing']);
        }else{
            return  response()->json(['status'=>'fail','mes'=>'Image not found']);
        }
    }
    public function train(){
        $user = Auth::user();
        if($user->group!=1){
            return response()->json(['status'=>'You not have permission']);
        }
        $client = new Client("6dc614d04b9c48079b19318c647e733f", "japaneast");
        $client->personGroup('ai')->train();
    }
    public function statusTrain(){
        $user = Auth::user();
        if($user->group!=1){
            return response()->json(['status'=>'You not have permission']);
        }
        $client = new Client("6dc614d04b9c48079b19318c647e733f", "japaneast");
        return response( )->json($client->personGroup('ai')->getTrainStatus());
    }
}
