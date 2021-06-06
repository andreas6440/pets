<?php

use App\Http\Controllers\ClientController;
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
    return view('welcome');
});
Route::get('/clients', [ClientController::class, 'index'])->name('clients.list');
Route::get('/datatable/clients', [ClientController::class, 'datatable'])->name('clients.list.datatable');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->where('id', '[0-9]+')->name('client.edit');
Route::get('/clients/{id}/destroy', [ClientController::class, 'destroy'])->where('id', '[0-9]+')->name('client.destroy');