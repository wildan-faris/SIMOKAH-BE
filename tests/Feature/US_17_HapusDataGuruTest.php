<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_17_HapusDataGuruTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_guru()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $response = $this->from('/guru/index')->get('/guru/delete/'. $this->guru->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/guru/index');
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('gurus', [
            'id' => $this->guru->id,
            'name' => $this->guru->name,
            'email' => $this->guru->email,
        ]);
    }
}
