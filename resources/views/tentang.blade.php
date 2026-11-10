@extends('layouts.app')

@section('title', 'Tentang Kami &amp; Dapur Gastronomi Alam &mdash; Lumina Pasific')

@push('styles')
<style>
    /* ============================================================
       ABOUT & NATURE RETREAT STORY
       Warm Scandinavian Wood, Clean Forest Living, Artisanal Dining
       ============================================================ */
    .about-hero {
        padding: 30px 0 70px;
        background: #FFFFFF;
    }

    .about-story-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 56px;
        align-items: center;
    }

    .about-story-photo-box {
        position: relative;
    }

    .about-main-img {
        width: 100%;
        aspect-ratio: 4/3;
        border-radius: var(--radius-2xl);
        object-fit: cover;
        display: block;
        border: 1px solid var(--border-base);
        box-shadow: 0 16px 40px -10px rgba(18, 38, 28, 0.18);
    }

    .about-mini-img-float {
        position: absolute;
        bottom: -24px;
        right: -24px;
        width: 52%;
        aspect-ratio: 4/3;
        border-radius: var(--radius-lg);
        object-fit: cover;
        border: 4px solid #FFFFFF;
        box-shadow: 0 14px 35px -5px rgba(0, 0, 0, 0.2);
    }

    .about-body-text {
        font-size: 1.0625rem;
        color: var(--text-muted);
        line-height: 1.8;
        margin-top: 18px;
        margin-bottom: 22px;
    }

    /* Core Pillars */
    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 60px;
    }

    .pillar-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        padding: 28px 24px;
        box-shadow: none;
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .pillar-card:hover {
        transform: translateY(-2px);
        border-color: var(--forest-accent);
        box-shadow: none;
    }

    .pillar-icon-box {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--forest-800);
        margin-bottom: 18px;
    }

    .pillar-icon-box svg { width: 20px; height: 20px; }

    .pillar-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 8px;
    }

    .pillar-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* ============================================================
       SECTION: THE ARTISAN KITCHEN & GASTRONOMI ALAM (MAGAZINE EDITORIAL)
       ============================================================ */
    .section-culinary {
        padding: 85px 0 95px;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    .culinary-layout {
        display: grid;
        grid-template-columns: 1.05fr 1fr;
        gap: 52px;
        align-items: start;
        margin-top: 40px;
    }

    /* Asymmetric Bento Photo Showcase */
    .culinary-gallery {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .culinary-photo-box {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border-base);
        aspect-ratio: 4/3;
        box-shadow: var(--shadow-soft);
        position: relative;
        background: #142B21;
    }

    .culinary-photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .culinary-photo-box:hover img {
        transform: scale(1.06);
    }

    .culinary-photo-box.large {
        grid-column: span 2;
        aspect-ratio: 16/9;
    }

    .culinary-photo-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(18, 38, 28, 0.82);
        backdrop-filter: blur(8px);
        color: #FFFFFF;
        font-size: 0.6875rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        letter-spacing: 0.05em;
    }

    .culinary-editorial-wrap {
        display: flex;
        flex-direction: column;
    }

    .culinary-highlights {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin: 24px 0 28px;
    }

    .culinary-point {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .culinary-point-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        color: var(--forest-800);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .culinary-point-icon svg { width: 18px; height: 18px; }

    .culinary-point-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 2px;
    }

    .culinary-point-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Tasting Menu Card */
    .tasting-menu-card {
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        border-radius: var(--radius-xl);
        padding: 24px;
        margin-bottom: 28px;
    }

    .tasting-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--forest-border);
    }

    .tasting-title {
        font-size: 0.875rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .tasting-items-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .tasting-dish-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.78125rem;
        color: var(--text-heading);
        font-weight: 600;
    }

    .tasting-dish-item svg {
        width: 13px;
        height: 13px;
        color: var(--forest-accent);
        flex-shrink: 0;
    }

    /* ============================================================
       SECTION: PRINSIP KEBERLANJUTAN ALAM (ECO-LUXURY)
       ============================================================ */
    .section-sustainability {
        padding: 80px 0;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    .sustain-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 40px;
    }

    .sustain-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        padding: 28px 22px;
        box-shadow: none;
        transition: all 0.25s ease;
    }

    .sustain-card:hover {
        transform: translateY(-2px);
        border-color: var(--forest-accent);
        box-shadow: none;
    }

    .sustain-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        color: var(--forest-800);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .sustain-icon svg { width: 20px; height: 20px; }

    .sustain-card-title {
        font-size: 0.9375rem;
        font-weight: 800;
        color: var(--text-heading);
        margin-bottom: 6px;
    }

    .sustain-card-text {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* ============================================================
       SECTION: DESTINASI ALAM RESOR LUMINA PASIFIC
       ============================================================ */
    .section-locations {
        padding: 85px 0 95px;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    .locations-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 44px;
    }

    .location-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: none;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
    }

    .location-card:hover {
        transform: translateY(-2px);
        border-color: var(--forest-accent);
        box-shadow: none;
    }

    .location-thumb {
        width: 100%;
        aspect-ratio: 16/10;
        object-fit: cover;
        display: block;
        background: #142B21;
        transition: transform 0.5s ease;
    }

    .location-card:hover .location-thumb {
        transform: scale(1.05);
    }

    .location-thumb-wrap {
        position: relative;
        overflow: hidden;
    }

    .location-tag-pill {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(18, 38, 28, 0.85);
        backdrop-filter: blur(8px);
        color: #FFFFFF;
        font-size: 0.6875rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: var(--radius-full);
    }

    .location-card-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .location-city {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-faint);
        margin-bottom: 4px;
    }

    .location-name {
        font-size: 1.0625rem;
        font-weight: 800;
        color: var(--text-heading);
        margin-bottom: 8px;
    }

    .location-address {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 18px;
        flex: 1;
    }

    /* ============================================================
       CONTACT & MAP
       ============================================================ */
    .section-contact {
        padding: 85px 0 95px;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    .contact-layout {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 48px;
        align-items: start;
        margin-top: 44px;
    }

    .contact-cards-stack {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .contact-info-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-lg);
        padding: 22px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        box-shadow: var(--shadow-subtle);
    }

    .contact-info-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        background: var(--forest-800);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-info-icon svg { width: 20px; height: 20px; }

    .contact-info-label {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-faint);
        margin-bottom: 4px;
    }

    .contact-info-val {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--text-heading);
        line-height: 1.5;
    }

    .contact-info-val a {
        color: var(--forest-800);
        text-decoration: none;
    }

    .contact-info-val a:hover { text-decoration: underline; }

    .map-frame {
        border-radius: var(--radius-xl);
        overflow: hidden;
        border: 1px solid var(--border-base);
        box-shadow: var(--shadow-soft);
        height: 100%;
        min-height: 400px;
    }

    .map-frame iframe {
        width: 100%;
        height: 100%;
        min-height: 400px;
        display: block;
        border: 0;
    }

    /* Button Styling & Covers in Tentang Page */
    .btn-forest-primary {
        background: var(--forest-800);
        color: #FFFFFF !important;
        font-size: 0.875rem;
        font-weight: 700;
        padding: 12px 24px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none !important;
        box-shadow: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-forest-primary:hover {
        background: var(--forest-hover);
        color: #FFFFFF !important;
        transform: translateY(-1px);
        box-shadow: none;
        text-decoration: none !important;
    }

    .btn-forest-primary svg { width: 16px; height: 16px; stroke-width: 2.2; }

    .btn-forest-ghost {
        background: #FFFFFF;
        color: var(--text-heading) !important;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 11px 22px;
        border-radius: var(--radius-full);
        border: 1.5px solid var(--border-base);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-forest-ghost:hover {
        border-color: var(--forest-800);
        color: var(--forest-800) !important;
        background: var(--forest-subtle);
        text-decoration: none !important;
    }

    .btn-forest-ghost svg { width: 16px; height: 16px; stroke-width: 2.2; }

    .btn-card-book {
        background: var(--forest-800);
        color: #FFFFFF !important;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: none;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-card-book:hover {
        background: var(--forest-hover);
        color: #FFFFFF !important;
        transform: translateY(-1px);
        box-shadow: none;
        text-decoration: none !important;
    }

    .btn-card-book svg { width: 14px; height: 14px; stroke-width: 2.2; }

    .contact-link-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        color: var(--forest-800) !important;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 7px 16px;
        border-radius: var(--radius-full);
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .contact-link-pill:hover {
        background: var(--forest-800);
        color: #FFFFFF !important;
        border-color: var(--forest-800);
        transform: translateY(-1px);
        box-shadow: none;
    }

    .contact-link-pill svg { width: 14px; height: 14px; }

    @media (max-width: 1024px) {
        .about-story-grid { grid-template-columns: 1fr; }
        .about-mini-img-float { display: none; }
        .pillars-grid { grid-template-columns: repeat(2, 1fr); }
        .culinary-layout { grid-template-columns: 1fr; }
        .sustain-grid { grid-template-columns: repeat(2, 1fr); }
        .locations-grid { grid-template-columns: repeat(2, 1fr); }
        .contact-layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .pillars-grid { grid-template-columns: 1fr; }
        .sustain-grid { grid-template-columns: 1fr; }
        .locations-grid { grid-template-columns: 1fr; }
        .tasting-items-list { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- ================================================================
     ABOUT HERO & STORY
     ================================================================ --}}
<section class="about-hero">
    <div class="container">
        <div class="about-story-grid">
            <div data-aos="fade-up">
                <h1 class="section-heading">
                    Menghidupkan Kembali Keanggunan Keramahan di Tengah Harmoni Alam
                </h1>
                <p class="about-body-text">
                    Berdiri dengan filosofi ketenangan alami, Lumina Pasific bertumbuh dari sebuah visi sederhana: menciptakan
                    tempat persinggahan bernuansa damai di mana kenyamanan mutlak berpadu selaras dengan ketelitian desain kayu kontemporer.
                    Kami memadukan keramahan khas Nusantara dengan standar pelayanan perhotelan bintang lima internasional di bawah naungan JWD Hotel Group.
                </p>
                <p class="about-body-text" style="margin-top: 0;">
                    Di setiap sudut resor kami &mdash; dari paviliun utama beraroma pinus segar hingga kamar suite
                    yang kedap suara &mdash; dedikasi kami berfokus pada ketenangan pikiran dan pengalaman beristirahat
                    terbaik bagi setiap tamu kami.
                </p>

                <div style="display:flex; gap:12px; margin-top:30px; flex-wrap:wrap;">
                    <a href="{{ route('pesan') }}" class="btn-forest-primary">
                        <i data-lucide="calendar-check"></i>
                        Pesan Kamar Sekarang
                    </a>
                    <a href="{{ route('harga') }}" class="btn-forest-ghost">
                        <i data-lucide="sparkles"></i>
                        Lihat Koleksi Kamar
                    </a>
                </div>
            </div>

            <div class="about-story-photo-box" data-aos="fade-in" data-aos-delay="200">
                <img
                    class="about-main-img"
                    src="{{ asset('images/about-heritage.jpg') }}"
                    alt="Arsitektur Warisan Alam Kayu Lumina Pasific"
                    loading="lazy">
                <img
                    class="about-mini-img-float"
                    src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=700&q=80"
                    alt="Interior Suite Kayu"
                    loading="lazy">
            </div>
        </div>

        {{-- 4 Core Pillars --}}
        <div class="pillars-grid" data-aos="fade-up" data-aos-delay="150">
            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i data-lucide="award"></i>
                </div>
                <h3 class="pillar-title">Standar Sertifikasi BNSP</h3>
                <p class="pillar-desc">Memenuhi 100% regulasi resmi kelaikan bintang lima dan sertifikasi higienitas pariwisata nasional.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i data-lucide="heart-handshake"></i>
                </div>
                <h3 class="pillar-title">Pelayanan Hangat 24/7</h3>
                <p class="pillar-desc">Tim concierge dan front desk kami siaga penuh mendampingi kebutuhan Anda setiap saat.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i data-lucide="shield-check"></i>
                </div>
                <h3 class="pillar-title">Privasi &amp; Keamanan Alami</h3>
                <p class="pillar-desc">Sistem kunci kamar digital enkripsi tinggi dan pengamanan patroli 24 jam untuk ketenangan Anda.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <i data-lucide="utensils"></i>
                </div>
                <h3 class="pillar-title">Dapur Artisan Organik</h3>
                <p class="pillar-desc">Menu sarapan dan santap malam dipersiapkan dari kebun organik lokal oleh chef berkaliber internasional.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     SECTION: THE ARTISAN KITCHEN & GASTRONOMI ALAM (MAGAZINE EDITORIAL)
     ================================================================ --}}
