<?php

namespace App\Http\Controllers\API\total_nilai_bulan;

use App\Http\Controllers\Controller;
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
            $data_total_nilai_bulan_bulan = TotalNilaiBulan::with("siswa")->with("aktivitas")->with("sub_aktivitas")->get();

            return response()->json([
                'message' => 'Success get all data',
                'data' => $data_total_nilai_bulan_bulan,

            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed get all data', 'error' => $th], 500);
        }
    }

    public function getById($id)
    {

        try {

            $total_nilai_bulan = TotalNilaiBulan::with("siswa")->with("aktivitas")->with("sub_aktivitas")->where("id", $id)->first();

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

            $total_nilai_bulan = TotalNilaiBulan::with("siswa")->with("aktivitas")->with("sub_aktivitas")->where("siswa_id", $request->siswa_id)->where("aktivitas_id", $request->aktivitas_id)->get();



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

            foreach ($data_total_nilai as $dtn) {

                $bulan_sebelumnya = Carbon::now()->subMonth();

                $tahun = $bulan_sebelumnya->year;
                $bulan = $bulan_sebelumnya->formatLocalized('%B');
                $data_total_nilai_kelas = TotalNilaiKelas::all();
                foreach ($data_total_nilai_kelas as $dtnk) {
                    TotalNilaiKelasBulan::create([
                        "sub_aktivitas_id" => $dtnk->sub_aktivitas_id,
                        "kelas_id" => $dtnk->kelas_id,
                        "nilai" => $dtnk->nilai,
                        "bulan" => $bulan,
                        "tahun" => $tahun,
                    ]);
                }
            }

            return response()->json([
                "message" => "Success create data",

            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed create data', 'error' => $th], 500);
        }
    }
}
