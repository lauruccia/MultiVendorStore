<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an Administrator
| dashboard. These routes are loaded by the DashboardServiceProvider.
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('dashboard/categories', CategoryController::class);
    Route::resource('dashboard/products', CategoryController::class);
    
});