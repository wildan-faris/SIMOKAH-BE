<?php

namespace App\Console;

use App\Models\Bulan;
use App\Models\TotalNilai;
use App\Models\TotalNilaiBulan;
use App\Models\TotalNilaiKelas;
use App\Models\TotalNilaiKelasBulan;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Masukkan Kode Anda Disini
        $schedule->call(function () {

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

            $data_total_nilai_kelas = TotalNilaiKelas::all();
            foreach ($data_total_nilai_kelas as $dtnk) {

                TotalNilaiKelasBulan::create([
                    "kelas_id" => $dtnk->kelas_id,
                    "sub_aktivitas_id" => $dtnk->sub_aktivitas_id,
                    "aktivitas_id" => $dtnk->aktivitas_id,
                    "nilai" => $dtnk->nilai,
                    "bulan_id" => $data_bulan->id,

                ]);
            }
        })->cron('* * * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
