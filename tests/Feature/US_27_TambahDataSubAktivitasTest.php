<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_27_TambahDataSubAktivitasTest extends TestCase
{
    public function test_admin_dapat_menambah_data_sub_aktivitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $aktivitas = Aktivitas::create([
            "name" => $this->faker()->jobTitle()
        ]);

        $request = [
            'name' => $this->faker()->jobTitle(),
            'aktivitas_id' => $aktivitas->id,
        ];

        $response = $this->from('/sub-aktivitas/create/index')->post('/sub-aktivitas/create', $request);

        // assert response
        $response->assertStatus(302);
        $response->assertRedirect('/sub-aktivitas/index/' . $aktivitas->id);
        $response->assertSessionHas("success_create", "Berhasil Menambahkan Data");

        // assert database
        $this->assertDatabaseHas('sub_aktivitas', [
            "aktivitas_id" => $request["aktivitas_id"],
            "name" => $request["name"],
        ]);
    }
}
