<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Pages\AppController;
use App\Http\Controllers\Pages\SuccessController;
use AwStudio\LaravelJsonTranslations\Facades\JsonTranslations;
use Illuminate\Support\Facades\Route;

// Route::get('/', HomeController::class)->name('home');
Route::get('/success/{code}/{event}', SuccessController::class)->name('success');
Route::get('/import/{token}', [AppController::class, 'upload'])->name('app.upload');
Route::post('/import/{token}', [OrderController::class, 'import'])->name('orders.import');
Route::get('/{organizers}/{event}/{subevent?}', AppController::class)->name('app');
Route::post('/orders/{event}', [OrderController::class, 'create'])->name('orders.create');

JsonTranslations::javascript('localization', ['de', 'en']);
