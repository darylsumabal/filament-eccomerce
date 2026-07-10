<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home/welcome')->name('home');
Route::view('/coffee', 'pages.coffee/index')->name('coffee.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
