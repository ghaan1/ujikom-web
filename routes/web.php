<?php

use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriSuratController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::resource('kategori-surat', KategoriSuratController::class);
Route::resource('arsip-surat', ArsipSuratController::class);
Route::get('arsip-surat/download/{id}', [ArsipSuratController::class, 'download'])->name('arsip-surat.download');