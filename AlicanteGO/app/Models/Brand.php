<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function establishments() {
        return $this->hasMany(Establishment::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function manager() {
        return $this->hasOne(Manager::class);
    }

    static public function create($name, $isin)
    {
        
        $brand = new Brand;
        $brand->name = $name;

        $brand->isin = $isin;

        $brand->save();
    }

    static public function edit($brand, $name, $isin)
    {

        $brand->name = $name;

        $brand->isin = $isin;

        $brand->save();
    }

    static public function update_brand($brand, $establishment)
    {
        if($brand == NULL)
            $establishment->brand_id = NULL;

        else
            $establishment->brand_id = $brand->id;

        $establishment->save();
    }
}
