<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/loan-calculator', [App\Http\Controllers\HomeController::class, 'loan'])->name('loan.calculator');
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/cars/compare', [App\Http\Controllers\CarController::class, 'compare'])->name('cars.compare');
Route::get('/cars/saved', [App\Http\Controllers\CarController::class, 'saved'])->name('cars.saved');
Route::resource('cars', App\Http\Controllers\CarController::class);

require __DIR__.'/auth.php';
