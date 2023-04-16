<?php

use App\Http\Controllers\API\aktivitas\AktivitasController;
use App\Http\Controllers\API\guru\AuthGuruController;
use App\Http\Controllers\API\guru\GuruController;
use App\Http\Controllers\API\kelas\KelasController;
use App\Http\Controllers\API\nilai\NilaiController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\orang_tua\AuthOrangTuaController;
use App\Http\Controllers\API\orang_tua\OrangTuaController;
use App\Http\Controllers\API\siswa\SiswaController;
use App\Http\Controllers\API\sub_aktivitas\SubAktivitasController;
use App\Http\Controllers\API\total_nilai\TotalNilaiController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('orang-tua')->group(function () {
    //API untuk melakukan register orang tua
    Route::post('/register', [AuthOrangTuaController::class, 'register']);
    Route::post('/login', [AuthOrangTuaController::class, 'login']);
});

Route::prefix('guru')->group(function () {
    //API untuk melakukan register orang tua
    Route::post('/register', [AuthGuruController::class, 'register']);
    Route::post('/login', [AuthGuruController::class, 'login']);
});

Route::prefix('user')->group(function () {
    //API route for register new user
    Route::post('/register', [UserController::class, 'register']);
    //API route for login user
    Route::post('/login', [UserController::class, 'login']);
});


// API route for logout user

Route::get('/login', [Controller::class, 'CheckToken'])->name('checktoken');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('user')->middleware('auth.bearer')->group(function () {

        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/get-profil/{id}', [UserController::class, 'GetProfil']);
        Route::put('/edit-profil/{id}', [UserController::class, 'EditProfil']);
        Route::post('/edit-photo-profil/{id}', [UserController::class, 'EditPhoto']);
        Route::post('/delete-photo-profil/{id}', [UserController::class, 'DeletePhoto']);
    });


    Route::prefix('orang-tua')->middleware('auth.bearer')->group(function () {

        Route::post('/logout', [AuthOrangTuaController::class, 'logout']);
        Route::get('/{id}', [OrangTuaController::class, 'getProfil']);
        Route::put('/{id}', [OrangTuaController::class, 'editProfil']);
        Route::post('/photo-edit/{id}', [OrangTuaController::class, 'editPhoto']);
        Route::post('/photo-delete/{id}', [OrangTuaController::class, 'deletePhoto']);
    });
    Route::prefix('guru')->middleware('auth.bearer')->group(function () {

        Route::post('/logout', [AuthGuruController::class, 'logout']);
        Route::get('/{id}', [GuruController::class, 'getProfil']);
        Route::put('/{id}', [GuruController::class, 'editProfil']);
        Route::post('/photo-edit/{id}', [GuruController::class, 'editPhoto']);
        Route::post('/photo-delete/{id}', [GuruController::class, 'deletePhoto']);
    });


    Route::prefix('kelas')->middleware('auth.bearer')->group(function () {

        Route::get('/', [KelasController::class, 'getAll']);
        Route::get('/{id}', [KelasController::class, 'getById']);
        Route::post('/', [KelasController::class, 'create']);
        Route::put('/{id}', [KelasController::class, 'update']);
        Route::delete('/{id}', [KelasController::class, 'delete']);
    });
    Route::prefix('siswa')->middleware('auth.bearer')->group(function () {

        Route::get('/', [SiswaController::class, 'getAll']);
        Route::get('/{id}', [SiswaController::class, 'getById']);
        Route::post('/', [SiswaController::class, 'create']);
        Route::put('/{id}', [SiswaController::class, 'update']);
        Route::delete('/{id}', [SiswaController::class, 'delete']);
    });
    Route::prefix('aktivitas')->middleware('auth.bearer')->group(function () {

        Route::get('/', [AktivitasController::class, 'getAll']);
        Route::get('/{id}', [AktivitasController::class, 'getById']);
        Route::post('/', [AktivitasController::class, 'create']);
        Route::put('/{id}', [AktivitasController::class, 'update']);
        Route::delete('/{id}', [AktivitasController::class, 'delete']);
    });
    Route::prefix('sub-aktivitas')->middleware('auth.bearer')->group(function () {

        Route::get('/', [SubAktivitasController::class, 'getAll']);
        Route::get('/{id}', [SubAktivitasController::class, 'getById']);
        Route::get('/aktivitas/{aktivitas_id}', [SubAktivitasController::class, 'getByAktivitas']);
        Route::post('/', [SubAktivitasController::class, 'create']);
        Route::put('/{id}', [SubAktivitasController::class, 'update']);
        Route::delete('/{id}', [SubAktivitasController::class, 'delete']);
    });
    Route::prefix('nilai')->middleware('auth.bearer')->group(function () {

        Route::get('/', [NilaiController::class, 'getAll']);
        Route::get('/{id}', [NilaiController::class, 'getById']);

        Route::get('/sub-aktivitas/siswa', [NilaiController::class, 'getBySiswaAndSubAktivitas']);
        Route::post('/', [NilaiController::class, 'create']);
        Route::put('/{id}', [NilaiController::class, 'update']);
        Route::delete('/{id}', [NilaiController::class, 'delete']);
    });
    Route::prefix('total-nilai')->middleware('auth.bearer')->group(function () {

        Route::get('/', [TotalNilaiController::class, 'getAll']);
        Route::get('/{id}', [TotalNilaiController::class, 'getById']);
        Route::get('/siswa/aktivitas', [TotalNilaiController::class, 'getBySiswaAndAktivitas']);
        Route::post('/', [TotalNilaiController::class, 'create']);
        Route::put('/{id}', [TotalNilaiController::class, 'update']);
        Route::delete('/{id}', [TotalNilaiController::class, 'delete']);
    });
});
