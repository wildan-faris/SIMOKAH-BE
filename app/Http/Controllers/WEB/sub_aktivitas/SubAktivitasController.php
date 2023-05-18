<?php

namespace App\Http\Controllers\WEB\sub_aktivitas;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\SubAktivitas;
use Illuminate\Http\Request;

class SubAktivitasController extends Controller
{
    public function index($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_sub_aktivitas = SubAktivitas::where("aktivitas_id", $id)->get();
        $aktivitas_id = $id;

        return view('sub_aktivitas.index', compact("data_sub_aktivitas", "aktivitas_id"));
    }

    public function createIndex()
    {

        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $data_aktivitas = Aktivitas::get();
        return view('sub_aktivitas.create', compact("data_aktivitas"));
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        SubAktivitas::insert([
            'name' => $request->name,
            'aktivitas_id' => $request->aktivitas_id,

        ]);
        $id = $request->aktivitas_id;
        $route = '/sub-aktivitas/index/' . $id;
        return redirect($route)->with("success_create", "Berhasil Menambahkan Data");
    }

    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        SubAktivitas::where("id", $request->id)->update([
            'name' => $request->name,
            'aktivitas_id' => $request->aktivitas_id,

        ]);
        $id = $request->aktivitas_id;
        $route = '/sub-aktivitas/index/' . $id;
        return redirect($route)->with("success_edit", "Berhasil Mengubah Data");
    }

    public function delete($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $get_sub_aktivitas = SubAktivitas::where("id", $id)->first();
        $id_aktivitas = $get_sub_aktivitas->aktivitas_id;
        SubAktivitas::where("id", $id)->delete();
        $route = '/sub-aktivitas/index/' . $id_aktivitas;
        return redirect($route)->with("success_delete", "Berhasil Menghapus Data");
    }
}
