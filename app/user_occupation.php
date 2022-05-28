<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_occupation extends Model
{
    protected $table = 'user_occupation';

    protected $fillable = [
        'user_id','occupation_id'
    ];
    
    public $timestamps = true;
}
