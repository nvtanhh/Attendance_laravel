<?php

namespace App;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements Jsonable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'studentid','name', 'email','password','person_id','is_trained','group','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];


    public function groups(){
        return $this->belongsToMany(Group::class,'user_group');
    }
    public function ownergroups(){
        return $this->hasMany(Group::class);
    }

}
