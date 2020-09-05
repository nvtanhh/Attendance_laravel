<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUploadImage extends Controller
{
    //
    public function storeImage(Request $request)
    {
        $files = $request->file('image');
        $folder = public_path('../public/storage/' . Auth::user()->studentid . '/');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder, 0775, true, true);
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                Storage::disk(['drivers' => 'local', 'root' => $folder])->put($file->getClientOriginalName(), file_get_contents($file));
            }
        }
    }
}
