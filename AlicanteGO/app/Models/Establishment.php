<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function manager() {
        return $this->hasOne(Managers::class);
    }
}
