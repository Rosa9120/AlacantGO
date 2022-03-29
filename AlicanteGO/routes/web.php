<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;


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
Route::post('/items/search', [App\Http\Controllers\ItemController::class, 'search']);
Route::get('/items/{item}', [App\Http\Controllers\ItemController::class, 'show']);
Route::patch('/items/{item}', [App\Http\Controllers\ItemController::class, 'edit']);
Route::get('/items/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit_view']);
Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'delete']);

/**
 * MANAGER ROUTES
 */
Route::get('/managers', [App\Http\Controllers\ManagerController::class, 'index']);
Route::delete('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'delete']);
Route::get('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);
Route::post('/managers/search', [App\Http\Controllers\ManagerController::class, 'search']);
Route::get('/addmanagers', [App\Http\Controllers\ManagerController::class, 'create_view']);
Route::post('/addmanagers/create', [App\Http\Controllers\ManagerController::class, 'create']);
Route::get('/managers/show/{manager}', [App\Http\Controllers\ManagerController::class, 'show']);


// ESTABLISHMENTS' ROUTES
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'create_establishment']);
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'get_all']);
Route::get('/establishment/{id}', [App\Http\Controllers\EstablishmentController::class, 'get_establishment']);
Route::get('/establishmentadd', [App\Http\Controllers\EstablishmentController::class, 'create_establishment']);

/**
 * BRAND ROUTES
 */
//Route::put('brand', [BrandController::class, 'form'])->name('brand.getBrand');
Route::get('brand', function () {return view('brand.paths_overview');});
Route::get('brand/get', function () {return view('brand.getForm');}); //ACCEDEMOS AL FORMULARIO
Route::post('brand', [BrandController::class, 'get_brand'])->name('brand.getBrand'); //ENVIAMOS LA INFORMACIÓN INTRODUCIDA DEL FORMULARIO AL CONTROLADOR
Route::get('brand/set', function () {return view('brand.setForm');});
Route::post('brand', [BrandController::class, 'set_brand'])->name('brand.setBrand');
