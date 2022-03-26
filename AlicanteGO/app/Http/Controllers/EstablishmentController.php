<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstablishmentController extends Controller
{
    function get_all() {
        return view('establishments')->with("establishments", Establishment::simplePaginate(5));
    }

    /**
     * Returns the form to add a new establishment
     */
    function create_establishment() {
        return view('establishmentadd');
    }

    /**
     * Returns the data of one establishment 
     */
    function get_establishment($id) {
        return view('establishment')->with('establishment', Establishment::findOrFail($id));
    }

    /**
     * Returns the establishment update form
     */
    function update_establishment($id) {
        $establishment = Establishment::findOrFail($id);
        return view('', ['establishment' => $establishment]);
    }

    /**
     * Deletes an establishment
     */
    function delete_establishment($id) {
        $establishment = Establishment::findOrFail($id);
        $establishment->delete();
        
    }


}
