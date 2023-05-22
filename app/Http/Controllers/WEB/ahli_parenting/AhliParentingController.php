<?php

namespace App\Http\Controllers\WEB\ahli_parenting;

use App\Http\Controllers\Controller;
use App\Models\AhliParenting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AhliParentingController extends Controller
{
    public function index()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/ahli-parenting/loginIndex")->with("failed", "anda belum login");
        }

        $data_ahli_parenting = AhliParenting::get();
        return view('ahli_parenting.index', compact("data_ahli_parenting"));
    }

    public function loginIndex()
    {
        return view('ahli_parenting.login');
    }

    public function login(Request $request)
    {

        $data_ahli_parenting = AhliParenting::where("email", $request->email)->first();

        if ($data_ahli_parenting == null) {
            $data_ahli_parenting = AhliParenting::where("email", $request->email)->first();

            if ($data_ahli_parenting == null) {
                return redirect("/ahli-parenting/loginIndex")->with("failed", "gagal login, email tidak ada");
            }
        }

        if (Hash::check($request->password, $data_ahli_parenting->password)) {
            AhliParenting::where("id", $data_ahli_parenting->id)->update([
                "remember_token" => Str::random(60),
            ]);
            $request->session()->put('name', $data_ahli_parenting->name);
            $request->session()->put('role', "ahli parenting");



            $request->session()->put('remember_token', $data_ahli_parenting->remember_token);

            return redirect("/")->with("success", $request->session()->get("remember_token"));
        }



        return redirect("/ahli-parenting/loginIndex")->with("failed", "gagal login");
    }


    public function createIndex()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/ahli-parenting/loginIndex")->with("failed", "anda belum login");
        }
        return view('ahli_parenting.create');
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/ahli-parenting/loginIndex")->with("failed", "anda belum login");
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
            'remember_token' => Str::random(60),
        ]);
        return redirect('/ahli-parenting/index')->with("success_create", "Berhasil Menambahkan Data");
    }
    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/ahli-parenting/loginIndex")->with("failed", "anda belum login");
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
            return redirect("/ahli-parenting/loginIndex")->with("failed", "anda belum login");
        }
        AhliParenting::where("id", $id)->delete();
        return redirect('/ahli-parenting/index')->with("success_delete", "Berhasil Menghapus Data");
    }

    public function logout(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/loginIndex")->with("failed", "gagal login");
        }
        $request->session()->flush();
        return redirect("/ahli-parenting/loginIndex")->with("success", "berhasil logout");
    }
}
