@extends('layouts.app')

@section('title', 'Riwayat &amp; Bukti Reservasi')

@push('styles')
<style>
    /* ============================================================
       BOOKING HISTORY & INVOICE CARDS
       ============================================================ */
    .riwayat-hero {
        padding: 40px 0 50px;
        background: #FFFFFF;
        text-align: center;
    }

    .riwayat-topbar-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-base);
    }

    .riwayat-counter {
        font-size: 0.9375rem;
        color: var(--text-muted);
    }

    .riwayat-counter strong {
        color: var(--text-heading);
    }

    /* Empty state */
    .empty-state-luxury {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        padding: 80px 32px;
        text-align: center;
        box-shadow: var(--shadow-soft);
        max-width: 580px;
        margin: 0 auto;
    }

    .empty-icon-circle {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: var(--bg-subtle);
        border: 1px solid var(--border-base);
        color: var(--text-faint);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .empty-icon-circle svg { width: 32px; height: 32px; }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-heading);
        margin-bottom: 8px;
    }

    .empty-desc {
        font-size: 0.9375rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 24px;
    }

    /* Booking List */
    .bookings-stack {
        display: flex;
        flex-direction: column;
        gap: 28px;
        margin-bottom: 90px;
    }

    .booking-summary-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .booking-summary-card:hover {
        border-color: var(--border-dark);
        box-shadow: var(--shadow-float);
    }

    .booking-card-topbar {
        padding: 20px 28px;
        background: #FFFFFF;
        border-bottom: 1px solid var(--border-base);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .booking-code-chip {
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-faint);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .booking-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        background: var(--text-heading);
        color: #FFFFFF;
        letter-spacing: 0.04em;
    }

    .booking-type-badge svg { width: 13px; height: 13px; }

    .booking-card-main {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 32px;
        padding: 28px;
    }

    .booking-room-thumb-box {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border-base);
        aspect-ratio: 4/3;
        background: var(--bg-subtle);
    }

    .booking-room-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .booking-grid-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 28px;
    }

    .b-cell-label {
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-faint);
        margin-bottom: 4px;
    }

    .b-cell-val {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
    }

    .b-cell-val.mono {
        font-family: 'Courier New', monospace;
        letter-spacing: 0.04em;
    }

    /* Booking Card Bottom / Financial Breakdown */
    .booking-card-financials {
        padding: 20px 28px;
        background: var(--bg-subtle);
        border-top: 1px solid var(--border-base);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .fin-numbers-group {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .fin-item {
        display: flex;
        flex-direction: column;
    }

    .fin-lbl {
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-faint);
    }

    .fin-val {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
    }

    .fin-val.green {
        color: #16A34A;
    }

    .fin-total-val {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
    }

    .booking-actions-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-delete-plain {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: var(--radius-full);
        border: 1px solid #FECACA;
        background: #FEF2F2;
        color: #B91C1C;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-delete-plain:hover {
        background: #FEE2E2;
        border-color: #F87171;
    }

    .btn-delete-plain svg { width: 14px; height: 14px; }

    /* Print View Customization */
    @media print {
        .navbar-floating-container, .site-footer, .booking-actions-group, .btn-luxury {
            display: none !important;
        }
        .site-content { padding-top: 0 !important; }
        .booking-summary-card { page-break-inside: avoid; border: 1px solid #ccc !important; box-shadow: none !important; }
    }

    @media (max-width: 900px) {
        .booking-card-main { grid-template-columns: 1fr; }
        .booking-grid-info { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .booking-grid-info { grid-template-columns: 1fr; }
        .booking-card-financials { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

{{-- ================================================================
     HERO: RIWAYAT PEMESANAN
     ================================================================ --}}
<section class="riwayat-hero">
    <div class="container">
        <div data-aos="fade-up">
            <h1 class="section-heading">Riwayat &amp; Bukti Reservasi Kamar</h1>
            <p class="section-subheading" style="margin: 10px auto 0;">
                Seluruh data pemesanan kamar yang telah terkonfirmasi dan tersimpan aman di basis data hotel.
            </p>
        </div>
    </div>
</section>

{{-- ================================================================
     LIST PEMESANAN
     ================================================================ --}}
<section style="background: #FFFFFF;">
    <div class="container">

        <div class="riwayat-topbar-flex" data-aos="fade-up">
            <div class="riwayat-counter">
                Menampilkan <strong>{{ $riwayat->count() }}</strong> data reservasi terdaftar
            </div>
            <div style="display:flex; gap:10px;">
                <a href="{{ route('pesan') }}" class="btn-luxury btn-luxury-primary btn-luxury-sm">
                    <i data-lucide="calendar-plus"></i>
                    Pesan Kamar Baru
                </a>
            </div>
        </div>

        @if($riwayat->isEmpty())
            <div class="empty-state-luxury" data-aos="fade-up">
                <div class="empty-icon-circle">
                    <i data-lucide="inbox"></i>
                </div>
                <h3 class="empty-title">Belum Ada Data Pemesanan</h3>
                <p class="empty-desc">
                    Saat ini belum terdapat reservasi yang tercatat dalam sistem. Silakan lakukan pemesanan
                    kamar hotel pertama Anda melalui formulir resmi.
                </p>
                <a href="{{ route('pesan') }}" class="btn-luxury btn-luxury-primary">
                    <i data-lucide="calendar-plus"></i>
                    Buat Reservasi Pertama
                </a>
            </div>
        @else
            <div class="bookings-stack">
                @foreach($riwayat as $item)
                @php
                    $roomImages = [
                        'Standar'      => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                        'Deluxe'       => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&q=80',
                        'Family Suite' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600&q=80',
                        'Family'       => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600&q=80',
                        'Executive'    => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80',
                    ];
                    $imgUrl = $roomImages[$item->tipe_kamar] ?? $roomImages['Standar'];
                @endphp

                <div class="booking-summary-card" data-aos="fade-up">
                    {{-- Topbar --}}
                    <div class="booking-card-topbar">
                        <div class="booking-code-chip">
                            <i data-lucide="receipt"></i>
                            INVOICE-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }} &bull; {{ $item->created_at->format('d M Y, H:i') }} WIB
                        </div>

                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                            <span class="booking-type-badge">
                                <i data-lucide="bed"></i>
                                Kamar {{ $item->tipe_kamar }}
                            </span>
                            @if($item->termasuk_breakfast)
                            <span style="font-size:0.75rem; font-weight:700; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:4px 10px; border-radius:var(--radius-full); display:inline-flex; align-items:center; gap:4px;">
                                <i data-lucide="utensils" style="width:12px; height:12px;"></i> Termasuk Breakfast
                            </span>
                            @endif
                            @if($item->diskon > 0)
                            <span style="font-size:0.75rem; font-weight:700; background:#EFF6FF; border:1px solid #BFDBFE; color:#1D4ED8; padding:4px 10px; border-radius:var(--radius-full); display:inline-flex; align-items:center; gap:4px;">
                                <i data-lucide="percent" style="width:12px; height:12px;"></i> Diskon 10%
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Main Content Grid --}}
                    <div class="booking-card-main">
                        <div class="booking-room-thumb-box">
                            <img src="{{ $imgUrl }}" alt="Kamar {{ $item->tipe_kamar }}" loading="lazy">
                        </div>

                        <div class="booking-grid-info">
                            <div>
                                <div class="b-cell-label">Nama Pemesan</div>
                                <div class="b-cell-val">{{ $item->nama_pemesan }}</div>
                            </div>

                            <div>
                                <div class="b-cell-label">Jenis Kelamin</div>
                                <div class="b-cell-val">{{ $item->jenis_kelamin }}</div>
                            </div>

                            <div>
                                <div class="b-cell-label">Nomor Identitas (16 Digit)</div>
                                <div class="b-cell-val mono">{{ $item->nomor_identitas }}</div>
                            </div>

                            <div>
                                <div class="b-cell-label">Lokasi Hotel Tujuan</div>
                                <div class="b-cell-val">{{ $item->lokasi_hotel }}</div>
                            </div>

                            <div>
                                <div class="b-cell-label">Tanggal Check-In</div>
                                <div class="b-cell-val">{{ $item->tanggal_pesan->format('d/m/Y') }}</div>
                            </div>

                            <div>
                                <div class="b-cell-label">Durasi Menginap</div>
                                <div class="b-cell-val">{{ $item->durasi_menginap }} Hari (Malam)</div>
                            </div>
                        </div>
                    </div>

                    {{-- Financial Breakdown Bar --}}
                    <div class="booking-card-financials">
                        <div class="fin-numbers-group">
                            <div class="fin-item">
                                <span class="fin-lbl">Harga per Malam</span>
                                <span class="fin-val">Rp {{ number_format($item->harga_kamar, 0, ',', '.') }}</span>
                            </div>

                            <div class="fin-item">
                                <span class="fin-lbl">Subtotal Kamar</span>
                                <span class="fin-val">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>

                            @if($item->diskon > 0)
                            <div class="fin-item">
                                <span class="fin-lbl">Potongan Diskon (10%)</span>
                                <span class="fin-val green">- Rp {{ number_format($item->diskon, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            @if($item->biaya_breakfast > 0)
                            <div class="fin-item">
                                <span class="fin-lbl">Tambahan Breakfast</span>
                                <span class="fin-val">Rp {{ number_format($item->biaya_breakfast, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <div class="fin-item" style="border-left: 1.5px solid var(--border-base); padding-left: 20px;">
                                <span class="fin-lbl">Total Pembayaran</span>
                                <span class="fin-total-val">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="booking-actions-group">
                            <a href="{{ route('pesan.invoice', $item->id) }}" class="btn-invoice-link" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:var(--radius-full); border:1px solid var(--forest-800); background:#FFFFFF; color:var(--forest-800); font-size:0.8125rem; font-weight:700; text-decoration:none; transition:all 0.2s;">
                                <i data-lucide="receipt" style="width:14px; height:14px;"></i>
                                Cetak Invoice
                            </a>
                            <form method="POST" action="{{ route('riwayat.hapus', $item->id) }}"
                                onsubmit="return confirm('Hapus data reservasi atas nama {{ $item->nama_pemesan }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-plain">
                                    <i data-lucide="trash-2"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>{{-- /booking-summary-card --}}
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection
