<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('cars', App\Http\Controllers\CarController::class);

require __DIR__.'/auth.php';
