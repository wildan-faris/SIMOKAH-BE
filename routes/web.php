<?php

use App\Http\Controllers\WEB\guru\guruController;
use App\Http\Controllers\WEB\kelas\kelasController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});
Route::get('login', function () {
    return view('welcome');
});

// guru controller
Route::get('/guru/index', [guruController::class, 'index']);
Route::get('/guru/create/index', [guruController::class, 'createIndex']);
Route::post('/guru/create', [guruController::class, 'create']);
Route::post('/guru/edit', [guruController::class, 'edit']);
Route::get('/guru/delete/{id}', [guruController::class, 'delete']);

// kelas controller
Route::get('/kelas/index', [kelasController::class, 'index']);
Route::get('/kelas/create/index', [kelasController::class, 'createIndex']);
Route::post('/kelas/create', [kelasController::class, 'create']);
Route::post('/kelas/edit', [kelasController::class, 'edit']);
Route::get('/kelas/delete/{id}', [kelasController::class, 'delete']);
Route::get('/kelas/view/{id}', [kelasController::class, 'siswaByKelas']);
Route::get('/kelas/grafik/kelas/{id}', [kelasController::class, 'grafikByKelas']);
Route::get('/kelas/grafik/siswa/{id}', [kelasController::class, 'grafikBySiswa']);
