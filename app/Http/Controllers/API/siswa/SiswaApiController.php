<?php

namespace App\Http\Controllers\API\siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaApiController extends Controller
{
    public function getAll()
    {
        $siswa = Siswa::get();
        return response()->json(['message' => 'Success get all data ', 'data' => $siswa], 200);
    }
    public function getById($id)
    {
        $siswa = Siswa::where("id", $id)->first();

        if ($siswa == null) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return response()->json(['message' => 'Success get data by id', 'data' => $siswa], 200);
    }

    function create(Request $request)
    {
        try {
            Siswa::create([
                "name" => $request->name,
                "nis" => $request->nis,
                "jenis_kelamin" => $request->jenis_kelamin,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "orang_tua_id" => $request->orang_tua_id,
                "kelas_id" => $request->kelas_id
            ]);

            $get = Siswa::get()->last();



            return response()->json(['message' => 'Success create data', 'data' => $get], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th]);
        }
    }

    public function update($id, Request $request)
    {
        Siswa::where("id", $id)->update([
            "name" => $request->name,
            "nis" => $request->nis,
            "jenis_kelamin" => $request->jenis_kelamin,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "orang_tua_id" => $request->orang_tua_id,
            "kelas_id" => $request->kelas_id
        ]);



        return response()->json(['message' => 'Success edit data',], 201);
    }

    public function delete($id)
    {
        Siswa::where("id", $id)->delete();
        return response()->json(['message' => 'Success delete data',], 201);
    }
}
