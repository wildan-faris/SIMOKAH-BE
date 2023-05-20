<?php

namespace App\Http\Controllers\API\bulan;

use App\Http\Controllers\Controller;
use App\Models\Bulan;
use Illuminate\Http\Request;

class BulanController extends Controller
{
    public function getAll()
    {
        try {
            $bulan = Bulan::with("total_nilai_bulan")->get();
            return response()->json(['message' => 'Success get all data ', 'data' => $bulan], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data ', 'error' => $th]);
        }
    }
    public function getById($id)
    {
        try {
            $bulan = Bulan::where("id", $id)->with("total_nilai_bulan")->first();

            if ($bulan == null) {
                return response()->json(['message' => 'data not found'], 404);
            }

            return response()->json(['message' => 'Success get data by id', 'data' => $bulan], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get data by id',
                'error' => $th
            ]);
        }
    }

    public function getByBulan(Request $request)
    {
        try {
            $bulan = Bulan::where("bulan", $request->bulan)->with("total_nilai_bulan")->get();

            if ($bulan == null) {
                return response()->json(['message' => 'data not founds'], 404);
            }

            return response()->json(['message' => 'Success get data by bulan', 'data' => $bulan], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get data by bulan',
                'error' => $th
            ]);
        }
    }
    public function getByBulanandTahun(Request $request)
    {
        try {
            $bulan = Bulan::where("bulan", $request->bulan)->where("tahun", $request->tahun)->with("total_nilai_bulan")->get();

            if ($bulan == null) {
                return response()->json(['message' => 'data not found'], 404);
            }

            return response()->json(['message' => 'Success get data by bulan and tahun', 'data' => $bulan], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get data by bulan and tahun',
                'error' => $th
            ]);
        }
    }
}
