<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::resource('restaurants', RestaurantController::class)
        ->except(['show']);
    Route::resource('menu-categories', MenuCategoryController::class)
        ->except(['show']);
    Route::resource('menu-items', MenuItemController::class)
        ->except(['show']);
});

require __DIR__.'/settings.php';