<section class="section-culinary" id="kuliner">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="section-heading">The Artisan Kitchen: Cita Rasa Murni dari Alam</h2>
            <p class="section-subheading">
                Kami meyakini bahwa sebuah pengalaman menginap mewah tidak pernah lengkap tanpa kelezatan kuliner
                yang mengesankan. Di Lumina Pasific, dapur adalah jantung seni di mana kesegaran alam, etika bahan baku organik,
                dan kehangatan perapian dipadukan secara harmonis.
            </p>
        </div>

        <div class="culinary-layout">
            {{-- Asymmetric Photo Bento --}}
            <div class="culinary-gallery" data-aos="fade-in">
                <div class="culinary-photo-box large">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900&q=85" alt="Master Executive Chef Open Wood Grill" loading="lazy">
                    <span class="culinary-photo-badge">Open Wood-Fired Hearth</span>
                </div>
                <div class="culinary-photo-box">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=700&q=80" alt="Gourmet Farm to Table Plating" loading="lazy">
                    <span class="culinary-photo-badge">Farm-to-Table Plating</span>
                </div>
                <div class="culinary-photo-box">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=700&q=80" alt="Artisan Bakery & Pastry" loading="lazy">
                    <span class="culinary-photo-badge">Fresh Morning Sourdough</span>
                </div>
            </div>

            {{-- Editorial Culinary Text & Tasting Menu Card --}}
            <div class="culinary-editorial-wrap" data-aos="fade-up" data-aos-delay="200">
                <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--text-heading); letter-spacing: -0.02em;">
                    Sentuhan Tangan Chef Berbintang &amp; Dapur Terbuka
                </h3>
                <p style="font-size: 0.9375rem; color: var(--text-muted); line-height: 1.7; margin-top: 10px;">
                    Setiap hidangan sarapan buffet prasmanan (dengan opsi tambahan Rp 80.000) hingga jamuan privat
                    diolah menggunakan bahan segar perkebunan organik setempat, daging premium tersertifikasi, dan bumbu rempah alami Nusantara.
                </p>

                <div class="culinary-highlights">
                    <div class="culinary-point">
                        <div class="culinary-point-icon">
                            <i data-lucide="chef-hat"></i>
                        </div>
                        <div>
                            <div class="culinary-point-title">Master Executive Chef</div>
                            <div class="culinary-point-desc">Dipimpin oleh tim koki berpengalaman hotel berbintang 5 dengan penghargaan gastronomi internasional.</div>
                        </div>
                    </div>

                    <div class="culinary-point">
                        <div class="culinary-point-icon">
                            <i data-lucide="flame"></i>
                        </div>
                        <div>
                            <div class="culinary-point-title">Open Hearth Cooking &amp; Wood Grill</div>
                            <div class="culinary-point-desc">Para tamu dapat menyaksikan langsung teknik memanggang di atas kayu kopi aromatik dengan standar higienitas ketat.</div>
                        </div>
                    </div>

                    <div class="culinary-point">
                        <div class="culinary-point-icon">
                            <i data-lucide="coffee"></i>
                        </div>
                        <div>
                            <div class="culinary-point-title">Artisan Bakery &amp; Roastery Sendiri</div>
                            <div class="culinary-point-desc">Roti sourdough, croissant hangat, dan biji kopi arabika pilihan disangrai segar setiap pagi untuk sarapan Anda.</div>
                        </div>
                    </div>
                </div>

                {{-- Tasting Menu Card --}}
                <div class="tasting-menu-card">
                    <div class="tasting-menu-header">
                        <span class="tasting-title">
                            <i data-lucide="sparkles" style="width:13px; height:13px; vertical-align:middle; margin-right:4px;"></i>
                            Kurasi Menu Musiman Chef
                        </span>
                        <span style="font-size:0.6875rem; font-weight:700; color:var(--forest-800); background:#FFFFFF; padding:2px 8px; border-radius:var(--radius-full);">100% Organik</span>
                    </div>
                    <div class="tasting-items-list">
                        <div class="tasting-dish-item">
                            <i data-lucide="check-circle-2"></i>
                            <span>Sarapan Buffet Prasmanan (Rp 80rb)</span>
                        </div>
                        <div class="tasting-dish-item">
                            <i data-lucide="check-circle-2"></i>
                            <span>Wood-Smoked Tenderloin Herba</span>
                        </div>
                        <div class="tasting-dish-item">
                            <i data-lucide="check-circle-2"></i>
                            <span>Wild Pine Mushroom Risotto</span>
                        </div>
                        <div class="tasting-dish-item">
                            <i data-lucide="check-circle-2"></i>
                            <span>Seduhan Teh Herbal Pegunungan</span>
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('pesan', ['breakfast' => '1']) }}" class="btn-forest-primary">
                        <i data-lucide="utensils"></i>
                        Pesan Kamar Termasuk Breakfast
                    </a>
                    <a href="#lokasi" class="btn-forest-ghost">
                        <i data-lucide="map-pin"></i>
                        Pilih Lokasi Resor
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     SECTION: KOMITMEN KEBERLANJUTAN ALAM (ECO-LUXURY SANCTUARY)
     ================================================================ --}}
