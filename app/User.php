<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\user_family_type;
use App\user_occupation;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',  'last_name', 'email', 'password','gender','dob', 'annual_income','manglik',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function occupation()
    {
        return $this->hasMany(user_occupation::class);
    }

    public function familyType()
    {
        return $this->hasMany(user_family_type::class);
    }


    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
    
}
