<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Endpoint untuk mengambil data JSON Top 5 dan Bottom 5 Biller
Route::get('/api/dashboard/ranking', [DashboardController::class, 'ranking']);