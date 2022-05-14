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

    public function update_brand(Request $request) //EL PROBLEMA ESTÁ EN <option value="{{ $brand }} de updateForm
    {
            $brand = Brand::where ('name', '=', $request->input('brand'))->first(); //ONLY THE ID IS NEEDED TO LINK

<<<<<<< HEAD
            $establish_wanted = Establishment::where ('name', '=', $request->input('establishment'));
=======
        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        if(Establishment::where ('name', '=', $request->input('establishment_name'))->get()->count() == 0) //SI EL ESTABLISHMENT NO EXISTE
            return view('establishment.exceptions.establishmentNotFound', ['inexistent_name' => $request->input('establishment_name')]);
        
        else if(Brand::where ('name', '=', $request->input('brand_name'))->get()->count() == 0) //SI LA BRAND NO EXISTE
            return view('brand.exceptions.brandNotFound', ['inexistent_name' => $request->input('brand_name')]);

        else
        {
            $brand = Brand::where ('name', '=', $request->input('brand_name'))->first(); //ONLY THE ID IS NEEDED TO LINK

            $establish_wanted = Establishment::where ('name', '=', $request->input('establishment_name'));
>>>>>>> 394b9ea3739e734888eb05374e65eafef04d25dd

            $establish_wanted->update(array('brand_id' => $brand->id));

            return view('brand.updateDone', 
            ['e_name' => $request->input('establishment'), 'b_name' => $request->input('brand')]);
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

        $brand = new Brand;
        $brand->name = $request->input('name');

        if($request->input('isin') == NULL)
            $brand->isin = NULL;

        else
            $brand->isin =$request->input('isin');

        $brand->save();

        return redirect('/brands');
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit_brand', ["success" => true, "brand" => $brand]);
    }

<<<<<<< HEAD
    function set_brand() {
        $establishments = Establishment::get();
        $brands = Brand::get();
        return view('brand.updateForm', ['establishments' => $establishments, 'brands' => $brands]);
    }

    public function edit_brand(Brand $brand) 
=======
    public function edit_brand(Request $request, Brand $brand) 
>>>>>>> 394b9ea3739e734888eb05374e65eafef04d25dd
    {

        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        $brand->name = $request["name"];
        $brand->isin = $request["isin"];

        $brand->save();

        return redirect('/brands');
    }
}
