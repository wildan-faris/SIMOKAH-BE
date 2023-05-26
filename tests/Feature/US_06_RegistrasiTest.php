<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_06_RegistrasiTest extends TestCase
{
    use WithFaker;

    public function test_orang_tua_dapat_melakukan_registrasi()
    {

        $dataOrangTua = [
            'name' => $this->faker()->unique()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->unique()->email(),
            'password' => $this->faker()->password(),
            'pekerjaan' => $this->faker()->jobTitle(),
            'alamat' => $this->faker()->address(),
            'no_hp' => $this->faker()->unique()->phoneNumber()
        ];

        $dataSiswa = [
            'name_siswa' => $this->faker()->unique()->name(),
            'nis_siswa' => $this->faker()->numberBetween(10000, 200000),
            'jenis_kelamin_siswa' => $this->faker()->randomElement(['laki-laki', 'perempuan']),
            'tempat_lahir_siswa' => $this->faker()->city(),
            'tanggal_lahir_siswa' => $this->faker()->date(),
            'kelas_id' => $this->kelas->id,
            'tahun_ajaran' => 2020
        ];

        $request = array_merge($dataOrangTua, $dataSiswa);

        $response = $this->post('/api/orang-tua/register', $request);

        $response->assertJson([
            'data' => [
                'name' => $dataOrangTua['name'],
                'email' => $dataOrangTua['email'],
                'username' => $dataOrangTua['username'],
                'pekerjaan' => $dataOrangTua['pekerjaan'],
                'alamat' => $dataOrangTua['alamat'],
                'no_hp' => $dataOrangTua['no_hp'],
            ],
            'data_anak' => [
                'name' => $dataSiswa['name_siswa'],
                'nis' => $dataSiswa['nis_siswa'],
                'jenis_kelamin' => $dataSiswa['jenis_kelamin_siswa'],
                'tempat_lahir' => $dataSiswa['tempat_lahir_siswa'],
                'tanggal_lahir' => $dataSiswa['tanggal_lahir_siswa'],
                'kelas_id' => $dataSiswa['kelas_id'],
                'tahun_ajaran' => $dataSiswa['tahun_ajaran'],
            ],
            'token_type' => 'Bearer'
        ]);

        $this->assertDatabaseHas('orang_tuas', [
            'name' => $dataOrangTua['name'],
            'email' => $dataOrangTua['email'],
            'username' => $dataOrangTua['username'],
            'pekerjaan' => $dataOrangTua['pekerjaan'],
            'alamat' => $dataOrangTua['alamat'],
            'no_hp' => $dataOrangTua['no_hp'],
        ]);

        $this->assertDatabaseHas('siswas', [
            'name' => $dataSiswa['name_siswa'],
            'nis' => $dataSiswa['nis_siswa'],
            'jenis_kelamin' => $dataSiswa['jenis_kelamin_siswa'],
            'tempat_lahir' => $dataSiswa['tempat_lahir_siswa'],
            'tanggal_lahir' => $dataSiswa['tanggal_lahir_siswa'],
            'kelas_id' => $dataSiswa['kelas_id'],
            'tahun_ajaran' => $dataSiswa['tahun_ajaran'],
        ]);
    }
}
