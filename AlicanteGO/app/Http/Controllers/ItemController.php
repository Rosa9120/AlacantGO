<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Establishment;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Auth;

class ItemController extends Controller
{
    public function index () {
        $count = Item::all()->count();
        $items = Item::paginate(7);
        return view('items.items', ["success" => true, "items" => $items, "count" => $count]);
    }

    public function delete(Item $item) {
        return view('items.delete', ["success" => true, "item" => $item]);
    }

    public function show(Item $item) {
        return view('items.item', ["success" => true, "item" => $item]);
    }

    public function destroy($id) 
    {
        $item = Item::Find($id);
        $item->delete();
        return redirect('/admin/items');
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

    // Still needs to check whether is an establishment item or brand item
    public function manager_edit_item(Item $item, ItemRequest $request) {
        $establishment = Establishment::whereId($item->establishment_id)->first();

        if ($establishment == null) {
            abort(404);
        }

        if (!Auth::check() || (Auth::user()->rol != "manager" && Auth::user()->rol != "admin") || ($establishment->manager()->first()->user()->first()->id != Auth::user()->id && Auth::user()->rol == "manager")) {
            abort(403);
        }

        Item::edit($item, trim($request["name"]), $request["price"], trim($request["description"]), $item->type, $item->brand_id, $item->establishment_id);

        return redirect($request["url"]);
    }

    public function manager_create_item(ItemRequest $request) {
        $establishment = Establishment::whereId($request->input("establishment"))->first();

        if ($establishment == null) {
            abort(404);
        }

        if (!Auth::check() || (Auth::user()->rol != "manager" && Auth::user()->rol != "admin") || ($establishment->manager()->first()->user()->first()->id != Auth::user()->id && Auth::user()->rol == "manager")) {
            abort(403);
        }

        Item::create(trim($request["name"]), $request["price"], trim($request["description"]), null, null, $establishment->id); // Needs brand compatibility. No type needed for now

        return redirect($request["url"]);
    }

    public function manager_delete_item(Item $item, Request $request) {
        $item->delete();
        return redirect($request->input("url"));
    }
    
    public function edit(Item $item, ItemRequest $request) {
        Item::edit($item, trim($request["name"]), $request["price"], trim($request["description"]), trim($request["type"]),
        Brand::whereId($request["brand"])->first(), Establishment::whereId($request["establishment"])->first());

        return redirect('/admin/items/' . $item->id);
    }

    public function create_view() {
        $brands = Brand::all();
        $establishments = Establishment::all();

        return view('items.item_create', ["success" => true, "brands" => $brands, "establishments" =>$establishments]);
    }

    public function create(ItemRequest $request) {
        
        $item = Item::create(trim($request["name"]), $request["price"], trim($request["description"]), trim($request["type"]),
        Brand::whereId($request->input('dropdownItem'))->first(), Establishment::whereId($request->input('dropdownItem'))->first());

        return redirect('/admin/items/' . $item->id);
    }
}
