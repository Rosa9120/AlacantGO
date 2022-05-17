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

    static public function create($name, $price, $description, $type, $brand, $establishment)
    {
        $item = new Item;
        $item->name = $name;
        $item->price = $price;
        $item->description = $description;
        $item->type = $type;

        if ($brand != NULL) 
            $item->brand()->associate($brand);

        else 
            $item->establishment()->associate($establishment);

        $item->save();

        return $item;
    }

    static public function edit($item, $name, $price, $description, $type, $brand, $establishment)
    {
        $item->name = $name;
        $item->price = $price;
        $item->description = $description;
        $item->type = $type;

        if ($brand != NULL) 
            $item->brand()->associate($brand);

        else 
            $item->establishment()->associate($establishment);

        $item->save();
    }
}
