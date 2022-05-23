<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    static public function create($name, $phone, $address, $pcod, $lat, $long, $brand, $category)
    {
        $establishment = new Establishment();
        $establishment->name = $name;
        $establishment->phone_number = $phone;
        $establishment->address = $address;
        $establishment->postal_code = $pcod;
        $establishment->latitude = $lat;
        $establishment->longitude = $long;

        if ($brand != NULL) {
            $establishment->brand()->associate($brand);
        }
        if ($category != NULL) {
            $establishment->category()->associate($category);
        }

        $establishment->save();

        return $establishment;

    }

    static public function edit($id, $name, $phone, $address, $pcod, $lat, $long, $brand, $category)
    {
        $establishment = Establishment::findOrFail($id);

        $establishment->name = $name;
        $establishment->phone_number = $phone;
        $establishment->address = $address;
        $establishment->postal_code = $pcod;
        $establishment->latitude = $lat;
        $establishment->longitude = $long;

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
        return $this->hasOne(Managers::class);
    }

    public function category() {
        return $this->belongsTo(Category::class)->withDefault(['name' => 'None',]);
    }
}
