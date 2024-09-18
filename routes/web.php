<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::post('/submit-product', [ProductController::class, 'store']);
Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::post('/edit-product/{id}', [ProductController::class, 'edit']);