<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Pages\AppController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', HomeController::class)->name('home');
Route::get('/{organizers}/{event}/{subevent}', AppController::class)->name('app');
Route::get('/success/{code}', [AppController::class, 'success'])->name('success');
Route::post('/orders', [OrderController::class, 'create'])->name('orders.create');

// Route::get('/download', [OrderController::class, 'downloadFile'])->name('downloadFile');