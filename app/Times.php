<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $table = "times";
    protected $fillable = [
        'start', 'finish',
    ];
    public $timestamps = false;
    protected $primaryKey = 'time_id';

}
