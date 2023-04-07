<?php

namespace App\Http\Controllers\API\guru;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthGuruController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $get_guru = Guru::where("email", $request->email)->first();
        if ($get_guru !== null) {
            return response()->json([
                "message" => "email sudah terdaftar"
            ]);
        }

        $guru = Guru::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",

        ]);


        return response()
            ->json(['data' => $guru, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        $get_guru = Guru::where('email', $request->email)->first();
        if ($get_guru == null) {

            return response()
                ->json([

                    'messege' => 'email atau password salah',
                ]);
        }

        if (Hash::check($request->password, $get_guru->password)) {

            $guru = Guru::where('email', $request['email'])->firstOrFail();

            $token = $guru->createToken('auth_token')->plainTextToken;

            Guru::where("email", $request['email'])->update([
                'remember_token' => $token
            ]);
            $request->session()->put("user_token", $token);
            return response()
                ->json([
                    'message' => 'Hi ' . $guru->name . ', welcome to home',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]);
        } else {
            return response()
                ->json([

                    'messege' => 'email atau password salah',
                ]);
        }
    }

    public function logout(Request $request)
    {


        $request->session()->forget("user_token");

        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',
        ];
    }
}
