<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan_kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nomor_identitas', 20);
            $table->string('lokasi_hotel')->default('JWD Sudirman Jakarta');
            $table->enum('tipe_kamar', ['Standar', 'Deluxe', 'Executive', 'Family']);
            $table->decimal('harga_kamar', 15, 2);
            $table->date('tanggal_pesan');
            $table->integer('durasi_menginap');
            $table->boolean('termasuk_breakfast')->default(false);
            $table->decimal('biaya_breakfast', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('total_bayar', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_kamar');
    }
};
