<?php

namespace App\Http\Controllers\API\orang_tua;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthOrangTuaApiController extends Controller
{
    public function register(Request $request)
    {
        try {


            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:2',
                'pekerjaan' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'no_hp' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $get_orang_tua = OrangTua::where("email", $request->email)->first();
            if ($get_orang_tua !== null) {
                return response()->json([
                    "message" => "email sudah terdaftar"
                ]);
            }

            $orang_tua = OrangTua::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'no_hp' => $request->email,
            ]);

            $siswa = Siswa::create([
                "name" => $request->name_siswa,
                "nis" => $request->nis_siswa,
                "jenis_kelamin" => $request->jenis_kelamin_siswa,
                "tempat_lahir" => $request->tempat_lahir_siswa,
                "tanggal_lahir" => $request->tanggal_lahir_siswa,
                "orang_tua_id" => $orang_tua->id,
                "kelas_id" => $request->kelas_id
            ]);


            return response()
                ->json(['data' => $orang_tua, 'token_type' => 'Bearer', 'data_anak' => $siswa]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed Register',
                'error' => $th
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            //code...

            $get_orang_tua = OrangTua::where('email', $request->email)->first();
            if ($get_orang_tua == null) {

                return response()
                    ->json([

                        'messege' => 'email tidak terdaftar',
                    ]);
            }

            if (Hash::check($request->password, $get_orang_tua->password)) {



                $orang_tua = OrangTua::where('email', $request['email'])->firstOrFail();

                $token = $orang_tua->createToken('auth_token')->plainTextToken;

                OrangTua::where("email", $request['email'])->update([
                    'remember_token' => $token
                ]);
                $request->session()->put("user_token", $token);
                return response()
                    ->json([
                        'message' => 'Hi ' . $orang_tua->name . ', welcome to home',
                        'access_token' => $token,
                        'id' => $orang_tua->id,
                        'token_type' => 'Bearer',
                    ]);
            } else {
                return response()
                    ->json([

                        'messege' => 'email atau password salah',
                    ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed Register',
                'error' => $th
            ], 500);
        }
    }

    public function logout(Request $request)
    {


        try {


            $request->session()->forget('user_token');
            auth()->user()->tokens()->delete();
            return [
                'message' => 'You have successfully logged out and the token was successfully deleted',

            ];
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed Register',
                'error' => $th
            ], 500);
        }
    }
}
