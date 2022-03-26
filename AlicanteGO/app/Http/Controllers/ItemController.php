<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index () {
        $items = Item::all();
        return view('items', ["success" => true, "items" => $items]);
    }

    public function delete($item) {
        $item = Item::findOrFail($item);
        $item->delete();
        return redirect()->back();
    }
}
