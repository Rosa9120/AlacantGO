<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    function index() {
        $count = Establishment::all()->count();
        $establishments = Establishment::paginate(5);
        return view('establishment/establishments', ["establishments" => $establishments, "count" => $count]);
    }

    /**
     * Returns the form to add a new establishment
     */
    function create_view() {
        $brands = Brand::get();
        $categories = Category::get();
        return view('establishment/establishment_create', ['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Returns the data of one establishment 
     */
    function show($id) {
        return view('establishment/establishment')->with('establishment', Establishment::findOrFail($id));
    }

    /**
     * Returns the establishment update form
     */
    function edit_view($id) {
        $establishment = Establishment::findOrFail($id);
        $brands = Brand::get();
        $categories = Category::get();
        return view('establishment/establishment_edit', ['establishment' => $establishment, 'brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Deletes an establishment
     */
    function delete(Establishment $establishment) {
        $establishment->delete();
        return redirect()->back();
    }

    /**
     * Search establishments
     */
    function search(Request $req) {
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
    function create(Request $req) {
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

    /**
     * Processes to form to edit an establishment
     */
    function edit(Request $req, $id) {

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
