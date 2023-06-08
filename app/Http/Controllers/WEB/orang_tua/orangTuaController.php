<?php

namespace App\Http\Controllers\WEB\orang_tua;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class orangTuaController extends Controller
{
    public function index()
    {
        $data_orang_tua = OrangTua::with("siswa")->get();

        return view("orang_tua.index", compact("data_orang_tua"));
    }

    public function editIndex($id)
    {
        $data_orang_tua = OrangTua::where("id", $id)->get();

        return view("orang_tua.edit", compact("data_orang_tua"));
    }

    public function create(Request $request)
    {

        OrangTua::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect("/orang-tua/index")->with("success_create", "Berhasil Menambahkan Data");
    }
    public function edit(Request $request)
    {

        OrangTua::where("id", $request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect("/orang-tua/index")->with("success_edit", "Berhasil Menambahkan Data");
    }

    public function createIndex()
    {


        return view("orang_tua.create");
    }
    public function createSiswaIndex($id)
    {
        $data_orang_tua = OrangTua::where("id", $id)->get();
        $data_kelas = Kelas::get();

        return view("orang_tua.create-siswa", compact("data_orang_tua", "data_kelas"));
    }
    public function editSiswaIndex($siswa_id)
    {

        $data_kelas = Kelas::get();

        $data_siswa = Siswa::where("id", $siswa_id)->with("kelas")->with("orang_tua")->get();

        return view("orang_tua.edit-siswa", compact("data_siswa", "data_kelas"));
    }

    public function createSiswa(Request $request)
    {
        Siswa::create([
            "name" => $request->name,
            "nis" => $request->nis,
            "jenis_kelamin" => $request->jenis_kelamin,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "orang_tua_id" => $request->orang_tua_id,
            "kelas_id" => $request->kelas_id,
            "tahun_ajaran" => $request->tahun_ajaran,
        ]);
        $url = "orang-tua/viewIndex/" . $request->orang_tua_id;

        return redirect($url)->with("success_create", "Berhasil Menambahkan Data");
    }
    public function editSiswa(Request $request)
    {
        Siswa::where("id", $request->id)->update([
            "name" => $request->name,
            "nis" => $request->nis,
            "jenis_kelamin" => $request->jenis_kelamin,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "orang_tua_id" => $request->orang_tua_id,
            "kelas_id" => $request->kelas_id,
            "tahun_ajaran" => $request->tahun_ajaran,
        ]);
        $url = "orang-tua/viewIndex/" . $request->orang_tua_id;

        return redirect($url)->with("success_edit", "Berhasil Mengubah Data");
    }

    public function getSiswaByOrangTua($id)
    {
        $data_orang_tua = OrangTua::with("siswa")->where("id", $id)->get();

        return view("orang_tua.view", compact("data_orang_tua"));
    }
}
