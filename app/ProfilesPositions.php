<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilesPositions extends Model
{
    protected $table = "profiles_positions";
    protected $primaryKey = 'profiles_positions_id';
    public $timestamps = false;
}
