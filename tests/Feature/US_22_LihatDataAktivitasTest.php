<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_22_LihatDataAktivitasTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_aktifitas()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // create aktivitas
        $request = [
            'name' => $this->faker()->jobTitle(),
        ];
        $response = $this->from('/aktivitas/create/index')->post('/aktivitas/create', $request);

        // request
        $aktivitas = Aktivitas::get();
        $response = $this->get('/aktivitas/index');

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('aktivitas.index');
        $response->assertViewHas('data_aktivitas', $aktivitas);
        $response->assertSee($aktivitas[0]->name);
    }
}
