<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    public function index (){
        $count = Manager::all()->count();
        $managers = Manager::all(); //\DB::table('managers')->paginate(7);
        return view('managers.managers', ["success" => true, "managers" => $managers, "count" => $count]);
    }

    public function delete($manager){
        $manager = Manager::findOrFail($manager);
        $manager->delete();
        return redirect()->back();
    }

    public function search() {
        $search = \Request::get('search');

        if ($search == null) {
            return redirect('/managers');
        }

        $search = trim($search);
        
        $count = \DB::table('managers')->where('name', 'like', '%' . $search . '%')->count();
        $managers = \DB::table('managers')->where('name', 'like', '%' . $search . '%')->paginate(7);
        return view('managers.managers', ["success" => true, "managers" => $managers, "count" => $count, "search" => $search]);
    }

    public function show(Manager $manager) {
       // $manager = Manager::findOrFail($manager);
        return view('managers.showmanager', ["success" => true, "manager" => $manager]);
    }

    public function create_view(){
        $establishments = \DB::table('establishments')->get();
        $brands = \DB::table('brands')->get();
        return view('managers.addmanagers', ["success" => true, "brands" => $brands, "establishments" => $establishments]);     
    }

    public function create(Request $request) {
        $name = $request->input('name');
        $DNI = $request->input('DNI');
        $phone = $request->input('phone');
        $establishment_id = $request->input('dropdownEstablishment', null);
        $brand_id = $request->input('dropdownBrand', null);

        $data=array('name'=>$name,"DNI"=>$DNI,"phone"=>$phone, "establishment_id" => $establishment_id, "brand_id"=>$brand_id);
        \DB::table('managers')->insert($data);

        return redirect('/managers')->with('success','Manager added successfully'); //no va ninguna ruta
    }

  
}
