<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Establishment;
use App\Models\Manager;
use Auth;

class BrandController extends Controller
{
    public function index()
    {
        $count = Brand::all()->count();
        $brands = Brand::paginate(7);
        return view('brand.brands', ["success" => true, "brands" => $brands, "count" => $count]);
    }

    public function create_view()
    {
        return view('brand.brand_create');
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

    public function search() {
        $search = \Request::get('search');

        if ($search == null) {
            return redirect('/admin/brands');
        }

        $search = trim($search);
        
        $count = \DB::table('brands')->where('name', 'like', '%' . $search . '%')->count();
        $brands = \DB::table('brands')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
        return view('brand.brands', ["success" => true, "brands" => $brands, "count" => $count, "search" => $search]);
    }

    public function delete(Brand $brand) 
    {
        return view('brand.delete', ["success" => true, "brand" => $brand]);
    }
    public function destroy($id) 
    {
        $brand = Brand::Find($id);
        $brand->delete();
        return redirect('/admin/brands');
    }

    public function manager_edit_brand(Brand $brand, Request $request) {
        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/',
        ]);

        if ($request->hasFile("image")) {
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file("image")->storeAs("public", $filename);
            Brand::edit($brand, $request->input('name'), $request->input('isin'), "/storage/" . $filename);

            return redirect('/profile');
        }

        Brand::edit($brand, $request->input('name'), $request->input('isin'), $brand->img_url);

        return redirect('/profile');
    }

    public function manager_create_brand(Request $request) {
        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/',
            'image' => 'required|image'
        ]);

        $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file("image")->storeAs("public", $filename);
        $brand = Brand::create($request->input('name'), $request->input('isin'), "/storage/" . $filename);
        $manager = Manager::whereUserId(Auth::user()->id)->first();

        $manager->brand_id = $brand->id;
        $manager->save();

        return redirect('/profile');
    }

    public function create(Request $request) 
    {
        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        Brand::create($request->input('name'), $request->input('isin'), $request->input('image'));

        return redirect('/admin/brands');
    }

    function set_brand() {
        $establishments = Establishment::get();
        $brands = Brand::get();
        return view('brand.updateForm', ['establishments' => $establishments, 'brands' => $brands]);
    }

    public function edit_view(Brand $brand)
    {
        return view('brand.brand_edit', ["success" => true, "brand" => $brand]);
    }

    public function edit(Request $request, Brand $brand) 
    {

        $request->validate([
            'isin' => 'required|regex:/^[A-Z]{2}\d{9}$/'
        ]);

        Brand::edit($brand, $request->input('name'), $request->input('isin'), $request->input('image'));

        return redirect('/admin/brands');
    }
}
