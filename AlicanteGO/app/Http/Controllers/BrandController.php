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
            $brand = Brand::whereId($request["brand"])->first();
            $establish_wanted = Establishment::findOrFail($request["establishment"]);

            Brand::update_brand($brand, $establish_wanted);

            if($brand != NULL)
                return view('brand.updateDone', ['e_name' => $establish_wanted->name, 'b_name' => $brand->name]);

            else
                return view('brand.updateDone', ['e_name' => $establish_wanted->name, 'b_name' => "no brand"]);
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
        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        Brand::create($request->input('name'), $request->input('isin'));

        return redirect('/brands');
    }

    function set_brand() {
        $establishments = Establishment::get();
        $brands = Brand::get();
        return view('brand.updateForm', ['establishments' => $establishments, 'brands' => $brands]);
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit_brand', ["success" => true, "brand" => $brand]);
    }

    public function edit_brand(Request $request, Brand $brand) 
    {

        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        Brand::edit($brand, $request->input('name'), $request->input('isin'));

        return redirect('/brands');
    }
}
