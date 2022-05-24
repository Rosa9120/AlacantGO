<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$BK = \DB::table('brands')->where('name', 'Burger King')->first()->id;
		$TGB = \DB::table('brands')->where('name', 'The Good Burger')->first()->id;
		$MD = \DB::table('brands')->where('name', 'McDonald\'s')->first()->id;

		\DB::table('establishments')->delete();
		// Add a new entry to the table
		\DB::table('establishments')->insert([
			'name' => 'Restaurante L\'alacanti',
			'address' => 'C. Álvarez Sereix, 10',
			'postal_code' => '03001',
			'latitude' => '38.34598563809095',
			'longitude' => '-0.48890237064772996',
			'img_url' => '/storage/lalacanti.jpg',
		]);

		\DB::table('establishments')->insert([
			'name' => 'SOHO PLAZA',
			'address' => 'Plaça de l\'Ajuntament, 7',
			'postal_code' => '03002',
			'latitude' => '38.34660685077837',
			'img_url' => '/storage/soho.jpg',
			'longitude' => '-0.4807297838516754'
		]);

		\DB::table('establishments')->insert([
			'name' => 'La Cocina',
			'address' => 'C. José Gutiérrez Petén, 10',
			'postal_code' => '03004',
			'latitude' => '38.34938516538533',
			'img_url' => '/storage/lacocina.jpg',
			'longitude' => '-0.4871595194473304'
		]);

		\DB::table('establishments')->insert([
			'name' => 'Madness Specialty Cofee',
			'address' => 'C. San Nicolás, nº4, Bajo',
			'postal_code' => '03002',
			'latitude' => '38.34558581212322',
			'longitude' => '-0.4819446993979722',
			'img_url' => '/storage/madnesscoffee.jpg'
		]);

		\DB::table('establishments')->insert([
			'name' => 'Burger King Paseo',
			'address' => 'Passeig Esplanada d\'Espanya, 4',
			'postal_code' => '03002',
			'latitude' => '38.3444660895255',
			'longitude' => '-0.4817486229803378',
			'img_url' => '/storage/burguerpaseo.jpg',
			'brand_id' => $BK
		]);

		\DB::table('establishments')->insert([
			'name' => 'Burger King Renfe',
			'address' => 'Frente a Renfe, Av. Salamanca, 4Bis',
			'postal_code' => '03006',
			'latitude' => '38.3437087611985',
			'longitude' => '-0.4941248148288982',
			'img_url' => '/storage/burguerrenfe.jpg',
			'brand_id' => $BK
		]);

		\DB::table('establishments')->insert([
			'name' => 'Burger King Calle Colombia',
			'address' => 'C. Colombia, 27',
			'postal_code' => '03010',
			'latitude' => '38.36625512805321',
			'longitude' => '-0.4857488602153263',
			'img_url' => '/storage/burguercolombia.jpg',
			'brand_id' => $BK
		]);

		\DB::table('establishments')->insert([
			'name' => 'McDonald\'s Esplanada',
			'address' => 'Passeig Esplanada d\'Espanya, 8',
			'postal_code' => '03002',
			'latitude' => '38.34402912331139',
			'longitude' => '-0.4825133277066535',
			'img_url' => '/storage/mcexplanada.jpg',
			'brand_id' => $MD
		]);

		\DB::table('establishments')->insert([
			'name' => 'McDonald\'s Avenida de Dénia',
			'address' => 'Avd de Dénia, s/n, Plaza Mar, 2, Centro comercial',
			'postal_code' => '03016',
			'latitude' => '38.35564281200154',
			'longitude' => '-0.4720150441895938',
			'img_url' => '/storage/mcdenia.jpg',
			'brand_id' => $MD
		]);

		\DB::table('establishments')->insert([
			'name' => 'McDonald\'s Calle Ciudad Real',
			'address' => 'C. Cdad. Real, 28',
			'postal_code' => '03005',
			'latitude' => '38.354847040776704',
			'longitude' => '-0.4983531711735167',
			'img_url' => '/storage/mcciudadreal.jpg',
			'brand_id' => $MD
		]);

		\DB::table('establishments')->insert([
			'name' => 'TGB Portal de Elche',
			'address' => 'Pl. Portal de Elche, 03001',
			'postal_code' => '03003',
			'latitude' => '38.344249509605945',
			'longitude' => '-0.4837816507142489',
			'img_url' => '/storage/tgbelche.jpg',
			'brand_id' => $TGB
		]);

		\DB::table('establishments')->insert([
			'name' => 'TGB Luceros',
			'address' => 'Pl. de los Luceros, 7',
			'postal_code' => '03003',
			'latitude' => '38.345574014748976',
			'longitude' => '-0.4908615970320252',
			'img_url' => '/storage/tgbluceros.jpg',
			'brand_id' => $TGB
		]);
	}
}
