<?php
    $title = "Domestic Destinations | Delvia Holidays International";
    $description = "Explore top domestic destinations with Delvia Holidays International. Book luxury resorts, hotels, and holiday stays for stress-free vacations across India.";

    include 'header.php';
?>

<style>
/* =========================================================
   DELVIA DESTINATIONS - PREMIUM USER FRIENDLY DESIGN
   ========================================================= */

:root {
    --dest-primary: #18B8A7;
    --dest-primary-dark: #0d9d90;
    --dest-primary-light: #e9faf8;
    --dest-secondary: #F4A261;
    --dest-gold: #F7C62B;
    --dest-white: #ffffff;
    --dest-bg: #f7fafb;
    --dest-heading: #17212b;
    --dest-text: #667085;
    --dest-muted: #98a2b3;
    --dest-border: #e6e9ed;
    --dest-shadow-sm: 0 3px 12px rgba(15, 23, 42, .05);
    --dest-shadow: 0 10px 30px rgba(15, 23, 42, .08);
    --dest-shadow-lg: 0 22px 55px rgba(15, 23, 42, .13);
    --dest-radius: 20px;
    --dest-radius-lg: 28px;
    --dest-transition: .35s cubic-bezier(.4, 0, .2, 1);
}

/* =========================================================
   PAGE
   ========================================================= */
.destinations-page {
    position: relative;
    background:
        radial-gradient(circle at 5% 10%, rgba(24,184,167,.07), transparent 25%),
        radial-gradient(circle at 95% 45%, rgba(244,162,97,.07), transparent 25%),
        var(--dest-bg);
    padding: 70px 0 90px;
    overflow: hidden;
}

/* =========================================================
   HERO
   ========================================================= */
.destination-hero {
    position: relative;
    min-height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background:
        linear-gradient(135deg, rgba(6, 74, 68, .88), rgba(24, 184, 167, .72)),
        url("https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=85&w=2070&auto=format&fit=crop")
        center center / cover no-repeat;
    overflow: hidden;
}

.destination-hero::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    right: -180px;
    top: -220px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
}

.destination-hero::after {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    left: -150px;
    bottom: -180px;
    border-radius: 50%;
    background: rgba(255,255,255,.07);
}

.destination-hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    padding: 70px 20px;
}

.destination-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 17px;
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 50px;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
    margin-bottom: 20px;
}

.destination-eyebrow i {
    color: var(--dest-gold);
}

.destination-hero h1 {
    margin: 0 0 18px;
    color: #fff;
    font-family: 'Jost', 'Poppins', sans-serif;
    font-size: clamp(38px, 6vw, 68px);
    line-height: 1.05;
    font-weight: 800;
    letter-spacing: -2px;
}

.destination-hero h1 span {
    color: #d9fffa;
}

.destination-hero p {
    max-width: 680px;
    margin: 0 auto 28px;
    color: rgba(255,255,255,.9);
    font-size: 17px;
    line-height: 1.8;
}

/* =========================================================
   HERO BREADCRUMB
   ========================================================= */
.destination-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 50px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(10px);
    color: rgba(255,255,255,.9);
    font-size: 13px;
}

.destination-breadcrumb a {
    color: #fff;
    text-decoration: none;
}

.destination-breadcrumb i {
    font-size: 10px;
    opacity: .7;
}

/* =========================================================
   FLOATING SEARCH PANEL
   ========================================================= */
.destination-search-panel {
    position: relative;
    z-index: 5;
    max-width: 1120px;
    margin: -42px auto 55px;
    padding: 22px;
    background: rgba(255,255,255,.96);
    border: 1px solid rgba(255,255,255,.8);
    border-radius: var(--dest-radius-lg);
    box-shadow: var(--dest-shadow-lg);
    backdrop-filter: blur(15px);
}

.destination-search-inner {
    display: flex;
    align-items: center;
    gap: 15px;
}

