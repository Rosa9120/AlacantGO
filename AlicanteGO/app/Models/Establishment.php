<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $appends = [
        "price"
    ];

    public function getPriceAttribute() { // Get the average price of all the items at a particular restaurant to order them
        $items_count = $this->items()->count();
        $items = $this->items()->get();

        if ($items_count == 0) {
            return 0;
        }

        $price = array_sum(array_column($items->toArray(), "price")) / $items_count;

        return $price;
    }

    static public function create($name, $phone, $address, $pcod, $lat, $long, $img, $brand, $category)
    {
        $establishment = new Establishment();
        $establishment->name = $name;
        $establishment->phone_number = $phone;
        $establishment->address = $address;
        $establishment->postal_code = $pcod;
        $establishment->latitude = $lat;
        $establishment->longitude = $long;
        $establishment->img_url = $img;

        if ($brand != NULL) {
            $establishment->brand()->associate($brand);
        }
        if ($category != NULL) {
            $establishment->category()->associate($category);
        }

        $establishment->save();

        return $establishment;

    }

    static public function edit($id, $name, $phone, $address, $pcod, $lat, $long, $img, $brand, $category)
    {
        $establishment = Establishment::findOrFail($id);

        $establishment->name = $name;
        $establishment->phone_number = $phone;
        $establishment->address = $address;
        $establishment->postal_code = $pcod;
        $establishment->latitude = $lat;
        $establishment->longitude = $long;
        $establishment->img_url = $img;

        if ($brand != NULL) {
            $establishment->brand()->associate($brand);
        }
        if ($category != NULL) {
            $establishment->category()->associate($category);
        }

        $establishment->save();

        return $establishment;

    }
    
    public function brand() {
        return $this->belongsTo(Brand::class)->withDefault(['name' => 'None',]);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function manager() {
        return $this->hasOne(Manager::class);
    }

    public function category() {
        return $this->belongsTo(Category::class)->withDefault(['name' => 'None',]);
    }
}
