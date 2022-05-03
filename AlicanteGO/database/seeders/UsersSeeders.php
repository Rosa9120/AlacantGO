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
    }
}
