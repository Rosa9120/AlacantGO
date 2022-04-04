<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $count = Category::all()->count();
        $categories = Category::paginate(7);
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

    public function update_brand(Request $request) 
    {

        if(Establishment::where ('name', '=', $request->input('establishment_name'))->get()->count() == 0) //SI EL ESTABLISHMENT NO EXISTE
            return view('establishment.exceptions.establishmentNotFound', ['inexistent_name' => $request->input('establishment_name')]);
        
        else if(Category::where ('name', '=', $request->input('brand_name'))->get()->count() == 0) //SI LA BRAND NO EXISTE
            return view('brand.exceptions.brandNotFound', ['inexistent_name' => $request->input('brand_name')]);

        else
        {
            $category = Category::where ('name', '=', $request->input('brand_name'))->first(); //ONLY THE ID IS NEEDED TO LINK

            $establish_wanted = Establishment::where ('name', '=', $request->input('establishment_name'));

            $establish_wanted->update(array('brand_id' => $category->id));

            return view('brand.updateDone', 
            ['e_name' => $request->input('establishment_name'), 'b_name' => $request->input('brand_name')]);
        }
    }

    public function search_category() {
        $search = \Request::get('search');

        if ($search == null) {
            return redirect('/categories');
        }

        $search = trim($search);
        
        $count = \DB::table('categories')->where('name', 'like', '%' . $search . '%')->count();
        $categories = \DB::table('categories')->where('name', 'like', '%' . $search . '%')->paginate(7);
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