<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    function get_all() {
        $count = Establishment::all()->count();
        $establishments = Establishment::paginate(5);
        return view('establishment/establishments', ["establishments" => $establishments, "count" => $count]);
    }

    /**
     * Returns the form to add a new establishment
     */
    function create_establishment() {
        $brands = Brand::get();
        $categories = Category::get();
        return view('establishment/establishmentadd', ['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Returns the data of one establishment 
     */
    function get_establishment($id) {
        return view('establishment/establishment')->with('establishment', Establishment::findOrFail($id));
    }

    /**
     * Returns the establishment update form
     */
    function update_establishment($id) {
        $establishment = Establishment::findOrFail($id);
        $brands = Brand::get();
        $categories = Category::get();
        return view('establishment/establishmentedit', ['establishment' => $establishment, 'brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Deletes an establishment
     */
    function delete_establishment(Establishment $establishment) {
        $establishment->delete();
        return redirect()->back();
    }

    /**
     * Search establishments
     */
    function search_establishment(Request $req) {
        $search = $req->get('search');
        $orderBy = $req->get('orderBy');

        if ($search == null && $orderBy == null) {
            return redirect('/establishments');
        }

        if ($search != null) {
            $establishments = Establishment::select('establishments.*')
                                        ->leftJoin('brands', 'establishments.brand_id', '=', 'brands.id')
                                        ->leftJoin('categories', 'establishments.category_id', '=', 'categories.id')
                                        ->where('establishments.name', 'LIKE', "%{$search}%")
                                        ->orwhere('brands.name', 'LIKE', "%{$search}%")
                                        ->orwhere('categories.name', 'LIKE', "%{$search}%");
            $count = $establishments->count();
        } else {
            $count = Establishment::all()->count();
            $establishments = new Establishment();
        }

        if ($orderBy != null) {
            switch ($orderBy) {
            // We have to append the query, otherwise it will reset the search parameters each time that we change the page
            case '-1':
                $establishments = $establishments->paginate(5)->appends(request()->query());
                break;
            case '1':
                $establishments = $establishments->orderBy('establishments.name')->paginate(5, 'establishments.*')->appends(request()->query());
                break;
            case '2':
                $establishments = $establishments->orderBy('brands.name')->paginate(5, 'establishments.*')->appends(request()->query());
                break;
            case '3':
                $establishments = $establishments->orderBy('categories.name')->paginate(5, 'establishments.*')->appends(request()->query());
                break;
            default:
                abort(500); // It should never reach this code
                break;
            }
        }
        
        return view('establishment/establishments', ['establishments' => $establishments, 'count' => $count, "search" => $search, "orderBy" => $orderBy]);                                                                              
    }

     /**
     * Processes to form to add a new establishment
     */
    function create_establishment_process(Request $req) {
        $req->validate(['name' => 'required',
                        'address' => 'required',
                        'postal_code' => 'required',
                        'latitude' => 'required',
                        'longitude' => 'required']);

        $establishment = Establishment::create($req->input('name'),
        $req->input('phone_number'), $req->input('address'), $req->input('postal_code'), $req->input('latitude'), $req->input('longitude'),
        Brand::whereId($req["brand"])->first(), Brand::whereId($req["category"])->first());

        return redirect('/establishments/' . $establishment->id);
    }

    function filter_establishments(Request $request) {
        $establishments = null;

        $search = $request->input("search") == null ? "" : trim($request->input("search"));

        $establishments = Establishment::where('name', 'like', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')->get();

        if ($request->input("category") > 0) {
            $establishments = Establishment::whereCategoryId($request->input("category"))->get();
            $establishments = array_filter($establishments->toArray(), function($item) use ($request) {
                return $item["category_id"] == $request->input("category");
            });
        }

        if ($request->input("brand") > 0) {
            $establishments = array_filter(gettype($establishments) != "array" ? $establishments->toArray() : $establishments, function($item) use ($request) {
                return $item["brand_id"] == $request->input("brand");
            });
        }
        if (gettype($establishments) != "array") {
            $establishments = $establishments->toArray();
        }

        switch($request->input("orderBy")) {
            case 1:
                usort($establishments, function($a, $b) {
                    return $a["price"] < $b["price"] ? 1 : -1;
                });
                break;
            case 2:
                usort($establishments, function($a, $b) {
                    return $a["price"] > $b["price"] ? 1 : -1;
                });
                break;
            default:
                break;
        }

        $categories = Category::all();
        $brands = Brand::all();
        return view("home")->with(["establishments" => $establishments, "categories" => $categories, "brands" => $brands, "brand" => $request->input("brand"), "category" => $request->input("category"), "orderBy" => $request->input("orderBy"), "search" => $search]);
    }

    /**
     * Processes to form to edit an establishment
     */
    function update_establishment_process(Request $req, $id) {

        $req->validate([
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $establishment = Establishment::edit($id, $req->input('name'),
        $req->input('phone_number'), $req->input('address'), $req->input('postal_code'), $req->input('latitude'), $req->input('longitude'),
        Brand::whereId($req["brand"])->first(), Brand::whereId($req["category"])->first());

        return redirect('/establishments/' . $establishment->id);
    }
}
