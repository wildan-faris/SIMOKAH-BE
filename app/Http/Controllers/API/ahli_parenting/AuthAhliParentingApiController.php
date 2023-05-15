<?php

namespace App\Http\Controllers\API\ahli_parenting;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\AhliParenting;
use App\Models\ahli_parenting;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAhliParentingApiController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:2',

            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $get_ahli_parenting = AhliParenting::where("email", $request->email)->first();
            if ($get_ahli_parenting !== null) {
                return response()->json([
                    "message" => "email sudah terdaftar"
                ]);
            }

            $ahli_parenting = AhliParenting::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",

            ]);



            return response()
                ->json(['data' => $ahli_parenting, 'token_type' => 'Bearer',]);
        } catch (\Throwable $th) {
            return response()
                ->json([

                    'messege' => 'failed register',
                    'error' => $th
                ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:2',

            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $get_ahli_parenting = AhliParenting::where('email', $request->email)->first();
            if ($get_ahli_parenting == null) {

                return response()
                    ->json([

                        'messege' => 'email atau password salah',
                    ]);
            }

            if (Hash::check($request->password, $get_ahli_parenting->password)) {

                $ahli_parenting = AhliParenting::where('email', $request['email'])->firstOrFail();

                $token = $ahli_parenting->createToken('auth_token')->plainTextToken;

                AhliParenting::where("email", $request['email'])->update([
                    'remember_token' => $token
                ]);
                $request->session()->put("user_token", $token);
                return response()
                    ->json([
                        'message' => 'Hi ' . $ahli_parenting->name . ', welcome to home',
                        'access_token' => $token,
                        'id' => $ahli_parenting->id,
                        'token_type' => 'Bearer',
                    ]);
            } else {
                return response()
                    ->json([

                        'messege' => 'email atau password salah',
                    ]);
            }
        } catch (\Throwable $th) {
            return response()
                ->json([

                    'messege' => 'failed login',
                    'error' => $th
                ], 500);
        }
    }

    public function logout(Request $request)
    {

        try {
            $request->session()->forget("user_token");

            auth()->user()->tokens()->delete();
            return [
                'message' => 'You have successfully logged out and the token was successfully deleted',
            ];
        } catch (\Throwable $th) {
            return response()
                ->json([

                    'messege' => 'failed logout',
                    'error' => $th
                ], 500);
        }
    }
}
