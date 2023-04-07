<?php

namespace App\Http\Controllers\API\kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function getAll()
    {
        $kelas = Kelas::get();
        return response()->json(['message' => 'Success get all data ', 'data' => $kelas], 200);
    }
    public function getById($id)
    {
        $kelas = Kelas::where("id", $id)->first();

        if ($kelas == null) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json(['message' => 'Success get data by id', 'data' => $kelas], 200);
    }

    function create(Request $request)
    {
        Kelas::create([
            "name" => $request->name,
            "guru_id" => $request->guru_id
        ]);

        $get = Kelas::get()->last();



        return response()->json(['message' => 'Success create data', 'data' => $get], 201);
    }

    public function update($id, Request $request)
    {
        Kelas::where("id", $id)->update([
            "name" => $request->name,
            "guru_id" => $request->guru_id
        ]);



        return response()->json(['message' => 'Success edit data',], 201);
    }

    public function delete($id)
    {
        Kelas::where("id", $id)->delete();
        return response()->json(['message' => 'Success delete data',], 201);
    }
}
