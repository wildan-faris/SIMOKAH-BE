<?php

use App\Http\Controllers\WEB\kepala_sekolah\kepalaSekolahController;
use App\Http\Controllers\WEB\admin\adminController;
use App\Http\Controllers\WEB\ahli_parenting\AhliParentingController;
use App\Http\Controllers\WEB\aktivitas\AktivitasController;
use App\Http\Controllers\WEB\guru\guruController;
use App\Http\Controllers\WEB\kelas\kelasController;
use App\Http\Controllers\WEB\sub_aktivitas\SubAktivitasController;
use App\Models\Aktivitas;
use App\Models\Guru;
use App\Models\Kelas;
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
        return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
    }
    $data_guru = Guru::count();
    $data_kelas = Kelas::count();
    $data_aktivitas = Aktivitas::count();
    return view('index', compact("data_guru", "data_kelas", "data_aktivitas"));
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


// aktivitas controller
Route::get('/aktivitas/index', [AktivitasController::class, 'index']);
Route::get('/aktivitas/create/index', [AktivitasController::class, 'createIndex']);
Route::post('/aktivitas/create', [AktivitasController::class, 'create']);
Route::post('/aktivitas/edit', [AktivitasController::class, 'edit']);
Route::get('/aktivitas/delete/{id}', [AktivitasController::class, 'delete']);

// sub-aktivitas controller
Route::get('/sub-aktivitas/index/{id}', [SubAktivitasController::class, 'index']);
Route::get('/sub-aktivitas/create/index', [SubAktivitasController::class, 'createIndex']);
Route::post('/sub-aktivitas/create', [SubAktivitasController::class, 'create']);
Route::post('/sub-aktivitas/edit', [SubAktivitasController::class, 'edit']);
Route::get('/sub-aktivitas/delete/{id}', [SubAktivitasController::class, 'delete']);

// admin controller
Route::get('/admin/loginIndex', [adminController::class, 'loginIndex']);
Route::get('/admin/registerIndex', [adminController::class, 'registerIndex']);
Route::post('/admin/register', [adminController::class, 'register']);
Route::post('/admin/login', [adminController::class, 'login']);
Route::get('/admin/logout', [adminController::class, 'logout']);

// kepala_sekolah controller
Route::get('/kepala-sekolah/index', [kepalaSekolahController::class, 'index']);
Route::get('/kepala-sekolah/create/index', [kepalaSekolahController::class, 'createIndex']);
Route::post('/kepala-sekolah/register', [kepalaSekolahController::class, 'register']);
Route::post('/kepala-sekolah/create', [kepalaSekolahController::class, 'create']);
Route::get('/kepala-sekolah/delete/{id}', [kepalaSekolahController::class, 'delete']);
Route::get('/kepala-sekolah/loginIndex', [kepalaSekolahController::class, 'loginIndex']);
Route::post('/kepala-sekolah/login', [kepalaSekolahController::class, 'login']);
Route::get('/kepala-sekolah/logout', [kepalaSekolahController::class, 'logout']);
