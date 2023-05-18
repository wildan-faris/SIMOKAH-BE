<?php

namespace App\Http\Controllers\WEB\aktivitas;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_aktivitas = Aktivitas::get();

        return view('aktivitas.index', compact("data_aktivitas"));
    }

    public function createIndex()
    {

        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        return view('aktivitas.create');
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Aktivitas::insert([
            'name' => $request->name,

        ]);
        return redirect('/aktivitas/index')->with("success_create", "Berhasil Menambahkan Data");
    }

    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Aktivitas::where("id", $request->id)->update([
            'name' => $request->name,


        ]);
        return redirect('/aktivitas/index')->with("success_edit", "Berhasil Mengubah Data");
    }

    public function delete($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Aktivitas::where("id", $id)->delete();
        return redirect('/aktivitas/index')->with("success_delete", "Berhasil Menghapus Data");
    }
}
