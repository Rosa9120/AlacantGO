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
        DB::table('managers')->delete();

        Manager::create([
            'name' => 'Amancio Ortega',
			'DNI' => '60484884G',
			'phone' => '658321258'
        ]);

        Manager::create([
            'name' => 'Jose Rodriguez',
			'DNI' => '741952486M',
			'phone' => '648221664'
        ]);

        Manager::create([
            'name' => 'Elena Martínez',
			'DNI' => '23548312F',
			'phone' => '864234944'
        ]);
	

    }
}
