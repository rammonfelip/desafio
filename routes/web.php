<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('api.')->prefix('/api')->group(function() {
        Route::get('company', [ApiController::class, 'getCotationInfo'])->name('company');
        Route::get('last-price', [ApiController::class, 'getLatestPrice'])->name('latestPrice');
    });
});

require __DIR__.'/auth.php';
