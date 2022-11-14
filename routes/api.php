<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->prefix('/api')->group(function() {
    Route::get('company', [ApiController::class, 'getCotationInfo'])->name('company');
    Route::get('last-price', [ApiController::class, 'getLatestPrice'])->name('latestPrice');
    Route::get('company/{symbol}/', [ApiController::class, 'getCompanyInfo'])->name('company-info');
    Route::get('company/{symbol}/quote/{field?}', [ApiController::class, 'getQuoteInfo'])->name('company-quote');
});