.destination-search-box {
    flex: 1;
    position: relative;
}

.destination-search-box i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--dest-primary);
    font-size: 16px;
}

.destination-search-box input {
    width: 100%;
    height: 52px;
    border: 1px solid var(--dest-border);
    border-radius: 14px;
    padding: 0 18px 0 48px;
    outline: none;
    color: var(--dest-heading);
    font-size: 14px;
    background: #fbfcfc;
    transition: var(--dest-transition);
}

.destination-search-box input:focus {
    border-color: var(--dest-primary);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(24,184,167,.09);
}

.destination-search-info {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 0 18px;
    min-height: 52px;
    border-radius: 14px;
    background: var(--dest-primary-light);
    color: var(--dest-primary-dark);
    white-space: nowrap;
    font-size: 13px;
    font-weight: 700;
}

.destination-search-info i {
    font-size: 16px;
}

/* =========================================================
   SECTION INTRO
   ========================================================= */
.destination-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 25px;
    margin-bottom: 30px;
}

.destination-section-title {
    max-width: 700px;
}

.destination-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 10px;
    color: var(--dest-primary-dark);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.destination-label::before {
    content: "";
    width: 28px;
    height: 3px;
    background: linear-gradient(90deg, var(--dest-primary), var(--dest-secondary));
    border-radius: 20px;
}

.destination-section-title h2 {
    margin: 0 0 8px;
    color: var(--dest-heading);
    font-family: 'Jost', 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 40px);
    font-weight: 800;
    letter-spacing: -1px;
}

.destination-section-title h2 span {
    color: var(--dest-primary);
}

.destination-section-title p {
    margin: 0;
    color: var(--dest-text);
    font-size: 14px;
    line-height: 1.7;
}

/* =========================================================
   MOBILE FILTER BUTTON
   ========================================================= */
.mobile-filter-btn {
    display: none;
    width: 100%;
    border: none;
    background: linear-gradient(135deg, var(--dest-primary), var(--dest-primary-dark));
    color: #fff;
    padding: 13px 18px;
    border-radius: 14px;
    font-weight: 700;
    margin-bottom: 20px;
    box-shadow: 0 7px 20px rgba(24,184,167,.25);
}

/* =========================================================
   FILTER SIDEBAR
   ========================================================= */
.filter-sidebar {
    position: sticky;
    top: 95px;
    background: #fff;
    border: 1px solid var(--dest-border);
    border-radius: var(--dest-radius);
    padding: 23px;
    box-shadow: var(--dest-shadow-sm);
}

.filter-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 18px;
    margin-bottom: 17px;
    border-bottom: 1px solid var(--dest-border);
}

.filter-title {
    display: flex;
    align-items: center;
    gap: 9px;
    margin: 0;
    color: var(--dest-heading);
    font-size: 17px;
    font-weight: 800;
}

.filter-title i {
    color: var(--dest-primary);
}

.filter-reset {
    border: none;
    background: transparent;
    color: var(--dest-primary);
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}

.filter-subtitle {
    color: var(--dest-muted);
    font-size: 12px;
    margin-bottom: 15px;
}

/* =========================================================
   FILTER LIST (PILL STYLE)
   ========================================================= */
.filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.filter-list li {
    margin-bottom: 9px;
}

.city-filter-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 14px;
    border: 1px solid var(--dest-border);
    border-radius: 30px;
    cursor: pointer;
    transition: var(--dest-transition);
    background: #fff;
}

.city-filter-label:hover {
    background: var(--dest-primary-light);
    border-color: rgba(24,184,167,.2);
}

.city-filter-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.city-filter-left input {
    width: 17px;
    height: 17px;
    accent-color: var(--dest-primary);
    cursor: pointer;
}

.city-filter-left span {
    color: var(--dest-text);
    font-size: 13px;
    font-weight: 600;
}

.city-filter-icon {
    color: var(--dest-muted);
    font-size: 12px;
}

