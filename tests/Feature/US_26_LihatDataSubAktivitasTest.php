<?php

namespace Tests\Feature;

use App\Models\Aktivitas;
use App\Models\SubAktivitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_26_LihatDataSubAktivitasTest extends TestCase
{
    public function test_Admin_dapat_melihat_data_sub_aktifitas()
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

        // create sub_aktivitas
        $request = [
            'name' => $this->faker()->jobTitle(),
            'aktivitas_id' => $aktivitas->id,
        ];
        $response = $this->from('/sub-aktivitas/create/index')->post('/sub-aktivitas/create', $request);

        // request
        $subAktivitas = SubAktivitas::get();
        $response = $this->get('/sub-aktivitas/index/' . $aktivitas->id);

        // response assert
        $response->assertStatus(200);
        $response->assertViewIs('sub_aktivitas.index');
        $response->assertViewHas('data_sub_aktivitas', $subAktivitas);
        $response->assertSee($subAktivitas[0]->name);
    }
}
