<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('cages', CageController::class);

Route::resource('animals', AnimalController::class);

Route::delete('/animals/{id}', [AnimalController::class, 'destroy'])->name('animals.destroy');