<section class="section-sustainability">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="section-heading">Komitmen Keberlanjutan Alam Lumina Pasific</h2>
            <p class="section-subheading">
                Kami berkomitmen menjaga kelestarian ekosistem hutan dan memberdayakan komunitas petani lokal di setiap destinasi properti kami.
            </p>
        </div>

        <div class="sustain-grid" data-aos="fade-up" data-aos-delay="150">
            <div class="sustain-card">
                <div class="sustain-icon">
                    <i data-lucide="recycle"></i>
                </div>
                <h4 class="sustain-card-title">Zero Single-Use Plastic</h4>
                <p class="sustain-card-text">
                    Seluruh botol air mineral berbahan kaca isi ulang, sedotan bambu organik, dan fasilitas mandi bebas plastik sekali pakai.
                </p>
            </div>

            <div class="sustain-card">
                <div class="sustain-icon">
                    <i data-lucide="sun"></i>
                </div>
                <h4 class="sustain-card-title">Energi Surya &amp; Alami</h4>
                <p class="sustain-card-text">
                    Pemanas air bertenaga matahari dan sirkulasi arsitektur ventilasi silang yang meminimalkan jejak karbon resor hingga 40%.
                </p>
            </div>

            <div class="sustain-card">
                <div class="sustain-icon">
                    <i data-lucide="sprout"></i>
                </div>
                <h4 class="sustain-card-title">Kemitraan Petani Lokal</h4>
                <p class="sustain-card-text">
                    100% bahan dapur bersumber langsung dari kebun organik mitra masyarakat desa di lereng pegunungan sekitar resor.
                </p>
            </div>

            <div class="sustain-card">
                <div class="sustain-icon">
                    <i data-lucide="trees"></i>
                </div>
                <h4 class="sustain-card-title">Adopsi Pohon Lindung</h4>
                <p class="sustain-card-text">
                    Setiap reservasi tamu di atas 3 malam secara otomatis menyumbang 1 bibit pohon pinus untuk area konservasi hutan lindung.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     SECTION: LOKASI RESOR (JARINGAN LUMINA PASIFIC & JWD GROUP)
     ================================================================ --}}
