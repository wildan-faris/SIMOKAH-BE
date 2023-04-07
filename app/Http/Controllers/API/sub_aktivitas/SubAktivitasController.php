<?php

namespace App\Http\Controllers\API\sub_aktivitas;

use App\Http\Controllers\Controller;
use App\Models\SubAktivitas;
use Illuminate\Http\Request;

class SubAktivitasController extends Controller
{
    public function getAll()
    {
        $sub_aktivitas = SubAktivitas::get();
        return response()->json([
            'message' => 'Success get all data',
            'data' => $sub_aktivitas,
        ], 200);
    }
    public function getById($id)
    {
        $sub_aktivitas = SubAktivitas::where("id", $id)->first();

        if ($sub_aktivitas == null) {
            return response()->json([
                "message" => "data not found",

            ]);
        }

        return response()->json([
            "message" => "Success get data by id",
            "data" => $sub_aktivitas,
        ]);
    }
    public function getByAktivitas($aktivitas_id)
    {
        $sub_aktivitas = SubAktivitas::where("aktivitas_id", $aktivitas_id)->get();

        return response()->json([
            "message" => "Success get data by aktivitas",
            "data" => $sub_aktivitas,
        ]);
    }

    public function create(Request $request)
    {
        SubAktivitas::create([
            "aktivitas_id" => $request->aktivitas_id,
            "name" => $request->name,
        ]);

        $sub_aktivitas = SubAktivitas::get()->last();

        return response()->json([
            "message" => "Success create data",
            "data" => $sub_aktivitas,
        ]);
    }

    public function update($id, Request $request)
    {
        SubAktivitas::where("id", $id)->update([
            "aktivitas_id" => $request->aktivitas_id,
            "name" => $request->name,
        ]);

        return response()->json([
            "message" => "Success update data"
        ]);
    }

    public function delete($id)
    {
        SubAktivitas::where("id", $id)->delete();

        return response()->json([
            "message" => "Success delete data"
        ]);
    }
}
