<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Tilak',
            'last_name' => 'Singh',
            'gender' => 'm',
            'email' => 'admin@gmail.com',
            'is_supper_admin' => 1,
            'password' => Hash::make('admin'),
        ]);
    }
}
