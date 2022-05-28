<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class occupation extends Model
{
    protected $table = 'occupation';

    protected $fillable = [
        'name',
    ];
    
    public $timestamps = true;

 
}
