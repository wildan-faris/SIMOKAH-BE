<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_24_UbahDataAktivitasTest extends TestCase
{

    public function test_admin_dapat_mengubah_data_aktivitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // create aktivitas
        $aktivitas = Aktivitas::create([
            "name" => $this->faker()->jobTitle()
        ]);

        // edit aktivitas
        $EditRequest = [
            "id" => $aktivitas->id,
            "name" => $this->faker()->jobTitle(),
        ];

        $response = $this->from('/aktivitas/index')->post('aktivitas/edit/', $EditRequest);

        // assert response
        $response->assertStatus(302);
        $response->assertRedirect('/aktivitas/index');
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");

        // assert database
        $this->assertDatabaseHas('aktivitas', [
            "id" => $aktivitas->id,
            "name" => $EditRequest["name"],
        ]);
    }
}
