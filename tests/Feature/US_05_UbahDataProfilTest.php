<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class US_05_UbahDataProfilTest extends TestCase
{

    public function test_guru_dapat_mengubah_foto_profil()
    {
        Auth::login($this->guru);

        $oldPhoto = $this->guru->photo_profiil;

        Storage::fake('photo-profil-guru');

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/api/guru/photo-edit/' . $this->guru->id, [
            'photo_profil' => $file
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success edit photo profil']);
        $this->assertDatabaseMissing('gurus', [
            'id' => $this->orang_tua->id,
            'photo_profil' => $oldPhoto
        ]);
    }

    public function test_orang_tua_dapat_mengubah_foto_profil()
    {
        Auth::login($this->orang_tua);

        $oldPhoto = $this->orang_tua->photo_profiil;

        Storage::fake('photo-profil-orang-tua');

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/api/orang-tua/photo-edit/' . $this->orang_tua->id, [
            'photo_profil' => $file
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success edit photo profil']);
        $this->assertDatabaseMissing('orang_tuas', [
            'id' => $this->orang_tua->id,
            'photo_profil' => $oldPhoto
        ]);
    }
}
