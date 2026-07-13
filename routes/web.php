<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::post('/logout', [AuthController::class, 'prosesLogout'])->name('logout');

Route::get('/ambil-antrian', [AntrianController::class, 'halamanAmbil']);
Route::post('/ambil-antrian/simpan', [AntrianController::class, 'simpanAntrian']);
Route::post('/simpan-antrian', [AntrianController::class, 'simpanAntrian']);

Route::get('/monitor-display', [AntrianController::class, 'halamanDisplay']);
Route::get('/api/data-monitor', [AntrianController::class, 'dataMonitorJson']);

Route::get('/operator/antrian', [AntrianController::class, 'index'])->name('operator.antrian');
Route::post('/panggil/{id}', [AntrianController::class, 'panggil']);
Route::post('/skip/{id}', [AntrianController::class, 'skip']);