.city-filter-label:has(input:checked) {
    background: var(--dest-primary);
    border-color: var(--dest-primary);
}

.city-filter-label:has(input:checked) .city-filter-left span {
    color: #fff;
}

.city-filter-label:has(input:checked) .city-filter-icon {
    color: rgba(255,255,255,.8);
}

/* =========================================================
   DESTINATION GRID
   ========================================================= */
.destination-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 25px;
}

/* =========================================================
   DESTINATION CARD (IMPROVED)
   ========================================================= */
.destination-card {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    background: #fff;
    border: 1px solid var(--dest-border);
    border-radius: 22px;
    box-shadow: var(--dest-shadow-sm);
    transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 0.4s cubic-bezier(0.22, 1, 0.36, 1),
                border-color 0.3s ease;
}

.destination-card:hover {
    transform: translateY(-10px) scale(1.01);
    border-color: rgba(24, 184, 167, 0.4);
    box-shadow: 0 30px 60px rgba(15, 23, 42, 0.16);
}

/* Image */
.destination-card-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    background: #edf2f2;
}

.destination-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.7s cubic-bezier(.25,.46,.45,.94), filter 0.5s ease;
}

.destination-card:hover .destination-card-image img {
    transform: scale(1.09);
    filter: brightness(.82);
}

.destination-card-image::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.1) 0%,
        rgba(0,0,0,0) 40%,
        rgba(0,0,0,0.7) 100%
    );
    pointer-events: none;
}

/* Badges container */
.destination-badges {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 3;
    display: flex;
    gap: 8px;
}

.destination-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 12px;
    border-radius: 50px;
    font-size: 10px;
    font-weight: 800;
    backdrop-filter: blur(8px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.destination-badge.premium {
    background: rgba(255,255,255,0.95);
    color: var(--dest-primary-dark);
}

.destination-badge.premium i {
    color: var(--dest-primary);
}

.destination-badge.popular {
    background: rgba(247, 198, 43, 0.95);
    color: #7a5c00;
}

.destination-badge.popular i {
    color: #d97706;
}

/* Location */
.destination-location {
    position: absolute;
    z-index: 3;
    left: 18px;
    bottom: 17px;
    display: flex;
    align-items: center;
    gap: 7px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
}

.destination-location i {
    color: var(--dest-gold);
}

/* Card content */
.destination-card-content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 21px;
}

.destination-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 8px;
}

.destination-card-title {
    margin: 0;
    flex: 1;
    color: var(--dest-heading);
    font-family: 'Jost', 'Poppins', sans-serif;
    font-size: 21px;
    line-height: 1.2;
    font-weight: 800;
    transition: color var(--dest-transition);
}

.destination-card:hover .destination-card-title {
    color: var(--dest-primary-dark);
}

.destination-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    background: #fff8e5;
    padding: 4px 8px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    color: #b45309;
    white-space: nowrap;
}

.destination-rating i {
    color: var(--dest-gold);
}

.destination-rating small {
    color: var(--dest-muted);
    font-weight: 500;
}

.destination-description {
    margin: 0 0 14px;
    color: var(--dest-text);
    font-size: 13px;
    line-height: 1.6;
}

/* Features */
.destination-features {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 6px;
    padding: 14px 0;
    border-top: 1px solid var(--dest-border);
    border-bottom: 1px solid var(--dest-border);
    margin-bottom: 16px;
}

.destination-feature {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 66px;
    padding: 7px 3px;
    border-radius: 10px;
    transition: var(--dest-transition);
}

.destination-feature:hover {
    background: var(--dest-primary-light);
}

.destination-feature img {
    width: 28px;
    height: 28px;
    object-fit: contain;
    margin-bottom: 6px;
}

.destination-feature span {
    color: var(--dest-text);
    font-size: 9px;
    font-weight: 700;
    text-align: center;
    line-height: 1.2;
}

/* Footer */
.destination-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: auto;
}

