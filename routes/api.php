<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutController;

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
