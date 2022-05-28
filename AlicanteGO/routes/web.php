<?php

use Illuminate\Support\Facades\Route;
use App\Models\Establishment;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Manager;
use Illuminate\Http\Request;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

/**
 * PUBLIC PART ROUTES
 */

Route::get('/aboutus', function () {return view('aboutus');});

//ALTERED REGISTER VIEW
Route::get('/signin', function(){
    $establishments = \DB::table('establishments')->get();
    $brands = \DB::table('brands')->get();
    return view('auth/register', ["success" => true, "brands" => $brands, "establishments" => $establishments]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/establishments/filter', [App\Http\Controllers\EstablishmentController::class, 'filter_establishments']);

/** 
 * ADMIN ROUTES
 * */ 

Route::get('/admin', function () {
    return view('admin');
})->middleware("admin");

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function() {
    /** 
     * ITEM ROUTES
     */

    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/items/create', [App\Http\Controllers\ItemController::class, 'create_view']);
    Route::post('/items', [App\Http\Controllers\ItemController::class, 'create']);
    Route::get('/items/search', [App\Http\Controllers\ItemController::class, 'search']);
    Route::get('/items/{item}', [App\Http\Controllers\ItemController::class, 'show']);
    Route::patch('/items/{item}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::get('/items/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit_view']);
    Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'destroy']);

    /**
     * MANAGER ROUTES
     */
    Route::get('/managers', [App\Http\Controllers\ManagerController::class, 'index']);
    Route::get('/managers/create', [App\Http\Controllers\ManagerController::class, 'create_view']);
    Route::post('/managers', [App\Http\Controllers\ManagerController::class, 'create']);
    Route::get('/managers/search', [App\Http\Controllers\ManagerController::class, 'search']);
    Route::get('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
    Route::patch('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'edit']);
    Route::get('/managers/{manager}/edit', [App\Http\Controllers\ManagerController::class, 'edit_view']);
    Route::delete('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'destroy']);

    /**
     * ESTABLISHMENT ROUTES
     */

    Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'index']);
    Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create_view']);
    Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'create']);
    Route::get('/establishments/search', [App\Http\Controllers\EstablishmentController::class, 'search']);
    Route::get('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'show'])->name('establishment');
    Route::patch('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'edit']);
    Route::get('/establishments/{id}/edit', [App\Http\Controllers\EstablishmentController::class, 'edit_view']);
    Route::delete('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'destroy']);

    /**
     * CATEGORY ROUTES
     */

    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/categories/create', function () {return view('categories.category_create');});
    Route::post('/categories/create', [App\Http\Controllers\CategoryController::class, 'create_category']);
    Route::get('/categories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete_category']);
    Route::get('/categories/search', [App\Http\Controllers\CategoryController::class, 'search_category']);
    Route::get('/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::patch('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'edit_category']);
    Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);


    /**
     * BRAND ROUTES
     */

    Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index']);
    Route::get('/brands/create', [App\Http\Controllers\BrandController::class, 'create_view']);
    Route::post('/brands', [App\Http\Controllers\BrandController::class, 'create']);
    Route::get('/brands/search', [App\Http\Controllers\BrandController::class, 'search']);
    Route::patch('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'edit']);
    Route::delete('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'destroy']);
    Route::get('/brands/set', [App\Http\Controllers\BrandController::class, 'set_brand']);
    Route::get('/brands/{brand}/edit', [App\Http\Controllers\BrandController::class, 'edit_view']);
    Route::put('/brands/update', [App\Http\Controllers\BrandController::class, 'update_brand']); //THIS IS FOR THE SET BRAND

});


/**
 * CREATE ESTABLISHMENT
 */

Route::get('/establishment/create', function () {
    if (!Auth::check() || Auth::user()->rol != "manager" || Manager::whereUserId(Auth::user()->id)->first()->establishment_id != null) {
        abort(403);
    }
    $brands = Brand::get();
    $categories = Category::get();
    return view('manager_create_establishment')->with('brands',$brands)->with('categories',$categories);
});
Route::post('/establishment', [App\Http\Controllers\EstablishmentController::class, 'manager_create_establishment']);


/**
 * ESTABLISHMENT VIEW
 */

Route::get('/establishment/{establishment}', function($establishment){
    $establishment = Establishment::whereId($establishment)->first();
    return view('establishment')->with("establishment", $establishment);
});

/**
 * BRAND VIEW
*/

Route::get('/brand/{brand}', function($brand){
    $establishments = Establishment::where('brand_id','=',$brand)->get();
    $items = Item::where('brand_id',"=",$brand)->get();
    $brand = Brand::whereId($brand)->first();
    return view('brand')->with("brand", $brand)->with("establishments",$establishments)->with("items",$items);
});


/**
 * UPDATE AND DELETE ESTABLISHMENT
 */

Route::get('/establishment/{establishment}/edit', function ($establishment) {    
    $establishment = Establishment::whereId($establishment)->first();
    $brands = Brand::get();
    $categories = Category::get();
    return view('manager_edit_establishment',['brands' => $brands, 'establishment' => $establishment, 'categories' => $categories]);
});

Route::patch('/establishment/{establishment}', [App\Http\Controllers\EstablishmentController::class, 'manager_edit_establishment']);

Route::delete('/establishment/{establishment}', [App\Http\Controllers\EstablishmentController::class, 'manager_delete_establishment']);

/**
 * CREATE ITEM
 */

Route::get('/item/create/', function (Request $request) {   // create item 
    $establishment = null;
    $brand = null;

    if ($request->has("establishment")) {
        $establishment = Establishment::whereId($request->input("establishment"))->first();
        if ($establishment == null) {
            abort(404);
        }
    } elseif ($request->has("brand")) {
        $brand = Brand::whereId($request->input("brand"))->first();
        if ($brand == null) {
            abort(404);
        }
    }

    return view('manager_create_item')->with("establishment", $establishment)->with("brand", $brand)->with("url", back()->getTargetUrl());
});

Route::post('/item', [App\Http\Controllers\ItemController::class, 'manager_create_item']);

/**
 * UPDATE AND DELETE ITEM
 */

Route::get('/item/{item}/edit', function (Item $item, Request $request) {
    return view('manager_edit_item')->with('item',$item)->with('url', back()->getTargetUrl());
});

Route::patch('/item/{item}', [App\Http\Controllers\ItemController::class, 'manager_edit_item']);
Route::delete('/item/{item}', [App\Http\Controllers\ItemController::class, 'manager_delete_item']);

/**
 * CREATE BRAND
 */

Route::get('/brand/create', function () { 
    if (!Auth::check() || Auth::user()->rol != "manager" || Manager::whereUserId(Auth::user()->id)->first()->brand_id != null) {
        abort(403);
    }
    return view('manager_create_brand');
});

Route::post('/brand', [App\Http\Controllers\BrandController::class, 'manager_create_brand']);

/**
 * UPDATE BRAND
 */

Route::get('/brand/{brand}/edit', function ($brand) {    
    $brand = Brand::whereId($brand)->first();
    return view('manager_edit_brand')->with('brand',$brand);
});

Route::patch('/brand/{brand}', [App\Http\Controllers\BrandController::class, 'manager_edit_brand']);

Route::get('/profile', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    
    if (Auth::user()->rol == "admin") {
        return redirect('/admin');
    }

    $manager = Manager::where('user_id','=', Auth::user()->id)->first();

    return view('profile')->with("manager", $manager);
});


