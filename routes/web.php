<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.welcome')->name('home');
Route::view('/coffee', 'pages.coffee.index')->name('coffee.index');
Route::view('/dessert', 'pages.dessert.index')->name('dessert.index');
Route::view('/testimonial', 'pages.testimonial.index')->name('testimonial.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
