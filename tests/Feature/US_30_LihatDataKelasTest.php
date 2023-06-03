<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_30_LihatDataKelasTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_kelas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // create kelas
        $request = [
            'name' => $this->faker()->jobTitle(),
            "guru_id" => $this->guru->id,
        ];

        // request
        $kelas = Kelas::with(['guru', "siswa"])->get();
        $guru = Guru::get();

        $response = $this->get('/kelas/index');

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('kelas.index');
        $response->assertViewHas('data_kelas', $kelas);
        $response->assertViewHas('data_guru', $guru);
    }
}