.destination-price {
    display: flex;
    align-items: baseline;
    gap: 4px;
    flex-wrap: wrap;
}

.price-label {
    font-size: 10px;
    color: var(--dest-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.price-amount {
    font-size: 20px;
    font-weight: 800;
    color: var(--dest-heading);
}

.price-per {
    font-size: 11px;
    color: var(--dest-muted);
}

/* Button */
.destination-view-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 18px;
    border-radius: 50px;
    background: linear-gradient(135deg, var(--dest-primary), var(--dest-primary-dark));
    color: #fff !important;
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    box-shadow: 0 6px 16px rgba(24,184,167,.22);
    transition: var(--dest-transition);
}

.destination-view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(24,184,167,.32);
}

.destination-view-btn i {
    transition: transform var(--dest-transition);
}

.destination-view-btn:hover i {
    transform: translateX(3px);
}

/* =========================================================
   EMPTY STATE
   ========================================================= */
.destination-empty {
    padding: 70px 25px;
    background: #fff;
    border: 1px solid var(--dest-border);
    border-radius: var(--dest-radius-lg);
    text-align: center;
    box-shadow: var(--dest-shadow-sm);
}

.destination-empty-icon {
    width: 75px;
    height: 75px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--dest-primary-light);
    color: var(--dest-primary);
    font-size: 28px;
}

.destination-empty h4 {
    margin-bottom: 8px;
    color: var(--dest-heading);
    font-weight: 800;
}

.destination-empty p {
    color: var(--dest-text);
    margin: 0;
}

/* =========================================================
   LOADING
   ========================================================= */
.destination-loading {
    min-height: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.7);
    border-radius: var(--dest-radius);
}

.destination-spinner {
    width: 45px;
    height: 45px;
    border: 4px solid var(--dest-primary-light);
    border-top-color: var(--dest-primary);
    border-radius: 50%;
    animation: destinationSpin .8s linear infinite;
    margin-bottom: 14px;
}

@keyframes destinationSpin {
    to { transform: rotate(360deg); }
}

/* =========================================================
   CTA
   ========================================================= */
.destination-cta {
    position: relative;
    margin-top: 65px;
    padding: 55px 35px;
    border-radius: 30px;
    overflow: hidden;
    text-align: center;
    background: linear-gradient(135deg, #087f74, #18B8A7 55%, #F4A261);
    box-shadow: 0 20px 50px rgba(24,184,167,.2);
}

.destination-cta::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    top: -130px;
    right: -70px;
    background: rgba(255,255,255,.1);
    border-radius: 50%;
}

.destination-cta::after {
    content: "";
    position: absolute;
    width: 200px;
    height: 200px;
    bottom: -110px;
    left: -70px;
    background: rgba(255,255,255,.08);
    border-radius: 50%;
}

.destination-cta-content {
    position: relative;
    z-index: 2;
}

.destination-cta h3 {
    color: #fff;
    font-family: 'Jost', 'Poppins', sans-serif;
    font-size: clamp(25px, 4vw, 35px);
    font-weight: 800;
    margin-bottom: 10px;
}

.destination-cta p {
    max-width: 650px;
    margin: 0 auto 24px;
    color: rgba(255,255,255,.88);
    font-size: 14px;
    line-height: 1.7;
}

.destination-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 13px 24px;
    background: #fff;
    color: var(--dest-primary-dark) !important;
    border-radius: 50px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 800;
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
    transition: var(--dest-transition);
}

.destination-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 13px 28px rgba(0,0,0,.22);
}

/* =========================================================
   TABLET
   ========================================================= */
@media (max-width: 991px) {
    .destination-hero { min-height: 380px; }
    .destination-search-panel { margin-left: 20px; margin-right: 20px; }
    .filter-sidebar { top: 85px; }
    .destination-grid { grid-template-columns: 1fr; }
    .destination-card-image { height: 270px; }
}

/* =========================================================
   MOBILE
   ========================================================= */
