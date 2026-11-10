<?php

use App\Http\Controllers\PemesananKamarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PemesananKamarController::class, 'home'])->name('home');
Route::get('/harga', [PemesananKamarController::class, 'harga'])->name('harga');
Route::get('/tentang', [PemesananKamarController::class, 'tentang'])->name('tentang');
Route::get('/pesan', [PemesananKamarController::class, 'formPesan'])->name('pesan');
Route::post('/pesan', [PemesananKamarController::class, 'simpan'])->name('pesan.simpan');
Route::get('/riwayat', [PemesananKamarController::class, 'riwayat'])->name('riwayat');
Route::delete('/riwayat/{pemesananKamar}', [PemesananKamarController::class, 'hapus'])->name('riwayat.hapus');
