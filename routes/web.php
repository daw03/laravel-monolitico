<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');


Route::controller(\App\Http\Controllers\PeticioneController::class)->group(function () {
    Route::get('peticiones/index', 'index')->name('peticiones.index');
    Route::get('mispeticiones', 'listMine')->name('peticiones.mine');
    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('peticiones.peticionesfirmadas');
    Route::get('peticiones/{id}', 'show')->name('peticiones.show');
    Route::get('peticion/add', 'create')->name('peticiones.create');
    Route::post('peticion', 'store')->name('peticiones.store');
    Route::delete('peticiones/{id}', 'delete')->name('peticiones.delete');
    Route::put('peticiones/{id}', 'update')->name('peticiones.update');
    Route::post('peticiones/firmar/{id}', 'firmar')->name('peticiones.firmar');
    Route::get('peticiones/edit/{id}', 'update')->name('peticiones.edit');
});

Route::get('/users/firmas', [\App\Http\Controllers\UserController::class,'peticionesFirmadas'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
