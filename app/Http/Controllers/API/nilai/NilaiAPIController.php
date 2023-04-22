<?php

namespace App\Http\Controllers\API\nilai;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\SubAktivitas;
use App\Models\TotalNilai;
use App\Models\TotalNilaiKelas;
use Illuminate\Http\Request;

class NilaiAPIController extends Controller
{
    public function getAll()
    {
        $nilai = Nilai::get();
        return response()->json([
            'message' => 'Success get all data',
            'data' => $nilai,
        ], 200);
    }
    public function getById($id)
    {
        $nilai = Nilai::where("id", $id)->first();

        if ($nilai == null) {
            return response()->json([
                "message" => "data not found",

            ]);
        }

        return response()->json([
            "message" => "Success get data by id",
            "data" => $nilai,
        ]);
    }


    public function getBySiswaAndSubAktivitas(Request $request)
    {
        $nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->get();
        $len_nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->count();
        $total_nilai = 0;
        foreach ($nilai as $nl) {

            $total_nilai = $total_nilai + $nl->nilai;
        }
        $hasil_nilai = $total_nilai / $len_nilai;
        return response()->json([
            "message" => "Success get data by id",

            "nilai" => $hasil_nilai,
            "data" => $nilai,
        ]);
    }

    public function create(Request $request)
    {
        $get_siswa = Siswa::where("id", $request->siswa_id)->first();
        $get_nilai = Nilai::where("siswa_id", $request->siswa_id)
            ->where("tanggal", $request->tanggal)
            ->where("sub_aktivitas_id", $request->sub_aktivitas_id)
            ->where("penilai", $request->penilai)
            ->first();

        if ($get_nilai != null) {
            return response()->json([
                "message" => "Tidak boleh melakukan penilaian lagi",

            ]);
        }

        Nilai::create([
            "sub_aktivitas_id" => $request->sub_aktivitas_id,
            "siswa_id" => $request->siswa_id,
            "nilai" => $request->nilai,
            "tanggal" => $request->tanggal,
            "penilai" => $request->penilai,
        ]);

        $nilai = Nilai::get()->last();

        $get_nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->get();

        $len_nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->count();
        $rate_nilai = 0;

        foreach ($get_nilai as $gn) {

            $rate_nilai = $rate_nilai + $gn->nilai;
        }

        $hasil_nilai = $rate_nilai / $len_nilai;


        $total_nilai = TotalNilai::where("siswa_id", $request->siswa_id)
            ->where("sub_aktivitas_id", $request->sub_aktivitas_id)
            ->first();
        $get_sub_aktivitas = SubAktivitas::where("id", $request->sub_aktivitas_id)->first();
        if ($total_nilai == null) {


            TotalNilai::create([
                "siswa_id" => $request->siswa_id,
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "aktivitas_id" => $get_sub_aktivitas->aktivitas_id,
                "nilai" => $hasil_nilai,
                "kelas_id" => $get_siswa->kelas_id,
                "tanggal" => $request->tanggal,

            ]);
        }
        TotalNilai::where("siswa_id", $request->siswa_id)->where("sub_aktivitas_id", $request->sub_aktivitas_id)->update([
            "nilai" => $hasil_nilai,
            "tanggal" => $request->tanggal,
        ]);


        $get_nilai_kelas = TotalNilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("kelas_id", $get_siswa->kelas_id)->get();
        $len_nilai_kelas = TotalNilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("kelas_id", $get_siswa->kelas_id)->count();
        $rate_nilai_kelas = 0;
        foreach ($get_nilai_kelas as $gnk) {

            $rate_nilai_kelas = $rate_nilai_kelas + $gnk->nilai;
        }
        $hasil_nilai_kelas = $rate_nilai_kelas / $len_nilai_kelas;

        $get_total_nilai_kelas = TotalNilaiKelas::where("kelas_id", $get_siswa->kelas_id)
            ->where("sub_aktivitas_id", $request->sub_aktivitas_id)
            ->first();
        if ($get_total_nilai_kelas == null) {


            TotalNilaiKelas::create([
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "nilai" => $hasil_nilai_kelas,
                "kelas_id" => $get_siswa->kelas_id,


            ]);
        }
        TotalNilaiKelas::where("kelas_id", $get_siswa->kelas_id)->where("sub_aktivitas_id", $request->sub_aktivitas_id)->update([
            "nilai" => $hasil_nilai_kelas,

        ]);

        return response()->json([
            "message" => "Success create data",
            "total_nilai" => $hasil_nilai,
            "data" => $nilai,
        ]);
    }






    public function update($id, Request $request)
    {
        Nilai::where("id", $id)->update([
            "sub_aktivitas_id" => $request->sub_aktivitas_id,
            "siswa_id" => $request->siswa_id,
            "nilai" => $request->nilai,
            "tanggal" => $request->tanggal,
            "penilai" => $request->penilai,
        ]);
        $get_nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->get();
        $len_nilai = Nilai::where("sub_aktivitas_id", $request->sub_aktivitas_id)->where("siswa_id", $request->siswa_id)->count();
        $rate_nilai = 0;
        foreach ($get_nilai as $gn) {

            $rate_nilai = $rate_nilai + $gn->nilai;
        }
        $hasil_nilai = $rate_nilai / $len_nilai;

        $total_nilai = TotalNilai::where("siswa_id", $request->siswa_id)->where("sub_aktivitas_id", $request->sub_aktivitas_id)->first();
        $get_sub_aktivitas = SubAktivitas::where("id", $request->sub_aktivitas_id)->first();
        if ($total_nilai == null) {

            $get_siswa = Siswa::where("id", $request->siswa_id)->first();
            TotalNilai::create([
                "siswa_id" => $request->siswa_id,
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "aktivitas_id" => $get_sub_aktivitas->aktivitas_id,
                "kelas_id" => $get_siswa->kelas_id,
                "nilai" => $hasil_nilai,
                "tanggal" => $request->tanggal,

            ]);
        }
        TotalNilai::where("siswa_id", $request->siswa_id)->where("sub_aktivitas_id", $request->sub_aktivitas_id)->update([
            "nilai" => $hasil_nilai,
            "tanggal" => $request->tanggal,
        ]);



        return response()->json([
            "message" => "Success update data",


        ]);
    }

    public function delete($id)
    {
        Nilai::where("id", $id)->delete();

        return response()->json([
            "message" => "Success delete data"
        ]);
    }
}
