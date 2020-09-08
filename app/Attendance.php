<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="attendances";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','group_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function groups(){
        return $this->hasMany(Group::class);
    }
    public $timestamps = false;
}
