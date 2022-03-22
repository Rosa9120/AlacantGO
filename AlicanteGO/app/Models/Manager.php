<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    
    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
