<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboard\ProfileController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')->middleware('auth');

Route::group(['middleware' => ['auth:admin,web'],
    'as' => 'dashboard.', // view in controller
    'prefix' => 'dashboard'], function (){ // route


    //Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index' );
    Route::get('categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');
    Route::resource('categories',CategoryController::class);


    Route::get('products/trash', [ProductController::class, 'trash'])
        ->name('products.trash');
    Route::put('products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');
    Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])
        ->name('products.force-delete');
    Route::resource('products',ProductController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');


});