@media (max-width: 767px) {
    .destination-hero { min-height: 420px; }
    .destination-hero-content { padding: 60px 20px; }
    .destination-hero h1 { font-size: 42px; letter-spacing: -1px; }
    .destination-hero p { font-size: 14px; line-height: 1.7; }

    .destination-search-panel {
        margin: -35px 15px 40px;
        padding: 15px;
    }
    .destination-search-inner {
        flex-direction: column;
        align-items: stretch;
    }
    .destination-search-info { justify-content: center; }

    .destinations-page { padding-top: 45px; }

    .destination-section-head { display: block; }
    .destination-section-title h2 { font-size: 30px; }

    .mobile-filter-btn { display: block; }
    .filter-sidebar {
        display: none;
        position: static;
        margin-bottom: 25px;
    }
    .filter-sidebar.show-mobile { display: block; }

    .destination-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .destination-card-image { height: 235px; }
    .destination-card-content { padding: 19px; }

    .destination-card-header { flex-direction: column; }
    .destination-rating { align-self: flex-start; }

    .destination-card-footer {
        flex-direction: column;
        align-items: flex-start;
    }
    .destination-view-btn {
        width: 100%;
        justify-content: center;
    }

    .destination-cta { margin-top: 45px; padding: 45px 20px; }
}

/* =========================================================
   SMALL MOBILE
   ========================================================= */
@media (max-width: 480px) {
    .destination-hero { min-height: 390px; }
    .destination-hero h1 { font-size: 34px; }
    .destination-eyebrow { font-size: 10px; }
    .destination-breadcrumb { font-size: 11px; }
    .destination-card-image { height: 220px; }
    .destination-card-title { font-size: 19px; }
    .destination-description { font-size: 12px; }
    .destination-feature span { font-size: 8px; }
    .destination-view-btn { padding: 9px 13px; font-size: 11px; }
}

/* =========================================================
   REDUCED MOTION
   ========================================================= */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
    }
}
</style>


<!-- =========================================================
     HERO
========================================================= -->
<section class="destination-hero">
    <div class="destination-hero-content">
        <div class="destination-eyebrow">
            <i class="fas fa-compass"></i>
            Explore India
        </div>

        <h1>Discover Your <span>Perfect Escape</span></h1>

        <p>
            Explore beautiful destinations, premium resorts and unforgettable holiday experiences across India with Delvia Holidays International.
        </p>

        <div class="destination-breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span><?= ucwords($category) ?></span>
            <i class="fas fa-chevron-right"></i>
            <span>Destinations</span>
        </div>
    </div>
</section>


<!-- =========================================================
     MAIN CONTENT
