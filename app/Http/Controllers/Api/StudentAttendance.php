<?php

namespace App\Http\Controllers\Api;

use App\AttendRecord;
use App\Http\Controllers\Controller;
use App\Jobs\UploadAvatarStudentToServer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $folder = storage_path('app/public/' . $user->studentid . '/');
        $files = File::allFiles($folder);
        if (sizeof($files) >= 8) {
            UploadAvatarStudentToServer::dispatch($user->id)->onQueue('addface');
        }
    }
    //
//    public function
    public function attendance(Request $request){
        $groupid= $request->groupid;
        $time = $request->time;
        $longtitude = $request->longtitude;
        $latitude =$request->latitude;
        $avatar = $request->file('avatar');
        $user = Auth::user();
        if ($user->studentid == null) {
            return response()->json(['status' => 'false', 'mes' => 'StudentId not found']);
        }
        $attendrecord = new AttendRecord();
        $attendrecord->user_id =$user->id;
        $attendrecord->group_id =$groupid;
        $attendrecord ->created_at =now();
        $attendrecord->save();

        $folder = storage_path('app/public/' . $user->studentid . '/');
        //tao folder neu chua ton tai
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder, 0775, true, true);
        }
        $folder = $folder.'avatar/';        //
        //tao folder neu chua ton tai
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder, 0775, true, true);
        }
        if (!empty($files)) {
            // luu file vao folder
            $files->move($folder, $files->getClientOriginalName() . $files->getExtension());

        }
    }
}
