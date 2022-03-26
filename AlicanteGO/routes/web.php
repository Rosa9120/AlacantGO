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

<<<<<<< HEAD
Route::get('/', function () {return view('welcome');});


//BRAND ROUTES
Route::get('brand', function () {return view('brand.paths_overview');});

Route::get('brand/get', function () {return view('brand.getForm');}); //ACCEDEMOS AL FORMULARIO
Route::post('brand', [BrandController::class, 'get_brand'])->name('brand.getBrand'); //ENVIAMOS LA INFORMACIÓN INTRODUCIDA DEL FORMULARIO AL CONTROLADOR

Route::get('brand/set', function () {return view('brand.setForm');});
Route::post('brand', [BrandController::class, 'set_brand'])->name('brand.setBrand');

//Route::put('brand', [BrandController::class, 'form'])->name('brand.getBrand');
=======
Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/managers', [App\Http\Controllers\ManagerController::class, 'index']);
Route::delete('/managers/{manager}', [App\Http\Controllers\ManagerController::class, 'delete']);
Route::get('/establishments', [App\Http\Controllers\EstablishmentController::class, 'get_all']);
Route::get('/establishment/{id}', [App\Http\Controllers\EstablishmentController::class, 'get_establishment']);
Route::get('/establishmentadd', [App\Http\Controllers\EstablishmentController::class, 'create_establishment']);
>>>>>>> ea12c157931d50a392360c1955a836dfaec68c7f
