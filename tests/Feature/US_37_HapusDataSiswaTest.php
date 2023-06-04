<?php

namespace Tests\Feature;

use App\Models\Kelas;
use Tests\TestCase;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Hash;

class US_37_HapusDataSiswaTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_siswa()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $newOrangTua = OrangTua::create([
            'name' => $this->faker()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->email(),
            'password' => Hash::make("passowrd_orang_tua"),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
            'pekerjaan' => $this->faker()->jobTitle(),
            'alamat' => $this->faker()->address(),
            'no_hp' => $this->faker("id")->phoneNumber(),
        ]);

        $newKelas = Kelas::create([
            'name' => $this->faker()->jobTitle(),
            "guru_id" => $this->guru->id,
        ]);

        $newSiswa = Siswa::create([
            "name" => $this->faker('id')->name(),
            "nis" => $this->faker()->randomNumber(5),
            "jenis_kelamin" => $this->faker()->randomElement(["laki-laki", "perempuan"]),
            "tempat_lahir" => $this->faker('id')->address(),
            "tanggal_lahir" => $this->faker()->date(),
            "orang_tua_id" => $newOrangTua->id,
            "kelas_id" => $newKelas->id,
            "tahun_ajaran" => 2020
        ]);

        // request
        $response = $this->get('/siswa/delete/'. $newSiswa->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/orang-tua/viewIndex/' . $newSiswa->id);
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('siswas', [
            'id' => $newSiswa->id,
            'name' => $newSiswa->name,
            'nis' => $newSiswa->nis,
        ]);
    }
}
