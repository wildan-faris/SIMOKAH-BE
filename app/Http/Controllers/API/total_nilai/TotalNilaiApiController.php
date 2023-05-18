<?php

namespace App\Http\Controllers\API\total_nilai;

use App\Http\Controllers\Controller;
use App\Models\TotalNilai;
use Illuminate\Http\Request;

class TotalNilaiApiController extends Controller
{
    public function getAll()
    {

        try {

            $total_nilai = TotalNilai::with("siswa")->with("aktivitas")->with("sub_aktivitas")->get();


            return response()->json([
                'message' => 'Success get all data',
                'data' => $total_nilai,

            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data', 'error' => $th], 500);
        }
    }
    public function getById($id)
    {

        try {

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
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by id', 'error' => $th], 500);
        }
    }
    public function getBySiswaAndAktivitas(Request $request)
    {
        try {

            $total_nilai = TotalNilai::with("siswa")->with("aktivitas")->with("sub_aktivitas")->where("siswa_id", $request->siswa_id)->where("aktivitas_id", $request->aktivitas_id)->get();



            return response()->json([
                "message" => "Success get data by siswa and aktivitas id",
                "data" => $total_nilai
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by siswa and aktivitas id', 'error' => $th], 500);
        }
    }


    public function create(Request $request)
    {

        try {

            TotalNilai::create([
                "siswa_id" => $request->siswa_id,
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "nilai" => $request->nilai,
                "penilai" => $request->penilai,
                "tanggal" => $request->tanggal,
            ]);

            $total_nilai = TotalNilai::get()->last();

            return response()->json([
                "message" => "Success create data",
                "data" => $total_nilai
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            TotalNilai::where("id", $id)->update([
                "siswa_id" => $request->siswa_id,
                "sub_aktivitas_id" => $request->sub_aktivitas_id,
                "nilai" => $request->nilai,
                "penilai" => $request->penilai,
                "tanggal" => $request->tanggal,
            ]);

            return response()->json([
                "message" => "Success update data"
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'Failed update data' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {

        try {

            TotalNilai::where("id", $id)->delete();

            return response()->json([
                "message" => "Success delete data"
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'Failed delete data' => $th->getMessage()]);
        }
    }
}
