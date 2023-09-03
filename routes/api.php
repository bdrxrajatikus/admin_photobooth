<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherApiController;

Route::prefix('vouchers')->group(function () {
    Route::get('/', [VoucherApiController::class, 'index']);
    Route::get('/{id}', [VoucherApiController::class, 'show']);
    Route::post('/', [VoucherApiController::class, 'store']);
    Route::put('/{id}', [VoucherApiController::class, 'update']);
    Route::delete('/{id}', [VoucherApiController::class, 'destroy']);
});
