<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendRecord extends Model
{
    protected $table = "attendrecords";

    public function users(){
        return $this->hasMany(User::class);
    }
    public function groups(){
        return $this->hasMany(Group::class);
    }
}
