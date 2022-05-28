<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 100)->make()->toArray();

        foreach ($users as $user) {
            App\User::create($user);
        }
    }
}
