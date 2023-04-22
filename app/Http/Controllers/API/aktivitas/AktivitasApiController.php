<?php

namespace App\Http\Controllers\API\aktivitas;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasApiController extends Controller
{
    public function getAll()
    {
        $aktivitas = Aktivitas::with("sub_aktivitas")->get();
        return response()->json(['message' => 'Success get all data ', 'data' => $aktivitas], 200);
    }
    public function getById($id)
    {
        $aktivitas = Aktivitas::with("sub_aktivitas")->where("id", $id)->first();

        if ($aktivitas == null) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json(['message' => 'Success get data by id', 'data' => $aktivitas], 200);
    }

    function create(Request $request)
    {
        Aktivitas::create([
            "name" => $request->name,

        ]);

        $get = Aktivitas::get()->last();



        return response()->json(['message' => 'Success create data', 'data' => $get], 201);
    }

    public function update($id, Request $request)
    {
        Aktivitas::where("id", $id)->update([
            "name" => $request->name,

        ]);



        return response()->json(['message' => 'Success edit data',], 201);
    }

    public function delete($id)
    {
        Aktivitas::where("id", $id)->delete();
        return response()->json(['message' => 'Success delete data',], 201);
    }
}
