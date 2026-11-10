<?php

use App\Models\PemesananKamar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('halaman utama dapat diakses', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Lumina Pasific');
    $response->assertSee('Koleksi Pilihan Kamar');
    $response->assertSee('Fasilitas &amp; Video Eksplorasi', false);
    $response->assertSee('Kenyamanan Autentik');
});

test('halaman harga dapat diakses dan menampilkan paket kamar', function () {
    $response = $this->get('/harga');
    $response->assertStatus(200);
    $response->assertSee('Koleksi Kamar &amp; Pilihan Tarif', false);
    $response->assertSee('Standar');
    $response->assertSee('Deluxe');
    $response->assertSee('Executive');
    $response->assertSee('Family Suite');
});

test('halaman tentang kami dapat diakses', function () {
    $response = $this->get('/tentang');
    $response->assertStatus(200);
    $response->assertSee('The Artisan Kitchen');
    $response->assertSee('Jaringan Resor Lumina Pasific');
});

test('halaman form pemesanan dapat diakses dengan preset query param', function () {
    $response = $this->get('/pesan?tipe=Deluxe&lokasi=JWD+Resort+%26+Spa+Bali');
    $response->assertStatus(200);
    $response->assertSee('Form Pemesanan Kamar Hotel');
    $response->assertSee('Deluxe');
});

test('validasi nomor identitas wajib tepat 16 digit', function () {
    $response = $this->post('/pesan', [
        'nama_pemesan'    => 'Glenn Marcel',
        'jenis_kelamin'   => 'Laki-laki',
        'nomor_identitas' => '12345', // Kurang dari 16 digit
        'lokasi_hotel'    => 'JWD Sudirman Jakarta',
        'tipe_kamar'      => 'Deluxe',
        'tanggal_pesan'   => '2026-11-10',
        'durasi_menginap' => 2,
    ]);

    $response->assertSessionHasErrors([
        'nomor_identitas' => 'isian salah..data harus 16 digit',
    ]);
});

test('validasi durasi menginap wajib berupa angka', function () {
    $response = $this->post('/pesan', [
        'nama_pemesan'    => 'Glenn Marcel',
        'jenis_kelamin'   => 'Laki-laki',
        'nomor_identitas' => '3273012505980001',
        'lokasi_hotel'    => 'JWD Sudirman Jakarta',
        'tipe_kamar'      => 'Deluxe',
        'tanggal_pesan'   => '2026-11-10',
        'durasi_menginap' => 'tiga_hari', // Bukan angka
    ]);

    $response->assertSessionHasErrors([
        'durasi_menginap' => 'harus isi angka',
    ]);
});

test('pemesanan kamar berhasil disimpan dengan kalkulasi diskon dan breakfast', function () {
    $response = $this->post('/pesan', [
        'nama_pemesan'       => 'Glenn Marcel',
        'jenis_kelamin'      => 'Laki-laki',
        'nomor_identitas'    => '3273012505980001',
        'lokasi_hotel'       => 'JWD Sudirman Jakarta',
        'tipe_kamar'         => 'Deluxe', // 550.000 / malam
        'tanggal_pesan'      => '2026-11-10',
        'durasi_menginap'    => 4, // > 3 hari -> diskon 10%
        'termasuk_breakfast' => '1', // 80.000 * 4 = 320.000
    ]);

    $response->assertRedirect('/riwayat');
    $response->assertSessionHas('success', 'Reservasi kamar berhasil disimpan.');

    $this->assertDatabaseHas('pemesanan_kamar', [
        'nama_pemesan'       => 'Glenn Marcel',
        'nomor_identitas'    => '3273012505980001',
        'tipe_kamar'         => 'Deluxe',
        'harga_kamar'        => 550000,
        'durasi_menginap'    => 4,
        'termasuk_breakfast' => true,
        'subtotal'           => 2200000, // 550.000 * 4
        'diskon'             => 220000,  // 10% dari 2.200.000
        'biaya_breakfast'    => 320000,  // 80.000 * 4
        'total_bayar'        => 2300000, // 2.200.000 - 220.000 + 320.000
    ]);
});

test('data pemesanan dapat dihapus dari riwayat', function () {
    $pemesanan = PemesananKamar::create([
        'nama_pemesan'       => 'Tamu Uji Coba',
        'jenis_kelamin'      => 'Perempuan',
        'nomor_identitas'    => '3273012505980002',
        'lokasi_hotel'       => 'JWD Resort & Spa Bali',
        'tipe_kamar'         => 'Standar',
        'harga_kamar'        => 350000,
        'tanggal_pesan'      => '2026-11-15',
        'durasi_menginap'    => 2,
        'termasuk_breakfast' => false,
        'biaya_breakfast'    => 0,
        'subtotal'           => 700000,
        'diskon'             => 0,
        'total_bayar'        => 700000,
    ]);

    $response = $this->delete("/riwayat/{$pemesanan->id}");
    $response->assertRedirect('/riwayat');
    $response->assertSessionHas('success', 'Data pemesanan berhasil dihapus.');

    $this->assertDatabaseMissing('pemesanan_kamar', [
        'id' => $pemesanan->id,
    ]);
});
