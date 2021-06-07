<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\SuscripcionController;
use App\Models\SuscripcionMovimiento;
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
    return redirect()->route('client.list');
});

Route::get('/clients', [ClientController::class, 'index'])->name('client.list');
Route::get('/datatable/clients', [ClientController::class, 'datatable'])->name('clients.list.datatable');
Route::get('/clients/create', [ClientController::class, 'create'])->name('client.create');
Route::post('/clients/create', [ClientController::class, 'store'])->name('client.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->where('id', '[0-9]+')->name('client.edit');
Route::post('/clients/{id}/update', [ClientController::class, 'update'])->where('id', '[0-9]+')->name('client.update');
Route::get('/clients/{id}/destroy', [ClientController::class, 'destroy'])->where('id', '[0-9]+')->name('client.destroy');


Route::get('/clients/{client}/mascota', [MascotaController::class, 'index'])->where('client', '[0-9]+')->name('mascota.list');
Route::get('/datatable/clients/{client}/mascota', [MascotaController::class, 'datatable'])->where('client', '[0-9]+')->name('mascota.datatable');
Route::get('/clients/{client}/mascota/create', [MascotaController::class, 'create'])->where('client', '[0-9]+')->name('mascota.create');
Route::post('/clients/{client}/mascota/store', [MascotaController::class, 'store'])->where('client', '[0-9]+')->name('mascota.store');
Route::get('/mascota/{id}/edit', [MascotaController::class, 'edit'])->where('id', '[0-9]+')->name('mascota.edit');
Route::post('/mascota/{id}/update', [MascotaController::class, 'update'])->where('id', '[0-9]+')->name('mascota.update');
Route::get('/mascota/{id}/destroy', [MascotaController::class, 'destroy'])->where('id', '[0-9]+')->name('mascota.destroy');


Route::get('/suscripcion/{suscripcion}/movientos', [SuscripcionController::class, 'index'])->where('client', '[0-9]+')->name('movimientos.list');
Route::get('/datatable/suscripcion/{suscripcion}/movientos', [SuscripcionController::class, 'datatable'])->where('client', '[0-9]+')->name('datatable.movimientos.list');
Route::get('/suscripcion/{suscripcion}/movientos/create', [SuscripcionController::class, 'create'])->where('client', '[0-9]+')->name('movimiento.create');
Route::post('/suscripcion/{suscripcion}/movientos/store', [SuscripcionController::class, 'index'])->where('client', '[0-9]+')->name('movimiento.store');
Route::get('movientos/{id}/destroy', [SuscripcionController::class, 'index'])->where('client', '[0-9]+')->name('movimiento.destroy');