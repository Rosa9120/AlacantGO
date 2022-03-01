<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Establishment;

class EstablishmentTest extends TestCase
{
    /**
     * Checks that it references an existing brand
     *
     * @return void
     */
    public function testRelationOfTheBrand()
    {
        $establishments = Establishment::all();

        foreach($establishments as $establishment) {
            $brand = $establishment->brand()->first();

            if ($brand != null) {
                $this->assertDatabaseHas('brands', [
                    'id' => $establishment->brand_id,
                    'name' => $brand->name,
                    'isin' => $brand->isin
                ]);
            }
        }
    }
}
