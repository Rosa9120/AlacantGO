<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(BrandSeeder::class);
        $this->call(EstablishmentSeeder::class);
        $this->call(ManagerSeeders::class);
        $this->call(ItemSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        
   
        
    }
}
