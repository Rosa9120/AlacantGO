<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }

    static public function create($name, $price, $description, $brand, $establishment)
    {
        $item = new Item;
        $item->name = $name;
        $item->price = $price;
        $item->description = $description;

        if ($brand != NULL) 
            $item->brand()->associate($brand);

        else 
            $item->establishment()->associate($establishment);

        $item->save();

        return $item;
    }

    static public function edit($item, $name, $price, $description, $brand, $establishment)
    {
        $item->name = $name;
        $item->price = $price;
        $item->description = $description;

        if ($brand != NULL) 
            $item->brand()->associate($brand);

        else 
            $item->establishment()->associate($establishment);

        $item->save();
    }
}
