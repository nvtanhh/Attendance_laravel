<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserUploadImage extends Controller
{
    //
    public function storeImage(Request $request)
    {
        $files = $request->file('image');
        $user = Auth::user();
        if ($user->studentid == null) {
            return response()->json(['status' => 'false', 'mes' => 'StudentId not found']);
        }
        $folder = public_path('/storage/' . $user->studentid . '/');
        //tao folder neu chua ton tai
//        return $folder;
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775);
        }
        //
        if (!empty($files)) {
            // luu file vao folder
            $files->move($folder, $files->getClientOriginalName() . $files->getExtension());
            // dem danh sach file trong folder
            $countfiles = sizeof(File::allFiles($folder));
            return response()->json(['status' => 'true', 'mes' => 'Upload Done', 'files' => $countfiles]);
        }
        return response()->json(['status' => 'false', 'mes' => 'File not found']);
    }

    public function deleteAll()
    {
        $user = Auth::user();
        File::deleteDirectories(public_path('/storage/' . $user->studentid . '/'));
        return response()->json(['status' => 'true', 'mes' => 'Upload Done']);
    }
}
