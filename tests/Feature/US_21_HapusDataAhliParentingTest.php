<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class US_21_HapusDataAhliParentingTest extends TestCase
{
    public function test_admin_dapat_menghapus_data_ahli_parenting()
    {
        // login
        $response = $this->from('/admin/loginIndex')->post('/admin/login', [
            'name' => $this->admin->name,
            'password' => "password_admin",
        ]);

        // request
        $response = $this->from('/ahli-parenting/index')->get('/ahli-parenting/delete/'. $this->ahli_parenting->id);

        // response assert
        $response->assertStatus(302);
        $response->assertRedirect('/ahli-parenting/index');
        $response->assertSessionHas('success_delete', 'Berhasil Menghapus Data');

        // database assert
        $this->assertDatabaseMissing('ahli_parentings', [
            'id' => $this->ahli_parenting->id,
            'name' => $this->ahli_parenting->name,
            'email' => $this->ahli_parenting->email,
        ]);
    }
}
