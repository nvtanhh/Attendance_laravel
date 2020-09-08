<?php

namespace App\Http\Controllers\FaceRecognition;

use App\Group;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailForInvite;
use App\Mail\InviteToClass;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Subsan\MicrosoftCognitiveFace\Client;
use Subsan\MicrosoftCognitiveFace\Entity\Person;

class HandleStudent extends controller
{
    function createStudent(Request $request)
    {
        $email = $request->email;
        $groupid = $request->group;
        $user = User::where('email', $email)->first();
        if ($user == null) {
            // new user
            $user = User::create([
                'name' => $request->fullname,
                'studentid' => $request->studentid,
                'email' => $request->email,
                'active' => 1
            ]);
            
            // add new row pivot
            $user->groups()->attach($groupid);
            // send email invite sutdent
           SendEmailForInvite::dispatch($user)->onQueue('sendemail');
            //save personid get from ApiServer
            $this->getPersonId($user);

            return redirect()->route('group', ['id' => $groupid])->with(['mes' => "add student success"]);
        } else {
            // kiem tra user da co trong group hay chua
            $group = Group::where('id', $groupid)->first();
            $a = $group->users()->where('id', $user->id)->get();/*->where('id',$user->id)->get();*/
            // chua co
            if (sizeof($a) == 0) {
                // add data in pivot
                $user->groups()->attach($groupid);
                return redirect()->route('group', ['id' => $groupid])->with(['mes' => "add student success"]);
            } else {
                return redirect()->route('group', ['id' => $groupid])->with(['mes' => "students already exist in the group"]);
            }

        }

    }

    public function getPersonId($user)
    {
        $client = new Client("6dc614d04b9c48079b19318c647e733f", "japaneast");
        $person = $client->personGroup('ai')->person()->create(new Person(null, $user->studentid));
        $user->person_id = $person->getPersonId();
        $user->save();
    }

}
