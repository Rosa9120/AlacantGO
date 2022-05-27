<?php

use Illuminate\Support\Facades\Route;
use App\Models\Establishment;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Manager;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/admin', function () {
    return view('admin');
})->middleware("admin");

//MAIN PAGE ROUTES
Route::get('/aboutus', function () {
    return view('aboutus');
});

//ALTERED REGISTER VIEW
Route::get('/signin', function(){
    $establishments = \DB::table('establishments')->get();
    $brands = \DB::table('brands')->get();
    return view('auth/register', ["success" => true, "brands" => $brands, "establishments" => $establishments]);
});


/** 
 * ADMIN ROUTES
 * */ 
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//las rutas anteriores que pertenezcan al admin deben llevar el prefijo admin
//provisionalmente y para distinguirlas bien, estas rutas se llaman ilyan + lo que sea
//por favor no toqueis estas rutas

Route::get('/ilyan/edit/{item}', function (Item $item, Request $request) {
    return view('ilyan_edit_item')->with('item',$item)->with('url', back()->getTargetUrl());
});

Route::get('/ilyan/create/brand', function () {    
    return view('ilyan_create_brand');
});

Route::patch('/ilyan/{item}', [App\Http\Controllers\ItemController::class, 'manager_edit_item']);

Route::get('/ilyan/create/establishment', function () {
    return view('ilyan_create_establishment');
});

Route::delete('/ilyan/{item}', [App\Http\Controllers\ItemController::class, 'manager_delete_item']);

Route::get('/ilyan/create/{establishment}', function (Establishment $establishment) {    
    return view('ilyan_create_item')->with("establishment", $establishment)->with("url", back()->getTargetUrl());
});

Route::post('/ilyan', [App\Http\Controllers\ItemController::class, 'manager_create_item']);

Route::get('/ilyan/edit/establishment/{establishment}', function ($establishment) {    
    $establishment = Establishment::whereId($establishment)->first();
    $brands = Brand::get();
    $categories = Category::get();
    return view('ilyan_edit_establishment',['brands' => $brands, 'establishment' => $establishment, 'categories' => $categories]);
});

Route::patch('/ilyan/establishment/{establishment}', [App\Http\Controllers\EstablishmentController::class, 'manager_edit_establishment']);

Route::delete('/ilyan/establishment/{establishment}', [App\Http\Controllers\EstablishmentController::class, 'manager_delete_establishment']);

Route::get('/establishments/filter', [App\Http\Controllers\EstablishmentController::class, 'filter_establishments']);

Route::get('/establishment/{establishment}', function($establishment){
    $establishment = Establishment::whereId($establishment)->first();
    return view('establishment')->with("establishment", $establishment);
});

Route::get('/brand/{brand}', function($brand){
    $establishments = Establishment::where('brand_id','=',$brand)->get();
    $items = Item::where('brand_id',"=",$brand)->get();
    $brand = Brand::whereId($brand)->first();
    return view('brand')->with("brand", $brand)->with("establishments",$establishments)->with("items",$items);
});

Route::get('/profile', function () {
    $manager = Manager::where('user_id','=', Auth::user()->id)->first();
    return view('profile')->with("manager", $manager);
});


