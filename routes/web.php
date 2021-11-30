<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/orders', [OrderController::class, 'create'])->name('orders.create');
