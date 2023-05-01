<?php

use App\Http\Controllers\WEB\kepala_sekolah\kepalaSekolahController;
use App\Http\Controllers\WEB\admin\adminController;
use App\Http\Controllers\WEB\ahli_parenting\AhliParentingController;
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
    if (session()->get("remember_token") == "") {
        return redirect("/lol")->with("failed", "anda belum login");
    }
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
// ahli_parenting controller
Route::get('/ahli-parenting/index', [AhliParentingController::class, 'index']);
Route::get('/ahli-parenting/create/index', [AhliParentingController::class, 'createIndex']);
Route::post('/ahli-parenting/create', [AhliParentingController::class, 'create']);
Route::post('/ahli-parenting/edit', [AhliParentingController::class, 'edit']);
Route::get('/ahli-parenting/delete/{id}', [AhliParentingController::class, 'delete']);

// kelas controller
Route::get('/kelas/index', [kelasController::class, 'index']);
Route::get('/kelas/create/index', [kelasController::class, 'createIndex']);
Route::post('/kelas/create', [kelasController::class, 'create']);
Route::post('/kelas/edit', [kelasController::class, 'edit']);
Route::get('/kelas/delete/{id}', [kelasController::class, 'delete']);
Route::get('/kelas/view/{id}', [kelasController::class, 'siswaByKelas']);
Route::get('/kelas/grafik/kelas/{id}', [kelasController::class, 'grafikByKelas']);
Route::get('/kelas/grafik/siswa/{id}', [kelasController::class, 'grafikBySiswa']);

// admin controller
Route::get('/admin/loginIndex', [adminController::class, 'loginIndex']);
Route::get('/admin/registerIndex', [adminController::class, 'registerIndex']);
Route::post('/admin/register', [adminController::class, 'register']);
Route::post('/admin/login', [adminController::class, 'login']);
Route::get('/admin/logout', [adminController::class, 'logout']);

// kepala_sekolah controller
Route::get('/kepala_sekolah/index', [kepalaSekolahController::class, 'index']);
Route::get('/kepala_sekolah/create/index', [kepalaSekolahController::class, 'createIndex']);
Route::post('/kepala_sekolah/register', [kepalaSekolahController::class, 'register']);
Route::post('/kepala_sekolah/delete', [kepalaSekolahController::class, 'delete']);
Route::get('/kepala_sekolah/loginIndex', [kepalaSekolahController::class, 'loginIndex']);
Route::post('/kepala_sekolah/login', [kepalaSekolahController::class, 'login']);
Route::get('/kepala_sekolah/logout', [kepalaSekolahController::class, 'logout']);
