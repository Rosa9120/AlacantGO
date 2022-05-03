<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $establishments = Establishment::all();
        $latitude = 38.34517;
        $longitude = -0.48149;
        return view('home')->with(["establishments" => $establishments, "latitude" => $latitude, "longitude" => $longitude]);
    }
}
