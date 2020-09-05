<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];
    //
   public function users(){
        return $this->belongsToMany(User::class,'user_group');
    }
    public function location(){
       return $this->hasOne(Location::class);
    }
    public function attendRecord(){
       return $this->belongsTo(AttendRecord::class);
    }

}
