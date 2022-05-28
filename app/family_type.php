<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class family_type extends Model
{
    protected $table = 'family_type';

    protected $fillable = [
        'name',
    ];

    
    
    public $timestamps = true;

   

}
