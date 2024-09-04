<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;


Route::get('/currency/latest', [CurrencyController::class, 'fetchLatestRates']);
Route::get('/currency/rates/by-date', [CurrencyController::class, 'getRatesByDate']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/currencies', function () {
    return App\Models\Currency::all();
});
