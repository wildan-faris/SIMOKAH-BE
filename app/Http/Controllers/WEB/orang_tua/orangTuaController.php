<?php

namespace App\Http\Controllers\WEB\orang_tua;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;

class orangTuaController extends Controller
{
    public function index()
    {
        $data_orang_tua = OrangTua::with("siswa")->get();

        return view("orang_tua.index", compact("data_orang_tua"));
    }

    public function getSiswaByOrangTua($id)
    {
        $data_orang_tua = OrangTua::with("siswa")->where("id", $id)->get();

        return view("orang_tua.view", compact("data_orang_tua"));
    }
}
