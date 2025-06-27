<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth:sanctum');

// Rotas para produtos
Route::apiResource('products', ProductController::class);

// Rotas para pedidos
Route::apiResource('orders', OrderController::class);

// Rotas para favoritos
Route::apiResource('favorites', FavoriteController::class);
