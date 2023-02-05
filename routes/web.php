<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\KendaraanController;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::resource('sewa', SewaController::class);
    Route::get('acc1/{sewa}', [SewaController::class, 'acc1']);
    Route::get('acc2/{sewa}', [SewaController::class, 'acc2']);
    Route::resource('riwayat', RiwayatController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('driver', DriverController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('aktivitas', AktivitasController::class);
    Route::get('status/{riwayat}', [RiwayatController::class, 'status']);
    Route::get('export', [SewaController::class, 'export']);
    Route::get('chart', [RiwayatController::class, 'chart']);    
});

Auth::routes();

