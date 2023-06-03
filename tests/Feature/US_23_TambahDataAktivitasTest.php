<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_23_TambahDataAktivitasTest extends TestCase
{

    public function test_admin_dapat_menambah_data_aktivitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $request = [
            'name' => $this->faker()->jobTitle(),
        ];
        $response = $this->from('/aktivitas/create/index')->post('/aktivitas/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertSessionHas("success_create", "Berhasil Menambahkan Data");

        // assert database
        $this->assertDatabaseHas('aktivitas', [
            "name" => $request["name"],
        ]);
    }
}
