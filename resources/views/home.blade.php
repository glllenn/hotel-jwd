@extends('layouts.app')

@section('title', 'Lumina Pasific &mdash; Luxury Forest &amp; Nature Retreat')

@push('styles')
<style>
    /* ============================================================
       HERO BANNER — HEAVENSTEAD SPLIT ARCHITECTURAL CARD LAYOUT
       Inspired by clean editorial Scandinavian / Nature Resort design
       ============================================================ */
    .hero-heavenstead-section {
        min-height: calc(100vh - 86px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 8px 0 28px;
        background: #FFFFFF;
        box-sizing: border-box;
    }

    .hero-card-frame {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        box-shadow: 0 12px 36px -8px rgba(15, 23, 42, 0.07);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1.05fr 1fr;
        position: relative;
        height: calc(100vh - 138px);
        min-height: 520px;
        max-height: 590px;
    }

    /* Left Column: Vertical Nature Forest Photo */
    .hero-photo-container {
        position: relative;
        overflow: hidden;
        min-height: 360px;
        height: 100%;
        background: #142B21;
    }

    .hero-nature-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 35%;
        display: block;
        transform: none !important;
        transition: none !important;
    }

    .hero-photo-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0.04) 0%,
            rgba(18, 38, 28, 0.15) 50%,
            rgba(18, 38, 28, 0.45) 100%
        );
        pointer-events: none;
    }

    /* ============================================================
       HERO EDITORIAL STAT & REVIEW CARDS (In Right Column)
       ============================================================ */
    .hero-editorial-badges-row {
        display: grid;
        grid-template-columns: 1fr 1.35fr;
        gap: 10px;
        margin-top: 10px;
        margin-bottom: 8px;
    }

    .editorial-stat-card {
        background: #F8FAF9;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-lg);
        padding: 13px 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 102px;
        transition: all 0.25s ease;
    }

    .editorial-stat-card:hover {
        border-color: var(--forest-accent);
        background: #FFFFFF;
        box-shadow: none;
    }

    .stat-card-number {
        font-family: inherit;
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--forest-800);
        line-height: 1;
        letter-spacing: -0.03em;
        margin-bottom: 4px;
    }

    .stat-card-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 2px;
    }

    .stat-card-desc {
        font-size: 0.6875rem;
        color: var(--text-muted);
        line-height: 1.38;
        margin: 0;
    }

    .editorial-review-card {
        background: #F8FAF9;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-lg);
        padding: 13px 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 102px;
        position: relative;
        transition: all 0.25s ease;
    }

    .editorial-review-card:hover {
        border-color: var(--forest-accent);
        background: #FFFFFF;
        box-shadow: none;
    }

    .review-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .review-stars-minimal {
        color: #D97706;
        font-size: 0.75rem;
        letter-spacing: 2px;
    }

    .review-tag-pill {
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--forest-800);
        background: var(--forest-subtle);
        padding: 2px 7px;
        border-radius: var(--radius-full);
    }

    .editorial-reviews-slider {
        position: relative;
        height: 54px;
        overflow: hidden;
    }

    .review-slide-item {
        position: absolute;
        inset: 0;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.45s ease, transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: none;
    }

    .review-slide-item.active {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .review-quote {
        font-size: 0.75rem;
        color: var(--text-heading);
        line-height: 1.4;
        font-style: italic;
        margin: 0 0 2px 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .review-author {
        font-size: 0.6875rem;
        font-weight: 700;
        color: var(--forest-800);
        letter-spacing: 0.02em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Right Column: Editorial Minimalist Copy */
    .hero-editorial-col {
        padding: 24px 30px 14px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: #FFFFFF;
    }

    .hero-main-headline {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.05rem, 2.95vw, 3.05rem);
        font-weight: 700;
        color: var(--forest-900);
        line-height: 1.14;
        letter-spacing: -0.02em;
        margin-bottom: 12px;
        max-width: 580px;
    }

    .hero-sub-tagline {
        font-size: 0.85rem;
        color: var(--text-muted);
        line-height: 1.55;
        margin-bottom: 16px;
        max-width: 510px;
    }

    .hero-cta-buttons-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-forest-primary {
        background: var(--forest-800);
        color: #FFFFFF;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        box-shadow: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-forest-primary:hover {
        background: var(--forest-hover);
        color: #FFFFFF;
        transform: translateY(-1px);
        box-shadow: none;
    }

    .btn-forest-primary svg { width: 14px; height: 14px; }

    .btn-forest-ghost {
        background: transparent;
        color: var(--text-heading);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 7px 16px;
        border-radius: var(--radius-full);
        border: 1.5px solid var(--border-base);
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-forest-ghost:hover {
        border-color: var(--forest-800);
        color: var(--forest-800);
        background: var(--forest-subtle);
    }

    .btn-forest-ghost svg { width: 14px; height: 14px; }

    /* Bottom Control Bar of Heavenstead Hero */
    .hero-bottom-controls {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-top: 8px;
        margin-top: auto;
        border-top: 1px solid var(--border-base);
    }

    .hero-scroll-prompt {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-faint);
        text-decoration: none;
        transition: color 0.2s;
    }

    .hero-scroll-prompt:hover {
        color: var(--forest-800);
    }

    .hero-scroll-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 1px solid var(--border-base);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-scroll-circle svg { width: 12px; height: 12px; }

    /* ============================================================
       SECTION: KOLEKSI KAMAR (CAROUSEL SLIDER)
       ============================================================ */
    .section-rooms {
        padding: 80px 0;
        background: #FFFFFF;
    }

    .section-head-flex {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .carousel-container {
        position: relative;
        overflow: hidden;
    }

    .carousel-track {
        display: flex;
        gap: 24px;
        transition: transform 0.45s cubic-bezier(0.2, 0.8, 0.2, 1);
        will-change: transform;
    }

    .room-card-box {
        flex: 0 0 calc((100% - 48px) / 3);
        min-width: 320px;
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-xl);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-subtle);
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .room-card-box:hover {
        transform: translateY(-2px);
        border-color: var(--forest-border);
        box-shadow: var(--shadow-soft);
    }

    .room-thumb-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 16/11;
        overflow: hidden;
        background: var(--bg-subtle);
    }

    .room-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .room-card-box:hover .room-thumb {
        transform: scale(1.06);
    }

    .room-badge-top {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(18, 38, 28, 0.85);
        backdrop-filter: blur(8px);
        color: #FFFFFF;
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: var(--radius-full);
    }

    .room-card-content {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .room-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.28rem;
        font-weight: 700;
        color: var(--forest-900);
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .room-desc-text {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 16px;
        flex: 1;
    }

    .room-amenity-tags {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .amenity-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.6875rem;
        color: var(--text-muted);
        background: var(--bg-subtle);
        border: 1px solid var(--border-base);
        padding: 3px 8px;
        border-radius: var(--radius-sm);
    }

    .amenity-chip svg { width: 11px; height: 11px; }

    .room-price-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--border-base);
        margin-bottom: 16px;
    }

    .room-price-val {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--forest-800);
        letter-spacing: -0.02em;
    }

    .room-price-period {
        font-size: 0.75rem;
        color: var(--text-faint);
        font-weight: 500;
        margin-left: 2px;
    }

    .carousel-nav-arrows {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-arrow-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 1px solid var(--border-base);
        background: #FFFFFF;
        color: var(--text-heading);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-arrow-circle:hover:not(:disabled) {
        background: var(--forest-800);
        color: #FFFFFF;
        border-color: var(--forest-800);
    }

    .btn-arrow-circle:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .btn-arrow-circle svg { width: 18px; height: 18px; }

    /* ============================================================
       UNIFIED SECTION: FASILITAS & VIDEO EKSPLORASI (COMBINED & CLEAN)
       - Local video player replacing external YouTube
       - 4 curated nature retreat cards (Pine Pool, Spa, Lounge, Pavilion)
       - Subtle default blur (1.5px), crisp clarity on hover (0px blur)
       - Concise typography, no clutter
       ============================================================ */
    .section-facilities-video {
        padding: 80px 0 90px;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    /* Video Tour Showcase Container */
    .video-showcase-card {
        background: #FFFFFF;
        border: 1px solid var(--border-base);
        border-radius: var(--radius-2xl);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 0;
        margin-bottom: 60px;
    }

    .video-frame-col {
        position: relative;
        background: #000000;
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .native-hotel-video {
        width: 100%;
        height: 100%;
        max-height: 480px;
        object-fit: contain;
        display: block;
        background: #000000;
    }

    .video-editorial-col {
        padding: 44px 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: #FFFFFF;
    }

    .video-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--forest-800);
        background: var(--forest-subtle);
        border: 1px solid var(--forest-border);
        padding: 5px 14px;
        border-radius: var(--radius-full);
        width: fit-content;
        margin-bottom: 16px;
    }

    .video-room-headline {
        font-size: 1.625rem;
        font-weight: 800;
        color: var(--text-heading);
        letter-spacing: -0.02em;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .video-room-summary {
        font-size: 0.875rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .video-features-mini-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 28px;
    }

    .v-feature-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.78125rem;
        font-weight: 600;
        color: var(--text-heading);
        background: var(--bg-subtle);
        padding: 9px 12px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-base);
    }

    .v-feature-item svg {
        width: 14px;
        height: 14px;
        color: var(--forest-800);
        flex-shrink: 0;
    }

    .video-action-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 20px;
        border-top: 1px solid var(--border-base);
        margin-top: auto;
    }

    /* 4 Curated Facility Cards (Sleek, Nature Retreat, Subtle Blur Effect) */
    .nature-facilities-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .facility-nature-card {
        position: relative;
        border-radius: var(--radius-xl);
        overflow: hidden;
        border: 1px solid var(--border-base);
        box-shadow: var(--shadow-subtle);
        aspect-ratio: 4/5;
        background: #142B21;
        cursor: pointer;
    }

    /* Default: very subtle blur (1.5px), full color (NO B&W) */
    .facility-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        filter: blur(1.5px);
        transform: scale(1.01);
        transition: filter 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* On Hover: crystal clear and subtle smooth zoom */
    .facility-nature-card:hover .facility-card-img {
        filter: blur(0px);
        transform: scale(1.05);
    }

    .facility-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(18, 38, 28, 0.05) 0%,
            rgba(18, 38, 28, 0.35) 45%,
            rgba(18, 38, 28, 0.88) 100%
        );
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 22px;
        color: #FFFFFF;
        transition: background 0.35s ease;
    }

    .facility-nature-card:hover .facility-card-overlay {
        background: linear-gradient(
            180deg,
            rgba(18, 38, 28, 0.02) 0%,
            rgba(18, 38, 28, 0.25) 40%,
            rgba(18, 38, 28, 0.82) 100%
        );
    }

    .facility-title {
        font-size: 1.0625rem;
        font-weight: 800;
        color: #FFFFFF;
        letter-spacing: -0.015em;
        margin-bottom: 6px;
        line-height: 1.3;
    }

    .facility-subtitle {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.84);
        line-height: 1.45;
    }

    /* ============================================================
       SECTION: GRAND BALLROOM & MICE
       ============================================================ */
    .section-ballroom {
        padding: 80px 0;
        background: #FFFFFF;
        border-top: 1px solid var(--border-base);
    }

    .ballroom-grid-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 52px;
        align-items: center;
    }

    .ballroom-photo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .b-photo-item {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border-base);
        aspect-ratio: 4/3;
        box-shadow: var(--shadow-soft);
    }

    .b-photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .b-photo-item:hover img {
        transform: scale(1.05);
    }

    .b-photo-item.span-2 {
        grid-column: span 2;
        aspect-ratio: 16/9;
    }

    .ballroom-perks-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin: 28px 0 36px;
    }

    .b-perk-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .b-perk-icon {
        width: 38px;
        height: 38px;
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

    .b-perk-icon svg { width: 18px; height: 18px; }

    .b-perk-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-heading);
    }

    .b-perk-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.55;
    }

    /* ============================================================
       SECTION: PRE-FOOTER CTA (NATURE LUXURY RETREAT)
       ============================================================ */
    .section-nature-cta {
        padding: 50px 0 90px;
        background: #FFFFFF;
    }

    .nature-cta-card {
        background: #142B21;
        border-radius: var(--radius-2xl);
        padding: 56px 52px;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 36px;
        box-shadow: 0 16px 40px -10px rgba(18, 38, 28, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .nature-cta-title {
        font-size: clamp(1.75rem, 2.8vw, 2.35rem);
        font-weight: 800;
        color: #FFFFFF;
        letter-spacing: -0.03em;
        line-height: 1.22;
    }

    .nature-cta-sub {
        font-size: 0.9375rem;
        color: rgba(255, 255, 255, 0.78);
        margin-top: 10px;
        max-width: 540px;
        line-height: 1.65;
    }

    /* Pre-footer Luxury CTA Buttons */
    .btn-cta-light-solid {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #FFFFFF !important;
        color: #12261C !important;
        font-size: 0.9375rem;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: var(--radius-full);
        text-decoration: none !important;
        border: 2px solid #FFFFFF !important;
        box-shadow: none;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-cta-light-solid:hover {
        background: #E8F0EC !important;
        color: #0A1C14 !important;
        border-color: #E8F0EC !important;
        transform: translateY(-2px);
        box-shadow: none;
        text-decoration: none !important;
    }

    .btn-cta-light-solid svg {
        width: 17px;
        height: 17px;
        stroke: #12261C !important;
    }

    .btn-cta-light-outline {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.1) !important;
        color: #FFFFFF !important;
        font-size: 0.9375rem;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: var(--radius-full);
        text-decoration: none !important;
        border: 1.5px solid rgba(255, 255, 255, 0.4) !important;
        backdrop-filter: blur(8px);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-cta-light-outline:hover {
        background: rgba(255, 255, 255, 0.22) !important;
        color: #FFFFFF !important;
        border-color: #FFFFFF !important;
        transform: translateY(-2px);
        box-shadow: none;
        text-decoration: none !important;
    }

    .btn-cta-light-outline svg {
        width: 17px;
        height: 17px;
        stroke: #FFFFFF !important;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-card-frame { grid-template-columns: 1fr; }
        .hero-photo-container { min-height: 400px; }
        .hero-editorial-badges-row { grid-template-columns: 1fr 1fr; }
        .video-showcase-card { grid-template-columns: 1fr; }
        .nature-facilities-grid { grid-template-columns: repeat(2, 1fr); }
        .room-card-box { flex: 0 0 calc((100% - 24px) / 2); }
        .ballroom-grid-split { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .hero-editorial-col { padding: 36px 24px; }
        .hero-editorial-badges-row { grid-template-columns: 1fr; gap: 10px; margin-top: 18px; margin-bottom: 18px; }
        .nature-facilities-grid { grid-template-columns: 1fr; }
        .room-card-box { flex: 0 0 100%; }
        .nature-cta-card { flex-direction: column; align-items: flex-start; padding: 40px 24px; }
    }
</style>
@endpush

@section('content')

{{-- ================================================================
     HERO BANNER: HEAVENSTEAD ARCHITECTURAL SPLIT CARD
     Left: Clean Forest Cabin Photo
     Right: Minimalist Headline, CTA, 2 Editorial Badges (250+ & Reviews), Slider Indicator
     ================================================================ --}}
<section class="hero-heavenstead-section">
    <div class="container">
        <div class="hero-card-frame" data-aos="fade-up">

            {{-- Left Column: User Forest Cabin Photo --}}
            <div class="hero-photo-container">
                <img
                    class="hero-nature-img"
                    src="{{ asset('images/hero-forest.jpg') }}"
                    alt="Lumina Pasific Luxury Forest Retreat"
                    loading="eager">

                <div class="hero-photo-gradient"></div>
            </div>

            {{-- Right Column: Editorial Copy & Minimalist Navigation --}}
            <div class="hero-editorial-col">
                <div>
                    <h1 class="hero-main-headline">
                        Kenyamanan Autentik di Harmoni Keasrian Alam
                    </h1>

                    <p class="hero-sub-tagline">
                        Nikmati kemewahan peristirahatan kabin kayu kontemporer di tengah keheningan hutan pinus alami.
                        Suasana damai nan privat yang berpadu selaras dengan keramahan berstandar sertifikasi resmi.
                    </p>

                    <div class="hero-cta-buttons-row">
                        <a href="{{ route('pesan') }}" class="btn-forest-primary">
                            <i data-lucide="calendar-check"></i>
                            Reservasi Kamar
                        </a>
                        <a href="#fasilitas" class="btn-forest-ghost">
                            <i data-lucide="compass"></i>
                            Jelajahi Fasilitas
                        </a>
                    </div>

                    {{-- 2 Editorial Badges: 250+ Tamu & Clean Auto-Rotating Reviews --}}
                    <div class="hero-editorial-badges-row">
                        {{-- Card 1: 250+ Satisfied Guests --}}
                        <div class="editorial-stat-card">
                            <div class="stat-card-number">250+</div>
                            <div class="stat-card-label">Tamu Terpuaskan</div>
                            <p class="stat-card-desc">Dedikasi keheningan alami dan relaksasi paripurna di setiap kunjungan Anda.</p>
                        </div>

                        {{-- Card 2: Minimalist Auto-Rotating Reviews (No avatar, clean star & text + author) --}}
                        <div class="editorial-review-card">
                            <div class="review-card-header">
                                <span class="review-stars-minimal">★★★★★</span>
                                <span class="review-tag-pill">Ulasan Tamu</span>
                            </div>

                            <div class="editorial-reviews-slider" id="reviewsAutoSlider">
                                <div class="review-slide-item active" data-slide="0">
                                    <p class="review-quote">"Keheningan hutan pinus dan aroma kayu alami membuat istirahat saya begitu tenang."</p>
                                    <div class="review-author">Glenn Marcel &bull; Tamu Deluxe Suite</div>
                                </div>
                                <div class="review-slide-item" data-slide="1">
                                    <p class="review-quote">"Arsitektur kabin modern terbaik dengan sarapan prasmanan organik yang sangat lezat."</p>
                                    <div class="review-author">Amanda S. &bull; Tamu Family Suite</div>
                                </div>
                                <div class="review-slide-item" data-slide="2">
                                    <p class="review-quote">"Pelayanan bintang lima dengan panorama kolam renang air hangat berkabut yang syahdu."</p>
                                    <div class="review-author">Rian Pratama &bull; Tamu Family Suite</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bottom Heavenstead Bar (Scroll Eksplorasi) --}}
                <div class="hero-bottom-controls">
                    <a href="#kamar" class="hero-scroll-prompt">
                        <span class="hero-scroll-circle">
                            <i data-lucide="arrow-down"></i>
                        </span>
                        <span>Scroll Eksplorasi</span>
                    </a>
                </div>

            </div>{{-- /hero-editorial-col --}}
        </div>{{-- /hero-card-frame --}}
    </div>
</section>

{{-- ================================================================
     SECTION: KOLEKSI PILIHAN KAMAR (CAROUSEL SLIDER)
     ================================================================ --}}
<section class="section-rooms" id="kamar">
    <div class="container">
        <div class="section-head-flex" data-aos="fade-up">
            <div>
                <h2 class="section-heading">Koleksi Pilihan Kamar</h2>
                <p class="section-subheading">
                    Dirancang dengan estetika minimalis monokromatik netral yang menenangkan, kasur berstandar internasional,
                    serta privasi maksimal untuk istirahat berkualitas Anda.
                </p>
            </div>

            <div class="carousel-nav-arrows">
                <button class="btn-arrow-circle" id="roomsPrev" aria-label="Kamar Sebelumnya" disabled>
                    <i data-lucide="chevron-left"></i>
                </button>
                <button class="btn-arrow-circle" id="roomsNext" aria-label="Kamar Berikutnya">
                    <i data-lucide="chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="carousel-container" id="roomsCarouselWrapper" data-aos="fade-up" data-aos-delay="150">
            <div class="carousel-track" id="roomsTrack">

                {{-- Card 1: Standar --}}
                <div class="room-card-box">
                    <div class="room-thumb-wrap">
                        <img class="room-thumb"
                            src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80"
                            alt="Kamar Standar Lumina Pasific"
                            loading="lazy">
                        <span class="room-badge-top">Standar</span>
                    </div>
                    <div class="room-card-content">
                        <h3 class="room-title">Kamar Standar</h3>
                        <p class="room-desc-text">
                            Kenyamanan esensial yang tenang dengan tempat tidur queen-size dan area kerja ergonomis untuk perjalanan istirahat Anda.
                        </p>
                        <div class="room-amenity-tags">
                            <span class="amenity-chip"><i data-lucide="wifi"></i> WiFi Cepat</span>
                            <span class="amenity-chip"><i data-lucide="tv"></i> Smart TV</span>
                            <span class="amenity-chip"><i data-lucide="wind"></i> AC Dingin</span>
                        </div>
                        <div class="room-price-row">
                            <div>
                                <span class="room-price-val">Rp 350.000</span>
                                <span class="room-price-period">/malam</span>
                            </div>
                            <span style="font-size:0.75rem; color:var(--text-faint);">2 Tamu</span>
                        </div>
                        <a href="{{ route('pesan', ['tipe' => 'Standar']) }}" class="btn-luxury btn-luxury-secondary btn-luxury-sm" style="width: 100%;">
                            <i data-lucide="calendar-check"></i>
                            Pesan Kamar Ini
                        </a>
                    </div>
                </div>

                {{-- Card 2: Deluxe --}}
                <div class="room-card-box">
                    <div class="room-thumb-wrap">
                        <img class="room-thumb"
                            src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80"
                            alt="Kamar Deluxe Lumina Pasific"
                            loading="lazy">
                        <span class="room-badge-top" style="background:var(--forest-800);">Terpopuler</span>
                    </div>
                    <div class="room-card-content">
                        <h3 class="room-title">Kamar Deluxe</h3>
                        <p class="room-desc-text">
                            Kamar lapang dengan pemandangan rimbun hutan pinus, bathtub marmer freestanding, dan mesin kopi espresso kapsul.
                        </p>
                        <div class="room-amenity-tags">
                            <span class="amenity-chip"><i data-lucide="bath"></i> Bathtub Marmer</span>
                            <span class="amenity-chip"><i data-lucide="coffee"></i> Espresso Bar</span>
                            <span class="amenity-chip"><i data-lucide="trees"></i> Forest View</span>
                        </div>
                        <div class="room-price-row">
                            <div>
                                <span class="room-price-val">Rp 550.000</span>
                                <span class="room-price-period">/malam</span>
                            </div>
                            <span style="font-size:0.75rem; color:var(--text-faint);">2 Tamu</span>
                        </div>
                        <a href="{{ route('pesan', ['tipe' => 'Deluxe']) }}" class="btn-luxury btn-luxury-secondary btn-luxury-sm" style="width: 100%;">
                            <i data-lucide="calendar-check"></i>
                            Pesan Kamar Ini
                        </a>
                    </div>
                </div>

                {{-- Card 3: Family Suite --}}
                <div class="room-card-box">
                    <div class="room-thumb-wrap">
                        <img class="room-thumb"
                            src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=700&q=80"
                            alt="Family Suite Lumina Pasific"
                            loading="lazy">
                        <span class="room-badge-top">Pilihan Keluarga</span>
                    </div>
                    <div class="room-card-content">
                        <h3 class="room-title">Family Suite</h3>
                        <p class="room-desc-text">
                            Kenyamanan luas bersama keluarga tercinta dengan 2 kamar tidur terpisah, ruang makan, mini pantry, dan balkon panorama alam.
                        </p>
                        <div class="room-amenity-tags">
                            <span class="amenity-chip"><i data-lucide="bed-double"></i> 2 Kamar Tidur</span>
                            <span class="amenity-chip"><i data-lucide="utensils"></i> Mini Pantry</span>
                            <span class="amenity-chip"><i data-lucide="trees"></i> Balkon Alam</span>
                        </div>
                        <div class="room-price-row">
                            <div>
                                <span class="room-price-val">Rp 1.200.000</span>
                                <span class="room-price-period">/malam</span>
                            </div>
                            <span style="font-size:0.75rem; color:var(--text-faint);">4-6 Tamu</span>
                        </div>
                        <a href="{{ route('pesan', ['tipe' => 'Family Suite']) }}" class="btn-luxury btn-luxury-secondary btn-luxury-sm" style="width: 100%;">
                            <i data-lucide="calendar-check"></i>
                            Pesan Kamar Ini
                        </a>
                    </div>
                </div>

            </div>{{-- /carousel-track --}}
        </div>
    </div>
</section>

{{-- ================================================================
     UNIFIED SECTION: FASILITAS & VIDEO EKSPLORASI
     User requested: Do not separate video and facilities; merge them.
     - Native HTML5 video player using local uploaded video (asset videos/hotel-tour.mp4)
     - 4 Curated Nature Retreat Facility Cards (Pine Pool, Spa, Lounge, Pavilion)
     - Subtle default blur (1.5px), crisp clarity on hover (0px blur)
     - No clutter, perfectly matched nature aesthetic
     ================================================================ --}}
<section class="section-facilities-video" id="fasilitas">
    <div class="container">
        {{-- Section Header --}}
        <div data-aos="fade-up" style="display:flex; align-items:flex-end; justify-content:space-between; gap:20px; flex-wrap:wrap; margin-bottom: 36px;">
            <div>
                <h2 class="section-heading">Fasilitas &amp; Video Eksplorasi</h2>
                <p class="section-subheading">
                    Saksikan video tur pratinjau kamar dan jelajahi fasilitas relaksasi bintang lima yang menyatu harmonis dengan keindahan hutan alam.
                </p>
            </div>
            <div style="font-size: 0.8125rem; font-weight: 700; color: var(--forest-800); background: var(--forest-subtle); padding: 8px 18px; border-radius: var(--radius-full); border: 1px solid var(--forest-border); display:inline-flex; align-items:center; gap:6px;">
                <i data-lucide="film" style="width:14px; height:14px;"></i>
                Pratinjau Video Resmi &bull; Sertifikasi BNSP
            </div>
        </div>

        {{-- 1. Video Showcase Card (Local HTML5 Video Player) --}}
        <div class="video-showcase-card" data-aos="fade-up">
            <div class="video-frame-col">
                <video
                    id="hotelTourVideoPlayer"
                    class="native-hotel-video"
                    muted
                    playsinline
                    loop
                    controls
                    preload="auto">
                    <source src="{{ asset('videos/hotel-tour.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                </video>
            </div>

            <div class="video-editorial-col">
                <div>
                    <h3 class="video-room-headline">
                        Eksplorasi Suasana Autentik Lumina Pasific
                    </h3>
                    <p class="video-room-summary">
                        Setiap ruangan dirancang dengan material kayu hangat berkelas, jendela panorama hutan terbuka,
                        dan insulasi kedap suara agar momen istirahat Anda benar-benar damai dan mendalam.
                    </p>

                    <div class="video-features-mini-grid">
                        <div class="v-feature-item">
                            <i data-lucide="trees"></i>
                            <span>Panorama Hutan Pinus</span>
                        </div>
                        <div class="v-feature-item">
                            <i data-lucide="volume-x"></i>
                            <span>Akustik Kedap Suara</span>
                        </div>
                        <div class="v-feature-item">
                            <i data-lucide="wifi"></i>
                            <span>WiFi Serat Optik 100Mbps</span>
                        </div>
                        <div class="v-feature-item">
                            <i data-lucide="shield-check"></i>
                            <span>Sertifikasi Bintang 5</span>
                        </div>
                    </div>
                </div>

                <div class="video-action-footer">
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-faint); display:block;">Tarif Menginap Mulai</span>
                        <span style="font-size:1.375rem; font-weight:800; color:var(--forest-800);">Rp 350.000</span>
                        <span style="font-size:0.75rem; color:var(--text-muted);">/malam</span>
                    </div>
                    <a href="{{ route('pesan') }}" class="btn-forest-primary">
                        <i data-lucide="calendar-check"></i>
                        Pesan Kamar Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. 4 Curated Nature Retreat Facility Cards --}}
        <div class="nature-facilities-grid" data-aos="fade-up" data-aos-delay="150">

            {{-- 1. Pine Forest Heated Pool --}}
            <div class="facility-nature-card">
                <img
                    class="facility-card-img"
                    src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?w=800&q=80"
                    alt="Pine Forest Heated Pool"
                    loading="lazy">
                <div class="facility-card-overlay">
                    <h4 class="facility-title">Pine Heated Infinity Pool</h4>
                    <p class="facility-subtitle">Kolam renang air hangat di tepi tebing hutan pinus berkabut untuk relaksasi tubuh.</p>
                </div>
            </div>

            {{-- 2. Sanctuary Herbal Spa --}}
            <div class="facility-nature-card">
                <img
                    class="facility-card-img"
                    src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&q=80"
                    alt="Sanctuary Herbal Spa"
                    loading="lazy">
                <div class="facility-card-overlay">
                    <h4 class="facility-title">Sanctuary Herbal Spa</h4>
                    <p class="facility-subtitle">Terapi relaksasi alami dengan minyak aromaterapi pinus dan batu mineral hangat.</p>
                </div>
            </div>

            {{-- 3. Artisan Wood & Hearth Lounge --}}
            <div class="facility-nature-card">
                <img
                    class="facility-card-img"
                    src="https://images.unsplash.com/photo-1507652313519-d4e9174996dd?w=800&q=80"
                    alt="Artisan Wood & Hearth Lounge"
                    loading="lazy">
                <div class="facility-card-overlay">
                    <h4 class="facility-title">Artisan Hearth Lounge</h4>
                    <p class="facility-subtitle">Ruang santai perapian kayu dengan seduhan kopi arabika lokal dan wine pilihan.</p>
                </div>
            </div>

            {{-- 4. Forest Botanica Pavilion --}}
            <div class="facility-nature-card">
                <img
                    class="facility-card-img"
                    src="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=800&q=80"
                    alt="Forest Botanica Pavilion"
                    loading="lazy">
                <div class="facility-card-overlay">
                    <h4 class="facility-title">Botanica Glass Pavilion</h4>
                    <p class="facility-subtitle">Paviliun kaca semi-outdoor untuk yoga pagi, sarapan santai, dan jamuan privat.</p>
                </div>
            </div>

        </div>{{-- /nature-facilities-grid --}}
    </div>
