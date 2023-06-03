<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\SubAktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_28_UbahDataSubAktivitasTest extends TestCase
{
    public function test_admin_dapat_mengubah_data_sub_aktivitas()
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

        $subAktivitas = SubAktivitas::create([
            "name" => $this->faker()->jobTitle(),
            "aktivitas_id" => $aktivitas->id,
        ]);

        // edit aktivitas
        $EditRequest = [
            "id" => $subAktivitas->id,
            "name" => $this->faker()->jobTitle(),
            "aktivitas_id" => $aktivitas->id,
        ];

        $response = $this->from('/sub-aktivitas/index/' . $aktivitas->id)->post('/sub-aktivitas/edit/', $EditRequest);

        // assert response
        $response->assertStatus(302);
        $response->assertRedirect('/sub-aktivitas/index/' . $aktivitas->id);
        $response->assertSessionHas("success_edit", "Berhasil Mengubah Data");

        // assert database
        $this->assertDatabaseHas('sub_aktivitas', [
            "id" => $subAktivitas->id,
            "aktivitas_id" => $aktivitas->id,
            "name" => $EditRequest["name"],
        ]);
    }
}
