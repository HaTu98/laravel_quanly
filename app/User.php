<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isAdmin'
    ];

    public function LienKet(){
        return $this->hasMany(times::class);
    }

    public function userProfiles(){
        return $this->hasone('App\Profiles','user_id','user_id');
    }

    public function userPositions(){
        return $this->belongsToMany('App\positions');
    }
    protected $primaryKey = 'user_id';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
