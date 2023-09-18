<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\CheckRole;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboards', [DashboardController::class, 'index']);
    Route::get('/getTotalVoucher', [DashboardController::class, 'getTotalVoucher']);
    Route::get('/getTotalRevenue', [DashboardController::class, 'getTotalRevenue']);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('templates', TemplateController::class);
    Route::resource('settings', SettingController::class);

    // Rute CRUD pengguna hanya untuk admin
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});


