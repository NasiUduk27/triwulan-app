<?php

use App\Http\Controllers\IndikatorKegiatanController;
use App\Http\Controllers\IndikatorKinerjaController;
use App\Http\Controllers\IndikatorProgramController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SubKegiatanController;
use App\Http\Controllers\TriwulanController;
use App\Models\IndikatorKegiatan;
use App\Models\IndikatorProgram;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => 'roles:admin'], function(){
//     Route::prefix('program')->group(function () {
//         Route::resource('/', ProgramController::class);
//         Route::resource('/indikator', IndikatorProgramController::class);
//     })->name('program');
// });

// Route Program
Route::prefix('/program')->group(function () {
    Route::resource('/', ProgramController::class);
    Route::resource('/indikator', IndikatorProgramController::class);
});

// Route Kegiatan
Route::prefix('/kegiatan')->group(function () {
    Route::get('/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::resource('/', KegiatanController::class);
    Route::resource('/indikator', IndikatorKegiatanController::class);
});

// Route Sub Kegiatan dan Kinerja
Route::prefix('/sub_kegiatan')->group(function () {
    Route::resource('/', SubKegiatanController::class);
    Route::resource('/kinerja', IndikatorKinerjaController::class);
});

// Route Realisasi
Route::resource('realisasi', RealisasiController::class);

// Route Triwulan
Route::resource('triwulan', TriwulanController::class);
