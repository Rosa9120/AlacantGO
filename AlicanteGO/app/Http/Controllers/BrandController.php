<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Establishment;

class BrandController extends Controller
{
    public function get_brand(Request $request) 
    {
        if( Brand::find($request->input('brand_id')) ) //SI EL ID PERTENECE A UNA BRAND EXISTENTE
        {
            $brand = Brand::find($request->input('brand_id'));

            return view('brand.get_brand', ['name' => $brand->name]);
        }

        else
            return view('brand.exceptions.notFoundById', ['wrong_id' => $request->input('brand_id')]); //DEBERÍA ESTAR EN UNA CARPETA LLAMADA EXCEPTION???  
    }

    public function set_brand(Request $request) 
    {
        if( !Establishment::where ('name', '=', $request->input('establishment_name'))) //SI EL ESTABLISHMENT NO EXISTE
            return view('establishment.exceptions.establishmentNotFound', ['inexistent_name' => $request->input('establishment_name')]);
        
        else if( !Brand::where ('name', '=', $request->input('brand_name'))) //SI LA BRAND NO EXISTE
            return view('brand.exceptions.brandNotFound', ['inexistent_name' => $request->input('brand_name')]);

        else //POR ALGÚN MOTIVO BURGUER KING DEVUELVE NULL, NO TENGO NI IDEA DE POR QUÉ
        {
            $brand = Brand::where ('name', '=', $request->input('brand_name'))->first(); //ONLY THE ID IS NEEDED TO LINK

            $establish_wanted = Establishment::where ('name', '=', $request->input('establishment_name'));

            $establish_wanted->update(array('brand_id' => $brand->id));

            return view('brand.setDone', 
            ['e_name' => $request->input('establishment_name'), 'b_name' => $request->input('brand_name')]);
        }
    }
}
