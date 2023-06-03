<?php

namespace Tests\Feature;

use App\Models\Guru;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class US_32_UbahDataKelasTest extends TestCase
{
    public function test_admin_dapat_mengubah_data_kelas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $newGuru = Guru::create([
            'name' => $this->faker()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->email(),
            'password' => Hash::make("password_guru"),
            'photo_profil' => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png",
        ]);

        // edit request
        $EditRequest = [
            "id" => $this->kelas->id,
            "guru_id" => $newGuru->id,
            "name" => $this->faker()->jobTitle(),
        ];

        $response = $this->from('/kelas/index')->post('kelas/edit/', $EditRequest);

        // assert response
        $response->assertStatus(302);
        $response->assertRedirect('/kelas/index');
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");

        // assert database
        $this->assertDatabaseHas('kelas', [
            "id" => $this->kelas->id,
            "guru_id" => $EditRequest["guru_id"],
            "name" => $EditRequest["name"],
        ]);
    }
}
