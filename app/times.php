<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class times extends Model
{	
	protected $table = "times";
    protected $fillable = [
         'start', 'finish',
    ];
    public $timestamps = false;
}
