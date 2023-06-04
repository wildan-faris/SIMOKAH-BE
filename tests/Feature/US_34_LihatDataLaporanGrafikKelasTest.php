<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\SubAktivitas;
use App\Models\TotalNilaiKelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class US_34_LihatDataLaporanGrafikKelasTest extends TestCase
{
    use RefreshDatabase;

    public function test_kepala_sekolah_dapat_melihat_data_laporan_kelas_dalam_grafik()
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

        $data_siswa = Siswa::where("kelas_id", $this->kelas->id)->get();
        $data_aktivitas = Aktivitas::with('sub_aktivitas')->get();
        $total_nilai = TotalNilaiKelas::get();

        $response = $this->get('/kelas/grafik/kelas/' . $this->kelas->id);

        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_kelas');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_kelas', $this->kelas);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai_kelas', $total_nilai);
    }

    public function test_ahli_parenting_dapat_melihat_data_laporan_kelas_dalam_grafik()
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
        $total_nilai = TotalNilaiKelas::get();

        // hit web url
        $response = $this->get('/kelas/grafik/kelas/' . $this->kelas->id);

        $response->assertStatus(200);
        $response->assertViewIs('kelas.grafik_kelas');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_kelas', $this->kelas);
        $response->assertViewHas('data_aktivitas', $data_aktivitas);
        $response->assertViewHas('data_total_nilai_kelas', $total_nilai);
    }
}
