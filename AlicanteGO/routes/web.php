<?php

use Illuminate\Support\Facades\Route;
use App\Models\Establishment;
use App\Models\Item;

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


Route::get('/establishment/{establishment}', function($establishment){
    $establishment = Establishment::whereId($establishment)->first();
    return view('establishment')->with("establishment", $establishment);
});

// ITEMS' ROUTES
Route::group(['middleware' => 'admin'], function() {
    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/items/create', [App\Http\Controllers\ItemController::class, 'create_view']);
    Route::post('/items', [App\Http\Controllers\ItemController::class, 'create']);
    Route::get('/items/search', [App\Http\Controllers\ItemController::class, 'search']);
    Route::get('/items/{item}', [App\Http\Controllers\ItemController::class, 'show']);
    Route::patch('/items/{item}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::get('/items/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit_view']);
    Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'delete']);
});

/**
 * MANAGER ROUTES
 */
Route::get('/managers', [App\Http\Controllers\ManagerController::class, 'index']);
Route::get('/managers/delete/{manager}', [App\Http\Controllers\ManagerController::class, 'delete']);
Route::get('/managers/remove/{manager}', [App\Http\Controllers\ManagerController::class, 'destroy']);
Route::get('/managers/search', [App\Http\Controllers\ManagerController::class, 'search']);
Route::get('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::get('/addmanagers', [App\Http\Controllers\ManagerController::class, 'create_view']);
Route::post('/addmanagers/create', [App\Http\Controllers\ManagerController::class, 'create']);
Route::get('/managers/show/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::get('/managers/edit/{manager}', [App\Http\Controllers\ManagerController::class, 'edit_view']);
Route::patch('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'edit']);

// ESTABLISHMENTS' ROUTES
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'get_all']);
Route::get('/addestablishments', [App\Http\Controllers\EstablishmentController::class, 'create_establishment']);
Route::get('/establishments/filter', [App\Http\Controllers\EstablishmentController::class, 'filter_establishments']);
Route::post('/addestablishments/create', [App\Http\Controllers\EstablishmentController::class, 'create_establishment_process']);
Route::get('/establishments/search', [App\Http\Controllers\EstablishmentController::class, 'search_establishment']);
Route::get('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'get_establishment'])->name('establishment');
Route::patch('/establishments/edit/{id}', [App\Http\Controllers\EstablishmentController::class, 'update_establishment_process']);
Route::get('/establishments/edit/{id}', [App\Http\Controllers\EstablishmentController::class, 'update_establishment']);
Route::get('/establishments/delete/{id}', [App\Http\Controllers\EstablishmentController::class, 'delete_establishment']);
Route::get('/establishments/remove/{id}', [App\Http\Controllers\EstablishmentController::class, 'destroy']);

/**
 * BRAND ROUTES
 */

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index']);
Route::get('/brands/create', function () {return view('brand.brand_create');});
Route::post('/brands/create', [App\Http\Controllers\BrandController::class, 'create_brand']);
Route::get('/brands/remove/{id}', [App\Http\Controllers\BrandController::class, 'destroy']);
Route::get('/brands/delete/{brand}', [App\Http\Controllers\BrandController::class, 'delete_brand']);
Route::get('/brands/search', [App\Http\Controllers\BrandController::class, 'search_brand']);

Route::get('/brands/{brand}/edit', [App\Http\Controllers\BrandController::class, 'edit']);
Route::patch('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'edit_brand']);

//MÉTODOS

Route::get('/brands/get', function () {return view('brand.getForm');}); //ACCEDEMOS AL FORMULARIO
Route::post('/brands/get', [App\Http\Controllers\BrandController::class, 'get_brand']); //ENVIAMOS LA INFORMACIÓN INTRODUCIDA DEL FORMULARIO AL CONTROLADOR

Route::get('/brands/set', [App\Http\Controllers\BrandController::class, 'set_brand']);
Route::put('/brands/update', [App\Http\Controllers\BrandController::class, 'update_brand']); //THIS IS FOR THE SET BRAND

/**
 * CATEGORY ROUTES
 */

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/create', function () {return view('categories.category_create');});
Route::post('/categories/create', [App\Http\Controllers\CategoryController::class, 'create_category']);

Route::get('/categories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete_category']);
Route::get('/categories/remove/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::get('/categories/search', [App\Http\Controllers\CategoryController::class, 'search_category']);

Route::get('/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::patch('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'edit_category']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* NO SE DONDE PONER ESTO */

Route::get('/profile', function () {
    return view('profile');
});

