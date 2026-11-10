@extends('layouts.app')

@section('title', 'Koleksi Kamar &amp; Pilihan Tarif &mdash; Lumina Pasific')

@push('styles')
<style>
    /* ============================================================
       PRICING SHOWCASE — Luxury Tier Grid & Interactive Detail Modal
       Strictly Aligned Buttons & Clean Monochromatic Minimalist Style
       ============================================================ */
    .pricing-hero {
        padding: 24px 0 32px;
        background: #FFFFFF;
        text-align: center;
    }

    .pricing-hero-inner {
        max-width: 760px;
        margin: 0 auto;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 24px;
        margin-bottom: 50px;
        align-items: stretch;
    }

    .pricing-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: var(--shadow-subtle);
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        position: relative;
        cursor: pointer;
    }

    .pricing-card:hover {
        transform: translateY(-2px);
        border-color: var(--forest-border);
        box-shadow: var(--shadow-soft);
    }

    .pricing-card.featured {
        border-color: var(--forest-800);
        box-shadow: 0 8px 30px rgba(27, 56, 43, 0.12);
    }

    .pricing-ribbon {
        position: absolute;
        top: 14px;
        right: 14px;
        background: var(--forest-800);
        color: #FFFFFF;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        z-index: 2;
    }

    .pricing-card-img-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: var(--bg-subtle);
    }

    .pricing-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .pricing-card:hover .pricing-card-img {
        transform: scale(1.04);
    }

    .pricing-card-body {
        padding: 18px 20px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .pricing-room-type {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-faint);
        margin-bottom: 3px;
    }

    .pricing-card-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--forest-900);
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }

    .price-block {
        margin-bottom: 14px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-base);
    }

    .price-main {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: -0.03em;
        line-height: 1.1;
    }

    .price-main small {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text-faint);
    }

    .discount-calc-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        font-weight: 700;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #166534;
        border-radius: var(--radius-full);
        padding: 3px 9px;
        margin-top: 6px;
    }

    .discount-calc-badge svg { width: 12px; height: 12px; }

    .pricing-specs-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 18px;
        min-height: 104px;
        flex-grow: 1; /* Pushes card-footer-btns strictly to bottom */
    }

    .pricing-spec-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.8125rem;
        color: var(--text-muted);
    }

    .pricing-spec-item svg {
        width: 15px;
        height: 15px;
        color: var(--forest-800);
        flex-shrink: 0;
    }

    /* Card Footer Buttons — Strictly docked to bottom */
    .card-footer-btns {
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 100%;
    }

    .btn-card-expand {
        background: var(--bg-subtle);
        border: 1px solid var(--border-base);
        color: var(--text-heading);
        font-size: 0.8125rem;
        font-weight: 600;
        padding: 9px 14px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
    }

    .btn-card-expand:hover {
        background: var(--forest-subtle);
        border-color: var(--forest-border);
        color: var(--forest-800);
    }

    .btn-card-expand svg { width: 14px; height: 14px; }

    .btn-card-book {
        background: var(--forest-800);
        color: #FFFFFF;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 10px 14px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        box-shadow: none;
    }

    .btn-card-book:hover {
        background: var(--forest-hover);
        color: #FFFFFF;
        transform: translateY(-1px);
        box-shadow: none;
    }

    .btn-card-book svg { width: 14px; height: 14px; }

    /* ============================================================
       SECTION: JAMINAN & STANDAR INKLUSIF MENGINAP (CLEAN & ELEGANT)
       ============================================================ */
    .section-inclusions {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        padding: 48px 44px;
        margin-bottom: 60px;
        box-shadow: none;
    }

    .inclusions-header-wrap {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .inclusions-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .inclusion-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        padding: 24px 22px;
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
    }

    .inclusion-card:hover {
        transform: translateY(-2px);
        border-color: var(--forest-accent);
        box-shadow: none;
    }

    .inclusion-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--forest-800);
        margin-bottom: 16px;
    }

    .inclusion-icon-badge svg {
        width: 20px;
        height: 20px;
    }

    .inclusion-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.015em;
        margin-bottom: 8px;
        line-height: 1.35;
    }

    .inclusion-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin: 0;
    }

    .inclusions-trust-strip {
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding-top: 24px;
        border-top: 1px solid var(--forest-border);
        flex-wrap: wrap;
        gap: 16px;
    }

    .trust-strip-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--forest-800);
    }

    .trust-strip-item svg {
        width: 16px;
        height: 16px;
        color: var(--forest-accent);
    }

    @media (max-width: 992px) {
        .inclusions-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .section-inclusions {
            padding: 32px 20px;
        }
        .inclusions-grid {
            grid-template-columns: 1fr;
        }
        .inclusions-trust-strip {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* ============================================================
       KEUNTUNGAN TAMBAHAN (CLEAN & ELEGANT)
       ============================================================ */
    .comparison-perks-box {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        padding: 44px 40px;
        margin-bottom: 70px;
        box-shadow: var(--shadow-subtle);
    }

    .perks-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        margin-top: 28px;
    }

    .perk-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .perk-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--forest-800);
        flex-shrink: 0;
    }

    .perk-icon svg { width: 20px; height: 20px; }

    .perk-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 6px;
    }

    .perk-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* ============================================================
       MODAL DETAIL RINCIAN KAMAR (BLURRED BACKDROP POPUP)
       ============================================================ */
    .room-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .room-modal-backdrop.is-open {
        opacity: 1;
        pointer-events: auto;
    }

    .room-modal-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        max-width: 960px;
        width: 100%;
        height: min(580px, calc(100vh - 36px));
        max-height: calc(100vh - 36px);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.3);
        transform: scale(0.95) translateY(12px);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    .room-modal-backdrop.is-open .room-modal-card {
        transform: scale(1) translateY(0);
    }

    .modal-photo-col {
        position: relative;
        background: #142B21;
        overflow: hidden;
        height: 100%;
    }

    .modal-photo-col::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(18, 38, 28, 0.45) 0%,
            rgba(18, 38, 28, 0.1) 40%,
            rgba(18, 38, 28, 0.6) 100%
        );
        z-index: 2;
        pointer-events: none;
    }

    .modal-photo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .modal-photo-badges {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        z-index: 5;
    }

    .modal-badge-item {
        background: rgba(18, 38, 28, 0.88);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #FFFFFF;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .modal-detail-col {
        height: 100%;
        max-height: 100%;
        min-height: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        position: relative;
        background: #FFFFFF;
    }

    .modal-detail-scroll-area {
        flex: 1 1 auto;
        overflow-y: auto;
        min-height: 0;
        padding: 24px 28px 12px;
    }

    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        color: var(--text-heading);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 10;
        box-shadow: var(--shadow-subtle);
    }

    .modal-close-btn:hover {
        background: var(--forest-800);
        color: #FFFFFF;
        border-color: var(--forest-800);
        transform: rotate(90deg);
    }

    .modal-close-btn svg { width: 16px; height: 16px; }

    .modal-cat-switch-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 16px;
        flex-wrap: wrap;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-base);
    }

    .modal-cat-tab-btn {
        background: var(--bg-subtle);
        border: 1px solid var(--border-base);
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .modal-cat-tab-btn:hover {
        background: var(--forest-subtle);
        color: var(--forest-800);
    }

    .modal-cat-tab-btn.is-active {
        background: var(--forest-800);
        color: #FFFFFF;
        border-color: var(--forest-800);
    }

    .modal-room-eyebrow {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--forest-accent);
        margin-bottom: 3px;
    }

    .modal-room-name {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--forest-900);
        letter-spacing: -0.02em;
        margin-bottom: 6px;
    }

    .modal-room-lead {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .modal-specs-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 14px;
        padding: 10px 14px;
        background: var(--bg-subtle);
        border: 1px solid var(--border-base);
        border-radius: var(--radius-md);
    }

    .modal-spec-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.75rem;
        color: var(--text-heading);
        font-weight: 600;
    }

    .modal-spec-cell svg {
        width: 14px;
        height: 14px;
        color: var(--forest-800);
        flex-shrink: 0;
    }

    .modal-feature-checklist {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
    }

    .modal-chk-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.78rem;
        color: var(--text-body);
    }

    .modal-chk-item svg {
        width: 14px;
        height: 14px;
        color: #16A34A;
        flex-shrink: 0;
    }

    /* Modal Bottom Actions Stationary / Fixed to Bottom */
    .modal-booking-actions {
        flex-shrink: 0;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
        padding: 12px 28px 16px;
        z-index: 10;
        box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.04);
    }

    .modal-primary-actions-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .modal-price-sub {
        font-size: 0.6875rem;
        text-transform: uppercase;
        color: var(--text-faint);
        font-weight: 700;
        letter-spacing: 0.05em;
    }

    .modal-price-value {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: -0.02em;
    }

    .modal-btn-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    @media (max-width: 1200px) {
        .pricing-grid { grid-template-columns: repeat(2, 1fr); }
        .experiences-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 860px) {
        .room-modal-card {
            grid-template-columns: 1fr;
            height: auto;
            max-height: 90vh;
        }
        .modal-photo-col { min-height: 200px; height: 200px; }
        .modal-detail-scroll-area { padding: 18px 20px 10px; }
        .modal-booking-actions { padding: 10px 20px 14px; }
        .perks-grid { grid-template-columns: 1fr; }
        .experiences-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .pricing-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- ================================================================
     PRICING HERO & OVERVIEW
     ================================================================ --}}
