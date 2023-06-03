<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use Tests\TestCase;

class US_25_HapusDataAktivitasTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_aktivitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $aktivitas = Aktivitas::create([
            "name" => $this->faker()->jobTitle(),
        ]);

        // request
        $response = $this->from('/aktivitas/index')->get('/aktivitas/delete/'. $aktivitas->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/aktivitas/index');
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('aktivitas', [
            'id' => $aktivitas->id,
            'name' => $aktivitas->name,
        ]);
    }
}
