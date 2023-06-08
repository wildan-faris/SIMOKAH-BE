<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class US_39_UbahDataSiswaTest extends TestCase
{

    public function test_admin_dapat_mengakses_halaman_ubah_data_siswa()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $data_siswa = Siswa::where("id", $this->siswa->id)->with(['kelas', 'orang_tua'])->get();
        $data_kelas = Kelas::get();

        $response = $this->get('orang-tua/siswa/edit/index/' . $this->siswa->id);

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.edit-siswa');
        $response->assertViewHas('data_siswa', $data_siswa);
        $response->assertViewHas('data_kelas', $data_kelas);
    }

    public function test_admin_dapat_mengubah_data_siswa()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $startDate = Carbon::create(2002, 1, 1);
        $endDate = Carbon::create(2002, 12, 31);

        $randomDate = $this->faker()->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        $request = [
            "id" => $this->siswa->id,
            'name' => $this->faker()->name(),
            'nis' => $this->faker()->randomDigit(4),
            'tahun_ajaran' => '2020',
            'jenis_kelamin' => $this->faker()->randomElement(['laki-laki', 'perempuan']),
            'tempat_lahir' => $this->faker()->address(),
            'tanggal_lahir' => $randomDate,
            'orang_tua_id' => $this->orang_tua->id,
            'kelas_id' => $this->kelas->id
        ];

        $response = $this->from('/orang-tua/siswa/edit/index/' . $this->siswa->id)
                        ->post('/orang-tua/siswa/edit', $request);

        $response->assertStatus(302);
        $response->assertRedirect('/orang-tua/viewIndex/' . $this->orang_tua->id);
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");

        $this->assertDatabaseHas('siswas', [
            "id" => $this->siswa->id,
            "name" => $request["name"],
            "nis" => $request["nis"],
            "tahun_ajaran" => $request["tahun_ajaran"],
            "jenis_kelamin" => $request["jenis_kelamin"],
            "tempat_lahir" => $request["tempat_lahir"],
            "tanggal_lahir" => $request["tanggal_lahir"],
            "orang_tua_id" => $request["orang_tua_id"],
            "kelas_id" => $request["kelas_id"],
        ]);
    }
}
