<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [DashboardController::class , 'dashboard'])->name('dashboard');
    Route::view('profile', 'profile');
    Route::resource('users', UserController::class);
    Route::resource('orders', controller: OrderController::class);
    Route::resource('clients', ClientController::class);

    Route::resource('stocks', StockController::class);
Route::post('stock-movements', [StockMovementController::class, 'store'])->name('stock-movements.store');

});
require_once __DIR__.'/auth.php';


Route::resource('tasks', App\Http\Controllers\TaskController::class);


Route::resource('tasks', App\Http\Controllers\TaskController::class);

