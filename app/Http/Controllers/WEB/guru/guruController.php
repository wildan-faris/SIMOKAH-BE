<?php

namespace App\Http\Controllers\WEB\guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class guruController extends Controller
{
    public function index()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_guru = Guru::get();
        return view('guru.index', compact("data_guru"));
    }
    public function createIndex()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        return view('guru.create');
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $get_guru = Guru::where("email", $request->email)->first();
        if ($get_guru !== null) {
            return redirect('/guru/create/index')->with("failed_create", "Gagal Menambahkan Data");
        }
        Guru::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);
        return redirect('/guru/index')->with("success_create", "Berhasil Menambahkan Data");
    }
    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        Guru::where("id", $request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,

        ]);
        return redirect('/guru/index')->with("success_edit", "Berhasil Mengubah Data");
    }

    public function delete($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        Guru::where("id", $id)->delete();
        return redirect('/guru/index')->with("success_delete", "Berhasil Menghapus Data");
    }
}