<section class="section-locations" id="lokasi">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="section-heading">Jaringan Resor Lumina Pasific</h2>
            <p class="section-subheading">
                Pilih lokasi peristirahatan tujuan Anda di kawasan asri pegunungan dan pantai Indonesia di bawah naungan JWD Hotel Group.
            </p>
        </div>

        <div class="locations-grid">
            {{-- Lokasi 1: Lembang Pine Hill --}}
            <div class="location-card" data-aos="fade-up" data-aos-delay="100">
                <div class="location-thumb-wrap">
                    <img class="location-thumb" src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=600&q=80" alt="Lumina Pasific Pine Hill Lembang" loading="lazy">
                    <span class="location-tag-pill">Hutan Pinus</span>
                </div>
                <div class="location-card-body">
                    <div class="location-city">Lembang, Jawa Barat</div>
                    <h4 class="location-name">Lumina Pasific Pine Hill</h4>
                    <p class="location-address">Pine Hill Forest Area No. 88, Lembang. Pemandangan hutan pinus berkabut.</p>
                    <a href="{{ route('pesan', ['lokasi' => 'Lumina Pasific Pine Hill Lembang']) }}" class="btn-card-book" style="width: 100%;">
                        <i data-lucide="map-pin"></i> Pesan di Lembang
                    </a>
                </div>
            </div>

            {{-- Lokasi 2: Ubud Bali --}}
            <div class="location-card" data-aos="fade-up" data-aos-delay="200">
                <div class="location-thumb-wrap">
                    <img class="location-thumb" src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=600&q=80" alt="Lumina Pasific Ubud Bali" loading="lazy">
                    <span class="location-tag-pill">Lembah Tropis</span>
                </div>
                <div class="location-card-body">
                    <div class="location-city">Ubud, Bali</div>
                    <h4 class="location-name">Lumina Pasific Sanctuary Ubud</h4>
                    <p class="location-address">Jl. Lembah Ayung No. 12, Ubud, Gianyar, Bali. Menghadap lembah hutan tropis.</p>
                    <a href="{{ route('pesan', ['lokasi' => 'Lumina Pasific Sanctuary Ubud Bali']) }}" class="btn-card-book" style="width: 100%;">
                        <i data-lucide="map-pin"></i> Pesan di Ubud
                    </a>
                </div>
            </div>

            {{-- Lokasi 3: Yogyakarta --}}
            <div class="location-card" data-aos="fade-up" data-aos-delay="300">
                <div class="location-thumb-wrap">
                    <img class="location-thumb" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80" alt="Lumina Pasific Heritage Merapi" loading="lazy">
                    <span class="location-tag-pill">Kaki Gunung</span>
                </div>
                <div class="location-card-body">
                    <div class="location-city">Kaliurang, Yogyakarta</div>
                    <h4 class="location-name">Lumina Pasific Heritage Merapi</h4>
                    <p class="location-address">Jl. Kaliurang Km 22, Sleman, Yogyakarta. Udara sejuk di kaki Gunung Merapi.</p>
                    <a href="{{ route('pesan', ['lokasi' => 'Lumina Pasific Heritage Merapi']) }}" class="btn-card-book" style="width: 100%;">
                        <i data-lucide="map-pin"></i> Pesan di Yogya
                    </a>
                </div>
            </div>

            {{-- Lokasi 4: Batu Highland --}}
            <div class="location-card" data-aos="fade-up" data-aos-delay="400">
                <div class="location-thumb-wrap">
                    <img class="location-thumb" src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=600&q=80" alt="Lumina Pasific Batu Highland" loading="lazy">
                    <span class="location-tag-pill">Puncak Bukit</span>
                </div>
                <div class="location-card-body">
                    <div class="location-city">Batu, Jawa Timur</div>
                    <h4 class="location-name">Lumina Pasific Batu Highland</h4>
                    <p class="location-address">Jl. Panderman Heights No. 10, Batu, Malang. Panorama pegunungan sejuk.</p>
                    <a href="{{ route('pesan', ['lokasi' => 'Lumina Pasific Batu Highland']) }}" class="btn-card-book" style="width: 100%;">
                        <i data-lucide="map-pin"></i> Pesan di Batu
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     SECTION: INFORMASI KONTAK & GOOGLE MAP
     ================================================================ --}}
