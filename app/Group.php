<?php

namespace App;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Jsonable
{
    protected $table ="groups";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'owner', 'location_id', 'room'
    ];

    //
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }

    public function groupOwner(){
        return $this->belongsTo(User::class,'owner');
    }
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function attendRecord()
    {
        return $this->belongsTo(Attendrecord::class);
    }

}
