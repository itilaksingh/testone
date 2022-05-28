<?php

use Illuminate\Database\Seeder;
use App\occupation;

class occupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        occupation::create(['name' => 'Private  job', ]);
        occupation::create(['name' => 'Government job', ]);
        occupation::create(['name' => 'Business']);


    }
}
