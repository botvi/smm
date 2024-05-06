<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    LayananController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/getkategori', [KategoriController::class, 'getKategori']);
Route::get('/kategori', [KategoriController::class, 'show']);
Route::get('/getlayanan', [LayananController::class, 'getLayanan']);
Route::get('/layanan', [LayananController::class, 'show']);


Route::get('/', [DashboardController::class, 'dashboard']);
