<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherApiController;
use App\Http\Controllers\TransactionApiController;

Route::prefix('vouchers')->group(function () {
    Route::get('/', [VoucherApiController::class, 'index']);
    Route::get('/{id}', [VoucherApiController::class, 'show']);
    Route::get('/check/{code}', [VoucherApiController::class, 'checkPromoCode']);
    Route::put('/{id}', [VoucherApiController::class, 'update']);
    Route::delete('/{id}', [VoucherApiController::class, 'destroy']);
});

Route::get('/transactions', [TransactionApiController::class, 'index']);
Route::get('/transactions/{id}', [TransactionApiController::class, 'show']);
Route::post('/transactions', [TransactionApiController::class, 'store']);
Route::put('/transactions/{id}', [TransactionApiController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionApiController::class, 'destroy']);