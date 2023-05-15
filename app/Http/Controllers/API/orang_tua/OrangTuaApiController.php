<?php

namespace App\Http\Controllers\API\orang_tua;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class OrangTuaApiController extends Controller
{
    public function getProfil($id)
    {

        try {
            //code...

            $orang_tua = OrangTua::where("id", $id)->get();

            return response()->json([
                'message' => 'success get user by id',
                'data' => $orang_tua,

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed get user by id',
                'error' => $th
            ], 500);
        }
    }
    public function editProfil($id, Request $request)
    {

        try {

            $orang_tua = OrangTua::findOrFail($id);

            if ($request->input('name')) {
                $orang_tua->name = $request->input('name');
            }
            if ($request->input('username')) {
                $orang_tua->username = $request->input('username');
            }

            if ($request->input('email')) {
                $orang_tua->email = $request->input('email');
            }
            if ($request->input('password')) {
                $new_password = Hash::make($request->password);
                $orang_tua->password = $new_password;
            }

            $orang_tua->save();

            return response()->json([
                'message' => 'success update data user'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed update data user',
                'error' => $th
            ], 500);
        }
    }

    public function editPhoto($id, Request $request)
    {

        try {

            $getUser = OrangTua::where("id", $id)->first();



            $this->deleteFile($getUser->photo_profil);

            $image = $request->file('photo_profil');
            $namePhoto = time() . $image->getClientOriginalName();
            if ($image->getClientMimeType() == 'application/pdf') {
                return redirect('/createIndex')->with("failed", "File harus berupa png or jpg");
            }
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'photo-profil-orang_tua';

            // upload file
            $image->move($tujuan_upload, $namePhoto);

            $namePhoto = url("/" . $tujuan_upload . "/" . $namePhoto);

            OrangTua::where("id", $id)->update([
                "photo_profil" => $namePhoto
            ]);

            return response()->json(['message' => "success edit photo profil"]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed edit photo profil',
                'error' => $th
            ], 500);
        }
    }

    public function deletePhoto($id)
    {

        try {

            $getUser = OrangTua::where("id", $id)->first();



            $this->deleteFile($getUser->photo_profil);

            OrangTua::where("id", $id)->update([
                "photo_profil" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png"
            ]);
            return response()->json(['message' => "success delete photo profil"]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed delete photo profil',
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
