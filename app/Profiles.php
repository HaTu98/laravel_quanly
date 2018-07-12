<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = "profiles";
    protected $fillable = [
         'first_name', 'last_name','date_of_birth','position','gender',
         'home_address','phone_number',
    ];
    public $timestamps = false;
    protected $primaryKey = 'user_id';
}
