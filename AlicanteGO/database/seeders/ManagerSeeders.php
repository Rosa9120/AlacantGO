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
            'Amancio Ortega',
			'60484884G',
			'658321258',
            '1',
            '1'
        );

        Manager::create(
            'Jose Rodriguez',
			'741952486M',
			'648221664',
            '4',
            null
        );

        Manager::create(
            'Elena Martínez',
			'23548312F',
			'864234944',
            null,
            '3'
        );
	

    }
}