<section class="section-contact" id="kontak">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="section-heading">Hubungi Tim Layanan Tamu</h2>
            <p class="section-subheading">
                Konsultasikan rencana liburan, reservasi rombongan, atau paket acara istimewa Anda bersama tim concierge kami.
            </p>
        </div>

        <div class="contact-layout">
            <div class="contact-cards-stack" data-aos="fade-up">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i data-lucide="map-pin"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Alamat Resor Pusat</div>
                        <div class="contact-info-val">
                            Pine Hill Forest Area No. 88, Lembang, Jawa Barat 40391
                        </div>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i data-lucide="phone"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Telepon &amp; WhatsApp Reservasi</div>
                        <div class="contact-info-val" style="display:flex; gap:8px; flex-wrap:wrap; margin-top:4px;">
                            <a href="tel:02155551234" class="contact-link-pill">
                                <i data-lucide="phone-call"></i> (021) 5555-1234
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="contact-link-pill">
                                <i data-lucide="message-circle"></i> +62 812-3456-7890
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i data-lucide="mail"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Surat Elektronik (Email)</div>
                        <div class="contact-info-val" style="margin-top:4px;">
                            <a href="mailto:reservasi@luminapasific.id" class="contact-link-pill">
                                <i data-lucide="send"></i> reservasi@luminapasific.id
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i data-lucide="clock"></i>
                    </div>
                    <div>
                        <div class="contact-info-label">Waktu Operasional</div>
                        <div class="contact-info-val">
                            Layanan Front Desk &amp; Reservasi Siaga 24 Jam Nonstop
                        </div>
                    </div>
                </div>
            </div>

            {{-- Embedded Google Maps --}}
            <div class="map-frame" data-aos="fade-left" data-aos-delay="150">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.44962294975!2d107.57311653153549!3d-6.819077677134011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e146dd1d0637%3A0x401e8f1fc28c7c0!2sLembang%2C%20West%20Bandung%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Peta Lokasi Resor Lumina Pasific">
                </iframe>
            </div>
        </div>
    </div>
</section>

@endsection
