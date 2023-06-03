<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_31_TambahDataKelasTest extends TestCase
{
    public function test_admin_dapat_menambah_data_kelas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $request = [
            'name' => $this->faker()->jobTitle(),
            "guru_id" => $this->guru->id,
        ];
        $response = $this->from('/kelas/create/index')->post('/kelas/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertRedirect("/kelas/index");
        $response->assertSessionHas("success_create", "Berhasil Menambahkan Data");

        // assert database
        $this->assertDatabaseHas('kelas', [
            "name" => $request["name"],
            "guru_id" => $request["guru_id"],
        ]);
    }
}
