<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BillerActivityController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('/', function () {
    return view('welcome');
});

// Endpoint untuk mengambil data JSON Top 5 dan Bottom 5 Biller
Route::get('/api/dashboard/ranking', [DashboardController::class, 'ranking']);

// Kelompok API untuk input data aktivitas Biller (Diubah ke GET sementara untuk testing di browser)
Route::withoutMiddleware([VerifyCsrfToken::class])->group(function () {
    Route::get('/api/catat-meter/mulai', [BillerActivityController::class, 'mulaiCatat']);
    Route::get('/api/catat-meter/selesai/{id}', [BillerActivityController::class, 'selesaiCatat']);
    Route::get('/api/koreksi', [BillerActivityController::class, 'inputKoreksi']);
    Route::get('/api/invoice', [BillerActivityController::class, 'simpanInvoice']);
});