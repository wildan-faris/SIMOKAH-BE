<?php

namespace App\Http\Controllers\API\aktivitas;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasApiController extends Controller
{
    public function getAll()
    {
        try {
            $aktivitas = Aktivitas::with("sub_aktivitas")->get();
            return response()->json(['message' => 'Success get all data ', 'data' => $aktivitas], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data ', 'data' => $th]);
        }
    }
    public function getById($id)
    {
        try {
            $aktivitas = Aktivitas::with("sub_aktivitas")->where("id", $id)->first();

            if ($aktivitas == null) {
                return response()->json(['message' => 'data not found'], 404);
            }

            return response()->json(['message' => 'Success get data by id', 'data' => $aktivitas], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by id', 'data' => $th]);
        }
    }

    function create(Request $request)
    {
        try {
            Aktivitas::create([
                "name" => $request->name,

            ]);

            $get = Aktivitas::get()->last();



            return response()->json(['message' => 'Success create data', 'data' => $get], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'data' => $th]);
        }
    }

    public function update($id, Request $request)
    {
        try {
            Aktivitas::where("id", $id)->update([
                "name" => $request->name,

            ]);



            return response()->json(['message' => 'Success edit data',], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed edit data', 'data' => $th]);
        }
    }

    public function delete($id)
    {
        try {
            Aktivitas::where("id", $id)->delete();
            return response()->json(['message' => 'Success delete data',], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed delete data', 'data' => $th]);
        }
    }
}
