<?php

namespace App\Http\Controllers\API\total_nilai;

use App\Http\Controllers\Controller;
use App\Models\TotalNilai;
use Illuminate\Http\Request;

class TotalNilaiApiController extends Controller
{
    public function getAll()
    {
        $total_nilai = TotalNilai::with("siswa")->with("aktivitas")->with("sub_aktivitas")->get();


        return response()->json([
            'message' => 'Success get all data',
            'data' => $total_nilai,

        ], 200);
    }
    public function getById($id)
    {
        $total_nilai = TotalNilai::with("siswa")->with("aktivitas")->with("sub_aktivitas")->where("id", $id)->first();

        if ($total_nilai == null) {
            return response()->json([
                "message" => "data not found",

            ]);
        }

        return response()->json([
            "message" => "Success get data by id",
            "data" => $total_nilai
        ]);
    }
    public function getBySiswaAndAktivitas(Request $request)
    {
        $total_nilai = TotalNilai::with("siswa")->with("aktivitas")->with("sub_aktivitas")->where("siswa_id", $request->siswa_id)->where("aktivitas_id", $request->aktivitas_id)->get();



        return response()->json([
            "message" => "Success get data by id",
            "data" => $total_nilai
        ]);
    }


    public function create(Request $request)
    {
        TotalNilai::create([
            "aktivitas_id" => $request->aktivitas_id,
            "name" => $request->name,
        ]);

        $total_nilai = TotalNilai::get()->last();

        return response()->json([
            "message" => "Success create data",
            "data" => $total_nilai
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            TotalNilai::where("id", $id)->update([
                "aktivitas_id" => $request->aktivitas_id,
                "name" => $request->name,
            ]);

            return response()->json([
                "message" => "Success update data"
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        TotalNilai::where("id", $id)->delete();

        return response()->json([
            "message" => "Success delete data"
        ]);
    }
}
