<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class ItemTest extends TestCase
{
    /**
     * Checks if it only has one establishment
     *
     * @return void
     */
    public function testCountOfTheEstablishment()
    {
        $items = Item::all();

        foreach($items as $item) {
            $count = count($item->establishment()->get());
            
            if ($count > 0) {
                $this->assertEquals(1, $count, 'Only one establishment can be assigned to one item');
            }
        }
    }

    /**
     * Checks if it references an existing establishment
     *
     * @return void
     */
    public function testRelationOfTheEstablishment()
    {
        $items = Item::all();

        foreach($items as $item) {
            $establishment = $item->establishment()->first();

            if ($establishment != null) {
                $this->assertDatabaseHas('establishments', [
                    'id' => $item->establishment_id,
                    'name' => $establishment->name,
                ]);
            }
        }
    }

    /**
     * Checks if it only has one brand
     *
     * @return void
     */
    public function testCountOfTheBrand()
    {
        $items = Item::all();

        foreach($items as $item) {
            $count = count($item->brand()->get());
            
            if ($count > 0) {
                $this->assertEquals(1, $count, 'Only one brand can be assigned to one item');
            }
        }
    }

    /**
     * Checks if it references an existing brand
     *
     * @return void
     */
    public function testRelationOfTheBrand()
    {
        $items = Item::all();

        foreach($items as $item) {
            $brand = $item->brand()->first();

            if ($brand != null) {
                $this->assertDatabaseHas('brands', [
                    'id' => $item->brand_id,
                    'name' => $brand->name,
                    'isin' => $brand->isin
                ]);
            }
        }
    }

    /**
     * Checks if it references both a brand and a establishment. If it does then it fails
     *
     * @return void
     */
    public function testBrandAndEstablishment()
    {
        $items = Item::all();

        foreach($items as $item) {
            $brand = $item->brand()->first();
            $establishment = $item->establishment()->first();

            // If both are not null then it fails

            $brand_exists = !is_null($brand);
            $establishment_exists = !is_null($establishment);

            $this->assertNotEquals($brand_exists, $establishment_exists, 'This item has a brand and an establishment (It must only have one of those)');
        }
    }

    /**
     * Checks if it references both a brand and a establishment. If it does then it fails
     *
     * @return void
     */
    public function testBrandAndEstablishmentNull()
    {
        $items = Item::all();

        foreach($items as $item) {
            $brand = $item->brand()->first();
            $establishment = $item->establishment()->first();

            // If both are not null then it fails

            $brand_exists = is_null($brand);
            $establishment_exists = is_null($establishment);

            $this->assertNotEquals($brand_exists, $establishment_exists, 'This item does not have any brand nor establishment (It must have at least one of those)');
        }
    }
}
