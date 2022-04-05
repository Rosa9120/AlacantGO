<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Establishment;

class BrandController extends Controller
{
    public function index()
    {
        $count = Brand::all()->count();
        $brands = Brand::paginate(7);
        return view('brand.brands', ["success" => true, "brands" => $brands, "count" => $count]);
    }

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

    public function update_brand(Request $request) 
    {

        if(Establishment::where ('name', '=', $request->input('establishment_name'))->get()->count() == 0) //SI EL ESTABLISHMENT NO EXISTE
            return view('establishment.exceptions.establishmentNotFound', ['inexistent_name' => $request->input('establishment_name')]);
        
        else if(Brand::where ('name', '=', $request->input('brand_name'))->get()->count() == 0) //SI LA BRAND NO EXISTE
            return view('brand.exceptions.brandNotFound', ['inexistent_name' => $request->input('brand_name')]);

        else
        {
            $brand = Brand::where ('name', '=', $request->input('brand_name'))->first(); //ONLY THE ID IS NEEDED TO LINK

            $establish_wanted = Establishment::where ('name', '=', $request->input('establishment_name'));

            $establish_wanted->update(array('brand_id' => $brand->id));

            return view('brand.updateDone', 
            ['e_name' => $request->input('establishment_name'), 'b_name' => $request->input('brand_name')]);
        }
    }

    public function search_brand() {
        $search = \Request::get('search');

        if ($search == null) {
            return redirect('/brands');
        }

        $search = trim($search);
        
        $count = \DB::table('brands')->where('name', 'like', '%' . $search . '%')->count();
        $brands = \DB::table('brands')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
        return view('brand.brands', ["success" => true, "brands" => $brands, "count" => $count, "search" => $search]);
    }

    public function delete_brand(Brand $brand) 
    {
        $brand->delete();
        return redirect()->back();
    }

    public function create_brand(Request $request) 
    {
        $brand = new Brand;
        $brand->name = $request->input('name');

        if($request->input('isin') == NULL)
            $brand->isin = NULL;

        else
            $brand->isin =$request->input('isin');

        $brand->save();

        return redirect('/brands');
    }

    public function edit_brand(Item $brand) 
    {
        $request = \Request::all();
        $brand->name = trim($request["name"]);
        $brand->isin = $request["isin"];

        $brand->save();

        return redirect('/brands');
    }
}
