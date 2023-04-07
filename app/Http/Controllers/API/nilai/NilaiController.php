<?php

namespace App\Http\Controllers\API\nilai;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\SubAktivitas;
use App\Models\TotalNilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
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
        Nilai::create([
            "sub_aktivitas_id" => $request->sub_aktivitas_id,
            "siswa_id" => $request->siswa_id,
            "nilai" => $request->nilai,
            "tanggal" => $request->tanggal,
        ]);

        $nilai = Nilai::get()->last();

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


            TotalNilai::create([
                "siswa_id" => $request->siswa_id,
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "aktivitas_id" => $get_sub_aktivitas->aktivitas_id,
                "nilai" => $hasil_nilai,
                "tanggal" => $request->tanggal,
            ]);
        }
        TotalNilai::where("siswa_id", $request->siswa_id)->where("sub_aktivitas_id", $request->sub_aktivitas_id)->update([
            "nilai" => $hasil_nilai,
            "tanggal" => $request->tanggal,
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
        ]);

        return response()->json([
            "message" => "Success update data"
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
