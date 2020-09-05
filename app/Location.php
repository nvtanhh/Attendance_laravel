<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    public function group(){
        return $this->belongsTo(Group::class);
    }
}
