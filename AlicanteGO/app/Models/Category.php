<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function establishments(){
    	return $this->hasMany('App\Model\Establishment');
    }

    static public function create($name)
    {
        $category = new Category;
        $category->name = $name;

        $category->save();

    }

    static public function edit($category, $name)
    {
        $category->name = $name;
        $category->save();

    }
}
