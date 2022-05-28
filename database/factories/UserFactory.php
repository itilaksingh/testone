<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['m', 'f']);
    $manglik = $faker->randomElement(['yes', 'no', 'both']);
    $annual_income_s = rand('300000', '5000000');
    $annual_income_e = rand('300000', '5000000');

    $nameArr=explode(' ', $faker->name);
    $img = $faker->randomElement(['https://i.pravatar.cc/300', 'https://www.w3schools.com/howto/img_avatar.png']);
    $first_name='';
    $last_name='';
    if(count($nameArr)>1){
        $first_name=@$nameArr[0];
        $last_name=@$nameArr[1];
    }else{
        $first_name= $user->name;
        $last_name= $user->name;
    }

    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'gender'=>$gender,
        'annual_income'=>$annual_income_s.'-'.$annual_income_e,
        'avatar'=>$img,
        'dob'=>randomDate('2004-01-05', '1980-01-05'),
        'manglik'=>$manglik,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

 function  randomDate($start_date, $end_date)
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    $val = rand($min, $max);

    return date('Y-m-d', $val);
}
