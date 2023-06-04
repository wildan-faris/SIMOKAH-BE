<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Aktivitas;
use App\Models\Siswa;
use App\Models\SubAktivitas;
use App\Models\TotalNilai;
use App\Models\TotalNilaiKelas;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class US_36_LihatDataLaporanBulananGrafikAnakTest extends TestCase
{
    public function test_orang_tua_dapat_melihat_data_laporan_bulanan_siswa_dalam_grafik()
    {
        Auth::login($this->guru);

        // buat aktifitas
        $aktivitas = Aktivitas::create([
            'name' => $this->faker()->jobTitle(),
        ]);

        // buat sub aktifitas
        $sub_aktivitas = SubAktivitas::create([
            'aktivitas_id' => $aktivitas['id'],
            'name' => $this->faker()->jobTitle()
        ]);

        // buat request
        $request = [
            'siswa_id' => $this->siswa->id,
            'tanggal' => Carbon::now(),
            'sub_aktivitas_id' => $sub_aktivitas['id'],
            'penilai' => $this->guru->id,
            'nilai' => $this->faker()->numberBetween(1,5),
        ];

        // buat nilai
        $response = $this->post('/api/nilai', $request);


        // data for assertion
        $data_siswa = Siswa::where("id", $this->siswa->id)->first();
        $data_aktivitas = Aktivitas::with('sub_aktivitas')->get();
        $total_nilai = TotalNilai::get();

        // hit api url
        $response = $this->withSession(['remember_token' => "token"])->get('/kelas/grafik/siswa/' . $this->siswa->id);

        // assert response
        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_siswa');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai', $total_nilai);
    }

    public function test_guru_dapat_melihat_data_laporan_bulanan_siswa_dalam_grafik()
    {
        Auth::login($this->guru);

        // buat aktifitas
        $aktivitas = Aktivitas::create([
            'name' => $this->faker()->jobTitle(),
        ]);

        // buat sub aktifitas
        $sub_aktivitas = SubAktivitas::create([
            'aktivitas_id' => $aktivitas['id'],
            'name' => $this->faker()->jobTitle()
        ]);

        // buat request
        $request = [
            'siswa_id' => $this->siswa->id,
            'tanggal' => Carbon::now(),
            'sub_aktivitas_id' => $sub_aktivitas['id'],
            'penilai' => $this->guru->id,
            'nilai' => $this->faker()->numberBetween(1,5),
        ];

        // buat nilai
        $response = $this->post('/api/nilai', $request);

        // data for assertion
        $data_siswa = Siswa::where("id", $this->siswa->id)->first();
        $data_aktivitas = Aktivitas::with('sub_aktivitas')->get();
        $total_nilai = TotalNilai::get();

        // hit api URL
        $response = $this->withSession(['remember_token' => "token"])->get('/kelas/grafik/siswa/' . $this->siswa->id);

        // assert response
        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_siswa');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai', $total_nilai);
    }
}
