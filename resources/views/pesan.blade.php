@extends('layouts.app')

@section('title', 'Form Pemesanan Kamar')

@push('styles')
<style>
    /* ============================================================
       BOOKING FORM PAGE — Solid White, Luxury Minimalist
       ============================================================ */
    .booking-page-hero {
        padding: 40px 0 50px;
        background: #FFFFFF;
        text-align: center;
    }

    .booking-layout {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 36px;
        align-items: start;
        margin-bottom: 90px;
    }

    /* Form Container */
    .form-card-container {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
    }

    .form-card-head {
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-base);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .form-head-icon {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-md);
        background: var(--text-heading);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .form-head-icon svg { width: 20px; height: 20px; }

    .form-head-title {
        font-size: 1.125rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
    }

    .form-head-sub {
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .form-body-pad {
        padding: 32px;
    }

    .form-field-group {
        margin-bottom: 22px;
    }

    .field-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 8px;
    }

    .field-label .required-star {
        color: #DC2626;
        margin-left: 2px;
    }

    .field-input {
        width: 100%;
        padding: 12px 16px;
        font-size: 0.9375rem;
        color: var(--text-heading);
        background: #FFFFFF;
        border: 1.5px solid var(--border-base);
        border-radius: var(--radius-md);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }

    .field-input:focus {
        border-color: var(--text-heading);
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }

    .field-input:read-only {
        background: var(--bg-subtle);
        color: var(--text-muted);
        cursor: not-allowed;
    }

    .field-input.is-invalid {
        border-color: #DC2626;
        background: #FFFDFD;
    }

    .field-error-msg {
        font-size: 0.8125rem;
        color: #DC2626;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
    }

    .field-error-msg svg { width: 14px; height: 14px; flex-shrink: 0; }

    .field-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    /* Radio Group */
    .radio-pill-group {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .radio-pill-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border: 1.5px solid var(--border-base);
        border-radius: var(--radius-md);
        cursor: pointer;
        font-size: 0.9375rem;
        color: var(--text-body);
        transition: all 0.2s ease;
        user-select: none;
        flex: 1;
        justify-content: center;
    }

    .radio-pill-item:hover {
        background: var(--bg-subtle);
        border-color: var(--border-dark);
    }

    .radio-pill-item:has(input:checked) {
        border-color: var(--text-heading);
        background: var(--bg-subtle);
        color: var(--text-heading);
        font-weight: 700;
    }

    .radio-pill-item input[type="radio"] {
        accent-color: var(--text-heading);
        width: 16px;
        height: 16px;
    }

    /* Checkbox Card */
    .checkbox-luxury-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border: 1.5px solid var(--border-base);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
        margin-top: 6px;
    }

    .checkbox-luxury-box:hover {
        background: var(--bg-subtle);
    }

    .checkbox-luxury-box:has(input:checked) {
        border-color: var(--text-heading);
        background: var(--bg-subtle);
    }

    .checkbox-luxury-box input[type="checkbox"] {
        accent-color: var(--text-heading);
        width: 18px;
        height: 18px;
    }

    /* Calculate Result Box */
    .calculation-breakdown-box {
        background: var(--bg-subtle);
        border: 1.5px solid var(--border-base);
        border-radius: var(--radius-lg);
        padding: 24px;
        margin-top: 24px;
        display: none;
    }

    .calculation-breakdown-box.is-active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .calc-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 0.9375rem;
        color: var(--text-body);
        border-bottom: 1px solid var(--border-base);
    }

    .calc-line:last-child { border-bottom: none; }

    .calc-line.highlight-discount .calc-val {
        color: #16A34A;
        font-weight: 700;
    }

    .calc-line.final-total {
        padding-top: 14px;
        margin-top: 6px;
        border-top: 2px solid var(--border-dark);
    }

    .calc-line.final-total .calc-lbl {
        font-size: 1.0625rem;
        font-weight: 800;
        color: var(--text-heading);
    }

    .calc-line.final-total .calc-val {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
    }

    /* Action Buttons Row */
    .form-btn-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    /* ============================================================
       SIDEBAR: DYNAMIC ROOM PREVIEW & LOCATION INFO
       ============================================================ */
    .preview-sticky-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        position: sticky;
        top: 110px;
    }

    .preview-photo-frame {
        position: relative;
        width: 100%;
        aspect-ratio: 16/10;
        overflow: hidden;
        background: var(--bg-subtle);
    }

    .preview-photo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease, opacity 0.3s ease;
    }

    .preview-photo-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: 1px solid var(--border-base);
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-heading);
    }

    .preview-card-content {
        padding: 24px;
    }

    .preview-hotel-loc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-faint);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 6px;
    }

    .preview-hotel-loc-pill svg { width: 13px; height: 13px; }

    .preview-room-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }

    .preview-room-desc {
        font-size: 0.875rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .preview-amenities-stack {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-base);
    }

    .preview-amenity-row {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.875rem;
        color: var(--text-body);
    }

    .preview-amenity-row svg {
        width: 15px;
        height: 15px;
        color: var(--text-heading);
        flex-shrink: 0;
    }

    .discount-banner-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        border-radius: var(--radius-md);
        font-size: 0.8125rem;
        color: #166534;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .discount-banner-alert svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }

    .preview-live-price-box {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    .preview-live-price-lbl {
        font-size: 0.8125rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .preview-live-price-val {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
    }

    @media (max-width: 992px) {
        .booking-layout { grid-template-columns: 1fr; }
        .preview-sticky-card { position: static; }
    }

    @media (max-width: 640px) {
        .field-row-2 { grid-template-columns: 1fr; }
        .form-body-pad { padding: 22px 18px; }
        .form-btn-actions { flex-direction: column; }
    }
</style>
@endpush

@section('content')

{{-- ================================================================
     HERO: FORM PEMESANAN KAMAR
     ================================================================ --}}
<section class="booking-page-hero">
    <div class="container">
        <div data-aos="fade-up">
            <span class="section-eyebrow">Reservasi Resmi</span>
            <h1 class="section-heading">Form Pemesanan Kamar Hotel</h1>
            <p class="section-subheading" style="margin: 10px auto 0;">
                Lengkapi rincian formulir di bawah ini dengan data yang sah untuk mengonfirmasi reservasi kamar Anda.
            </p>
        </div>
    </div>
</section>

{{-- ================================================================
     MAIN BOOKING SECTION
     ================================================================ --}}
<section style="background: #FFFFFF;">
    <div class="container">
        <div class="booking-layout">

            {{-- FORM COLUMN --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <form method="POST" action="{{ route('pesan.simpan') }}" id="formPemesanan" novalidate>
                    @csrf

                    <div class="form-card-container">
                        <div class="form-card-head">
                            <div class="form-head-icon">
                                <i data-lucide="clipboard-pen-line"></i>
                            </div>
                            <div>
                                <h3 class="form-head-title">Data Diri &amp; Identitas Pemesan</h3>
                                <p class="form-head-sub">Pastikan data sesuai dengan kartu identitas resmi (KTP)</p>
                            </div>
                        </div>

                        <div class="form-body-pad">

                            {{-- Nama Pemesan --}}
                            <div class="form-field-group">
                                <label class="field-label" for="nama_pemesan">
                                    Nama Lengkap Pemesan <span class="required-star">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="nama_pemesan"
                                    name="nama_pemesan"
                                    class="field-input {{ $errors->has('nama_pemesan') ? 'is-invalid' : '' }}"
                                    value="{{ old('nama_pemesan') }}"
                                    placeholder="Contoh: Raden Glenn Marcel"
                                    autocomplete="name"
                                    pattern="[a-zA-Z\s\'.\-]+"
                                    title="Hanya karakter huruf dan spasi yang diperbolehkan"
                                    required>
                                <div class="field-error-msg js-error" id="namaJsError" style="display: none;">
                                    <i data-lucide="alert-circle"></i>
                                    Nama hanya boleh berisi huruf dan spasi (tidak boleh angka).
                                </div>
                                @error('nama_pemesan')
                                    <div class="field-error-msg">
                                        <i data-lucide="alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin (Radio Button) --}}
                            <div class="form-field-group">
                                <label class="field-label">
                                    Jenis Kelamin <span class="required-star">*</span>
                                </label>
                                <div class="radio-pill-group">
                                    <label class="radio-pill-item">
                                        <input
                                            type="radio"
                                            name="jenis_kelamin"
                                            value="Laki-laki"
                                            {{ old('jenis_kelamin', 'Laki-laki') === 'Laki-laki' ? 'checked' : '' }}
                                            required>
                                        <i data-lucide="user"></i>
                                        Laki-laki
                                    </label>
                                    <label class="radio-pill-item">
                                        <input
                                            type="radio"
                                            name="jenis_kelamin"
                                            value="Perempuan"
                                            {{ old('jenis_kelamin') === 'Perempuan' ? 'checked' : '' }}>
                                        <i data-lucide="user"></i>
                                        Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="field-error-msg">
                                        <i data-lucide="alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Nomor Identitas (Validasi Tepat 16 Digit) --}}
                            <div class="form-field-group">
                                <label class="field-label" for="nomor_identitas">
                                    Nomor Identitas (KTP / NIK) <span class="required-star">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="nomor_identitas"
                                    name="nomor_identitas"
                                    class="field-input {{ $errors->has('nomor_identitas') ? 'is-invalid' : '' }}"
                                    value="{{ old('nomor_identitas') }}"
                                    placeholder="Wajib tepat 16 digit angka (contoh: 3273012505980001)"
                                    maxlength="16"
                                    inputmode="numeric"
                                    pattern="\d{16}"
                                    required>

                                {{-- Pesan Error Khusus Syarat Sertifikasi --}}
                                <div id="nikJsError" class="field-error-msg" style="display: none;">
                                    <i data-lucide="alert-circle"></i>
                                    isian salah..data harus 16 digit
                                </div>

                                @error('nomor_identitas')
                                    <div class="field-error-msg">
                                        <i data-lucide="alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div style="font-size:0.75rem; color:var(--text-faint); margin-top:5px;">
                                    Harus tepat 16 digit angka numerik tanpa spasi atau tanda hubung (-).
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Form Card 2: Detail Hotel & Kamar --}}
                    <div class="form-card-container" style="margin-top: 24px;">
                        <div class="form-card-head">
                            <div class="form-head-icon">
                                <i data-lucide="hotel"></i>
                            </div>
                            <div>
                                <h3 class="form-head-title">Lokasi Properti &amp; Detail Kamar</h3>
                                <p class="form-head-sub">Pilih hotel tujuan dan tipe kamar yang Anda inginkan</p>
                            </div>
                        </div>

                        <div class="form-body-pad">

                            {{-- Pilihan Lokasi Hotel --}}
                            <div class="form-field-group">
                                <label class="field-label" for="lokasi_hotel">
                                    Lokasi Hotel Tujuan <span class="required-star">*</span>
                                </label>
                                <select
                                    id="lokasi_hotel"
                                    name="lokasi_hotel"
                                    class="field-input {{ $errors->has('lokasi_hotel') ? 'is-invalid' : '' }}"
                                    required>
                                    @foreach($daftarLokasi as $namaLokasi => $alamatLokasi)
                                        <option value="{{ $namaLokasi }}"
                                            data-alamat="{{ $alamatLokasi }}"
                                            {{ old('lokasi_hotel', $selectedLokasi) === $namaLokasi ? 'selected' : '' }}>
                                            {{ $namaLokasi }} &mdash; {{ $alamatLokasi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lokasi_hotel')
                                    <div class="field-error-msg">
                                        <i data-lucide="alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field-row-2">
                                {{-- Dropdown Tipe Kamar --}}
                                <div class="form-field-group">
                                    <label class="field-label" for="tipe_kamar">
                                        Tipe Kamar <span class="required-star">*</span>
                                    </label>
                                    <select
                                        id="tipe_kamar"
                                        name="tipe_kamar"
                                        class="field-input {{ $errors->has('tipe_kamar') ? 'is-invalid' : '' }}"
                                        required>
                                        @foreach($daftarHarga as $tipe => $harga)
                                            <option value="{{ $tipe }}"
                                                data-harga="{{ $harga }}"
                                                {{ old('tipe_kamar', $selectedTipe) === $tipe ? 'selected' : '' }}>
                                                {{ $tipe }} (Rp {{ number_format($harga, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipe_kamar')
                                        <div class="field-error-msg">
                                            <i data-lucide="alert-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Input Harga Kamar (Read-only otomatis) --}}
                                <div class="form-field-group">
                                    <label class="field-label" for="harga_kamar_display">
                                        Harga Dasar per Malam
                                    </label>
                                    <input
                                        type="text"
                                        id="harga_kamar_display"
                                        class="field-input"
                                        readonly>
                                    <input type="hidden" name="harga_kamar" id="harga_kamar" value="{{ old('harga_kamar') }}">
                                </div>
                            </div>

                            <div class="field-row-2">
                                {{-- Tanggal Pesan (dd/mm/yyyy) --}}
                                <div class="form-field-group">
                                    <label class="field-label" for="tanggal_pesan">
                                        Tanggal Menginap (Check-in) <span class="required-star">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        id="tanggal_pesan"
                                        name="tanggal_pesan"
                                        class="field-input {{ $errors->has('tanggal_pesan') ? 'is-invalid' : '' }}"
                                        value="{{ old('tanggal_pesan', date('Y-m-d')) }}"
                                        min="{{ date('Y-m-d') }}"
                                        required>
                                    @error('tanggal_pesan')
                                        <div class="field-error-msg">
                                            <i data-lucide="alert-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Durasi Menginap (Hari) --}}
                                <div class="form-field-group">
                                    <label class="field-label" for="durasi_menginap">
                                        Durasi Menginap (Hari) <span class="required-star">*</span>
                                    </label>
                                    <input
                                        type="number"
                                        id="durasi_menginap"
                                        name="durasi_menginap"
                                        class="field-input {{ $errors->has('durasi_menginap') ? 'is-invalid' : '' }}"
                                        value="{{ old('durasi_menginap', 1) }}"
                                        min="1"
                                        max="90"
                                        placeholder="Contoh: 3"
                                        required>
                                    <div id="durasiJsError" class="field-error-msg" style="display: none;">
                                        <i data-lucide="alert-circle"></i>
                                        harus isi angka
                                    </div>
                                    @error('durasi_menginap')
                                        <div class="field-error-msg">
                                            <i data-lucide="alert-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Checkbox Termasuk Breakfast --}}
                            <div class="form-field-group">
                                <label class="field-label">Layanan Tambahan Gastronomi</label>
                                <label class="checkbox-luxury-box">
                                    <input
                                        type="checkbox"
                                        id="termasuk_breakfast"
                                        name="termasuk_breakfast"
                                        value="1"
                                        {{ old('termasuk_breakfast') ? 'checked' : '' }}>
                                    <i data-lucide="utensils" style="width: 18px; height: 18px; color: var(--text-heading);"></i>
                                    <div>
                                        <div style="font-weight: 700; color: var(--text-heading); font-size: 0.9375rem;">
                                            Termasuk Breakfast Prasmanan (+ Rp 80.000 / hari)
                                        </div>
                                        <div style="font-size: 0.8125rem; color: var(--text-muted); margin-top: 1px;">
                                            Sarapan buffet internasional di Signature Artisan Kitchen
                                        </div>
                                    </div>
                                </label>
                            </div>

                            {{-- Tombol Hitung Total Bayar --}}
                            <button type="button" id="btnHitungTotal" class="btn-luxury btn-luxury-secondary" style="width: 100%; margin-top: 10px;">
                                <i data-lucide="calculator"></i>
                                Hitung Total Bayar
                            </button>

                            {{-- Breakdown Hasil Perhitungan --}}
                            <div class="calculation-breakdown-box" id="calcBox">
                                <div class="calc-line">
                                    <span class="calc-lbl">Harga Kamar per Malam</span>
                                    <span class="calc-val" id="resHargaKamar">-</span>
                                </div>
                                <div class="calc-line">
                                    <span class="calc-lbl">Durasi Menginap</span>
                                    <span class="calc-val" id="resDurasi">-</span>
                                </div>
                                <div class="calc-line">
                                    <span class="calc-lbl">Subtotal Kamar</span>
                                    <span class="calc-val" id="resSubtotal">-</span>
                                </div>
                                <div class="calc-line highlight-discount" id="resDiskonRow">
                                    <span class="calc-lbl">Potongan Diskon 10% (Durasi &gt; 3 Hari)</span>
                                    <span class="calc-val" id="resDiskon">-</span>
                                </div>
                                <div class="calc-line" id="resBreakfastRow">
                                    <span class="calc-lbl">Biaya Breakfast (Rp 80.000 &times; hari)</span>
                                    <span class="calc-val" id="resBreakfast">-</span>
                                </div>
                                <div class="calc-line final-total">
                                    <span class="calc-lbl">Total Biaya Pembayaran</span>
                                    <span class="calc-val" id="resTotalBayar">-</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Form Actions Row --}}
                    <div class="form-btn-actions">
                        <button type="submit" id="btnSimpanPemesanan" class="btn-luxury btn-luxury-primary" style="flex: 1;" disabled>
                            <i data-lucide="check-check"></i>
                            Simpan Pemesanan
                        </button>
                        <a href="{{ route('home') }}" class="btn-luxury btn-luxury-secondary">
                            <i data-lucide="x"></i>
                            Cancel
                        </a>
                    </div>

                    <p style="text-align: center; font-size: 0.8125rem; color: var(--text-faint); margin-top: 14px;">
                        Silakan klik tombol <strong>Hitung Total Bayar</strong> terlebih dahulu sebelum melakukan penyimpanan.
                    </p>

                </form>
            </div>

            {{-- SIDEBAR PREVIEW COLUMN --}}
            <div data-aos="fade-in" data-aos-delay="200">
                <div class="preview-sticky-card">
                    <div class="preview-photo-frame">
                        <img
                            id="previewRoomImg"
                            class="preview-photo-img"
                            src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80"
                            alt="Pratinjau Kamar Terpilih"
                            loading="eager">
                        <span class="preview-photo-badge" id="previewRoomBadge">Kamar Standar</span>
                    </div>

                    <div class="preview-card-content">
                        <div class="preview-hotel-loc-pill">
                            <i data-lucide="map-pin"></i>
                            <span id="previewHotelLocText">JWD Sudirman Jakarta</span>
                        </div>

                        <h3 class="preview-room-title" id="previewRoomTitle">Kamar Standar</h3>
                        <p class="preview-room-desc" id="previewRoomDesc">
                            Kamar nyaman berdesain minimalis dengan fasilitas tempat tidur queen-size, area kerja ergonomis,
                            dan rain shower air hangat untuk kenyamanan menginap Anda.
                        </p>

                        <div class="preview-amenities-stack">
                            <div class="preview-amenity-row">
                                <i data-lucide="calendar"></i>
                                <span id="previewCheckinDate">Check-in: Hari ini</span>
                            </div>
                            <div class="preview-amenity-row">
                                <i data-lucide="clock"></i>
                                <span id="previewStayDuration">1 Malam Menginap</span>
                            </div>
                            <div class="preview-amenity-row">
                                <i data-lucide="utensils"></i>
                                <span id="previewBreakfastStatus">Tanpa Tambahan Breakfast</span>
                            </div>
                        </div>

                        {{-- Alert banner diskon > 3 hari --}}
                        <div class="discount-banner-alert" id="previewDiscountBadge" style="display: none;">
                            <i data-lucide="gift"></i>
                            <div>
                                <strong>Diskon 10% Terpenuhi!</strong><br>
                                Durasi menginap lebih dari 3 hari berhak mendapatkan potongan biaya kamar.
                            </div>
                        </div>

                        <div class="preview-live-price-box">
                            <div>
                                <div class="preview-live-price-lbl">Estimasi Tagihan</div>
                                <span style="font-size:0.75rem; color:var(--text-faint);">Sudah termasuk pajak &amp; layanan</span>
                            </div>
                            <div class="preview-live-price-val" id="previewLivePrice">-</div>
                        </div>

                        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--border-base);">
                            <a href="{{ route('harga') }}" class="btn-luxury btn-luxury-secondary btn-luxury-sm" style="width: 100%;">
                                <i data-lucide="sparkles"></i>
                                Bandingkan dengan Kamar Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /booking-layout --}}
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // 1. Data Dictionary Kamar (Foto, Deskripsi, Harga)
    const ROOM_DATA = {
        'Standar': {
            harga: 350000,
            image: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80',
            desc: 'Kamar nyaman berdesain minimalis dengan fasilitas tempat tidur queen-size, area kerja ergonomis, dan rain shower air hangat untuk kenyamanan menginap Anda.'
        },
        'Deluxe': {
            harga: 550000,
            image: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80',
            desc: 'Kamar luas dengan jendela panorama pemandangan rimbun pinus, tempat tidur king-size, bathtub marmer mewah, dan mini bar pilihan.'
        },
        'Family Suite': {
            harga: 1200000,
            image: 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&q=80',
            desc: 'Suite luas untuk keluarga tercinta dengan 2 kamar tidur terpisah, ruang makan, mini pantry, balkon pemandangan alam, dan kapasitas 4-6 tamu.'
        },
        'Family': {
            harga: 1200000,
            image: 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&q=80',
            desc: 'Suite luas untuk keluarga tercinta dengan 2 kamar tidur terpisah, ruang makan, mini pantry, balkon pemandangan alam, dan kapasitas 4-6 tamu.'
        }
    };

    // 2. DOM Elements
    const namaEl            = document.getElementById('nama_pemesan');
    const namaJsErrorEl     = document.getElementById('namaJsError');
    const tipeKamarEl       = document.getElementById('tipe_kamar');
    const lokasiHotelEl     = document.getElementById('lokasi_hotel');
    const hargaDisplayEl    = document.getElementById('harga_kamar_display');
    const hargaHiddenEl     = document.getElementById('harga_kamar');
    const tanggalPesanEl    = document.getElementById('tanggal_pesan');
    const durasiEl          = document.getElementById('durasi_menginap');
    const breakfastEl       = document.getElementById('termasuk_breakfast');
    const nikEl             = document.getElementById('nomor_identitas');
    const nikJsErrorEl      = document.getElementById('nikJsError');
    const durasiJsErrorEl   = document.getElementById('durasiJsError');
    const btnHitung         = document.getElementById('btnHitungTotal');
    const btnSimpan         = document.getElementById('btnSimpanPemesanan');
    const calcBox           = document.getElementById('calcBox');

    // Sidebar Elements
    const previewRoomImg      = document.getElementById('previewRoomImg');
    const previewRoomBadge    = document.getElementById('previewRoomBadge');
    const previewHotelLocText = document.getElementById('previewHotelLocText');
    const previewRoomTitle    = document.getElementById('previewRoomTitle');
    const previewRoomDesc     = document.getElementById('previewRoomDesc');
    const previewCheckinDate  = document.getElementById('previewCheckinDate');
    const previewStayDuration = document.getElementById('previewStayDuration');
    const previewBreakfastStatus = document.getElementById('previewBreakfastStatus');
    const previewDiscountBadge = document.getElementById('previewDiscountBadge');
    const previewLivePrice    = document.getElementById('previewLivePrice');

    function formatRupiah(val) {
        return 'Rp ' + Number(val).toLocaleString('id-ID');
    }

    // 3. Dynamic Update saat Tipe Kamar Dipilih
    function updateRoomSelection() {
        const tipe = tipeKamarEl.value;
        const info = ROOM_DATA[tipe];

        if (info) {
            // Update Read-only inputs
            hargaDisplayEl.value = formatRupiah(info.harga);
            hargaHiddenEl.value  = info.harga;

            // Update Image & Content on Preview Sidebar
            previewRoomImg.style.opacity = '0.5';
            setTimeout(() => {
                previewRoomImg.src = info.image;
                previewRoomImg.style.opacity = '1';
            }, 150);

            previewRoomBadge.textContent = 'Kamar ' + tipe;
            previewRoomTitle.textContent = 'Kamar ' + tipe;
            previewRoomDesc.textContent  = info.desc;
        }

        resetCalculation();
    }

    // 4. Update Lokasi Hotel di Sidebar
    function updateLocationSelection() {
        previewHotelLocText.textContent = lokasiHotelEl.value;
    }

    // 5. Update Tanggal & Durasi & Breakfast di Sidebar
    function updateSidebarDetails() {
        // Tanggal
        if (tanggalPesanEl.value) {
            const dateObj = new Date(tanggalPesanEl.value);
            const opt = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            previewCheckinDate.textContent = 'Check-in: ' + dateObj.toLocaleDateString('id-ID', opt);
        }

        // Durasi
        const durasi = parseInt(durasiEl.value) || 1;
        previewStayDuration.textContent = durasi + ' Malam Menginap';
        if (durasi > 3) {
            previewDiscountBadge.style.display = 'flex';
        } else {
            previewDiscountBadge.style.display = 'none';
        }

        // Breakfast
        if (breakfastEl.checked) {
            previewBreakfastStatus.textContent = 'Termasuk Breakfast Buffet (+Rp 80rb/hari)';
        } else {
            previewBreakfastStatus.textContent = 'Tanpa Tambahan Breakfast';
        }

        resetCalculation();
    }

    function resetCalculation() {
        calcBox.classList.remove('is-active');
        btnSimpan.disabled = true;
        previewLivePrice.textContent = '-';
    }

    // 6a. Validasi Nama Pemesan (Wajib Huruf & Spasi, Tanpa Angka)
    function validateNama() {
        if (!namaEl) return true;
        const val = namaEl.value;
        // Jika ada angka, otomatis buang secara langsung
        if (/[0-9]/.test(val)) {
            namaEl.value = val.replace(/[0-9]/g, '');
            if (namaJsErrorEl) {
                namaJsErrorEl.style.display = 'flex';
            }
            namaEl.classList.add('is-invalid');
            return false;
        }

        const trimmed = namaEl.value.trim();
        const isValid = /^[a-zA-Z\s\'.\-]+$/.test(trimmed);

        if (trimmed.length > 0 && !isValid) {
            if (namaJsErrorEl) {
                namaJsErrorEl.style.display = 'flex';
            }
            namaEl.classList.add('is-invalid');
            return false;
        } else {
            if (namaJsErrorEl) {
                namaJsErrorEl.style.display = 'none';
            }
            namaEl.classList.remove('is-invalid');
            return trimmed.length > 0;
        }
    }

    // 6b. Validasi Ketat NIK (Wajib 16 Digit)
    function validateNik() {
        const val = nikEl.value.trim();
        // Hanya izinkan angka
        if (/[^\d]/.test(val)) {
            nikEl.value = val.replace(/[^\d]/g, '');
        }

        const isExact16 = /^\d{16}$/.test(nikEl.value);
        if (nikEl.value.length > 0 && !isExact16) {
            nikJsErrorEl.style.display = 'flex';
            nikEl.classList.add('is-invalid');
            return false;
        } else {
            nikJsErrorEl.style.display = 'none';
            nikEl.classList.remove('is-invalid');
            return isExact16;
        }
    }

    // 6b. Validasi Durasi (Wajib Angka / Syarat BNSP: "harus isi angka")
    function validateDurasi() {
        const raw = durasiEl.value.trim();
        if (raw === '' || isNaN(raw) || parseInt(raw) < 1) {
            durasiJsErrorEl.style.display = 'flex';
            durasiEl.classList.add('is-invalid');
            return false;
        } else {
            durasiJsErrorEl.style.display = 'none';
            durasiEl.classList.remove('is-invalid');
            return true;
        }
    }

    // 7. Kalkulasi Total Bayar (Rumus Syarat Sertifikasi)
    function executeCalculation() {
        const tipe = tipeKamarEl.value;
        const info = ROOM_DATA[tipe];

        // Validasi Nama
        if (!validateNama()) {
            if (namaJsErrorEl) namaJsErrorEl.style.display = 'flex';
            if (namaEl) {
                namaEl.classList.add('is-invalid');
                namaEl.focus();
            }
            return;
        }

        // Validasi NIK
        if (!validateNik()) {
            nikJsErrorEl.style.display = 'flex';
            nikEl.classList.add('is-invalid');
            nikEl.focus();
            return;
        }

        // Validasi Durasi (Syarat BNSP)
        if (!validateDurasi()) {
            durasiJsErrorEl.style.display = 'flex';
            durasiEl.classList.add('is-invalid');
            durasiEl.focus();
            return;
        }

        const durasi = parseInt(durasiEl.value) || 0;

        if (!info) {
            alert('Silakan pilih tipe kamar terlebih dahulu.');
            tipeKamarEl.focus();
            return;
        }

        const hargaKamar       = info.harga;
        const subtotal         = hargaKamar * durasi;
        const diskon           = (durasi > 3) ? (subtotal * 0.10) : 0;
        const biayaBreakfast   = breakfastEl.checked ? (80000 * durasi) : 0;
        const totalBayar       = subtotal - diskon + biayaBreakfast;

        // Tampilkan ke Box Breakdown
        document.getElementById('resHargaKamar').textContent = formatRupiah(hargaKamar);
        document.getElementById('resDurasi').textContent     = durasi + ' Hari';
        document.getElementById('resSubtotal').textContent   = formatRupiah(subtotal);

        const resDiskonRow = document.getElementById('resDiskonRow');
        if (diskon > 0) {
            document.getElementById('resDiskon').textContent = '- ' + formatRupiah(diskon);
            resDiskonRow.style.display = 'flex';
        } else {
            resDiskonRow.style.display = 'none';
        }

        const resBreakfastRow = document.getElementById('resBreakfastRow');
        if (biayaBreakfast > 0) {
            document.getElementById('resBreakfast').textContent = formatRupiah(biayaBreakfast);
            resBreakfastRow.style.display = 'flex';
        } else {
            resBreakfastRow.style.display = 'none';
        }

        document.getElementById('resTotalBayar').textContent = formatRupiah(totalBayar);
        calcBox.classList.add('is-active');

        // Update preview sidebar price
        previewLivePrice.textContent = formatRupiah(totalBayar);

        // Aktifkan tombol Simpan
        btnSimpan.disabled = false;
        btnSimpan.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // 8. Event Listeners
    if (namaEl) {
        namaEl.addEventListener('input', validateNama);
        namaEl.addEventListener('keydown', (e) => {
            // Blokir tombol angka 0-9 langsung saat ditekan
            if ((e.key >= '0' && e.key <= '9') && !e.ctrlKey && !e.altKey && !e.metaKey) {
                e.preventDefault();
                if (namaJsErrorEl) {
                    namaJsErrorEl.style.display = 'flex';
                }
                namaEl.classList.add('is-invalid');
            }
        });
    }

    tipeKamarEl.addEventListener('change', updateRoomSelection);
    lokasiHotelEl.addEventListener('change', updateLocationSelection);
    tanggalPesanEl.addEventListener('change', updateSidebarDetails);
    durasiEl.addEventListener('input', () => {
        validateDurasi();
        updateSidebarDetails();
    });
    breakfastEl.addEventListener('change', updateSidebarDetails);
    nikEl.addEventListener('input', validateNik);
    btnHitung.addEventListener('click', executeCalculation);

    // Initial setup on page load
    updateRoomSelection();
    updateLocationSelection();
    updateSidebarDetails();

    // Re-enable if old form was submitted with errors
    @if(old('tipe_kamar'))
        executeCalculation();
    @endif
})();
</script>
@endpush
