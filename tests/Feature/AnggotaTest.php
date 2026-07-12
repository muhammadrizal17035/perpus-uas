<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_bisa_login_dengan_kredensial_valid()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_gagal_dengan_password_salah()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-salah',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /** @test */
    public function anggota_berhasil_disimpan_jika_semua_input_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', [
            'nama'   => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp'  => '081234567890',
            'email'  => 'budi.santoso@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/anggota');
        $this->assertDatabaseHas('anggota', [
            'email' => 'budi.santoso@gmail.com',
        ]);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_nama_mengandung_angka()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', [
            'nama'   => 'Budi Santoso 123',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp'  => '081234567890',
            'email'  => 'budi@gmail.com',
        ]);

        $response->assertSessionHasErrors(['nama']);
        $this->assertDatabaseMissing('anggota', ['email' => 'budi@gmail.com']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_email_tidak_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', [
            'nama'   => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp'  => '081234567890',
            'email'  => 'bukan-email-valid',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_nomor_hp_format_salah()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', [
            'nama'   => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp'  => '12345',
            'email'  => 'budi@gmail.com',
        ]);

        $response->assertSessionHasErrors(['no_hp']);
    }
}