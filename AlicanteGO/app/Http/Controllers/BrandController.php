<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function form(Request $request) 
    {
        if( Brand::find($request->input('brand_id')) ) //SI EL ID PERTENECE A UNA BRAND EXISTENTE
        {
            $brand = Brand::find($request->input('brand_id'));

            return view('brand.get_brand', ['name' => $brand->name]);
        }

        else
            return view('brand.notFound', ['wrong_id' => $request->input('brand_id')]); //DEBERÍA SER UNA EXCEPTION???   
    }
}
