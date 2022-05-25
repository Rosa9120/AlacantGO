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

    public function user() {
        return $this->belongsTo(User::class);
    }

    static public function create($name, $dni, $phone, $establishment, $brand, $user)
    {
        $manager = new Manager();
        $manager->name = $name;
        $manager->dni = $dni;
        $manager->phone = $phone;

        $manager->establishment_id = $establishment;
        $manager->brand_id = $brand;
        $manager->user_id = $user;

        $manager->save();

    }

    static public function edit($manager,$name, $dni, $phone, $establishment, $brand)
    {
        $manager->name = $name;
        $manager->dni = $dni;
        $manager->phone = $phone;

        $manager->establishment_id = $establishment;
        $manager->brand_id = $brand;

        $manager->save();

    }
}
