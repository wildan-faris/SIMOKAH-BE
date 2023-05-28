<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_13_TambahDataKepalaSekolahTest extends TestCase
{
    use WithFaker;

    public function test_admin_dapat_menambah_data_kepala_sekolah()
    {
        // login as admin
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $request = [
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(),
        ];
        $response = $this->from('/kepala-sekolah/create/index')->post('/kepala-sekolah/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertSessionHas("success_create", "Berhasil Mendaftar");

        // assert database
        $this->assertDatabaseHas('kepala_sekolahs', [
            "name" => $request["name"],
            "email" => $request["email"],
        ]);
    }
}
