<?php

use App\Http\Controllers\NumberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NumberController::class, 'index'])->name('home');
Route::post('/generate-random', [NumberController::class, 'generateRandom'])->name('numbers.generate');
Route::resource('numbers', NumberController::class);
