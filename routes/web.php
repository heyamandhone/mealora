<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuCategoryController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::resource('restaurants', RestaurantController::class)
        ->except(['show']);
    Route::resource('menu-categories', MenuCategoryController::class)
        ->except(['show']);
});

require __DIR__.'/settings.php';