</section>

{{-- ================================================================
     SECTION: GRAND BALLROOM & MICE
     ================================================================ --}}
<section class="section-ballroom" id="ballroom">
    <div class="container">
        <div class="ballroom-grid-split">
            <div data-aos="fade-up">
                <h2 class="section-heading">Grand Forest Ballroom &amp; Ruang Acara</h2>
                <p class="section-subheading">
                    Abadikan perayaan terindah dalam hidup Anda. Lumina Pasific menyediakan ruang perjamuan berteknologi akustik canggih
                    dan pemandangan alam spektakuler untuk resepsi pernikahan impian, pesta perayaan, maupun konferensi bergengsi.
                </p>

                <div class="ballroom-perks-list">
                    <div class="b-perk-row">
                        <div class="b-perk-icon">
                            <i data-lucide="heart"></i>
                        </div>
                        <div>
                            <div class="b-perk-title">Paket Pernikahan Alam (Forest Wedding)</div>
                            <div class="b-perk-desc">Termasuk dekorasi bunga segar alami, sound system konser, kamar suite pengantin gratis, dan jamuan prasmanan 7 menu.</div>
                        </div>
                    </div>

                    <div class="b-perk-row">
                        <div class="b-perk-icon">
                            <i data-lucide="cake"></i>
                        </div>
                        <div>
                            <div class="b-perk-title">Perayaan Ulang Tahun &amp; Gala Dinner</div>
                            <div class="b-perk-desc">Ruangan fleksibel berdaya tampung hingga 1.200 undangan dengan kustomisasi tata cahaya cerdas bernuansa hangat.</div>
                        </div>
                    </div>

                    <div class="b-perk-row">
                        <div class="b-perk-icon">
                            <i data-lucide="users"></i>
                        </div>
                        <div>
                            <div class="b-perk-title">Tim Event Planner &amp; Concierge Berdedikasi</div>
                            <div class="b-perk-desc">Konsultan acara profesional yang memastikan setiap susunan acara berjalan lancar dari perencanaan hingga pelaksanaan.</div>
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('tentang') }}#kontak" class="btn-forest-primary">
                        <i data-lucide="phone-call"></i>
                        Konsultasi Acara &amp; Ballroom
                    </a>
                    <a href="{{ route('pesan') }}" class="btn-forest-ghost">
                        <i data-lucide="calendar"></i>
                        Reservasi Kamar Tamu
                    </a>
                </div>
            </div>

            <div class="ballroom-photo-grid" data-aos="fade-in" data-aos-delay="200">
                <div class="b-photo-item span-2">
                    <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&q=80" alt="Resepsi Ballroom Pernikahan" loading="lazy">
                </div>
                <div class="b-photo-item">
                    <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=500&q=80" alt="Jamuan Makan Malam Perayaan" loading="lazy">
                </div>
                <div class="b-photo-item">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500&q=80" alt="Dekorasi Meja Elegan" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     SECTION: PRE-FOOTER CTA (NATURE LUXURY RETREAT)
     Clean, Elegant, High-End Forest Atmosphere
     ================================================================ --}}