<section class="pricing-hero">
    <div class="container">
        <div class="pricing-hero-inner" data-aos="fade-up">
            <h1 class="section-heading" style="margin-bottom: 0;">Koleksi Kamar &amp; Pilihan Tarif</h1>
        </div>

        {{-- ============================================================
             PRICING TIER GRID (4 COLUMNS - STRICTLY ALIGNED BUTTONS)
             ============================================================ --}}
        <div class="pricing-grid">

            {{-- 1. Kamar Standar --}}
            <div class="pricing-card" data-room-key="Standar" data-aos="fade-up" data-aos-delay="100">
                <div class="pricing-card-img-wrap">
                    <img class="pricing-card-img"
                        src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80"
                        alt="Kamar Standar Lumina Pasific"
                        loading="lazy">
                </div>
                <div class="pricing-card-body">
                    <div class="pricing-room-type">Kategori Nyaman</div>
                    <h3 class="pricing-card-title">Kamar Standar</h3>

                    <div class="price-block">
                        <div class="price-main">
                            Rp 350.000 <small>/malam</small>
                        </div>
                        <div class="discount-calc-badge">
                            <i data-lucide="percent"></i>
                            Inap &gt;3 Hari: <strong>Rp 315.000</strong>
                        </div>
                    </div>

                    <ul class="pricing-specs-list">
                        <li class="pricing-spec-item"><i data-lucide="users"></i> Kapasitas 2 Orang Tamu</li>
                        <li class="pricing-spec-item"><i data-lucide="maximize"></i> 32 m² Luas Ruangan</li>
                        <li class="pricing-spec-item"><i data-lucide="bed"></i> Queen-size Bed Nyaman</li>
                        <li class="pricing-spec-item"><i data-lucide="wifi"></i> WiFi Kecepatan Tinggi</li>
                    </ul>

                    <div class="card-footer-btns">
                        <button type="button" class="btn-card-expand">
                            <i data-lucide="maximize-2"></i>
                            Rincian Detail Kamar
                        </button>
                        <a href="{{ route('pesan', ['tipe' => 'Standar']) }}" class="btn-card-book">
                            <i data-lucide="calendar-check"></i>
                            Reservasi Standar
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. Kamar Deluxe (Featured) --}}
            <div class="pricing-card featured" data-room-key="Deluxe" data-aos="fade-up" data-aos-delay="200">
                <span class="pricing-ribbon">Terpopuler</span>
                <div class="pricing-card-img-wrap">
                    <img class="pricing-card-img"
                        src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80"
                        alt="Kamar Deluxe Lumina Pasific"
                        loading="lazy">
                </div>
                <div class="pricing-card-body">
                    <div class="pricing-room-type">Paling Diminati</div>
                    <h3 class="pricing-card-title">Kamar Deluxe</h3>

                    <div class="price-block">
                        <div class="price-main">
                            Rp 550.000 <small>/malam</small>
                        </div>
                        <div class="discount-calc-badge">
                            <i data-lucide="percent"></i>
                            Inap &gt;3 Hari: <strong>Rp 495.000</strong>
                        </div>
                    </div>

                    <ul class="pricing-specs-list">
                        <li class="pricing-spec-item"><i data-lucide="users"></i> Kapasitas 2 Orang Tamu</li>
                        <li class="pricing-spec-item"><i data-lucide="maximize"></i> 45 m² Luas Ruangan</li>
                        <li class="pricing-spec-item"><i data-lucide="bath"></i> Bathtub Marmer Pribadi</li>
                        <li class="pricing-spec-item"><i data-lucide="trees"></i> Panorama Hutan Pinus</li>
                    </ul>

                    <div class="card-footer-btns">
                        <button type="button" class="btn-card-expand">
                            <i data-lucide="maximize-2"></i>
                            Rincian Detail Kamar
                        </button>
                        <a href="{{ route('pesan', ['tipe' => 'Deluxe']) }}" class="btn-card-book">
                            <i data-lucide="calendar-check"></i>
                            Reservasi Deluxe
                        </a>
                    </div>
                </div>
            </div>

            {{-- 3. Family Suite --}}
            <div class="pricing-card" data-room-key="Family Suite" data-aos="fade-up" data-aos-delay="300">
                <div class="pricing-card-img-wrap">
                    <img class="pricing-card-img"
                        src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&q=80"
                        alt="Kamar Family Suite Lumina Pasific"
                        loading="lazy">
                </div>
                <div class="pricing-card-body">
                    <div class="pricing-room-type">Keluarga &amp; Rombongan</div>
                    <h3 class="pricing-card-title">Family Suite</h3>

                    <div class="price-block">
                        <div class="price-main">
                            Rp 1.200.000 <small>/malam</small>
                        </div>
                        <div class="discount-calc-badge">
                            <i data-lucide="percent"></i>
                            Inap &gt;3 Hari: <strong>Rp 1.080.000</strong>
                        </div>
                    </div>

                    <ul class="pricing-specs-list">
                        <li class="pricing-spec-item"><i data-lucide="users"></i> Kapasitas 4-6 Tamu</li>
                        <li class="pricing-spec-item"><i data-lucide="bed-double"></i> 2 Kamar Tidur Terpisah</li>
                        <li class="pricing-spec-item"><i data-lucide="utensils"></i> Ruang Makan &amp; Pantry</li>
                        <li class="pricing-spec-item"><i data-lucide="trees"></i> Balkon Pemandangan Alam</li>
                    </ul>

                    <div class="card-footer-btns">
                        <button type="button" class="btn-card-expand">
                            <i data-lucide="maximize-2"></i>
                            Rincian Detail Kamar
                        </button>
                        <a href="{{ route('pesan', ['tipe' => 'Family Suite']) }}" class="btn-card-book">
                            <i data-lucide="calendar-check"></i>
                            Reservasi Family Suite
                        </a>
                    </div>
                </div>
            </div>

        </div>{{-- /pricing-grid --}}

        {{-- ============================================================
             SECTION: STANDAR & JAMINAN INKLUSIF MENGINAP (CLEAN & ELEGANT)
             Mempercantik isi tanpa menambah fitur/biaya ekstra
             ============================================================ --}}
        <div class="section-inclusions" data-aos="fade-up">
            <div class="inclusions-header-wrap">
                <div>
                    <h2 class="section-heading" style="font-size: 1.85rem; margin-bottom: 6px;">
                        Jaminan Kenyamanan Tanpa Biaya Tersembunyi
                    </h2>
                    <p style="font-size: 0.875rem; color: var(--text-muted); max-width: 680px;">
                        Setiap reservasi kamar di Lumina Pasific telah mencakup seluruh standar keramahan bintang lima dan fasilitas kawasan secara cuma-cuma.
                    </p>
                </div>
                <div style="font-size: 0.8125rem; font-weight: 700; color: var(--forest-800); background: #FFFFFF; padding: 8px 18px; border-radius: var(--radius-full); border: 1px solid var(--border-base); display:inline-flex; align-items:center; gap:6px; box-shadow: none;">
                    <i data-lucide="shield-check" style="width:15px; height:15px; color:var(--forest-accent);"></i>
                    Transparansi 100% Terjamin
                </div>
            </div>

            <div class="inclusions-grid">
                <div class="inclusion-card">
                    <div class="inclusion-icon-badge">
                        <i data-lucide="receipt"></i>
                    </div>
                    <h3 class="inclusion-title">Transparansi Tarif Penuh</h3>
                    <p class="inclusion-desc">
                        Harga kamar yang tertera adalah nilai pasti tanpa biaya tambahan tersembunyi. Pajak dan biaya layanan ditampilkan secara jujur dan transparan.
                    </p>
                </div>

                <div class="inclusion-card">
                    <div class="inclusion-icon-badge">
                        <i data-lucide="sparkles"></i>
                    </div>
                    <h3 class="inclusion-title">Sanitasi &amp; Linen Ortopedik</h3>
                    <p class="inclusion-desc">
                        Sterilisasi kamar berstandar sertifikasi industri dengan kasur pegas ortopedik, seprai katun Mesir 400-thread, dan set bantal bulu angsa hipoalergenik.
                    </p>
                </div>

                <div class="inclusion-card">
                    <div class="inclusion-icon-badge">
                        <i data-lucide="trees"></i>
                    </div>
                    <h3 class="inclusion-title">Akses Fasilitas Kawasan</h3>
                    <p class="inclusion-desc">
                        Akses bebas tanpa batas ke Pine Heated Infinity Pool, Pinecone Fitness Sanctuary, dan forest jogging trail berkabut selama masa menginap.
                    </p>
                </div>

                <div class="inclusion-card">
                    <div class="inclusion-icon-badge">
                        <i data-lucide="clock"></i>
                    </div>
                    <h3 class="inclusion-title">Concierge &amp; Layanan 24 Jam</h3>
                    <p class="inclusion-desc">
                        Bantuan staf terlatih 24 jam untuk kebutuhan room service artisan, penitipan bagasi aman, penjemputan tamu, dan pengaturan acara keluarga.
                    </p>
                </div>
            </div>

            <div class="inclusions-trust-strip">
                <div class="trust-strip-item">
                    <i data-lucide="check-circle-2"></i>
                    <span>Sertifikasi Resmi JWD Hotel Group &amp; BNSP</span>
                </div>
                <div class="trust-strip-item">
                    <i data-lucide="check-circle-2"></i>
                    <span>Diskon 10% Otomatis Masa Inap &gt; 3 Hari</span>
                </div>
                <div class="trust-strip-item">
                    <i data-lucide="check-circle-2"></i>
                    <span>Pilihan Sarapan Buffet Prasmanan Segar</span>
                </div>
            </div>
        </div>

        {{-- ============================================================
             SECTION: KEUNTUNGAN TAMBAHAN (CLEAN & ELEGANT)
             ============================================================ --}}
        <div class="comparison-perks-box" data-aos="fade-up">
            <h2 class="section-heading" style="font-size: 1.85rem;">Standar Kenyamanan Lumina Pasific</h2>

            <div class="perks-grid">
                <div class="perk-item">
                    <div class="perk-icon">
                        <i data-lucide="utensils"></i>
                    </div>
                    <div>
                        <h4 class="perk-title">Pilihan Sarapan Buffet Segar</h4>
                        <p class="perk-desc">
                            Tambahan sarapan buffet prasmanan mewah di Artisan Kitchen hanya dengan
                            Rp 80.000 per hari per tamu, menyajikan masakan tradisional dan kontinental organik.
                        </p>
                    </div>
                </div>

                <div class="perk-item">
                    <div class="perk-icon">
                        <i data-lucide="percent"></i>
                    </div>
                    <div>
                        <h4 class="perk-title">Diskon Otomatis Masa Inap &gt; 3 Hari</h4>
                        <p class="perk-desc">
                            Setiap reservasi dengan durasi menginap 4 hari atau lebih berhak mendapatkan potongan
                            langsung sebesar 10% dari total biaya sewa kamar tanpa perlu memasukkan kode kupon.
                        </p>
                    </div>
                </div>

                <div class="perk-item">
                    <div class="perk-icon">
                        <i data-lucide="shield-check"></i>
                    </div>
                    <div>
                        <h4 class="perk-title">Garansi Harga Transparan</h4>
                        <p class="perk-desc">
                            Harga yang tercantum sudah mencakup biaya layanan dan pajak resmi pemerintah. Tidak ada
                            tambahan biaya tersembunyi saat proses check-in di front office resor.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ================================================================
     MODAL POPUP: FULL DETAIL RINCIAN KAMAR (BLURRED BACKDROP)
     ================================================================ --}}
