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

}
