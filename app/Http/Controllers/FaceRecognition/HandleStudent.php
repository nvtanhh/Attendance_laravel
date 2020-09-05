<?php

namespace App\Http\Controllers\FaceRecognition;

use App\Group;
use App\Http\Controllers\Controller;
use App\Mail\InviteToClass;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Subsan\MicrosoftCognitiveFace\Client;
use Subsan\MicrosoftCognitiveFace\Entity\Person;

require_once 'vendor/autoload.php';

class HandleStudent extends controller
{
    function createStudent($studentid, $name, $email, $groupid)
    {
        // new user
        $user = new User($studentid, $name, $email);
        // save user
        $user->save();
        // add new row pivot
        $user->groups()->attach($groupid);
        // send email invite sutdent
        $this->sendMail($user);
        //save personid get from ApiServer
        $this->getPersonId($user);
    }

    public function sendMail($user)
    {
        $password = $this->generateRandomString(8);
        $user->password = Hash::make($password);
        $user->save();
        Mail::to($user->email)->send(new InviteToClass($user->email, $password));
    }

    function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getPersonId( $user)
    {
        $client = new Client(env('FACE_SERVER_KEY1', ""), env('FACE_SERVER_LOCATION', ""));
        $person = $client->personGroup('ai')->person()->create(new Person(null, $user->name));
        $user->person_id = $person->getPersonId();
        $user->save();
    }

}
