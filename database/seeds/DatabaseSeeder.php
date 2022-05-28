<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            familyType::class,
        ]);
        $this->call([
            occupationSeeder::class,
        ]);
        $this->call(UserSeeder::class);
        $this->call(adminSeeder::class);

    }
}


