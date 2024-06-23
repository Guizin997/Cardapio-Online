<?php

use App\Http\Controllers\CardapioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardapioController::class, 'index'])->name('cardapio.index');




Route::get('/login', [CardapioController::class, 'login'])->name('login');
Route::get('/logout', [CardapioController::class, 'logout'])->name('logout');

Route::post('/auth', [CardapioController::class, 'auth'])->name('auth');

Route::post('/products/store', [CardapioController::class, 'store'])->name('products.store');
