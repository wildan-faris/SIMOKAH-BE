<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png"
        ]);


        return response()
            ->json(['data' => $user, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        User::where("email", $request['email'])->update([
            'remember_token' => $token
        ]);
        $request->session()->put("user_token", $token);
        return response()
            ->json([
                'message' => 'Hi ' . $user->name . ', welcome to home',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
    }

    // method for user photo_profilut and delete token
    public function logout(Request $request)
    {



        $request->session()->forget('user_token');
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',
        ];
    }

    public function GetProfil($id)
    {
        $user = User::where("id", $id)->get();

        return response()->json([
            'message' => 'success get user by id',
            'data' => $user,

        ]);
    }
    public function EditProfil($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->input('name')) {
            $user->name = $request->input('name');
        }
        if ($request->input('username')) {
            $user->username = $request->input('username');
        }

        if ($request->input('email')) {
            $user->email = $request->input('email');
        }

        $user->save();

        return response()->json([
            'message' => 'success update data user'
        ]);
    }

    public function EditPhoto($id, Request $request)
    {
        $getUser = User::where("id", $id)->first();



        $this->deleteFile($getUser->photo_profil);

        $image = $request->file('photo_profil');
        $namePhoto = time() . $image->getClientOriginalName();
        if ($image->getClientMimeType() == 'application/pdf') {
            return redirect('/createIndex')->with("failed", "File harus berupa png or jpg");
        }
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'photo-profil';

        // upload file
        $image->move($tujuan_upload, $namePhoto);

        $namePhoto = url("/" . $tujuan_upload . "/" . $namePhoto);

        User::where("id", $id)->update([
            "photo_profil" => $namePhoto
        ]);

        return response()->json(['message' => "success edit photo profil"]);
    }

    public function DeletePhoto($id)
    {
        $getUser = User::where("id", $id)->first();



        $this->deleteFile($getUser->photo_profil);

        User::where("id", $id)->update([
            "photo_profil" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png"
        ]);
        return response()->json(['message' => "success delete photo profil"]);
    }


    public function deleteFile($name_file)
    {
        $basePath = url('/');
        $delfile = str_replace("$basePath/", "", $name_file);
        return File::delete($delfile);
    }
}
