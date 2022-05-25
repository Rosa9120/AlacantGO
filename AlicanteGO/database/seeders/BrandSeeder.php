<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete the table data
	\DB::table('brands')->delete();
	// Add a new entry to the table
	\DB::table('brands')->insert([
		'name' => 'Burger King',
		'isin' => 'CA76131D1033',
		'img_url' => '/storage/burgerking.jpg']);
	\DB::table('brands')->insert([
		'name' => 'The Good Burger',
		'isin' => 'CA8765111064',
		'img_url' => '/storage/tgb.jpg']);
	\DB::table('brands')->insert([
		'name' => 'McDonald\'s',
		'isin' => 'US5801351017',
		'img_url' => '/storage/mcdonalds.jpg']);
    }
}
