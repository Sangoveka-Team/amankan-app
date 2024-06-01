<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelaporController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'pelapor'])->group(function () {
    Route::get('profil-pelapor', [PelaporController::class, 'profile']);
    Route::post('updateprofil-pelapor', [PelaporController::class, 'updateProfile']);
    // Route::get('data-lapor', [LaporanController::class, 'create']);
    // Route::get('riwayat-lapor', [LaporanController::class, 'riwayat']);
    // Route::get('show-laporan/{id}', [LaporanController::class, 'show']);
    // Route::post('post-lapor', [LaporanController::class, 'store']);
    Route::get('dashboard-lapor', [LaporanController::class, 'index']);

});

Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'registerUser']);
