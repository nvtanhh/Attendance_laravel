<?php

namespace App\Jobs;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use League\Flysystem\FileNotFoundException;

class UploadAvatarStudentToServer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userid)
    {
        $this->userid = $userid;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where('id', $this->userid)->first();
        if ($user==null) return "null";
        if($user->is_trained !='1') return "-1";

        $folder = storage_path('app/public/' . $user->studentid . '/');
        $client = new Client();
        $url = "https://japaneast.api.cognitive.microsoft.com/face/v1.0/persongroups/ai/persons/"
            . $user->person_id . "/persistedFaces?detectionModel=detection_01";
        try {
            $a =0;
            foreach (File::allFiles($folder) as $allFile) {
                $params = [
                    'headers' => [
                        'Ocp-Apim-Subscription-Key'=>'6dc614d04b9c48079b19318c647e733f',
                        'Content-Type' => 'application/octet-stream',
                    ],
                    'body' => fopen($allFile,'r'),
                ];
                $respen =$client->request("POST",$url,$params);
                // check status
                if($respen->getStatusCode()==200){
                    try {
                        if(json_decode($respen->getBody())->{'persistedFaceId'}!=null)
                            $a++;
                    }catch (JsonException $s){
                        return $s;
                    }

                }
                // dung 4s
                sleep(4);
            }
            if($a>8){
                $user->is_trained='2';
                $user->save();
                File::deleteDirectories($folder);
                return ;
            }else{
                return;
            }

        } catch (FileNotFoundException $e) {
            print $e;
        }
    }
}
