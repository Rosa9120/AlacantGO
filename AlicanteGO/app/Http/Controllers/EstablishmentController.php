<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
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
        $establishment = Establishment::findOrFail($id);
        return view('', ['establishment' => $establishment]);
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
