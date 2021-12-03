<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Pages\AppController;
use AwStudio\LaravelJsonTranslations\Facades\JsonTranslations;

// Route::get('/', HomeController::class)->name('home');
Route::get('/{organizers}/{event}/{subevent}', AppController::class)->name('app');
Route::get('/success/{code}', [AppController::class, 'success'])->name('success');
Route::post('/orders/{event}', [OrderController::class, 'create'])->name('orders.create');

JsonTranslations::javascript('localization', ['de', 'en']);