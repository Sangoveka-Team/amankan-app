<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;

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
    Route::get('profile/pelapor', [ProfileController::class, 'profile']);
    Route::patch('profile/pelapor/update', [ProfileController::class, 'updateProfile']);
    Route::get('laporan/pelapor', [UserController::class, 'laporanAnda']);
    Route::get('laporan/all/pelapor', [LaporanController::class, 'index']);
    Route::get('laporan/{id}/pelapor', [LaporanController::class, 'show']);
    Route::post('laporan/pelapor/create', [LaporanController::class, 'createLaporan']);
    // Route::get('show-laporan/{id}', [LaporanController::class, 'show']);
    // Route::post('post-lapor', [LaporanController::class, 'store']);
    Route::get('dashboard/pelapor', [UserController::class, 'dashboardPelapor']);

});
Route::middleware(['auth:sanctum', 'keamanan'])->group(function () {
    Route::get('profile/petugas', [ProfileController::class, 'profile']);
    Route::post('updateprofil-pelapor', [ProfileController::class, 'updateProfile']);
    Route::get('laporan/petugas', [UserController::class, 'laporanAnda']);
    Route::get('laporan/all/petugas', [LaporanController::class, 'index']);
    Route::get('laporan/{id}/petugas', [LaporanController::class, 'show']);
    Route::get('dashboard/petugas', [UserController::class, 'dashboardPelapor']);
});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('profile/admin', [ProfileController::class, 'profile']);
    Route::post('updateprofil-pelapor', [ProfileController::class, 'updateProfile']);
    Route::get('laporan/all/admin', [LaporanController::class, 'index']);
    Route::get('laporan/{id}/admin', [LaporanController::class, 'show']);
    Route::get('dashboard/admin', [AdminController::class, 'dashboardAdmin']);
    Route::get('akun/all', [AdminController::class, 'getSemuaAkun']);
    Route::get('akun/{id}', [AdminController::class, 'detailAkun']);

});

Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'registerUser']);
