<?php

namespace App\Http\Controllers\WEB\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function loginIndex()
    {
        return view('admin.login');
    }
    public function registerIndex()
    {
        return view('admin.register');
    }


    public function register(Request $request)
    {


        Admin::insert([
            "name" => $request->name,
            "password" => Hash::make($request->password),
            'remember_token' => Str::random(60),
            'photo_profil' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png'
        ]);



        return redirect("/admin/loginIndex")->with("success", "Berhasil Mendaftar");
    }
    public function login(Request $request)
    {

        $data = Admin::where("name", $request->name)->first();

        if ($data == null) {

            return redirect("/admin/loginIndex")->with("failed", "gagal login");
        }

        if (Hash::check($request->password, $data->password)) {
            Admin::where("id", $data->id)->update([
                'remember_token' => Str::random(60),
            ]);
            $request->session()->put('name', $data->name);
            $request->session()->put('role', "admin");



            $request->session()->put('remember_token', $data->remember_token);

            return redirect("/")->with("success", $request->session()->get("remember_token"));
        }



        return redirect("/admin/loginIndex")->with("failed", "gagal login");
    }

    public function logout(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/admin/loginIndex")->with("failed", "gagal login");
        }
        $request->session()->flush();
        return redirect("/admin/loginIndex")->with("success", "berhasil logout");
    }
}
