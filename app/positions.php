<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class positions extends Model
{
    protected $table = "positions";
    protected $primaryKey = 'position_id';
     public $timestamps = false;
}
