<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $count = Category::all()->count();
        $categories = Category::orderBy('name')->paginate(7);
        return view('categories.categories', ["success" => true, "categories" => $categories, "count" => $count]);
    }

    public function get_category(Request $request) 
    {
        if( Category::find($request->input('category_id')) ) //SI EL ID PERTENECE A UNA BRAND EXISTENTE
        {
            $category = Category::find($request->input('category_id'));

            return view('categories.get_category', ['name' => $category->name]);
        }

        else
            return view('categories.exceptions.notFoundById', ['wrong_id' => $request->input('categories_id')]); //DEBERÍA ESTAR EN UNA CARPETA LLAMADA EXCEPTION???  
    }


    public function search_category() {
        $search = \Request::get('search');

        if ($search == null) {
            return redirect('/categories');
        }

        $search = trim($search);
        
        $count = \DB::table('categories')->where('name', 'like', '%' . $search . '%')->count();
        $categories = \DB::table('categories')->where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(7)->appends(request()->query());
        return view('categories.categories', ["success" => true, "categories" => $categories, "count" => $count, "search" => $search]);
    }

    public function delete_category(Category $category) 
    {
        $category->delete();
        return redirect()->back();
    }

    public function create_category(Request $request) 
    {
        $category = new Category;
        $category->name = $request->input('name');

        $category->save();

        return redirect('/categories');
    }

    public function edit(Category $category) {
        return view('categories.edit_category', ["success" => true, "category" => $category]);
    }

    public function edit_category(Category $category) 
    {
        $request = \Request::all();
        $category->name = trim($request["name"]);

        $category->save();

        return redirect('/categories');
    }
}