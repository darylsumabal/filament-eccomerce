<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home.index');
Route::livewire('/coffee', 'pages::coffee.index')->name('coffee.index');
Route::livewire('/dessert', 'pages::dessert.index')->name('dessert.index');
Route::view('/testimonial', 'pages.testimonial.index')->name('testimonial.index');
Route::livewire('/checkout', 'pages::checkout.index')->name('checkout.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
