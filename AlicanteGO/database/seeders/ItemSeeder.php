<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->delete();
        
        $ID = \DB::table('establishments')->where('name', 'Restaurante L\'alacanti')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Tiras de pollo',
		'price' => '9',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Queso brie frito',
		'price' => '7',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Huevos rotos con jamón',
		'price' => '10',
		'establishment_id' => $ID]);
	
	
	$ID = \DB::table('establishments')->where('name', 'La Cocina')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Menú 1',
		'price' => '12.90',
		'description' => 'Ensaladilla rusa o patatas bravas.
					Calamares andaluza o salteada de verduras.
					Croquetas caseras 2uds. p/p.
					Mini hamburguesa o Arepa.

					Bebida:
					Jarra de cerveza o Jarra de tinto de verano.
					Botella de vino de la casa.',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Menú 2',
		'price' => '11.50',
		'description' => 'Croquetas caseras 2uds y tequeños 2uds.
					Patatas strogonof o salteado de verduras.
					Mini hamburguesa o Arepa.

					Bebida:
					Caña/Tinto de verano/Refresco.',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Ensalada de tomate rallado con salazones',
		'price' => '12.90',
		'description' => '(Hueva de atún, Mojama y Bacalao)',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Solomillo de cerdo trinchado con ajetes',
		'price' => '11.90',
		'establishment_id' => $ID]);
	
	
	$ID = \DB::table('establishments')->where('name', 'Madness Specialty Cofee')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Benedictos de salmón',
		'price' => '7',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Tarta Red Velvet',
		'price' => '4',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Tostada o croissant con bacon',
		'price' => '3',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Iced latte',
		'price' => '3',
		'establishment_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Café japonés',
		'price' => '4',
		'establishment_id' => $ID]);
	
	
	$ID = \DB::table('brands')->where('name', 'Burger King')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Whopper',
		'price' => '4.10',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Doble cheese bacon XXL',
		'price' => '5.95',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Patatas clásicas',
		'price' => '2.40',
		'brand_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Paseo')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Gofre caliente con sirope',
		'price' => '2.80',
		'establishment_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Renfe')->first()->id;
	\DB::table('items')->insert([
		'name' => 'BK muffin',
		'price' => '1.50',
		'establishment_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Calle Colombia')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Alitas',
		'price' => '2.20',
		'establishment_id' => $ID]);
	
	
	$ID = \DB::table('brands')->where('name', 'The Good Burger')->first()->id;
	\DB::table('items')->insert([
		'name' => 'TGB Burger',
		'price' => '3.50',
		'description' => 'Carne, queso americano, bacon, lechuga, tomate y salsa TGB',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'BBQ',
		'price' => '3.50',
		'description' => 'Carne, bacon, aros de cebolla y salsa BBQ',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Cheeseburger',
		'price' => '2.40',
		'description' => 'Carne, queso americano, lechuga, tomate y salsa TGB',
		'brand_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'TGB Portal de Elche')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Hot dog',
		'price' => '1.50',
		'description' => 'Ketchup y mostaza',
		'establishment_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'TGB Luceros')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Hot dog',
		'price' => '1.50',
		'description' => 'Patatas paja, ali oli y bacon'
		'establishment_id' => $ID]);
	
	
	$ID = \DB::table('brands')->where('name', 'McDonald\'s')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Whopper',
		'price' => '4.10',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Doble cheese bacon XXL',
		'price' => '5.95',
		'brand_id' => $ID]);
	
	\DB::table('items')->insert([
		'name' => 'Patatas clásicas',
		'price' => '2.40',
		'brand_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Paseo')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Gofre caliente con sirope',
		'price' => '2.80',
		'establishment_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Renfe')->first()->id;
	\DB::table('items')->insert([
		'name' => 'BK muffin',
		'price' => '1.50',
		'establishment_id' => $ID]);
	
	$ID = \DB::table('establishments')->where('name', 'Burger King Calle Colombia')->first()->id;
	\DB::table('items')->insert([
		'name' => 'Alitas',
		'price' => '2.20',
		'establishment_id' => $ID]);
    }
}
