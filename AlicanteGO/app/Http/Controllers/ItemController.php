<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index () {
        $count = Item::all()->count();
        $items = Item::paginate(7);
        return view('items.items', ["success" => true, "items" => $items, "count" => $count]);
    }

    public function delete(Item $item) {
        $item->delete();
        return redirect()->back();
    }

    public function show(Item $item) {
        return view('items.item', ["success" => true, "item" => $item]);
    }
}
