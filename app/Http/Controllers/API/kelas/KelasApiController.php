<?php

namespace App\Http\Controllers\API\kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasApiController extends Controller
{
    public function getAll()
    {
        try {
            $kelas = Kelas::get();
            return response()->json(['message' => 'Success get all data ', 'data' => $kelas], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data ', 'error' => $th]);
        }
    }
    public function getById($id)
    {
        try {
            $kelas = Kelas::where("id", $id)->with("siswa")->with("guru")->first();

            if ($kelas == null) {
                return response()->json(['message' => 'data not found'], 404);
            }

            return response()->json(['message' => 'Success get data by id', 'data' => $kelas], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get data by id',
                'error' => $th
            ]);
        }
    }

    function create(Request $request)
    {
        try {
            Kelas::create([
                "name" => $request->name,
                "guru_id" => $request->guru_id
            ]);

            $get = Kelas::get()->last();



            return response()->json(['message' => 'Success create data', 'data' => $get], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed create data',
                'error' => $th
            ], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            Kelas::where("id", $id)->update([
                "name" => $request->name,
                "guru_id" => $request->guru_id
            ]);

            $get_kelas = Kelas::where("id", $id)->first();



            return response()->json([
                'message' => 'Success edit data',
                'data' => $get_kelas
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed create data',
                'error' => $th
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            Kelas::where("id", $id)->delete();
            return response()->json(['message' => 'Success delete data'], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed delete data',
                'error' => $th
            ], 500);
        }
    }
}
