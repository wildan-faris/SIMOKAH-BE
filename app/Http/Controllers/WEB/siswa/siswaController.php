<?php

namespace App\Http\Controllers\WEB\siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function delete($id)
    {
        $get_siswa = Siswa::where("id", $id)->first();

        $url = "/orang-tua/viewIndex/" . $get_siswa->id;
        Siswa::where("id", $id)->delete();
        return redirect($url)->with("success_delete", "Berhasil Menghapus Data");
    }
}
