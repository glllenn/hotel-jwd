<?php

namespace App\Http\Controllers;

use App\Models\PemesananKamar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemesananKamarController extends Controller
{
    /**
     * Tampilkan halaman utama / beranda.
     */
    public function home(): View
    {
        $daftarHarga  = PemesananKamar::daftarHarga();
        $daftarLokasi = PemesananKamar::daftarLokasi();

        return view('home', compact('daftarHarga', 'daftarLokasi'));
    }

    /**
     * Tampilkan halaman daftar harga & perbandingan kamar mewah.
     */
    public function harga(): View
    {
        $daftarHarga  = PemesananKamar::daftarHarga();
        $daftarLokasi = PemesananKamar::daftarLokasi();

        return view('harga', compact('daftarHarga', 'daftarLokasi'));
    }

    /**
     * Tampilkan halaman tentang kami & fasilitas dapur kuliner.
     */
    public function tentang(): View
    {
        return view('tentang');
    }

    /**
     * Tampilkan form pemesanan kamar dengan preset tipe dan lokasi.
     */
    public function formPesan(Request $request): View
    {
        $daftarHarga   = PemesananKamar::daftarHarga();
        $daftarLokasi  = PemesananKamar::daftarLokasi();
        $selectedTipe   = $request->query('tipe', 'Standar');
        $selectedLokasi = $request->query('lokasi', 'JWD Sudirman Jakarta');

        // Pastikan fallback aman jika query param tidak dikenal
        if (!array_key_exists($selectedTipe, $daftarHarga)) {
            $selectedTipe = 'Standar';
        }
        if (!array_key_exists($selectedLokasi, $daftarLokasi)) {
            $selectedLokasi = 'JWD Sudirman Jakarta';
        }

        return view('pesan', compact('daftarHarga', 'daftarLokasi', 'selectedTipe', 'selectedLokasi'));
    }

    /**
     * Simpan data pemesanan ke database MySQL/SQLite.
     */
    public function simpan(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_pemesan'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'.\-]+$/'],
            'jenis_kelamin'   => ['required', 'in:Laki-laki,Perempuan'],
            'nomor_identitas' => ['required', 'digits:16'],
            'lokasi_hotel'    => ['required', 'string'],
            'tipe_kamar'      => ['required', 'in:Standar,Deluxe,Family Suite,Family'],
            'tanggal_pesan'   => ['required', 'date'],
            'durasi_menginap' => ['required', 'integer', 'min:1'],
        ], [
            'nomor_identitas.digits'   => 'isian salah..data harus 16 digit',
            'nomor_identitas.required' => 'Nomor identitas wajib diisi.',
            'nama_pemesan.required'    => 'Nama pemesan wajib diisi.',
            'nama_pemesan.regex'       => 'Nama pemesan hanya boleh berisi huruf dan spasi.',
            'jenis_kelamin.required'   => 'Jenis kelamin wajib dipilih.',
            'lokasi_hotel.required'    => 'Lokasi hotel wajib dipilih.',
            'tipe_kamar.required'      => 'Tipe kamar wajib dipilih.',
            'tanggal_pesan.required'   => 'Tanggal pesan wajib diisi.',
            'durasi_menginap.required' => 'Durasi menginap wajib diisi.',
            'durasi_menginap.integer'  => 'harus isi angka',
            'durasi_menginap.numeric'  => 'harus isi angka',
            'durasi_menginap.min'      => 'Durasi menginap minimal 1 hari.',
        ]);

        $daftarHarga       = PemesananKamar::daftarHarga();
        $tipeKamar         = $request->input('tipe_kamar');
        $hargaKamar        = $daftarHarga[$tipeKamar] ?? ($tipeKamar === 'Family' ? ($daftarHarga['Family Suite'] ?? 1200000) : 350000);
        $durasi            = (int) $request->input('durasi_menginap');
        $termasukBreakfast = $request->boolean('termasuk_breakfast');

        $subtotal        = $hargaKamar * $durasi;
        $biayaBreakfast  = $termasukBreakfast ? (80000 * $durasi) : 0;
        $diskon          = ($durasi > 3) ? ($subtotal * 0.10) : 0;
        $totalBayar      = $subtotal - $diskon + $biayaBreakfast;

        $pemesanan = PemesananKamar::create([
            'nama_pemesan'       => $request->input('nama_pemesan'),
            'jenis_kelamin'      => $request->input('jenis_kelamin'),
            'nomor_identitas'    => $request->input('nomor_identitas'),
            'lokasi_hotel'       => $request->input('lokasi_hotel'),
            'tipe_kamar'         => $tipeKamar,
            'harga_kamar'        => $hargaKamar,
            'tanggal_pesan'      => $request->input('tanggal_pesan'),
            'durasi_menginap'    => $durasi,
            'termasuk_breakfast' => $termasukBreakfast,
            'biaya_breakfast'    => $biayaBreakfast,
            'subtotal'           => $subtotal,
            'diskon'             => $diskon,
            'total_bayar'        => $totalBayar,
        ]);

        return redirect()->route('pesan.invoice', $pemesanan->id)->with('success', 'Reservasi kamar berhasil disimpan.');
    }

    /**
     * Tampilkan halaman bukti invoice / konfirmasi reservasi sekali pakai.
     */
    public function invoice(PemesananKamar $pemesananKamar): View
    {
        return view('invoice', ['pesanan' => $pemesananKamar]);
    }

    /**
     * Tampilkan riwayat seluruh pemesanan kamar.
     */
    public function riwayat(): View
    {
        $riwayat = PemesananKamar::latest()->get();

        return view('riwayat', compact('riwayat'));
    }

    /**
     * Hapus satu data pemesanan.
     */
    public function hapus(PemesananKamar $pemesananKamar): RedirectResponse
    {
        $pemesananKamar->delete();

        return redirect()->route('riwayat')->with('success', 'Data pemesanan berhasil dihapus.');
    }
}
