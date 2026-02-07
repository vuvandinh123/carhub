<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/loan-calculator', [App\Http\Controllers\HomeController::class, 'loan'])->name('loan.calculator');
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/cars/compare', [App\Http\Controllers\CarController::class, 'compare'])->name('cars.compare');
Route::get('/cars/saved', [App\Http\Controllers\CarController::class, 'saved'])->name('cars.saved');
Route::get('/cars/search', [App\Http\Controllers\CarController::class, 'search'])->name('cars.search');
Route::get('cars/{slug}', [App\Http\Controllers\CarController::class, 'show'])->name('cars.show');
Route::get('/cars', [App\Http\Controllers\CarController::class, 'index'])->name('cars.index');


// Consultation Request Routes
Route::post('/consultation-request', [App\Http\Controllers\ConsultationRequestController::class, 'store'])->name('consultation.store');
Route::post('/consultation-request/car/{car}', [App\Http\Controllers\ConsultationRequestController::class, 'storeForCar'])->name('consultation.store.car');

require __DIR__.'/auth.php';
