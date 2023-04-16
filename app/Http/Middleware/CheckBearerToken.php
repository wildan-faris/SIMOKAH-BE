<?php

namespace App\Http\Middleware;

use App\Models\Guru;
use App\Models\OrangTua;
use Closure;
use Illuminate\Http\Request;

class CheckBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $guru = Guru::where("remember_token", session()->get("user_token"))->first();
        if ($guru == null) {

            $orang_tua = OrangTua::where("remember_token", session()->get("user_token"))->first();

            if ($orang_tua == null) {
                return response()->json([
                    'message' => 'invalid token',

                ]);
            }
        }

        return $next($request);
    }
}
