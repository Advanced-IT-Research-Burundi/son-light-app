<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [DashboardController::class , 'dashboard'])->name('dashboard');
    Route::view('profile', 'profile');
    Route::resource('users', UserController::class);
    Route::resource('orders', controller: OrderController::class);
    Route::resource('clients', ClientController::class);

});
require_once __DIR__.'/auth.php';
