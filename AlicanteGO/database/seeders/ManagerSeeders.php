<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagerSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('managers')->delete();

        Manager::create(
            'Jose Rodriguez',
			'741952486M',
			'648221664',
            '4',
            null,
            '2'
        );	
    }
}
