<?php

namespace App\Http\Controllers\API\total_nilai_bulan;

use App\Http\Controllers\Controller;
use App\Models\Bulan;
use App\Models\TotalNilai;
use App\Models\TotalNilaiBulan;
use App\Models\TotalNilaiKelas;
use App\Models\TotalNilaiKelasBulan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TotalNilaiBulanController extends Controller
{
    public function getAll()
    {

        try {
            $total_nilai_bulan = TotalNilaiBulan::with("siswa")->with("aktivitas")->with("sub_aktivitas")->with("bulan")->get();

            return response()->json([
                'message' => 'Success get all data',
                'data' => $total_nilai_bulan,

            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data', 'error' => $th], 500);
        }
    }

    public function getById($id)
    {

        try {

            $total_nilai_bulan = TotalNilaiBulan::where("id", $id)->with("siswa")->with("aktivitas")->with("sub_aktivitas")->with("bulan")->first();

            if ($total_nilai_bulan == null) {
                return response()->json([
                    "message" => "data not found",

                ]);
            }

            return response()->json([
                "message" => "Success get data by id",
                "data" => $total_nilai_bulan
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by id', 'error' => $th], 500);
        }
    }
    public function getBySiswaAndAktivitas(Request $request)
    {
        try {

            $total_nilai_bulan = TotalNilaiBulan::with("siswa")->with("aktivitas")->with("sub_aktivitas")->with("bulan")->where("siswa_id", $request->siswa_id)->where("aktivitas_id", $request->aktivitas_id)->get();



            return response()->json([
                "message" => "Success get data by siswa and aktivitas id",
                "data" => $total_nilai_bulan
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get data by siswa and aktivitas id', 'error' => $th], 500);
        }
    }


    public function create(Request $request)
    {

        try {

            $data_total_nilai = TotalNilai::all();
            $bulan_sebelumnya = Carbon::now()->subMonth();

            $tahun = $bulan_sebelumnya->year;
            $bulan = $bulan_sebelumnya->formatLocalized('%B');


            $data_bulan = Bulan::create([
                'bulan' => $bulan,
                'tahun' => $tahun,
            ]);
            foreach ($data_total_nilai as $dtn) {



                TotalNilaiBulan::create([
                    "siswa_id" => $dtn->siswa_id,
                    "sub_aktivitas_id" => $dtn->sub_aktivitas_id,
                    "aktivitas_id" => $dtn->aktivitas_id,
                    "nilai" => $dtn->nilai,
                    "bulan_id" => $data_bulan->id,

                ]);
            }

            return response()->json([
                "message" => "Success create data",

            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th], 500);
        }
    }
    public function createKelas(Request $request)
    {

        try {

            $data_total_nilai_kelas = TotalNilaiKelas::all();
            $bulan_sebelumnya = Carbon::now()->subMonth();

            $tahun = $bulan_sebelumnya->year;
            $bulan = $bulan_sebelumnya->formatLocalized('%B');

            $data_bulan = Bulan::create([
                'bulan' => $bulan,
                'tahun' => $tahun,
            ]);
            foreach ($data_total_nilai_kelas as $dtnk) {

                TotalNilaiKelasBulan::create([
                    "kelas_id" => $dtnk->kelas_id,
                    "sub_aktivitas_id" => $dtnk->sub_aktivitas_id,
                    "aktivitas_id" => $dtnk->aktivitas_id,
                    "nilai" => $dtnk->nilai,
                    "bulan_id" => $data_bulan->id,

                ]);
            }

            return response()->json([
                "message" => "Success create data",

            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th], 500);
        }
    }
}
