<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananKamar extends Model
{
    /** @var string */
    protected $table = 'pemesanan_kamar';

    /** @var list<string> */
    protected $fillable = [
        'nama_pemesan',
        'jenis_kelamin',
        'nomor_identitas',
        'lokasi_hotel',
        'tipe_kamar',
        'harga_kamar',
        'tanggal_pesan',
        'durasi_menginap',
        'termasuk_breakfast',
        'biaya_breakfast',
        'subtotal',
        'diskon',
        'total_bayar',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'tanggal_pesan'      => 'date',
        'termasuk_breakfast' => 'boolean',
        'harga_kamar'        => 'decimal:2',
        'biaya_breakfast'    => 'decimal:2',
        'subtotal'           => 'decimal:2',
        'diskon'             => 'decimal:2',
        'total_bayar'        => 'decimal:2',
    ];

    /**
     * Harga dasar kamar berdasarkan tipe.
     *
     * @return array<string, int>
     */
    public static function daftarHarga(): array
    {
        return [
            'Standar'   => 350000,
            'Deluxe'    => 550000,
            'Executive' => 850000,
            'Family'    => 1200000,
        ];
    }

    /**
     * Daftar lokasi hotel resmi JWD.
     *
     * @return array<string, string>
     */
    public static function daftarLokasi(): array
    {
        return [
            'JWD Sudirman Jakarta'       => 'Jl. Jenderal Sudirman No. 88, Jakarta Pusat',
            'JWD Resort & Spa Bali'       => 'Jl. Pantai Kuta No. 12, Badung, Bali',
            'JWD Heritage Yogyakarta'     => 'Jl. Malioboro No. 45, Danurejan, Yogyakarta',
            'JWD Grand Surabaya'         => 'Jl. Embong Malang No. 10, Tegalsari, Surabaya',
        ];
    }
}
