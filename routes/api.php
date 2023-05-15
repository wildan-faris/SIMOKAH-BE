<?php

use App\Http\Controllers\API\ahli_parenting\AuthAhliParentingApiController;
use App\Http\Controllers\API\aktivitas\AktivitasApiController;
use App\Http\Controllers\API\guru\AuthGuruApiController;
use App\Http\Controllers\API\guru\GuruApiController;
use App\Http\Controllers\API\kelas\KelasApiController;
use App\Http\Controllers\API\nilai\NilaiAPIController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\orang_tua\AuthOrangTuaApiController;
use App\Http\Controllers\API\orang_tua\OrangTuaApiController;
use App\Http\Controllers\API\siswa\SiswaApiController;
use App\Http\Controllers\API\sub_aktivitas\SubAktivitasApiController;
use App\Http\Controllers\API\total_nilai\TotalNilaiApiController;
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
    Route::post('/register', [AuthOrangTuaApiController::class, 'register']);
    Route::post('/login', [AuthOrangTuaApiController::class, 'login']);
});

Route::prefix('guru')->group(function () {
    //API untuk melakukan register orang tua
    Route::post('/register', [AuthGuruApiController::class, 'register']);
    Route::post('/login', [AuthGuruApiController::class, 'login']);
});


Route::prefix('ahli-parenting')->group(function () {
    //API untuk melakukan register orang tua
    Route::post('/register', [AuthAhliParentingApiController::class, 'register']);
    Route::post('/login', [AuthAhliParentingApiController::class, 'login']);
});

Route::prefix('user')->group(function () {
    //API route for register new user
    Route::post('/register', [UserController::class, 'register']);
    //API route for login user
    Route::post('/login', [UserController::class, 'login']);
});


Route::get('/kelas', [KelasApiController::class, 'getAll']);

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

    Route::prefix('ahli-parenting')->group(function () {
        //API untuk melakukan register orang tua
        Route::post('/logout', [AuthAhliParentingApiController::class, 'logout']);
    });


    Route::prefix('orang-tua')->middleware('auth.bearer')->group(function () {

        Route::post('/logout', [AuthOrangTuaApiController::class, 'logout']);
        Route::get('/{id}', [OrangTuaApiController::class, 'getProfil']);
        Route::put('/{id}', [OrangTuaApiController::class, 'editProfil']);
        Route::post('/photo-edit/{id}', [OrangTuaApiController::class, 'editPhoto']);
        Route::post('/photo-delete/{id}', [OrangTuaApiController::class, 'deletePhoto']);
    });
    Route::prefix('guru')->middleware('auth.bearer')->group(function () {

        Route::post('/logout', [AuthGuruApiController::class, 'logout']);
        Route::get('/{id}', [GuruApiController::class, 'getProfil']);
        Route::put('/{id}', [GuruApiController::class, 'editProfil']);
        Route::post('/photo-edit/{id}', [GuruApiController::class, 'editPhoto']);
        Route::post('/photo-delete/{id}', [GuruApiController::class, 'deletePhoto']);
    });


    Route::prefix('kelas')->middleware('auth.bearer')->group(function () {


        Route::get('/{id}', [KelasApiController::class, 'getById']);
        Route::post('/', [KelasApiController::class, 'create']);
        Route::put('/{id}', [KelasApiController::class, 'update']);
        Route::delete('/{id}', [KelasApiController::class, 'delete']);
    });
    Route::prefix('siswa')->middleware('auth.bearer')->group(function () {

        Route::get('/', [SiswaApiController::class, 'getAll']);
        Route::get('/{id}', [SiswaApiController::class, 'getById']);
        Route::post('/', [SiswaApiController::class, 'create']);
        Route::put('/{id}', [SiswaApiController::class, 'update']);
        Route::delete('/{id}', [SiswaApiController::class, 'delete']);
    });
    Route::prefix('aktivitas')->middleware('auth.bearer')->group(function () {

        Route::get('/', [AktivitasApiController::class, 'getAll']);
        Route::get('/{id}', [AktivitasApiController::class, 'getById']);
        Route::post('/', [AktivitasApiController::class, 'create']);
        Route::put('/{id}', [AktivitasApiController::class, 'update']);
        Route::delete('/{id}', [AktivitasApiController::class, 'delete']);
    });
    Route::prefix('sub-aktivitas')->middleware('auth.bearer')->group(function () {

        Route::get('/', [SubAktivitasApiController::class, 'getAll']);
        Route::get('/{id}', [SubAktivitasApiController::class, 'getById']);
        Route::get('/aktivitas/{aktivitas_id}', [SubAktivitasApiController::class, 'getByAktivitas']);
        Route::post('/', [SubAktivitasApiController::class, 'create']);
        Route::put('/{id}', [SubAktivitasApiController::class, 'update']);
        Route::delete('/{id}', [SubAktivitasApiController::class, 'delete']);
    });
    Route::prefix('nilai')->middleware('auth.bearer')->group(function () {

        Route::get('/', [NilaiAPIController::class, 'getAll']);
        Route::get('/{id}', [NilaiAPIController::class, 'getById']);

        Route::get('/sub-aktivitas/siswa', [NilaiAPIController::class, 'getBySiswaAndSubAktivitas']);
        Route::post('/', [NilaiAPIController::class, 'create']);
        Route::put('/{id}', [NilaiAPIController::class, 'update']);
        Route::delete('/{id}', [NilaiAPIController::class, 'delete']);
    });
    Route::prefix('total-nilai')->middleware('auth.bearer')->group(function () {

        Route::get('/', [TotalNilaiApiController::class, 'getAll']);
        Route::get('/{id}', [TotalNilaiApiController::class, 'getById']);
        Route::get('/siswa/aktivitas', [TotalNilaiApiController::class, 'getBySiswaAndAktivitas']);
        Route::post('/', [TotalNilaiApiController::class, 'create']);
        Route::put('/{id}', [TotalNilaiApiController::class, 'update']);
        Route::delete('/{id}', [TotalNilaiApiController::class, 'delete']);
    });
});
