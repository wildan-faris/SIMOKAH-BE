<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\SubAktivitas;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class US_07_CatatKegiatanHarianTest extends TestCase
{
    use WithFaker;

    public function test_guru_dapat_mencatat_kegiatan_siswa()
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

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Success create data',
            'total_nilai' => $request['nilai'],
            'data' => [
                'nilai' => $request['nilai']
            ]
        ]);
    }
}
