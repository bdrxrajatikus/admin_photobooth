<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherApiController;
use App\Http\Controllers\TransactionApiController;
use App\Http\Controllers\SettingApiController;
use App\Http\Controllers\TemplateApiController;

Route::prefix('vouchers')->group(function () {
    Route::get('/', [VoucherApiController::class, 'index']);
    Route::get('/{id}', [VoucherApiController::class, 'show']);
    Route::post('/', [VoucherApiController::class, 'store']);
    Route::put('/{id}', [VoucherApiController::class, 'update']);
    Route::delete('/{id}', [VoucherApiController::class, 'destroy']);
});

Route::get('/transactions', [TransactionApiController::class, 'index']);
Route::get('/transactions/{id}', [TransactionApiController::class, 'show']);
Route::post('/transactions', [TransactionApiController::class, 'store']);
Route::put('/transactions/{id}', [TransactionApiController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionApiController::class, 'destroy']);

Route::get('/settings', [SettingApiController::class, 'index']);
Route::get('/settings/{id}', [SettingApiController::class, 'show']);
Route::post('/settings', [SettingApiController::class, 'store']);
Route::put('/settings/{id}', [SettingApiController::class, 'update']);
Route::delete('/settings/{id}', [SettingApiController::class, 'destroy']);

Route::get('/templates', [TemplateApiController::class, 'index']);
Route::get('/templates/{id}', [TemplateApiController::class, 'show']);
Route::post('/templates', [TemplateApiController::class, 'store']);
Route::put('/templates/{id}', [TemplateApiController::class, 'update']);
Route::delete('/templates/{id}', [TemplateApiController::class, 'destroy']);