<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    public function index (){
        $count = Manager::all()->count();
        $managers = Manager::all();
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
        return view('managers.managers', ["success" => true, "manager" => $manager]);
    }

    public function create(Request $request) {
        $name = $request->input('name');
        $DNI = $request->input('DNI');
        $phone = $request->input('phone');
        $establishment_name = $request->input('establishment', null);
        $brand_name = $request->input('brand', null);

        $data=array('name'=>$name,"DNI"=>$DNI,"phone"=>$phone);
        \DB::table('managers')->insert($data);

        return redirect('/managers')->with('success','Manager added successfully'); //no va ninguna ruta
    }

  
}