<section class="section-nature-cta">
    <div class="container">
        <div class="nature-cta-card" data-aos="fade-up">
            <div style="position:relative; z-index:2;">
                <div style="font-size:0.75rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--forest-border); margin-bottom:8px;">
                    Peristirahatan Terbaik di Alam
                </div>
                <h2 class="nature-cta-title">
                    Mulai Liburan Bernuansa Keasrian Bersama Lumina Pasific
                </h2>
                <p class="nature-cta-sub">
                    Pilih tanggal menginap Anda sekarang dan nikmati diskon otomatis 10% untuk masa inap lebih dari 3 hari,
                    lengkap dengan sarapan buffet prasmanan segar dari dapur artisan kami.
                </p>
            </div>

            <div style="position:relative; z-index:2; display:flex; gap:14px; flex-shrink:0; flex-wrap:wrap; align-items:center;">
                <a href="{{ route('pesan') }}" class="btn-cta-light-solid">
                    <i data-lucide="calendar-check"></i>
                    <span>Reservasi Kamar</span>
                </a>
                <a href="{{ route('harga') }}" class="btn-cta-light-outline">
                    <i data-lucide="sparkles"></i>
                    <span>Koleksi &amp; Pilihan Tarif</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // 1. Auto-Rotating Reviews Inside Box 2 (stays fixed inside box)
    const reviewSlider = document.getElementById('reviewsAutoSlider');
    if (reviewSlider) {
        const slides = reviewSlider.querySelectorAll('.review-slide-item');
        let currentReview = 0;

        function showNextReview() {
            slides[currentReview].classList.remove('active');
            currentReview = (currentReview + 1) % slides.length;
            slides[currentReview].classList.add('active');
        }

        // Auto rotate every 3.5 seconds
        setInterval(showNextReview, 3500);
    }

    // 2. Rooms Carousel Slider
    const track   = document.getElementById('roomsTrack');
    const prevBtn = document.getElementById('roomsPrev');
    const nextBtn = document.getElementById('roomsNext');

    if (track && prevBtn && nextBtn) {
        const cards = track.querySelectorAll('.room-card-box');
        let currentIndex = 0;

        function getVisibleCount() {
            const width = track.parentElement.clientWidth;
            if (width < 640) return 1;
            if (width < 1024) return 2;
            return 3;
        }

        function getMaxIndex() {
            return Math.max(0, cards.length - getVisibleCount());
        }

        function getStepWidth() {
            if (cards.length === 0) return 0;
            return cards[0].offsetWidth + 24;
        }

        function updateSlider() {
            const maxIdx = getMaxIndex();
            currentIndex = Math.max(0, Math.min(currentIndex, maxIdx));
            track.style.transform = `translateX(-${currentIndex * getStepWidth()}px)`;
            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= maxIdx;
        }

        prevBtn.addEventListener('click', () => {
            currentIndex--;
            updateSlider();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex++;
            updateSlider();
        });

        window.addEventListener('resize', () => {
            setTimeout(updateSlider, 150);
        });

        updateSlider();
    }

    // 3. Mini Arrows in Hero bottom controls
    const heroPrev = document.getElementById('heroPrevBtn');
    const heroNext = document.getElementById('heroNextBtn');
    if (heroPrev && heroNext && prevBtn && nextBtn) {
        heroPrev.addEventListener('click', () => {
            prevBtn.click();
        });
        heroNext.addEventListener('click', () => {
            nextBtn.click();
        });
    }

    // 4. Video Tour Auto-Play on Scroll into View (No Manual Click Needed)
    const hotelVideo = document.getElementById('hotelTourVideoPlayer');
    if (hotelVideo && 'IntersectionObserver' in window) {
        const videoObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const playPromise = hotelVideo.play();
                    if (playPromise !== undefined) {
                        playPromise.catch(() => {
                            // Autoplay was prevented by browser policy if unmuted
                        });
                    }
                } else {
                    hotelVideo.pause();
                }
            });
        }, { threshold: 0.25 });
        videoObserver.observe(hotelVideo);
    }

})();
</script>
@endpush
