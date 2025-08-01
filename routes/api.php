<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\VisionMissionController;
use App\Http\Middleware\CustomCors;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendefinisikan semua route API untuk aplikasi Anda.
| Route dalam grup ini akan otomatis mendapatkan prefix "/api".
|
*/

Route::middleware(['throttle:api', CustomCors::class])->group(function () {
    Route::get('/about', [AboutController::class, 'show']);
    Route::get('/history', [HistoryController::class, 'show']);
    Route::get('/vision-mission', [VisionMissionController::class, 'show']);
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{slug}', [BlogController::class, 'show']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{slug}', [CategoryController::class, 'show']);
    Route::get('/client', [ClientController::class, 'index']);
    Route::get('/faq', [FaqController::class, 'index']);
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/hero', [HeroController::class, 'index']);
    Route::get('/portfolio', [PortfolioController::class, 'index']);
    Route::get('/service', [ServiceController::class, 'index']);
});
