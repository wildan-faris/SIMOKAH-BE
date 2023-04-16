<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\OrangTua;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function CheckToken(Request $request)
    {


        $token = $request->bearerToken();

        $guru = Guru::where("remember_token", $token)->first();
        if ($guru == null) {
            return response()
                ->json([

                    'messege' => 'invalid token',
                ]);
        }

        $orang_tua = OrangTua::where("remember_token", $token)->first();
        if ($orang_tua == null) {
            return response()
                ->json([

                    'messege' => 'invalid token',
                ]);
        }
    }
}
