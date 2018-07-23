<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profiles_log extends Model
{
	
    protected $table = "profiles_log";
    protected $primaryKey = 'action_id';
}

