<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert([
		'name' => 'Burger'
	]);
	\DB::table('categories')->insert([
		'name' => 'Pizza'
	]);
	\DB::table('categories')->insert([
		'name' => 'Mexican'
	]);
	\DB::table('categories')->insert([
		'name' => 'Indian'
	]);
	\DB::table('categories')->insert([
		'name' => 'Chinese'
	]);
	
	
	$BK = \DB::table('categories')->where('name', 'Burger')->first()->id;
	\DB::table('establishments')->where('name', 'Burger King Paseo')->update(['category_id' => $BK]);
	\DB::table('establishments')->where('name', 'Burger King Renfe')->update(['category_id' => $BK]);
	\DB::table('establishments')->where('name', 'Burger King Calle Colombia')->update(['category_id' => $BK]);
	\DB::table('establishments')->where('name', 'McDonald\'s Esplanada')->update(['category_id' => $BK]);
	\DB::table('establishments')->where('name', 'McDonald\'s Avenida de Dénia')->update(['category_id' => $BK]);
	\DB::table('establishments')->where('name', 'McDonald\'s Calle Ciudad Real')->update(['category_id' => $BK]);

    }
}
