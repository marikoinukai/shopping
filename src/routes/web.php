<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::patch('/products/update', [ProductController::class, 'update']);
Route::delete('/products/delete', [ProductController::class, 'destroy']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::patch('/categories/update', [CategoryController::class, 'update']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::delete('/categories/delete', [CategoryController::class, 'destroy']);