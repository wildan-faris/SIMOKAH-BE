<?php

namespace Tests\Feature;

use App\Models\Kelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_33_HapusDataKelasTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_kelas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        $newKelas = Kelas::create([
            "guru_id" => $this->guru->id,
            "name" => $this->faker()->jobTitle(),
        ]);

        // request
        $response = $this->from('/kelas/index')->get('/kelas/delete/'. $newKelas->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/kelas/index');
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('kelas', [
            'id' => $newKelas->id,
            "guru_id" => $newKelas->guru_id,
            'name' => $newKelas->name,
        ]);
    }
}
