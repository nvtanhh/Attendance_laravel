<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendRecord extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }
    public function groups(){
        return $this->hasMany(Group::class);
    }
}
