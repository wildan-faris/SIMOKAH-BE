<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\SubAktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_29_HapusDataSubAktivitasTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_sub_aktivitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $aktivitas = Aktivitas::create([
            "name" => $this->faker()->jobTitle(),
        ]);

        $subAktivitas = SubAktivitas::create([
            "name" => $this->faker()->jobTitle(),
            "aktivitas_id" => $aktivitas->id,
        ]);

        // request
        $response = $this->from('/sub-aktivitas/index/' . $aktivitas->id)->get('/sub-aktivitas/delete/'. $subAktivitas->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/sub-aktivitas/index/' . $aktivitas->id);
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('sub_aktivitas', [
            'id' => $subAktivitas->id,
            'aktivitas_id' => $aktivitas->id,
            'name' => $subAktivitas->name,
        ]);
    }
}
