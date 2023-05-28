<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_19_TambahDataAhliParentingTest extends TestCase
{
    use WithFaker;

    public function test_admin_dapat_menambah_data_ahli_parenting()
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
        $response = $this->from('/ahli-parenting/create/index')->post('/ahli-parenting/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertSessionHas("success_create", "Berhasil Menambahkan Data");

        // assert database
        $this->assertDatabaseHas('ahli_parentings', [
            "name" => $request["name"],
            "email" => $request["email"],
        ]);
    }
}
