<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilesLog extends Model
{
    protected $table = "profiles_log";
    protected $primaryKey = 'action_id';
}

