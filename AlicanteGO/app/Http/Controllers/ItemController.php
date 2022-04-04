<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Establishment;

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

    public function search() {
        $search = \Request::get('search');
        $orderBy = \Request::get('orderBy');

        if ($search == null) {
            return redirect('/items');
        }

        $search = trim($search);

        $items = \DB::table('items');
        $count = \DB::table('items')->where('name', 'like', '%' . $search . '%')->count();

        switch ($orderBy) {
            // We have to append the query, otherwise it will reset the search parameters each time that we change the page
            case -1:
                $items = $items->where('name', 'like', '%' . $search . '%')->paginate(7)->appends(request()->query());
                break;
            case 1:
                $items = $items->where('name', 'like', '%' . $search . '%')->orderBy('price', 'desc')->paginate(7)->appends(request()->query());
                break;
            case 2:
                $items = $items->where('name', 'like', '%' . $search . '%')->orderBy('price', 'asc')->paginate(7)->appends(request()->query());
                break;
            default:
                abort(500); // It should never reach this code
                break;
        }
        
        return view('items.items', ["success" => true, "items" => $items, "count" => $count, "search" => $search, "orderBy" => $orderBy]);
    }

    public function edit_view(Item $item) {
        $establishments = \DB::table('establishments')->get();
        $brands = \DB::table('brands')->get();
        return view('items.item_edit', ["success" => true, "item" => $item, "brands" => $brands, "establishments" => $establishments]);
    }

    public function edit(Item $item) {
        $request = \Request::all();
        $item->name = trim($request["name"]);
        $item->price = $request["price"];
        $item->description = trim($request["description"]);
        $item->type = trim($request["type"]);
        if (\Request::has("brand")) {
            $brand = Brand::whereId($request["brand"])->first();
            $item->brand()->associate($brand);
        }
        else {
            $establishment = Establishment::whereId($request["establishment"])->first();
            $item->establishment()->associate($establishment);
        }

        $item->save();

        return redirect('/items/' . $item->id);
    }

    public function create_view() {
        $brands = Brand::all();
        $establishments = Establishment::all();

        return view('items.item_create', ["success" => true, "brands" => $brands, "establishments" =>$establishments]);
    }

    public function create(Request $request) {
        $item = new Item;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->type = $request->input('type');

        if ($request->input('radioItem') == 'brand') {
            $item->brand()->associate(Brand::whereId($request->input('dropdownItem'))->first());
        } else {
            $item->establishment()->associate(Establishment::whereId($request->input('dropdownItem'))->first());
        }

        $item->save();

        return redirect('/items/' . $item->id);
    }
}
