<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
			'password' => bcrypt('adminadmin'),
			'rol' => 'admin'
        ]);

        User::create([
            'name' => 'Jose',
            'email' => 'jose@jose.com',
			'password' => bcrypt('jose'),
			'rol' => 'manager'
        ]);

        User::create([
            'name' => 'Ilyan',
            'email' => 'ilyan@ilyan.com',
			'password' => bcrypt('ilyan'),
			'rol' => 'manager'
        ]);

        User::create([
            'name' => 'rosa',
            'email' => 'rosa@rosa.com',
			'password' => bcrypt('rosa'),
			'rol' => 'manager'
        ]);
    }
}
