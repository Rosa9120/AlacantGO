<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    public function index (){
        $managers = Manager::all();
        return view('managers', ["success" => true, "managers" => $managers]);
    }

    public function delete($manager){
        $manager = Manager::findOrFail($manager);
        $manager->delete();
        return redirect()->back();
    }
}
