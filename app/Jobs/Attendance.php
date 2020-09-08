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

class Attendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $recordid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recordid)
    {
        $this->recordid = $recordid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $atendance = \App\Attendance::where('id', $this->recordid)->first();
        $user = User::where('id', $atendance->user_id)->first();
        $personId =$user->person_id;
        $folder = public_path('/storage/' . $user->studentid . '/avatar/');
        $client = new Client();
        $url = "https://japaneast.api.cognitive.microsoft.com/face/v1.0/detect?returnFaceId=true&returnFaceLandmarks=false&recognitionModel=recognition_03&returnRecognitionModel=true&detectionModel=detection_01";
        foreach (File::allFiles($folder) as $allFile) {
            $params = [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => '6dc614d04b9c48079b19318c647e733f',
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => fopen($allFile, 'r'),
            ];
            $respen = $client->request("POST", $url, $params);
            error_log($respen->getBody());
            // dung 3s
            sleep(3);
            // check status
            if ($respen->getStatusCode() == 200) {
                try {
                    $jsonde =json_decode($respen->getBody());
                    $faceId =$jsonde[0]->{'faceId'};
                    // reconigh face
                    $client = new \Subsan\MicrosoftCognitiveFace\Client("6dc614d04b9c48079b19318c647e733f", "japaneast");
                    $response = $client->face()->identify([$faceId],'ai');
                    $jsonde = json_decode(json_encode($response));
                    // get candidates chua personid
                    $jsonde = $jsonde[0]->{'candidates'};
                    // lay personid de so sanh vs user
                    $jsonde = $jsonde[0]->{'personId'};
                    error_log($personId);
                    error_log($jsonde);
                    // dang personid in db thi change record =1 da diem danh
                    if($jsonde==$personId){
                        $atendance->status=1;
                        $atendance->save();
                        File::delete($allFile);
                        return 1;
                    }else{
                        // khon bang thu lai
//                       Attendance::dispatch($this->recordid)->onQueue('addface');
                       return 0;
                    }
                } catch (JsonException $s) {

                    return $s;
                }

            }
        }
    }
}
