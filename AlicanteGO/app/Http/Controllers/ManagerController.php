<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    public function index (){
        $count = Manager::all()->count();
        $managers = Manager::paginate(7);
        return view('managers.managers', ["success" => true, "managers" => $managers, "count" => $count]);
    }

    public function delete($manager){
        $manager = Manager::findOrFail($manager);
        $manager->delete();
        return redirect('/managers');
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $orderBy = $request->get('orderBy');

        if ($search == null && $orderBy == null) {
            return redirect('/managers');
        }

        $search = trim($search);
        $count = \DB::table('managers')->where('name', 'like', '%' . $search . '%')->count();
        $managers = \DB::table('managers')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
        
        if ($orderBy != null) {
            switch ($orderBy) {
            // We have to append the query, otherwise it will reset the search parameters each time that we change the page
            case '-1':
                $managers = \DB::table('managers')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
                break;
            case '1':
                $managers = \DB::table('managers')->orderBy('name','asc')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
                break;
            case '2':
                $managers = \DB::table('managers')->orderBy('name','desc')->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
                break;
            default:
                abort(500); // It should never reach this code
                break;
            }
        }

        
        return view('managers.managers', ["success" => true, "managers" => $managers, "count" => $count, "search" => $search, "orderBy" => $orderBy]);
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
        $request->validate([
            'name' => 'required',
            'DNI' => 'required|regex:/^\d{8}[A-Z]$/',
            'phone' => 'required|numeric|digits:9',
            ]);
            
        $name = $request->input('name');
        $DNI = $request->input('DNI');
        $phone = $request->input('phone');
        $establishment_id = $request->input('dropdownEstablishment', null);
        $brand_id = $request->input('dropdownBrand', null);

        $data=array('name'=>$name,"DNI"=>$DNI,"phone"=>$phone, "establishment_id" => $establishment_id, "brand_id"=>$brand_id);
        \DB::table('managers')->insert($data);

        return redirect('/managers')->with('success','Manager added successfully'); 
    }
    
    public function edit_view(Manager $manager){
        $brands = \DB::table('brands')->get();
        $establishments = \DB::table('establishments')->get();
        return view('managers.editmanagers', ["success" => true, "manager" => $manager, "brands" => $brands, "establishments" => $establishments]);     
    }

    public function edit(Manager $manager, Request $request){

        $request->validate([
            'name' => 'required',
            'DNI' => 'required|regex:/^\d{8}[A-Z]$/',
            'phone' => 'required|numeric|digits:9',
            ]);

        $manager->name = $request->input('name');
        $manager->DNI = $request->input('DNI');
        $manager->phone = $request->input('phone');
        $manager->establishment_id = $request->input('dropdownEstablishment', null);
        $manager->brand_id = $request->input('dropdownBrand', null);

        $manager->save();
        return redirect('/managers')->with('success','Manager updated successfully'); 
    }
  
}