========================================================= -->
<section class="destinations-page">
    <div class="container">

        <!-- SEARCH PANEL -->
        <div class="destination-search-panel">
            <div class="destination-search-inner">
                <div class="destination-search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="destinationSearch" placeholder="Search destination or resort..." autocomplete="off">
                </div>
                <div class="destination-search-info">
                    <i class="fas fa-map-marked-alt"></i>
                    <span><?= !empty($resorts) ? count($resorts) : 0; ?> Destinations Available</span>
                </div>
            </div>
        </div>

        <!-- SECTION HEADING -->
        <div class="destination-section-head">
            <div class="destination-section-title">
                <div class="destination-label">Premium Holiday Collection</div>
                <h2><?= ucwords($category) ?> <span>Destinations</span></h2>
                <p>Choose a destination and discover hand-picked resorts designed for memorable holidays.</p>
            </div>
        </div>

        <!-- MOBILE FILTER BUTTON -->
        <button type="button" class="mobile-filter-btn" id="mobileFilterBtn">
            <i class="fas fa-filter me-2"></i> Filter Destinations
        </button>

        <div class="row g-4">
            <!-- FILTER SIDEBAR -->
            <div class="col-lg-3">
                <aside class="filter-sidebar" id="destinationFilter">
                    <div class="filter-header">
                        <h4 class="filter-title">
                            <i class="fas fa-sliders-h"></i> Filter by City
                        </h4>
                        <button type="button" class="filter-reset" id="resetFilters">Reset</button>
                    </div>

                    <div class="filter-subtitle">Select one or more cities to explore.</div>

                    <ul class="filter-list">
                        <?php if (!empty($cities)): ?>
                            <?php foreach ($cities as $city): ?>
                                <li>
                                    <label class="city-filter-label" for="city<?= $city['id']; ?>">
                                        <div class="city-filter-left">
                                            <input type="checkbox" class="cities" id="city<?= $city['id']; ?>" value="<?= $city['id']; ?>">
                                            <span><?= esc($city['name']); ?></span>
                                        </div>
                                        <i class="fas fa-chevron-right city-filter-icon"></i>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="text-muted">No cities available.</span></li>
                        <?php endif; ?>
                    </ul>
                </aside>
            </div>

            <!-- RESORT LISTING -->
            <div class="col-lg-9">
                <div id="filtered_data">
                    <?php if (!empty($resorts)): ?>
                        <div class="destination-grid">
                            <?php foreach ($resorts as $resort): ?>
                                <?php
                                    $description = strip_tags($resort['descr'] ?? '');
                                    $words = preg_split('/\s+/', trim($description));
                                    $short_descr = implode(' ', array_slice($words, 0, 24));
                                    if (count($words) > 24) {
                                        $short_descr .= '...';
                                    }
                                ?>

                                <!-- DESTINATION CARD -->
                                <article class="destination-card" data-search="<?= esc(strtolower(($resort['name'] ?? '') . ' ' . ($resort['destination_name'] ?? ''))); ?>">
                                    <!-- IMAGE -->
                                    <div class="destination-card-image">
                                        <img src="<?= base_url('uploads/resorts/' . $resort['main_image']); ?>" alt="<?= esc($resort['name']); ?>" loading="lazy">

                                        <!-- Badges -->
                                        <div class="destination-badges">
                                            <span class="destination-badge premium">
                                                <i class="fas fa-check-circle"></i> Premium
                                            </span>
                                            <?php if (!empty($resort['is_popular'])): ?>
                                                <span class="destination-badge popular">
                                                    <i class="fas fa-fire"></i> Popular
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Location -->
                                        <div class="destination-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span><?= esc($resort['destination_name']); ?></span>
                                        </div>
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="destination-card-content">
                                        <!-- Title + Rating -->
                                        <div class="destination-card-header">
                                            <h3 class="destination-card-title"><?= esc($resort['name']); ?></h3>
                                            <div class="destination-rating">
                                                <i class="fas fa-star"></i>
                                                <span>4.8 <small>(128 reviews)</small></span>
                                            </div>
                                        </div>

                                        <p class="destination-description"><?= esc($short_descr); ?></p>

                                        <!-- Features -->
                                        <div class="destination-features">
                                            <div class="destination-feature">
                                                <img src="<?= base_url('asset/icons/bad.png'); ?>" alt="Hotel">
                                                <span>Hotel</span>
                                            </div>
                                            <div class="destination-feature">
                                                <img src="<?= base_url('asset/icons/bus.png'); ?>" alt="Transfer">
                                                <span>Transfer</span>
                                            </div>
                                            <div class="destination-feature">
                                                <img src="<?= base_url('asset/icons/bag.png'); ?>" alt="Luggage">
                                                <span>Luggage</span>
                                            </div>
                                            <div class="destination-feature">
                                                <img src="<?= base_url('asset/icons/location1.png'); ?>" alt="Destination">
                                                <span><?= esc($resort['destination_name']); ?></span>
                                            </div>
                                        </div>

                                        <!-- Price + CTA -->
                                        <div class="destination-card-footer">
                                            <div class="destination-price">
                                                <span class="price-label">From</span>
                                                <span class="price-amount">₹12,499</span>
                                                <span class="price-per">/ night</span>
                                            </div>
                                            <a href="<?= base_url('property/' . $resort['slug']); ?>" class="destination-view-btn">
                                                View Details <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <!-- SEARCH EMPTY -->
                        <div class="destination-empty" id="searchEmpty" style="display:none;">
                            <div class="destination-empty-icon"><i class="fas fa-search"></i></div>
                            <h4>No Destination Found</h4>
                            <p>Try searching for another city or resort.</p>
                        </div>

                    <?php else: ?>
                        <!-- EMPTY STATE -->
                        <div class="destination-empty">
                            <div class="destination-empty-icon"><i class="fas fa-map-marked-alt"></i></div>
                            <h4>No Destinations Available</h4>
                            <p>There are currently no destinations available in this category.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="destination-cta">
            <div class="destination-cta-content">
                <h3>Your Dream Holiday Starts Here</h3>
                <p>
                    Can't decide where to go? Let Delvia Holidays International help you find the perfect destination and stay for your next unforgettable journey.
                </p>
                <a href="<?= base_url('contact'); ?>" class="destination-cta-btn">
                    Plan My Holiday <i class="fas fa-paper-plane"></i>
                </a>
            </div>
        </div>

    </div>
