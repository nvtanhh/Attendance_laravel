<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadAvatarStudentToServer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $persondId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($persondId)
    {
        $this->$persondId=$persondId;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
