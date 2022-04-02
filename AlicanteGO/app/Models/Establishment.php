<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

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
