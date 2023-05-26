<?php

namespace App\Http\Controllers\API\guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class GuruApiController extends Controller
{
    public function getProfil($id)
    {


        try {



            $guru = Guru::where("id", $id)->first();

            if ($guru == null) {
                return response()->json([
                    'message' => 'data guru tidak ada',


                ], 404);
            }

            return response()->json([
                'message' => 'success get user by id',
                'data' => $guru,

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed get user by id',
                'error' => $th,

            ], 500);
        }
    }
    public function editProfil($id, Request $request)
    {
        try {
            $guru = Guru::findOrFail($id);

            if ($request->input('name')) {
                $guru->name = $request->input('name');
            }
            if ($request->input('username')) {
                $guru->username = $request->input('username');
            }

            if ($request->input('email')) {
                $guru->email = $request->input('email');
            }
            if ($request->input('password')) {
                $new_password = Hash::make($request->password);
                $guru->password = $new_password;
            }

            $guru->save();

            return response()->json([
                'message' => 'success update data user'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed update data user',
                "error" => $th
            ], 500);
        }
    }

    public function editPhoto($id, Request $request)
    {
        try {
            $getUser = Guru::where("id", $id)->first();



            $this->deleteFile($getUser->photo_profil);

            $image = $request->file('photo_profil');
            $namePhoto = time() . $image->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'photo-profil-guru';

            // upload file
            $image->move($tujuan_upload, $namePhoto);

            $namePhoto = url("/" . $tujuan_upload . "/" . $namePhoto);

            Guru::where("id", $id)->update([
                "photo_profil" => $namePhoto
            ]);

            return response()->json(['message' => "success edit photo profil"]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "failed edit photo profil",
                'error' => $th
            ], 500);
        }
    }

    public function deletePhoto($id)
    {
        try {
            $getUser = Guru::where("id", $id)->first();



            $this->deleteFile($getUser->photo_profil);

            Guru::where("id", $id)->update([
                "photo_profil" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png"
            ]);
            return response()->json(['message' => "success delete photo profil"]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "failed delete photo profil",
                'error' => $th
            ], 500);
        }
    }


    public function deleteFile($name_file)
    {
        $basePath = url('/');
        $delfile = str_replace("$basePath/", "", $name_file);
        return File::delete($delfile);
    }
}
