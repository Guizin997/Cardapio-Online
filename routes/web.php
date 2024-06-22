<?php

use App\Http\Controllers\CardapioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardapioController::class, 'index'])->name('cardapio.index');
