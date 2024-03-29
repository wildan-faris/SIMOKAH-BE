<?php

namespace App\Http\Controllers\WEB\kepala_sekolah;

use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class kepalaSekolahController extends Controller
{
    public function loginIndex()
    {
        return view('kepala_sekolah.login');
    }
    public function index()
    {
        $data_kepala_sekolah = KepalaSekolah::get();
        $len_kepala_sekolah = KepalaSekolah::count();
        return view('kepala_sekolah.index', compact("data_kepala_sekolah", "len_kepala_sekolah"));
    }
    public function createIndex()
    {
        return view('kepala_sekolah.create');
    }


    public function register(Request $request)
    {


        KepalaSekolah::insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            'remember_token' => Str::random(60),
            'photo_profil' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png'
        ]);

        return redirect("/kepala_sekolah/index")->with("success_create", "Berhasil Mendaftar");
    }
    public function login(Request $request)
    {

        $data = KepalaSekolah::where("email", $request->email)->first();

        if ($data == null) {

            return redirect("/kepala_sekolah/loginIndex")->with("failed", "gagal login");
        }

        if (Hash::check($request->password, $data->password)) {

            $request->session()->put('name', $data->name);
            $request->session()->put('role', "kepala sekolah");



            $request->session()->put('remember_token', $data->remember_token);

            return redirect("/")->with("success", $request->session()->get("remember_token"));
        }



        return redirect("/kepala_sekolah/loginIndex")->with("failed", "gagal login");
    }

    public function logout(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/loginIndex")->with("failed", "gagal login");
        }
        $request->session()->flush();
        return redirect("/kepala_sekolah/loginIndex")->with("success", "berhasil logout");
    }
}
