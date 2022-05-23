<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/admin', function () {
    return view('admin');
})->middleware("admin");

Route::get('/aboutus', function () {
    return view('aboutus');
});

// ITEMS' ROUTES
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->middleware("admin");
Route::get('/items/create', [App\Http\Controllers\ItemController::class, 'create_view']);
Route::post('/items', [App\Http\Controllers\ItemController::class, 'create']);
Route::get('/items/search', [App\Http\Controllers\ItemController::class, 'search']);
Route::get('/items/{item}', [App\Http\Controllers\ItemController::class, 'show']);
Route::patch('/items/{item}', [App\Http\Controllers\ItemController::class, 'edit']);
Route::get('/items/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit_view']);
Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'delete']);

/**
 * MANAGER ROUTES
 */
Route::get('/managers', [App\Http\Controllers\ManagerController::class, 'index']);
Route::get('/managers/create', [App\Http\Controllers\ManagerController::class, 'create_view']);
Route::post('/managers', [App\Http\Controllers\ManagerController::class, 'create']);
Route::get('/managers/search', [App\Http\Controllers\ManagerController::class, 'search']);
Route::get('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::get('/managers/{manager}/edit', [App\Http\Controllers\ManagerController::class, 'edit_view']);
Route::patch('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'edit']);
Route::delete('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'delete']);

// ESTABLISHMENTS' ROUTES
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'index']);
Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create_view']);
Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'create']);
Route::get('/establishments/search', [App\Http\Controllers\EstablishmentController::class, 'search']);
Route::get('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'show'])->name('establishment');
Route::get('/establishments/{id}/edit', [App\Http\Controllers\EstablishmentController::class, 'edit_view']);
Route::patch('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'edit']);
Route::delete('/establishments/{id}', [App\Http\Controllers\EstablishmentController::class, 'delete']);

/**
 * BRAND ROUTES
 */

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index']);
Route::get('/brands/create', function () {return view('brand.brand_create');});
Route::post('/brands/create', [App\Http\Controllers\BrandController::class, 'create_brand']);
Route::delete('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'delete_brand']);
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
