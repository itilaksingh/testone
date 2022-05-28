<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_family_type extends Model
{
    protected $table = 'user_family_type';

    protected $fillable = [
        'user_id','family_type_id'
    ];
    
    public $timestamps = true;
}
