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
        return view('establishment/establishmentadd');
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
    function delete_establishment($id) {
        $establishment = Establishment::findOrFail($id);
        $establishment->delete();
        return redirect('/establishments');
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
            $establishments = Establishment::leftJoin('brands', 'establishments.brand_id', '=', 'brands.id')
                                        ->leftJoin('categories', 'establishments.category_id', '=', 'categories.id')
                                        ->where('establishments.name', 'LIKE', "%{$search->input('search')}%")
                                        ->orwhere('brands.name', 'LIKE', "%{$search->input('search')}%")
                                        ->orwhere('categories.name', 'LIKE', "%{$search->input('search')}%")
                                        ->get('establishments.*');
            $count = $establishments->count();
        } else {
            $count = Establishment::all()->count();
            $establishments = new Establishment();
        }

        if ($orderBy != null) {
            switch ($orderBy) {
            // We have to append the query, otherwise it will reset the search parameters each time that we change the page
            case '-1':
                $establishments = $establishments->paginate(5);
                break;
            case '1':
                $establishments = $establishments->orderBy('name')->paginate(5);
                break;
            case '2':
                $establishments = $establishments->leftJoin('brands', 'establishments.brand_id', '=', 'brands.id')
                                                 ->orderBy('brands.name')->paginate(5, 'establishments.*');
                break;
            case '3':
                $establishments = $establishments->leftJoin('categories', 'establishments.category_id', '=', 'categories.id')
                                                 ->orderBy('categories.name')->paginate(5, 'establishments.*');
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
                        'phone_number' => 'required',
                        'address' => 'required',
                        'postal_code' => 'required']);

        $establishment = new Establishment();
        $establishment->name = $req->input('name');
        $establishment->phone_number = $req->input('phone_number');
        $establishment->address = $req->input('address');
        $establishment->postal_code = $req->input('postal_code');
        $establishment->save();

        return redirect('/establishments');
    }

    /**
     * Processes to form to edit an establishment
     */
    function update_establishment_process(Request $req, $id) {
        $establishment = Establishment::findOrFail($id);

        $req->validate(['name' => 'required',
                        'phone_number' => 'required',
                        'address' => 'required',
                        'postal_code' => 'required']);

        $establishment->name = $req->input('name');
        $establishment->phone_number = $req->input('phone_number');
        $establishment->address = $req->input('address');
        $establishment->postal_code = $req->input('postal_code');
        if ((new Request)->has("brand")) {
            $brand = Brand::whereId($req["brand"])->first();
            $establishment->brand()->associate($brand);
        }
        if ((new Request)->has("category")) {
            $category = Brand::whereId($req["category"])->first();
            $establishment->category()->associate($category);
        }
        $establishment->save();

        return redirect('/establishments');
    }
}
