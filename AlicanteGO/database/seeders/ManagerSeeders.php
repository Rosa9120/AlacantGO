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

        Manager::create(
            'Ilya Slyusarchuk',
			'123456789A',
			'660206515',
            '8',
            '3',
            '3'
        );	


        Manager::create(
            'Rosa Rodriguez',
			'50383873G',
			'686942928',
            null,
            null,
            '4'
        );	

    }
}
