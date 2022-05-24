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
    function delete_establishment($id) {
        $establishment = Establishment::findOrFail($id);
        return view('establishment.delete', ["success" => true, "establishment" => $establishment]);
    }
    public function destroy($id) 
    {
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
        
        return view('establishment.establishments', ['establishments' => $establishments, 'count' => $count, "search" => $search, "orderBy" => $orderBy]);                                                                              
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

        $establishment = new Establishment();
        $establishment->name = $req->input('name');
        $establishment->phone_number = $req->input('phone_number');
        $establishment->address = $req->input('address');
        $establishment->postal_code = $req->input('postal_code');
        $establishment->latitude = $req->input('latitude');
        $establishment->longitude = $req->input('longitude');
        if ($req->has("brand")) {
            $brand = Brand::whereId($req["brand"])->first();
            $establishment->brand()->associate($brand);
        }
        if ($req->has("category")) {
            $category = Brand::whereId($req["category"])->first();
            $establishment->category()->associate($category);
        }
        $establishment->save();

        return redirect('/establishments/' . $establishment->id);
    }

    /**
     * Processes to form to edit an establishment
     */
    function update_establishment_process(Request $req, $id) {
        $establishment = Establishment::findOrFail($id);

        $req->validate([
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $establishment->name = $req->input('name');
        $establishment->phone_number = $req->input('phone_number');
        $establishment->address = $req->input('address');
        $establishment->postal_code = $req->input('postal_code');
        $establishment->latitude = $req->input('latitude');
        $establishment->longitude = $req->input('longitude');
        if ($req->input("brand") !== null) {
            $brand = Brand::whereId($req->input("brand"))->first();
            $establishment->brand()->associate($brand);
        }
        if ($req->input("category") !== null) {
            $category = Brand::whereId($req["category"])->first();
            $establishment->category()->associate($category);
        }
        $establishment->save();

        return redirect('/establishments/' . $establishment->id);
    }
}
