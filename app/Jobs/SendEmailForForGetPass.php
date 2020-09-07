<?php

namespace App\Jobs;

use App\Mail\ForgetPass;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForForGetPass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // tao randomkey và lưu user vs randomkey va thoi gian tao
        $key = openssl_random_pseudo_bytes(200);
        $time = now();
        $hash = md5($key . $time);
        Mail::to($this->user->email)->send( new ForgetPass($this->user->email, $hash));
        $this->user->random_key = $hash;
        $this->user->key_time = Carbon::now();
        $this->user->save();
    }
}
