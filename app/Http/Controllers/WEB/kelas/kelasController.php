<?php

namespace App\Http\Controllers\WEB\kelas;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Bulan;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TotalNilai;
use App\Models\TotalNilaiKelas;
use Illuminate\Http\Request;

class kelasController extends Controller
{
    public function index()
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_kelas = Kelas::with("guru")->with("siswa")->get();
        $data_guru = Guru::get();
        return view('kelas.index', compact("data_kelas", "data_guru"));
    }

    public function createIndex()
    {

        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $data_guru = Guru::get();
        return view('kelas.create', compact("data_guru"));
    }

    public function create(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Kelas::insert([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
        ]);
        return redirect('/kelas/index')->with("success_create", "Berhasil Menambahkan Data");
    }

    public function edit(Request $request)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Kelas::where("id", $request->id)->update([
            'name' => $request->name,
            'guru_id' => $request->guru_id,

        ]);
        return redirect('/kelas/index')->with("success_edit", "Berhasil Mengubah Data");
    }

    public function delete($id)
    {
        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        Kelas::where("id", $id)->delete();
        return redirect('/kelas/index')->with("success_delete", "Berhasil Menghapus Data");
    }

    public function siswaByKelas($id)
    {

        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }

        $data_siswa = Siswa::where("kelas_id", $id)->get();
        $data_kelas = Kelas::where("id", $id)->first();
        return view('kelas.view', compact("data_siswa", "data_kelas"));
    }
    public function grafikByKelas($id)
    {
        $data_siswa = Siswa::where("kelas_id", $id)->get();
        $data_kelas = Kelas::where("id", $id)->first();
        $data_aktivitas = Aktivitas::with("sub_aktivitas")->get();
        $data_total_nilai_kelas = TotalNilaiKelas::get();
        return view('kelas.grafik_kelas', compact("data_siswa", "data_kelas", "data_aktivitas", "data_total_nilai_kelas"));
    }
    public function grafikBulanByKelas($id)
    {
        $data_siswa = Siswa::where("kelas_id", $id)->get();
        $data_kelas = Kelas::where("id", $id)->first();
        $data_aktivitas = Aktivitas::with("sub_aktivitas")->get();
        $data_total_nilai_kelas_bulan = Bulan::with("total_nilai_kelas_bulan")->get();
        return view('kelas.grafik_kelas_bulan', compact("data_siswa", "data_kelas", "data_aktivitas", "data_total_nilai_kelas_bulan"));
    }



    public function grafikBySiswa($id)
    {

        if (session()->get("remember_token") == "") {
            return redirect("/kepala-sekolah/loginIndex")->with("failed", "anda belum login");
        }
        $data_siswa = Siswa::where("id", $id)->first();

        $data_aktivitas = Aktivitas::with("sub_aktivitas")->get();
        $data_total_nilai = TotalNilai::get();
        return view('kelas.grafik_siswa', compact("data_siswa", "data_aktivitas", "data_total_nilai"));
    }
}
