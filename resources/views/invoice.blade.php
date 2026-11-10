@extends('layouts.app')

@section('title', 'Bukti Reservasi & Invoice Resmi &mdash; Lumina Pasific')

@push('styles')
<style>
    .invoice-section {
        padding: 40px 0 80px;
        background: #FFFFFF;
    }

    .invoice-card {
        max-width: 820px;
        margin: 0 auto;
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        overflow: hidden;
        box-shadow: 0 16px 40px -10px rgba(15, 23, 42, 0.08);
    }

    .invoice-header-bar {
        background: var(--forest-900);
        color: #FFFFFF;
        padding: 32px 36px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .invoice-brand-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        margin-bottom: 4px;
    }

    .invoice-brand-sub {
        font-size: 0.72rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--forest-accent);
        font-weight: 700;
    }

    .invoice-status-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #FFFFFF;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: var(--radius-full);
    }

    .invoice-body-pad {
        padding: 36px 36px;
    }

    .invoice-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 24px;
        margin-bottom: 28px;
        border-bottom: 1px solid var(--border-base);
        flex-wrap: wrap;
        gap: 16px;
    }

    .invoice-number-box {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: -0.02em;
    }

    .invoice-date-val {
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .invoice-details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .invoice-info-block {
        background: #F8FAF9;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        padding: 22px 24px;
    }

    .invoice-block-title {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--forest-800);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .invoice-field-pair {
        margin-bottom: 10px;
    }

    .invoice-field-pair:last-child {
        margin-bottom: 0;
    }

    .invoice-field-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 2px;
    }

    .invoice-field-value {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
    }

    .invoice-table-box {
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        overflow: hidden;
        margin-bottom: 32px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table th {
        background: #F8FAF9;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid var(--border-base);
    }

    .invoice-table td {
        padding: 16px 20px;
        font-size: 0.875rem;
        border-bottom: 1px solid var(--border-base);
        color: var(--text-heading);
    }

    .invoice-table tr:last-child td {
        border-bottom: none;
    }

    .invoice-total-row {
        background: #FAFDFB;
        font-weight: 800;
    }

    .invoice-total-amount {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: -0.02em;
    }

    .invoice-footer-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 24px;
        border-top: 1px solid var(--border-base);
        flex-wrap: wrap;
        gap: 14px;
    }

    @media (max-width: 680px) {
        .invoice-details-grid {
            grid-template-columns: 1fr;
        }
        .invoice-header-bar,
        .invoice-body-pad {
            padding: 24px 20px;
        }
    }

    /* ============================================================
       PRINT-READY OFFICIAL HOTEL INVOICE STYLING
       ============================================================ */
    .print-only-block {
        display: none;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 12mm 15mm 15mm 15mm;
        }

        body {
            background: #FFFFFF !important;
            color: #0F172A !important;
            font-size: 11pt !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        header.site-header,
        footer.site-footer,
        .invoice-footer-actions,
        .btn-scroll-top,
        .back-to-top {
            display: none !important;
        }

        .site-content {
            padding-top: 0 !important;
        }

        .invoice-section {
            padding: 0 !important;
            background: #FFFFFF !important;
        }

        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .invoice-card {
            border: 1.5px solid #0F172A !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            max-width: 100% !important;
            margin: 0 !important;
            page-break-inside: avoid;
        }

        .invoice-header-bar {
            background: #1B382B !important;
            color: #FFFFFF !important;
            padding: 22px 26px !important;
            border-bottom: 2px solid #0F172A !important;
        }

        .invoice-brand-title {
            color: #FFFFFF !important;
            font-size: 1.5rem !important;
        }

        .invoice-brand-sub {
            color: #D1FAE5 !important;
        }

        .invoice-status-chip {
            background: rgba(255, 255, 255, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            color: #FFFFFF !important;
        }

        .invoice-body-pad {
            padding: 22px 26px !important;
        }

        .invoice-details-grid {
            gap: 16px !important;
            margin-bottom: 20px !important;
        }

        .invoice-info-block {
            background: #F8FAF9 !important;
            border: 1px solid #CBD5E1 !important;
            padding: 14px 16px !important;
            border-radius: 6px !important;
        }

        .invoice-table-box {
            border: 1px solid #CBD5E1 !important;
            border-radius: 6px !important;
            margin-bottom: 20px !important;
        }

        .invoice-table th {
            background: #F1F5F9 !important;
            color: #0F172A !important;
            border-bottom: 1.5px solid #94A3B8 !important;
            padding: 10px 14px !important;
        }

        .invoice-table td {
            border-bottom: 1px solid #E2E8F0 !important;
            padding: 12px 14px !important;
        }

        .invoice-total-row {
            background: #F8FAF9 !important;
            border-top: 2px solid #0F172A !important;
        }

        .invoice-total-amount {
            color: #1B382B !important;
            font-size: 1.25rem !important;
        }

        .print-only-block {
            display: block !important;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .print-signatures-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px dashed #CBD5E1;
        }

        .print-sig-col {
            text-align: center;
        }

        .print-sig-title {
            font-size: 8.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
            margin-bottom: 45px;
        }

        .print-sig-line {
            border-top: 1px solid #0F172A;
            width: 75%;
            margin: 0 auto 4px;
        }

        .print-sig-name {
            font-size: 9pt;
            font-weight: 700;
            color: #0F172A;
        }

        .print-sig-sub {
            font-size: 7.5pt;
            color: #64748B;
        }

        .print-notice-box {
            background: #F8FAF9;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 7.5pt;
            color: #475569;
            line-height: 1.5;
            margin-top: 12px;
        }
    }
</style>
@endpush

@section('content')
<section class="invoice-section">
    <div class="container">

        <div class="invoice-card" data-aos="fade-up">
            {{-- Header Bar --}}
            <div class="invoice-header-bar">
                <div>
                    <div class="invoice-brand-title">Lumina Pasific</div>
                    <div class="invoice-brand-sub">Luxury Nature Retreat &bull; Bukti Reservasi Resmi</div>
                </div>
                <div class="invoice-status-chip">
                    <i data-lucide="check-circle-2"></i>
                    Reservasi Terkonfirmasi
                </div>
            </div>

            {{-- Body --}}
            <div class="invoice-body-pad">

                {{-- Meta row --}}
                <div class="invoice-meta-row">
                    <div>
                        <div class="invoice-field-label">Nomor Invoice Resmi</div>
                        <div class="invoice-number-box">INV-{{ str_pad($pesanan->id, 5, '0', STR_PAD_LEFT) }}</div>
                        <div class="invoice-date-val">Diterbitkan pada {{ $pesanan->created_at->format('d M Y, H:i') }} WIB</div>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-size: 0.75rem; color: var(--text-faint); font-weight: 600;">Metode Pemesanan:</span>
                        <div style="font-size: 0.875rem; font-weight: 700; color: var(--forest-800);">Online Direct Booking</div>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="invoice-details-grid">
                    {{-- Guest Info --}}
                    <div class="invoice-info-block">
                        <div class="invoice-block-title">
                            <i data-lucide="user-check"></i>
                            Informasi Tamu Pemesan
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Nama Lengkap</div>
                            <div class="invoice-field-value">{{ $pesanan->nama_pemesan }}</div>
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Nomor Identitas (16 Digit KTP)</div>
                            <div class="invoice-field-value mono">{{ $pesanan->nomor_identitas }}</div>
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Jenis Kelamin</div>
                            <div class="invoice-field-value">{{ $pesanan->jenis_kelamin }}</div>
                        </div>
                    </div>

                    {{-- Stay Info --}}
                    <div class="invoice-info-block">
                        <div class="invoice-block-title">
                            <i data-lucide="bed-double"></i>
                            Rincian Akomodasi &amp; Inap
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Tipe Kamar</div>
                            <div class="invoice-field-value">Kamar {{ $pesanan->tipe_kamar }}</div>
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Lokasi Hotel Tujuan</div>
                            <div class="invoice-field-value">{{ $pesanan->lokasi_hotel }}</div>
                        </div>
                        <div class="invoice-field-pair">
                            <div class="invoice-field-label">Jadwal Check-In &amp; Durasi</div>
                            <div class="invoice-field-value">
                                {{ $pesanan->tanggal_pesan->format('d M Y') }} &bull; {{ $pesanan->durasi_menginap }} Malam
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Financials Table --}}
                <div class="invoice-table-box">
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>Deskripsi Item</th>
                                <th style="text-align: center;">Jumlah / Durasi</th>
                                <th style="text-align: right;">Tarif Satuan</th>
                                <th style="text-align: right;">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Sewa Kamar {{ $pesanan->tipe_kamar }}</strong>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        Standar bintang 5 &bull; Fasilitas lengkap &bull; Check-in {{ $pesanan->tanggal_pesan->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td style="text-align: center;">{{ $pesanan->durasi_menginap }} Malam</td>
                                <td style="text-align: right;">Rp {{ number_format($pesanan->harga_kamar, 0, ',', '.') }}</td>
                                <td style="text-align: right; font-weight: 700;">Rp {{ number_format($pesanan->subtotal, 0, ',', '.') }}</td>
                            </tr>

                            @if($pesanan->diskon > 0)
                            <tr>
                                <td>
                                    <span style="color: #166534; font-weight: 700;">Potongan Diskon Otomatis (10%)</span>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        Apresiasi menginap jangka panjang (> 3 hari)
                                    </div>
                                </td>
                                <td style="text-align: center;">10%</td>
                                <td style="text-align: right;">-</td>
                                <td style="text-align: right; font-weight: 700; color: #166534;">
                                    - Rp {{ number_format($pesanan->diskon, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endif

                            @if($pesanan->biaya_breakfast > 0)
                            <tr>
                                <td>
                                    <strong>Layanan Sarapan Buffet Organik</strong>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        Menu prasmanan khas The Artisan Kitchen
                                    </div>
                                </td>
                                <td style="text-align: center;">{{ $pesanan->durasi_menginap }} Hari</td>
                                <td style="text-align: right;">Rp 80.000</td>
                                <td style="text-align: right; font-weight: 700;">
                                    Rp {{ number_format($pesanan->biaya_breakfast, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endif

                            <tr class="invoice-total-row">
                                <td colspan="3" style="text-align: right; font-size: 0.9375rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Total Akhir Pembayaran:
                                </td>
                                <td style="text-align: right;">
                                    <span class="invoice-total-amount">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Print Only: Official Signatures & Verification --}}
                <div class="print-only-block">
                    <div class="print-notice-box">
                        <strong>Ketentuan &amp; Tata Tertib Resor:</strong>
                        Harap membawa dan menunjukkan bukti cetak invoice resmi ini beserta kartu identitas asli (KTP/Paspor) saat proses pendaftaran di meja resepsionis (Front Office). Waktu check-in resmi dimulai pukul 14:00 WIB dan check-out maksimal pukul 12:00 WIB.
                    </div>

                    <div class="print-signatures-wrap">
                        <div class="print-sig-col">
                            <div class="print-sig-title">Petugas Resepsionis / Front Office</div>
                            <div class="print-sig-line"></div>
                            <div class="print-sig-name">Lumina Pasific Front Desk</div>
                            <div class="print-sig-sub">Verifikasi Sistem &bull; {{ now()->format('d M Y') }}</div>
                        </div>

                        <div class="print-sig-col">
                            <div class="print-sig-title">Tamu Pemesan (Guest)</div>
                            <div class="print-sig-line"></div>
                            <div class="print-sig-name">{{ $pesanan->nama_pemesan }}</div>
                            <div class="print-sig-sub">NIK: {{ $pesanan->nomor_identitas }}</div>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="invoice-footer-actions">
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <a href="{{ route('home') }}" class="btn-forest-ghost" style="padding: 10px 18px; font-weight: 600;">
                            <i data-lucide="home"></i>
                            Beranda
                        </a>
                        <a href="{{ route('riwayat') }}" class="btn-forest-ghost" style="padding: 10px 18px; font-weight: 600;">
                            <i data-lucide="clock"></i>
                            Semua Riwayat
                        </a>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <button type="button" class="btn-forest-secondary" onclick="window.print()" style="padding: 11px 22px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                            <i data-lucide="printer"></i>
                            Cetak Bukti Invoice
                        </button>
                        <a href="{{ route('pesan') }}" class="btn-forest-primary" style="padding: 11px 22px; font-weight: 700;">
                            <i data-lucide="calendar-plus"></i>
                            Pesan Kamar Baru
                        </a>
                    </div>
                </div>

            </div>{{-- /invoice-body-pad --}}
        </div>{{-- /invoice-card --}}

    </div>
</section>
@endsection
