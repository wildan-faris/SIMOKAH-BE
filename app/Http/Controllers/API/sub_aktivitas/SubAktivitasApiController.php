<?php

namespace App\Http\Controllers\API\sub_aktivitas;

use App\Http\Controllers\Controller;
use App\Models\SubAktivitas;
use Illuminate\Http\Request;

class SubAktivitasApiController extends Controller
{
    public function getAll()
    {

        try {

            $sub_aktivitas = SubAktivitas::get();
            return response()->json([
                'message' => 'Success get all data',
                'data' => $sub_aktivitas,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get all data',
                'error' => $th
            ], 500);
        }
    }
    public function getById($id)
    {

        try {

            $sub_aktivitas = SubAktivitas::where("id", $id)->first();

            if ($sub_aktivitas == null) {
                return response()->json([
                    "message" => "data not found",

                ], 404);
            }

            return response()->json([
                "message" => "Success get data by id",
                "data" => $sub_aktivitas,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by id', 'error' => $th], 500);
        }
    }
    public function getByAktivitas($aktivitas_id)
    {

        try {

            $sub_aktivitas = SubAktivitas::where("aktivitas_id", $aktivitas_id)->get();

            return response()->json([
                "message" => "Success get data by aktivitas",
                "data" => $sub_aktivitas,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by id', 'error' => $th], 500);
        }
    }

    public function create(Request $request)
    {

        try {

            SubAktivitas::create([
                "aktivitas_id" => $request->aktivitas_id,
                "name" => $request->name,
            ]);

            $sub_aktivitas = SubAktivitas::get()->last();

            return response()->json([
                "message" => "Success create data",
                "data" => $sub_aktivitas,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th], 500);
        }
    }

    public function update($id, Request $request)
    {

        try {

            SubAktivitas::where("id", $id)->update([
                "aktivitas_id" => $request->aktivitas_id,
                "name" => $request->name,
            ]);

            return response()->json([
                "message" => "Success update data"
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed update data', 'error' => $th], 500);
        }
    }

    public function delete($id)
    {

        try {

            SubAktivitas::where("id", $id)->delete();

            return response()->json([
                "message" => "Success delete data"
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed delete data', 'error' => $th], 500);
        }
    }
}