<div class="room-modal-backdrop" id="roomDetailModal" role="dialog" aria-modal="true">
    <div class="room-modal-card">
        {{-- Close Button (X) --}}
        <button type="button" class="modal-close-btn" id="modalCloseBtn" aria-label="Tutup Detail">
            <i data-lucide="x"></i>
        </button>

        {{-- Left: Large Room Photo & Badges --}}
        <div class="modal-photo-col">
            <img id="modalRoomImg" class="modal-photo-img" src="" alt="Foto Detail Kamar">
            <div class="modal-photo-badges">
                <span class="modal-badge-item" id="modalRoomBadge">
                    <i data-lucide="sparkles" style="width:13px; height:13px;"></i>
                    <span id="modalRoomBadgeText">Kamar Pilihan</span>
                </span>
                <span class="modal-badge-item">
                    <i data-lucide="shield-check" style="width:13px; height:13px;"></i>
                    Sertifikasi Bintang 5
                </span>
            </div>
        </div>

        {{-- Right: Comprehensive Details & Action --}}
        <div class="modal-detail-col">
            {{-- Scrollable Content Body --}}
            <div class="modal-detail-scroll-area">
                {{-- Category Switch Buttons Inside Modal --}}
                <div class="modal-cat-switch-wrap">
                    <span style="font-size:0.75rem; font-weight:700; color:var(--text-faint); margin-right:4px;">Kategori:</span>
                    <button type="button" class="modal-cat-tab-btn" data-cat-key="Standar">Standar</button>
                    <button type="button" class="modal-cat-tab-btn" data-cat-key="Deluxe">Deluxe</button>
                    <button type="button" class="modal-cat-tab-btn" data-cat-key="Family Suite">Family Suite</button>
                </div>

                <div class="modal-room-eyebrow" id="modalRoomCategory">Kategori Kamar</div>
                <h2 class="modal-room-name" id="modalRoomTitle">Nama Kamar</h2>
                <p class="modal-room-lead" id="modalRoomLead">Deskripsi lengkap mengenai kenyamanan dan suasana ruangan.</p>

                {{-- 4 Core Specs --}}
                <div class="modal-specs-grid">
                    <div class="modal-spec-cell">
                        <i data-lucide="maximize"></i>
                        <span id="modalSpecArea">38 m² Luas Ruangan</span>
                    </div>
                    <div class="modal-spec-cell">
                        <i data-lucide="users"></i>
                        <span id="modalSpecGuests">2 Orang Tamu</span>
                    </div>
                    <div class="modal-spec-cell">
                        <i data-lucide="bed"></i>
                        <span id="modalSpecBed">King-size Bed</span>
                    </div>
                    <div class="modal-spec-cell">
                        <i data-lucide="trees"></i>
                        <span id="modalSpecView">Pine Forest View</span>
                    </div>
                </div>

                {{-- Included Features --}}
                <div class="modal-feature-checklist" id="modalFeatureList">
                    {{-- Injected dynamically --}}
                </div>
            </div>{{-- /modal-detail-scroll-area --}}

            {{-- Category Booking Action Buttons (Stationary Footer) --}}
            <div class="modal-booking-actions">
                <div class="modal-primary-actions-row">
                    <div>
                        <div class="modal-price-sub">Tarif Resmi per Malam</div>
                        <div class="modal-price-value" id="modalPriceVal">Rp 0</div>
                    </div>
                    <div class="modal-btn-group">
                        <a id="modalBreakfastLink" href="#" class="btn-card-expand" style="width:auto; padding:9px 16px;" title="Pesan dengan Sarapan Buffet">
                            <i data-lucide="utensils" style="width:14px; height:14px;"></i>
                            + Sarapan Buffet
                        </a>
                        <a id="modalBookLink" href="#" class="btn-card-book" style="width:auto; padding:10px 20px;">
                            <i data-lucide="calendar-check"></i>
                            <span id="modalBookBtnText">Pesan Kamar Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // Detailed Database of Rooms for Modal
    const MODAL_ROOMS = {
        'Standar': {
            category: 'Kategori Nyaman &amp; Esensial',
            title: 'Kamar Standar',
            price: 'Rp 350.000',
            image: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1200&q=85',
            lead: 'Ruang istirahat bernuansa tenang yang dirancang dengan perpaduan aksen kayu alami. Sangat ideal untuk pelancong bisnis dan keluarga yang menginginkan kenyamanan tanpa kompromi.',
            area: '32 m² Luas Ruang',
            guests: 'Maks. 2 Tamu Dewasa',
            bed: 'Queen-size Plush Bed',
            view: 'Courtyard / Forest View',
            features: [
                'Koneksi Wi-Fi optik berkecepatan tinggi gratis tanpa batas',
                'Smart TV LED 43 inch dengan siaran kabel internasional',
                'Kamar mandi marmer dengan rain shower air hangat bertekanan tinggi',
                'Meja kerja ergonomis dan safety deposit box ukuran laptop',
                'Opsi penambahan sarapan buffet hanya Rp 80.000 / hari',
                'Diskon otomatis 10% untuk masa inap di atas 3 hari'
            ]
        },
        'Deluxe': {
            category: 'Kategori Terpopuler &amp; Favorit',
            title: 'Kamar Deluxe',
            price: 'Rp 550.000',
            image: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=1200&q=85',
            lead: 'Menghadirkan kenyamanan mewah dengan jendela kaca besar yang menghadap langsung ke panorama rimbun hutan pinus. Dilengkapi bathtub marmer freestanding untuk pengalaman berendam menenangkan.',
            area: '45 m² Luas Ruang',
            guests: 'Maks. 2 Tamu Dewasa',
            bed: 'King-size Luxury Mattress',
            view: 'Panoramic Pine Forest View',
            features: [
                'Bathtub marmer pribadi dengan garam mandi aromaterapi pinus',
                'Mesin kopi espresso kapsul dan mini bar premium',
                'Jendela kedap suara ganda (double-glazed acoustic glass)',
                'Akses gratis ke Pine Heated Pool dan Fitness Center',
                'Opsi penambahan sarapan buffet hanya Rp 80.000 / hari',
                'Diskon otomatis 10% untuk masa inap di atas 3 hari'
            ]
        },
        'Family Suite': {
            category: 'Kategori Keluarga &amp; Rombongan',
            title: 'Family Suite',
            price: 'Rp 1.200.000',
            image: 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1200&q=85',
            lead: 'Suite luas yang dirancang khusus untuk kehangatan liburan bersama keluarga tercinta. Terdiri atas dua kamar tidur terpisah, ruang makan, mini pantry, dan balkon privat yang lapang.',
            area: '90 m² Luas Ruang',
            guests: 'Kapasitas 4-6 Tamu',
            bed: '1 King-size + 2 Twin Beds',
            view: 'Pool &amp; Pine Forest View',
            features: [
                '2 kamar tidur terpisah dengan 2 kamar mandi pribadi lengkap',
                'Area mini pantry dengan microwave, kulkas besar, dan perlengkapan makan',
                'Balkon privat luas menghadap kolam renang dan rimbun pepohonan',
                'Akses tanpa batas ke Kids Wonderland Club untuk anak-anak',
                'Opsi penambahan sarapan buffet hanya Rp 80.000 / hari per orang',
                'Diskon otomatis 10% untuk masa inap di atas 3 hari'
            ]
        },
        'Family': {
            category: 'Kategori Keluarga &amp; Rombongan',
            title: 'Family Suite',
            price: 'Rp 1.200.000',
            image: 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=1200&q=85',
            lead: 'Suite luas yang dirancang khusus untuk kehangatan liburan bersama keluarga tercinta. Terdiri atas dua kamar tidur terpisah, ruang makan, mini pantry, dan balkon privat yang lapang.',
            area: '90 m² Luas Ruang',
            guests: 'Kapasitas 4-6 Tamu',
            bed: '1 King-size + 2 Twin Beds',
            view: 'Pool &amp; Pine Forest View',
            features: [
                '2 kamar tidur terpisah dengan 2 kamar mandi pribadi lengkap',
                'Area mini pantry dengan microwave, kulkas besar, dan perlengkapan makan',
                'Balkon privat luas menghadap kolam renang dan rimbun pepohonan',
                'Akses tanpa batas ke Kids Wonderland Club untuk anak-anak',
                'Opsi penambahan sarapan buffet hanya Rp 80.000 / hari per orang',
                'Diskon otomatis 10% untuk masa inap di atas 3 hari'
            ]
        }
    };

    const modalBackdrop      = document.getElementById('roomDetailModal');
    const modalCloseBtn      = document.getElementById('modalCloseBtn');
    const modalRoomImg       = document.getElementById('modalRoomImg');
    const modalRoomBadgeText = document.getElementById('modalRoomBadgeText');
    const modalRoomCategory  = document.getElementById('modalRoomCategory');
    const modalRoomTitle     = document.getElementById('modalRoomTitle');
    const modalRoomLead      = document.getElementById('modalRoomLead');
    const modalSpecArea      = document.getElementById('modalSpecArea');
    const modalSpecGuests    = document.getElementById('modalSpecGuests');
    const modalSpecBed       = document.getElementById('modalSpecBed');
    const modalSpecView      = document.getElementById('modalSpecView');
    const modalFeatureList   = document.getElementById('modalFeatureList');
    const modalPriceVal      = document.getElementById('modalPriceVal');
    const modalBookLink      = document.getElementById('modalBookLink');
    const modalBreakfastLink = document.getElementById('modalBreakfastLink');
    const modalBookBtnText   = document.getElementById('modalBookBtnText');
    const modalCatTabBtns    = document.querySelectorAll('.modal-cat-tab-btn');

    function openRoomModal(roomKey) {
        const data = MODAL_ROOMS[roomKey];
        if (!data) return;

        modalRoomImg.src               = data.image;
        modalRoomBadgeText.textContent = data.title;
        modalRoomCategory.innerHTML    = data.category;
        modalRoomTitle.textContent     = data.title;
        modalRoomLead.textContent      = data.lead;
        modalSpecArea.textContent      = data.area;
        modalSpecGuests.textContent    = data.guests;
        modalSpecBed.textContent       = data.bed;
        modalSpecView.textContent      = data.view;
        modalPriceVal.textContent      = data.price + ' / malam';
        modalBookLink.href             = '{{ route('pesan') }}?tipe=' + encodeURIComponent(roomKey);
        modalBreakfastLink.href        = '{{ route('pesan') }}?tipe=' + encodeURIComponent(roomKey) + '&breakfast=1';
        modalBookBtnText.textContent   = 'Pesan ' + data.title + ' Sekarang';

        modalCatTabBtns.forEach(btn => {
            if (btn.getAttribute('data-cat-key') === roomKey) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });

        modalFeatureList.innerHTML = '';
        data.features.forEach(feat => {
            const row = document.createElement('div');
            row.className = 'modal-chk-item';
            row.innerHTML = '<i data-lucide="check-circle-2"></i><span>' + feat + '</span>';
            modalFeatureList.appendChild(row);
        });

        if (window.lucide) {
            window.lucide.createIcons();
        }

        modalBackdrop.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    modalCatTabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const catKey = btn.getAttribute('data-cat-key');
            openRoomModal(catKey);
        });
    });

    function closeRoomModal() {
        modalBackdrop.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    const cards = document.querySelectorAll('.pricing-card');
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            if (e.target.closest('a[href*="pesan"]')) {
                return;
            }
            const key = card.getAttribute('data-room-key');
            openRoomModal(key);
        });
    });

    modalCloseBtn.addEventListener('click', closeRoomModal);

    modalBackdrop.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            closeRoomModal();
        }
    });

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalBackdrop.classList.contains('is-open')) {
            closeRoomModal();
        }
    });
})();
</script>
@endpush
