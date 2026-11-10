<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Lumina Pasific') &mdash; Luxury Forest &amp; Nature Retreat</title>

    {{-- Google Fonts - Plus Jakarta Sans & Playfair Display --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    {{-- Lucide Icons CDN --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        /* ============================================================
           DESIGN SYSTEM — Pure Solid White & Forest Nature Luxury
           ============================================================ */
        :root {
            --bg-body:       #FFFFFF;
            --bg-surface:    #FFFFFF;
            --bg-card:       #FFFFFF;
            --bg-subtle:     #F8FAFC;
            --bg-hover:      #F1F5F9;
            
            --border-light:  #F1F5F9;
            --border-base:   #E2E8F0;
            --border-dark:   #CBD5E1;
            
            --text-heading:  #0F172A;
            --text-body:     #334155;
            --text-muted:    #64748B;
            --text-faint:    #94A3B8;
            
            --slate-800:     #1E293B;
            --slate-900:     #0F172A;
            --accent-navy:   #0B1325;
            
            /* Nature Forest Green Palette */
            --forest-900:    #12261C;
            --forest-800:    #1B382B;
            --forest-700:    #244B39;
            --forest-accent: #2E5D46;
            --forest-hover:  #142B21;
            --forest-subtle: #F2F7F4;
            --forest-border: #D1E2D9;
            
            /* Tasteful Warm Bronze / Muted Gold Accents */
            --gold-accent:   #9A7B4F;
            --gold-muted:    #B89A6B;
            --gold-light:    #FBF8F2;
            --gold-border:   #EBE2D3;
            
            --radius-sm:     8px;
            --radius-md:     12px;
            --radius-lg:     16px;
            --radius-xl:     24px;
            --radius-2xl:    32px;
            --radius-full:   9999px;
            
            --shadow-subtle: 0 1px 3px rgba(15, 23, 42, 0.04);
            --shadow-soft:   0 4px 20px -2px rgba(15, 23, 42, 0.05);
            --shadow-float:  0 10px 30px -5px rgba(15, 23, 42, 0.07);
            --shadow-nav:    0 8px 32px 0 rgba(15, 23, 42, 0.06);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
            background-color: var(--bg-body);
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-body);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Serif Display Font for Elegant Accents */
        .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* ============================================================
           FLOATING NAVBAR — Extended Luxury Island Aligned with Grid
           Initially attached to the page; floats as island on scroll
           ============================================================ */
        .navbar-floating-container {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 100%;
            max-width: 1240px;
            padding: 8px 28px 0;
            transition: top 0.3s cubic-bezier(0.16, 1, 0.3, 1), padding 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .navbar-floating-container.is-scrolled {
            top: 10px;
            padding: 0 28px;
        }

        .navbar-floating {
            position: relative;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border: 1px solid transparent;
            border-radius: var(--radius-full);
            box-shadow: none;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease;
        }

        .navbar-floating-container.is-scrolled .navbar-floating {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-color: var(--border-base);
            box-shadow: 0 10px 30px -4px rgba(18, 38, 28, 0.08), 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* Brand Pill */
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            color: var(--text-heading);
            text-decoration: none;
            font-weight: 800;
            font-size: 0.9375rem;
            letter-spacing: -0.02em;
        }

        .nav-brand-logo {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: var(--text-heading);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-brand-logo svg {
            width: 14px;
            height: 14px;
            stroke-width: 2.2;
        }

        /* Nav Links Track */
        .nav-links-track {
            position: relative;
            display: flex;
            align-items: center;
            gap: 2px;
        }

        /* Sliding Pill Effect */
        .nav-indicator-pill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            border-radius: var(--radius-full);
            background: #F1F5F9;
            pointer-events: none;
            opacity: 0;
            transition: transform 0.28s cubic-bezier(0.2, 0.8, 0.2, 1),
                        width 0.28s cubic-bezier(0.2, 0.8, 0.2, 1),
                        opacity 0.2s ease;
            z-index: 1;
        }

        .nav-item-link {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius-full);
            transition: color 0.2s ease;
            white-space: nowrap;
        }

        .nav-item-link svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
            transition: transform 0.2s ease, stroke 0.2s ease;
        }

        .nav-item-link:hover {
            color: var(--text-heading);
        }

        .nav-item-link.active {
            color: var(--text-heading);
            font-weight: 700;
        }

        .nav-item-link.nav-cta {
            background: var(--forest-800);
            color: #FFFFFF;
            margin-left: 6px;
            padding: 8px 18px;
            box-shadow: 0 2px 10px rgba(27, 56, 43, 0.25);
            transition: all 0.2s ease;
        }

        .nav-item-link.nav-cta:hover {
            background: var(--forest-hover);
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(27, 56, 43, 0.35);
        }

        .nav-item-link.nav-cta svg {
            stroke: #FFFFFF;
        }

        /* ============================================================
           MAIN CONTENT & WRAPPER
           ============================================================ */
        .site-content {
            padding-top: 58px;
            min-height: 100vh;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 28px;
        }

        /* ============================================================
           ANIMATION ON SCROLL (AOS) SYSTEM
           ============================================================ */
        [data-aos] {
            opacity: 0;
            transition-property: transform, opacity;
            transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1);
            transition-duration: 0.7s;
            will-change: transform, opacity;
        }

        [data-aos="fade-up"] {
            transform: translateY(32px);
        }

        [data-aos="fade-down"] {
            transform: translateY(-32px);
        }

        [data-aos="fade-in"] {
            transform: scale(0.97);
        }

        [data-aos].aos-animate {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Stagger Delays */
        [data-aos-delay="100"] { transition-delay: 100ms; }
        [data-aos-delay="200"] { transition-delay: 200ms; }
        [data-aos-delay="300"] { transition-delay: 300ms; }
        [data-aos-delay="400"] { transition-delay: 400ms; }
        [data-aos-delay="500"] { transition-delay: 500ms; }

        /* ============================================================
           TYPOGRAPHY & SECTION HEADERS
           ============================================================ */
        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 12px;
        }

        .section-eyebrow::before {
            content: '';
            width: 18px;
            height: 1px;
            background: var(--text-faint);
        }

        .section-heading {
            font-size: clamp(1.85rem, 3.2vw, 2.75rem);
            font-weight: 700;
            color: var(--text-heading);
            letter-spacing: -0.03em;
            line-height: 1.2;
        }

        .section-subheading {
            font-size: 1.0625rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-top: 12px;
            max-width: 640px;
        }

        /* ============================================================
           BUTTONS & CHIPS
           ============================================================ */
        .btn-luxury {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: var(--radius-full);
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
            white-space: nowrap;
        }

        .btn-luxury:active {
            transform: scale(0.98);
        }

        .btn-luxury-primary {
            background: var(--text-heading);
            color: #FFFFFF;
            border-color: var(--text-heading);
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        }

        .btn-luxury-primary:hover {
            background: var(--slate-800);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.18);
            transform: translateY(-1px);
        }

        .btn-luxury-secondary {
            background: #FFFFFF;
            color: var(--text-heading);
            border-color: var(--border-base);
            box-shadow: var(--shadow-subtle);
        }

        .btn-luxury-secondary:hover {
            background: var(--bg-subtle);
            border-color: var(--border-dark);
            transform: translateY(-1px);
        }

        .btn-luxury-sm {
            padding: 8px 18px;
            font-size: 0.8125rem;
        }

        .btn-luxury svg {
            width: 15px;
            height: 15px;
            stroke-width: 2;
        }

        /* ============================================================
           FOREST LUXURY BUTTONS (Universal Design System)
           ============================================================ */
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
            box-shadow: 0 4px 14px rgba(27, 56, 43, 0.25);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-forest-primary:hover {
            background: var(--forest-hover);
            color: #FFFFFF !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 56, 43, 0.35);
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
            box-shadow: 0 2px 8px rgba(27, 56, 43, 0.2);
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-card-book:hover {
            background: var(--forest-hover);
            color: #FFFFFF !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 56, 43, 0.3);
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
            padding: 6px 14px;
            border-radius: var(--radius-full);
            text-decoration: none !important;
            transition: all 0.2s ease;
            margin-top: 4px;
            margin-right: 6px;
        }

        .contact-link-pill:hover {
            background: var(--forest-800);
            color: #FFFFFF !important;
            border-color: var(--forest-800);
            transform: translateY(-1px);
        }

        .contact-link-pill svg { width: 13px; height: 13px; }

        /* ============================================================
           CARDS & SURFACES (All Solid White)
           ============================================================ */
        .card-luxury {
            background: #FFFFFF;
            border: 1px solid var(--border-base);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .card-luxury:hover {
            border-color: var(--border-dark);
            box-shadow: var(--shadow-float);
        }

        /* ============================================================
           ALERT & NOTIFICATIONS
           ============================================================ */
        .alert-luxury {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 20px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-base);
            background: #FFFFFF;
            font-size: 0.9rem;
            margin-bottom: 24px;
            box-shadow: var(--shadow-subtle);
        }

        .alert-luxury-success {
            border-color: #86EFAC;
            color: #166534;
            background: #F0FDF4;
        }

        .alert-luxury-error {
            border-color: #FECACA;
            color: #991B1B;
            background: #FEF2F2;
        }

        .alert-luxury svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ============================================================
           FOOTER (Solid White & Minimalist)
           ============================================================ */
        .site-footer {
            background: #FFFFFF;
            border-top: 1px solid var(--border-base);
            padding: 80px 0 40px;
            margin-top: 100px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 48px;
            margin-bottom: 60px;
        }

        .footer-brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .footer-brand-desc {
            font-size: 0.9375rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 380px;
        }

        .footer-col-title {
            font-size: 0.8125rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-heading);
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--text-heading);
        }

        .footer-bottom {
            padding-top: 32px;
            border-top: 1px solid var(--border-base);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8125rem;
            color: var(--text-faint);
            flex-wrap: wrap;
            gap: 16px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar-floating-container {
                top: 0;
                right: 0;
                left: 0;
                transform: none;
                max-width: none;
                width: 100%;
                padding: 4px 12px;
            }

            .navbar-floating-container.is-scrolled {
                top: 8px;
                padding: 0 12px;
            }

            .navbar-floating {
                padding: 4px 8px;
                justify-content: space-between;
            }

            .nav-item-link span {
                display: none;
            }

            .nav-brand span {
                display: none;
            }

            .site-content {
                padding-top: 80px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ============================================================
         FLOATING NAVBAR (Top Right with Magnetic Pill Indicator)
         ============================================================ --}}
    <div class="navbar-floating-container">
        <nav class="navbar-floating" id="floatingNav">
            <a href="{{ route('home') }}" class="nav-brand">
                <div class="nav-brand-logo" style="background: var(--forest-800);">
                    <i data-lucide="trees"></i>
                </div>
                <span>Lumina Pasific</span>
            </a>

            <div class="nav-links-track" id="navLinksTrack">
                {{-- Sliding Hover/Active Pill Indicator --}}
                <div class="nav-indicator-pill" id="navIndicator"></div>

                <a href="{{ route('home') }}"
                   class="nav-item-link {{ request()->routeIs('home') ? 'active' : '' }}"
                   data-nav="home">
                    <i data-lucide="home"></i>
                    <span>Beranda</span>
                </a>

                <a href="{{ route('tentang') }}"
                   class="nav-item-link {{ request()->routeIs('tentang') ? 'active' : '' }}"
                   data-nav="tentang">
                    <i data-lucide="info"></i>
                    <span>Tentang Kami</span>
                </a>

                <a href="{{ route('harga') }}"
                   class="nav-item-link {{ request()->routeIs('harga') ? 'active' : '' }}"
                   data-nav="harga">
                    <i data-lucide="sparkles"></i>
                    <span>Daftar Harga</span>
                </a>

                <a href="{{ route('riwayat') }}"
                   class="nav-item-link {{ request()->routeIs('riwayat') ? 'active' : '' }}"
                   data-nav="riwayat">
                    <i data-lucide="receipt"></i>
                    <span>Riwayat</span>
                </a>

                <a href="{{ route('pesan') }}"
                   class="nav-item-link nav-cta {{ request()->routeIs('pesan') ? 'active' : '' }}"
                   data-nav="pesan">
                    <i data-lucide="calendar-check"></i>
                    <span>Reservasi</span>
                </a>
            </div>
        </nav>
    </div>

    {{-- ============================================================
         MAIN CONTENT
         ============================================================ --}}
    <main class="site-content">
        @if(session('success'))
        <div class="container" data-aos="fade-down">
            <div class="alert-luxury alert-luxury-success">
                <i data-lucide="check-circle-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="container" data-aos="fade-down">
            <div class="alert-luxury alert-luxury-error">
                <i data-lucide="alert-triangle"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    {{-- ============================================================
         FOOTER (Solid White, Clean & Elegant)
         ============================================================ --}}
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-title">
                        <div class="nav-brand-logo" style="width:28px; height:28px; background:var(--forest-800);">
                            <i data-lucide="trees"></i>
                        </div>
                        Lumina Pasific &mdash; JWD Hotel Group
                    </div>
                    <p class="footer-brand-desc">
                        Menghadirkan standar keramahan bintang lima bernuansa alam dengan dedikasi penuh pada kenyamanan,
                        keasrian arsitektur kayu kontemporer, dan pengalaman gastronomi premium berstandar sertifikasi resmi.
                    </p>
                </div>

                <div>
                    <div class="footer-col-title">Navigasi Utama</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda &amp; Fasilitas</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('harga') }}">Daftar Harga</a></li>
                        <li><a href="{{ route('pesan') }}">Reservasi Kamar</a></li>
                        <li><a href="{{ route('riwayat') }}">Riwayat Pemesanan</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-col-title">Layanan Khusus</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}#ballroom">Grand Forest Ballroom</a></li>
                        <li><a href="{{ route('home') }}#fasilitas">Pine Heated Infinity Pool</a></li>
                        <li><a href="{{ route('tentang') }}#kuliner">Artisan Kitchen &amp; Chef</a></li>
                        <li><a href="{{ route('home') }}#ballroom">Pernikahan &amp; Acara Alam</a></li>
                        <li><a href="{{ route('tentang') }}#kontak">Layanan Concierge 24 Jam</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-col-title">Hubungi Kami</div>
                    <ul class="footer-links">
                        <li>
                            <strong style="color:var(--text-heading); font-size:0.875rem;">Resor Utama Lumina Pasific</strong><br>
                            Pine Hill Forest Area No. 88, Lembang, Jawa Barat
                        </li>
                        <li>
                            <strong style="color:var(--text-heading); font-size:0.875rem;">Telepon Reservasi</strong><br>
                            (021) 5555-1234 &nbsp;|&nbsp; +62 812-3456-7890
                        </li>
                        <li>
                            <strong style="color:var(--text-heading); font-size:0.875rem;">Email Resmi</strong><br>
                            reservasi@luminapasific.id
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    &copy; {{ date('Y') }} <strong>Lumina Pasific Hotel &amp; Resorts</strong> (JWD Group). Seluruh hak cipta dilindungi undang-undang.
                </div>
                <div style="display: flex; gap: 20px;">
                    <span>Sertifikasi Standar Resmi BNSP JWD</span>
                    <span>Kebijakan Privasi</span>
                    <span>Syarat &amp; Ketentuan</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Initialize Lucide Icons & AOS & Floating Navbar Indicator --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Initialize Lucide Icons
            lucide.createIcons();

            // 2. Dynamic Scroll Transition for Navbar (Attached initially -> Floating Island on scroll)
            const navContainer = document.querySelector('.navbar-floating-container');
            function updateNavScrollState() {
                if (!navContainer) return;
                if (window.scrollY > 20) {
                    navContainer.classList.add('is-scrolled');
                } else {
                    navContainer.classList.remove('is-scrolled');
                }
            }
            window.addEventListener('scroll', updateNavScrollState, { passive: true });
            updateNavScrollState();

            // 3. Sliding Indicator Pill in Floating Navbar
            const track = document.getElementById('navLinksTrack');
            const pill  = document.getElementById('navIndicator');
            const links = track.querySelectorAll('.nav-item-link:not(.nav-cta)');
            const activeLink = track.querySelector('.nav-item-link.active:not(.nav-cta)');

            function movePillTo(element) {
                if (!element || !pill) return;
                const trackRect = track.getBoundingClientRect();
                const elemRect  = element.getBoundingClientRect();

                const left  = elemRect.left - trackRect.left;
                const width = elemRect.width;

                pill.style.transform = `translateX(${left}px)`;
                pill.style.width     = `${width}px`;
                pill.style.opacity   = '1';
            }

            function resetPill() {
                if (activeLink) {
                    movePillTo(activeLink);
                } else {
                    pill.style.opacity = '0';
                }
            }

            links.forEach(link => {
                link.addEventListener('mouseenter', () => movePillTo(link));
            });

            track.addEventListener('mouseleave', resetPill);

            // Initial positioning
            resetPill();

            // 3. Animation On Scroll (AOS) using IntersectionObserver
            const animatedElements = document.querySelectorAll('[data-aos]');
            if ('IntersectionObserver' in window) {
                const aosObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('aos-animate');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                animatedElements.forEach(el => aosObserver.observe(el));
            } else {
                animatedElements.forEach(el => el.classList.add('aos-animate'));
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
