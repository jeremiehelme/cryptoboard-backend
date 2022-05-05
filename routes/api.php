<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeCurrencyController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('exchange', [ExchangeController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('exchange', [ExchangeController::class, 'store']);
Route::middleware(['auth:sanctum'])->delete('exchange/{exchange}', [ExchangeController::class, 'delete']);

// Route::get('exchange/{exchange}', [ExchangeController::class, 'show']);
// Route::put('exchange/{exchange}', [ExchangeController::class, 'update']);


Route::middleware(['auth:sanctum'])->get('portfolio', [PortfolioController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('portfolio/{id}', [PortfolioController::class, 'show']);
Route::middleware(['auth:sanctum'])->post('portfolio', [PortfolioController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('portfolio/{id}', [PortfolioController::class, 'update']);
Route::middleware(['auth:sanctum'])->delete('portfolio/{id}', [PortfolioController::class, 'delete']);


Route::middleware(['auth:sanctum'])->get('currency', [CurrencyController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('currency', [CurrencyController::class, 'store']);
Route::middleware(['auth:sanctum'])->delete('currency/{currency}', [CurrencyController::class, 'delete']);


Route::middleware(['auth:sanctum'])->get('exchange_currencies', [ExchangeCurrencyController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('exchange_currencies', [ExchangeCurrencyController::class, 'store']);
Route::middleware(['auth:sanctum'])->delete('exchange_currencies/{exchange_currencies}', [ExchangeCurrencyController::class, 'delete']);
