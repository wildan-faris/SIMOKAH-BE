<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\Bulan;
use App\Models\Siswa;
use App\Models\SubAktivitas;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class US_35_LihatDataLaporanBulananGrafikKelasTest extends TestCase
{
    public function test_kepala_sekolah_dapat_melihat_data_laporan_kelas_dalam_grafik_berdasarkan_bulan()
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


        // login as kepsek
        $response = $this->from('/kepala-sekolah/loginIndex')->post('/kepala-sekolah/login', [
            'name' => $this->kepala_sekolah->name,
            'password' => "password_kepala_sekolah",
        ]);

        // data for assertion
        $data_siswa = Siswa::where("kelas_id", $this->kelas->id)->get();
        $data_aktivitas = Aktivitas::with('sub_aktivitas')->get();
        $total_nilai = Bulan::with("total_nilai_kelas_bulan")->get();

        // hit web url
        $response = $this->get('/kelas/grafik/kelas/bulan/' . $this->kelas->id);

        // assert response
        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_kelas_bulan');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_kelas', $this->kelas);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai_kelas_bulan', $total_nilai);
    }

    public function test_ahli_parenting_dapat_melihat_data_laporan_kelas_dalam_grafik_berdasarkan_bulan()
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

        // test post api
        $response = $this->post('/api/nilai', $request);

        // login as ahli parenting
        $response = $this->from('/ahli-parenting/loginIndex')->post('/ahli-parenting/login', [
            'name' => $this->ahli_parenting->name,
            'password' => "password_ahli_parenting",
        ]);

        // data for assertion
        $data_siswa = Siswa::where("kelas_id", $this->kelas->id)->get();
        $data_aktivitas = Aktivitas::with('sub_aktivitas')->get();
        $total_nilai = Bulan::with("total_nilai_kelas_bulan")->get();

        // hit web url
        $response = $this->get('/kelas/grafik/kelas/bulan/' . $this->kelas->id);

        // assert response
        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_kelas_bulan');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_kelas', $this->kelas);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai_kelas_bulan', $total_nilai);
    }
}
