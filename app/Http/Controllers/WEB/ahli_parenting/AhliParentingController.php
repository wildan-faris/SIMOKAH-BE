<?php

namespace App\Http\Controllers\WEB\ahli_parenting;

use App\Http\Controllers\Controller;
use App\Models\AhliParenting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AhliParentingController extends Controller
{
    public function index()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_ahli_parenting = AhliParenting::get();
        return view('ahli_parenting.index', compact("data_ahli_parenting"));
    }
    public function createIndex()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        return view('ahli_parenting.create');
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $get_ahli_parenting = AhliParenting::where("email", $request->email)->first();
        if ($get_ahli_parenting !== null) {
            return redirect('/ahli-parenting/create/index')->with("failed_create", "Gagal Menambahkan Data");
        }
        AhliParenting::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);
        return redirect('/ahli-parenting/index')->with("success_create", "Berhasil Menambahkan Data");
    }
    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        AhliParenting::where("id", $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        return redirect('/ahli-parenting/index')->with("success_edit", "Berhasil Mengubah Data");
    }

    public function delete($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        AhliParenting::where("id", $id)->delete();
        return redirect('/ahli-parenting/index')->with("success_delete", "Berhasil Menghapus Data");
    }
}
