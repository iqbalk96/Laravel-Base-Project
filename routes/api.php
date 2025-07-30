<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\VisionMissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendefinisikan semua route API untuk aplikasi Anda.
| Route dalam grup ini akan otomatis mendapatkan prefix "/api".
|
*/

// API GET /about — menampilkan data About sebagai objek
Route::get('/about', [AboutController::class, 'show']);
Route::get('/history', [HistoryController::class, 'show']);
Route::get('/vision-mission', [VisionMissionController::class, 'show']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);
