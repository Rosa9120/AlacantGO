<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin');
});

// ITEMS' ROUTES
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
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
Route::delete('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'delete']);
Route::get('/managers/search', [App\Http\Controllers\ManagerController::class, 'search']);
Route::get('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::get('/addmanagers', [App\Http\Controllers\ManagerController::class, 'create_view']);
Route::post('/addmanagers/create', [App\Http\Controllers\ManagerController::class, 'create']);
Route::get('/managers/show/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::get('/managers/edit/{manager}', [App\Http\Controllers\ManagerController::class, 'edit_view']);
Route::patch('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'edit']);

// ESTABLISHMENTS' ROUTES
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'get_all']);
Route::get('/establishment/new', [App\Http\Controllers\EstablishmentController::class, 'create_establishment']);
Route::get('/establishment/{id}', [App\Http\Controllers\EstablishmentController::class, 'get_establishment']);
Route::delete('/establishment/{id}', [App\Http\Controllers\EstablishmentController::class, 'delete_establishment']);
Route::post('/establishment/new', [App\Http\Controllers\EstablishmentController::class, 'create_establishment_process']);
Route::get('/establishment/edit/{id}', [App\Http\Controllers\EstablishmentController::class, 'update_establishment']);
Route::post('/establishment/edit/{id}', [App\Http\Controllers\EstablishmentController::class, 'update_establishment_process']);
Route::get('/establishments/search', [App\Http\Controllers\EstablishmentController::class, 'search_establishment']);

/**
 * BRAND ROUTES
 */

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index']);
Route::get('/brands/get', function () {return view('brand.getForm');}); //ACCEDEMOS AL FORMULARIO
Route::post('/brands/get', [App\Http\Controllers\BrandController::class, 'get_brand']); //ENVIAMOS LA INFORMACIÓN INTRODUCIDA DEL FORMULARIO AL CONTROLADOR

Route::get('/brands/update', function () {return view('brand.updateForm');});
Route::patch('/brands/update', [App\Http\Controllers\BrandController::class, 'update_brand']);

Route::get('/brands/create', function () {return view('brand.brand_create');});
Route::post('/brands/create', [App\Http\Controllers\BrandController::class, 'create_brand']);
Route::delete('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'delete_brand']);
Route::get('/brands/search', [App\Http\Controllers\BrandController::class, 'search_brand']);

Route::get('/brands/{brand}/edit', [App\Http\Controllers\BrandController::class, 'edit']);
Route::patch('/brands/{brand}', [App\Http\Controllers\BrandController::class, 'edit_brand']);

/**
 * CATEGORY ROUTES
 */

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/create', function () {return view('categories.category_create');});
Route::post('/categories/create', [App\Http\Controllers\CategoryController::class, 'create_category']);

Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'delete_category']);
Route::get('/categories/search', [App\Http\Controllers\CategoryController::class, 'search_category']);

Route::get('/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::patch('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'edit_category']);