</section>


<!-- =========================================================
     FILTER + SEARCH SCRIPT
========================================================= -->
<script>
$(document).ready(function () {
    /* =====================================================
       CITY FILTER
       ===================================================== */
    function applyFilter() {
        let selectedCities = $(".cities:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: "<?= base_url('destination/filterByCity') ?>",
            type: "POST",
            data: { city_ids: selectedCities },
            beforeSend: function () {
                $("#filtered_data").html(`
                    <div class="destination-loading">
                        <div class="destination-spinner"></div>
                        <strong>Finding destinations...</strong>
                        <small class="text-muted mt-1">Please wait</small>
                    </div>
                `);
            },
            success: function (response) {
                $("#filtered_data").html(response);
                // Re-apply search after AJAX response
                $("#destinationSearch").trigger("input");
            },
            error: function () {
                $("#filtered_data").html(`
                    <div class="destination-empty">
                        <div class="destination-empty-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <h4>Something Went Wrong</h4>
                        <p>Unable to load destinations. Please try again.</p>
                    </div>
                `);
            }
        });
    }

    /* =====================================================
       CITY CHECKBOX CHANGE
       ===================================================== */
    $(".cities").on("change", function () {
        applyFilter();
    });

    /* =====================================================
       RESET FILTER
       ===================================================== */
    $("#resetFilters").on("click", function () {
        $(".cities").prop("checked", false);
        applyFilter();
    });

    /* =====================================================
       MOBILE FILTER
       ===================================================== */
    $("#mobileFilterBtn").on("click", function () {
        $("#destinationFilter").toggleClass("show-mobile");
        let isVisible = $("#destinationFilter").hasClass("show-mobile");
        if (isVisible) {
            $(this).html(`<i class="fas fa-times me-2"></i> Close Filters`);
        } else {
            $(this).html(`<i class="fas fa-filter me-2"></i> Filter Destinations`);
        }
    });

    /* =====================================================
       DESTINATION SEARCH
       ===================================================== */
    $("#destinationSearch").on("input", function () {
        let searchValue = $(this).val().toLowerCase().trim();
        let visibleCards = 0;

        $(".destination-card").each(function () {
            let searchText = ($(this).attr("data-search") || "").toLowerCase();
            if (searchValue === "" || searchText.indexOf(searchValue) !== -1) {
                $(this).show();
                visibleCards++;
            } else {
                $(this).hide();
            }
        });

        if (searchValue !== "" && visibleCards === 0) {
            $("#searchEmpty").show();
        } else {
            $("#searchEmpty").hide();
        }
    });
});
</script>

<?php include 'footer.php'; ?>