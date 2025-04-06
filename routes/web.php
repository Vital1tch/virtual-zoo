<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Index
Route::get('/', [HomeController::class, 'index'])->name('home');

//Клетки
Route::resource('cages', CageController::class);

Route::get('/cage/{id}/edit', [CageController::class, 'edit'])->name('cages.edit');

Route::put('/cage/{id}', [CageController::class, 'update'])->name('cages.update');

Route::delete('/cage/{id}', [CageController::class, 'destroy'])->name('cages.destroy');

//Животные
Route::resource('animals', AnimalController::class);

Route::delete('/animals/{id}', [AnimalController::class, 'destroy'])->name('animals.destroy');

Route::get('/animal/{id}', [AnimalController::class, 'show'])->name('animals.show');

Route::get('/animal/{id}/edit', [AnimalController::class, 'edit'])->name('animals.edit');

Route::put('/animal/{id}', [AnimalController::class, 'update'])->name('animals.update');
