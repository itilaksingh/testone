<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\family_type;

class familyType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        family_type::create(['name' => 'Joint family', ]);
        family_type::create(['name' => 'Nuclear  family', ]);

    }
}
