<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPass;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function showForgetPass()
    {
        return \view('forgot-pass');
    }

    public function doForgetPass(Request $request)
    {
        // validate emal dung dinh dang
        $request->validate([
            'email' => 'required|email',
        ], $this->messages());
        // get user tu trong db de so sanh
        $u = User::select('id', 'email')
            ->where('email', '=', $request->email)
            ->where('active', '=', '1')->get();

        if (count($u) == 1) {
            // tao randomkey và lưu user vs randomkey va thoi gian tao
            $key = openssl_random_pseudo_bytes(200);
            $time = now();
            $hash = md5($key . $time);
            Mail::to($request->input('email'))->send(new ForgetPass($request->input('email'), $hash));
            $u[0]->random_key = $hash;
            $u[0]->key_time = Carbon::now();
            $u[0]->save();
            //trả vè view vưới mesgage da gửi email yêu cầu check mail
            return redirect()->route('verify')->with('mes', 'forgot');
        } else {
            // thông báo lỗi email khong ton tại
            return \redirect()->back()->withErrors(['mes' => "Email doesn't exist"])
                ->withInput($request->only('email'));
        }
    }

    public function doConfirmPassword($email, $key)
    {
        // get user từ db
        $u = User::select('id', 'email', 'random_key', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('active', '=', '1')->get();
        // kiểm tra email và randomekey
        if (count($u) == 1 && $u[0]->email == $email && $u[0]->random_key == $key) {
            $kt = Carbon::createFromFormat('Y-m-d H:i:s', $u[0]->key_time);
            $kt->addHours(24);
            $now = Carbon::now();
            // kiểm tra key dã hết hạn hay chưa
            if ($now->lt($kt) == true) {

                return view('reset-pass')->with([
                    'email' => $email,
                    'key' => $key,
                ]);
            } else {
                // trả về view với htoong báo email hết hạn
                return redirect('notify')->withErrors('mes', 'Email is expired');
            }
        } else {
            // trả về view với thông báo link này đã đc sử dụng
            return redirect('notify')->withErrors(['mes' => 'This link is only use once!']);
        }
    }

    public function resetPass($email, $key, Request $request)
    {
        // kiem tra password hop le
        $request->validate([
            'pass' => 'required|min:8',
            'repass' => 'required|same:pass',
        ], $this->messages());
        // get user từ db ra để so sánh
        $u = User::select('id', 'email', 'random_key', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('active', '=', '1')->get();
        // kiểm tra user có tồn tại hay k
        // thay đổi password user thang passowrd mới
        if (count($u) == 1 && $u[0]->email == $email) {
            $u[0]->password = Hash::make($request->pass);
            $u[0]->random_key = '';
            $u[0]->save();
            return redirect('login')->with('ok', 'Password was changed!');
        }
    }
    // hàm trả về các lỗi khi validate
    private function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Wrong email format.',
            'pass.required' => 'Password is required.',
            'pass.min' => 'Password is required at least 8 characters',
            'repass.required' => 'RePassword is required.',
            'repass.same' => 'Password and repassword do not match.',
        ];
    }
}
