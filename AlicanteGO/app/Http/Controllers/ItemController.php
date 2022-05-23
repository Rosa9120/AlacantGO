<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Establishment;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

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

    public function search(Request $request) {
        $search = trim($request->search);
        $orderBy = $request->orderBy;
        $maxPrice = $request->maxPrice;

        if ($search != null) {
            $items = \DB::table('items')->where('name', 'like', '%' . $search . '%');
            // return redirect('/items');
        } else {
            $items = \DB::table('items');
        }

        if ($maxPrice != null) {
            $items = $items->where('price', '<', $maxPrice);
        }

        $count = $items->count();

        switch ($orderBy) {
            // We have to append the query, otherwise it will reset the search parameters each time that we change the page
            case -1:
                $items = $items->paginate(7)->appends(request()->query());
                break;
            case 1:
                $items = $items->orderBy('price', 'desc')->paginate(7)->appends(request()->query());
                break;
            case 2:
                $items = $items->orderBy('price', 'asc')->paginate(7)->appends(request()->query());
                break;
            default:
                abort(500); // It should never reach this code
                break;
        }
        
        return view('items.items', ["success" => true, "items" => $items, "count" => $count, "search" => $search, "orderBy" => $orderBy, "maxPrice" => $maxPrice]);
    }

    public function edit_view(Item $item) {
        $establishments = \DB::table('establishments')->get();
        $brands = \DB::table('brands')->get();
        return view('items.item_edit', ["success" => true, "item" => $item, "brands" => $brands, "establishments" => $establishments]);
    }
    
    public function edit(Item $item, ItemRequest $request) {

        Item::edit($item, trim($request["name"]), $request["price"], trim($request["description"]), trim($request["type"]),
        Brand::whereId($request["brand"])->first(), Establishment::whereId($request["establishment"])->first());

        return redirect('/items/' . $item->id);
    }

    public function create_view() {
        $brands = Brand::all();
        $establishments = Establishment::all();

        return view('items.item_create', ["success" => true, "brands" => $brands, "establishments" =>$establishments]);
    }

    public function create(ItemRequest $request) {
        
        $item = Item::create(trim($request["name"]), $request["price"], trim($request["description"]), trim($request["type"]),
        Brand::whereId($request->input('dropdownItem'))->first(), Establishment::whereId($request->input('dropdownItem'))->first());

        return redirect('/items/' . $item->id);
    }
}
