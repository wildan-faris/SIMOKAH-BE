<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_15_TambahDataGuruTest extends TestCase
{
    use WithFaker;

    public function test_admin_dapat_menambah_data_guru()
    {
        // login as admin
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $request = [
            'name' => $this->faker()->name(),
            'username' => $this->faker()->userName(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(),
        ];
        $response = $this->from('/guru/create/index')->post('/guru/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertSessionHas("success_create", "Berhasil Menambahkan Data");

        // assert database
        $this->assertDatabaseHas('gurus', [
            "name" => $request["name"],
            "username" => $request["username"],
            "email" => $request["email"],
        ]);
    }
}
