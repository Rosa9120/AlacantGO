<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
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
        $categories = Category::all();
        $brands = Brand::all();
        $orderBy = -1;
        $brand = -1;
        $category = -1;
        return view('home')->with(["establishments" => $establishments, "categories" => $categories, "brands" => $brands, "orderBy" => $orderBy, "category" => $category, "brand" => $brand, "search" => ""]);
    }
}
