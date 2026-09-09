<?php
$title = "Member Holiday Reviews | Delvia Holidays International";
$description = "Read genuine member holiday reviews of Delvia Holidays International. Discover real travel experiences and why discerning travelers trust our luxury holiday services.";

include 'header.php';
?>

<style>

/* =========================================================
   DELVIA REVIEWS PAGE - PREMIUM LUXURY EDITION
========================================================= */

:root {
    --review-primary: #18B8A7;
    --review-primary-dark: #0C9C8E;
    --review-primary-light: #E9FAF7;

    --review-orange: #F4A261;
    --review-orange-dark: #E8893C;

    --review-gold: #FBBF24;

    --review-dark: #17212B;
    --review-heading: #1F2937;
    --review-text: #667085;
    --review-muted: #98A2B3;

    --review-white: #ffffff;
    --review-bg: #F7FAFC;
    --review-border: #E8EDF2;

    --review-shadow-sm:
        0 4px 15px rgba(15, 23, 42, .05);

    --review-shadow:
        0 15px 40px rgba(15, 23, 42, .08);

    --review-shadow-lg:
        0 25px 70px rgba(15, 23, 42, .13);

    --review-radius: 24px;
    --review-radius-lg: 32px;

    --review-transition:
        .35s cubic-bezier(.4, 0, .2, 1);

    --review-font-heading:
        'Outfit', 'Poppins', sans-serif;

    --review-font-body:
        'Inter', sans-serif;
}


/* =========================================================
   GLOBAL
========================================================= */

.reviews-page *,
.review-hero * {
    box-sizing: border-box;
}

.reviews-page {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(
            circle at 5% 10%,
            rgba(24,184,167,.08),
            transparent 25%
        ),
        radial-gradient(
            circle at 95% 35%,
            rgba(244,162,97,.07),
            transparent 25%
        ),
        var(--review-bg);

    font-family: var(--review-font-body);
}


/* =========================================================
   PREMIUM HERO
========================================================= */

.review-hero {
    position: relative;
    min-height: 470px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    background:
        linear-gradient(
            120deg,
            rgba(4, 83, 78, .94),
            rgba(15, 163, 149, .86),
            rgba(24, 184, 167, .75)
        ),
        url("https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=85&w=2070&auto=format&fit=crop")
        center / cover no-repeat;
}


/* Hero dark overlay */

.review-hero::before {
    content: "";
    position: absolute;
    inset: 0;

    background:
        radial-gradient(
            circle at 20% 20%,
            rgba(255,255,255,.15),
            transparent 30%
        ),
        linear-gradient(
            180deg,
            transparent 45%,
            rgba(0,0,0,.20)
        );
}


/* Decorative circles */

.review-hero::after {
    content: "";
    position: absolute;

    width: 420px;
    height: 420px;

    right: -160px;
    top: -180px;

    border-radius: 50%;

    border: 1px solid rgba(255,255,255,.18);

    box-shadow:
        0 0 0 40px rgba(255,255,255,.025),
        0 0 0 80px rgba(255,255,255,.02);
}


/* Hero content */

.review-hero-content {
    position: relative;
    z-index: 5;

    width: 100%;
    max-width: 900px;

    padding: 90px 20px 110px;

    text-align: center;

    color: #fff;
}

.hero-mini-label {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 9px 17px;

    margin-bottom: 22px;

    border: 1px solid rgba(255,255,255,.28);

    background: rgba(255,255,255,.10);

    backdrop-filter: blur(12px);

    border-radius: 50px;

    color: #fff;

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 1.4px;

    text-transform: uppercase;
}

.hero-mini-label i {
    color: var(--review-gold);
}


.review-hero h1 {
    margin: 0 0 20px;

    color: #fff;

    font-family: var(--review-font-heading);

    font-size: clamp(42px, 6vw, 72px);

    line-height: 1.05;

    font-weight: 800;

    letter-spacing: -2px;

    text-shadow:
        0 5px 25px rgba(0,0,0,.18);
}

.review-hero h1 span {
    color: #CFFFF8;
}

.review-hero-description {
    max-width: 650px;

    margin: 0 auto 28px;

    color: rgba(255,255,255,.88);

    font-size: 16px;

    line-height: 1.8;
}


/* Breadcrumb */

.review-breadcrumb {
    display: flex;
    justify-content: center;
    align-items: center;

    flex-wrap: wrap;

    gap: 8px;

    margin: 0;

    padding: 0;

    list-style: none;
}

.review-breadcrumb li {
    color: rgba(255,255,255,.65);

    font-size: 13px;
    font-weight: 500;
}

.review-breadcrumb li:not(:last-child)::after {
    content: "›";

    margin-left: 8px;

    color: rgba(255,255,255,.55);
}

.review-breadcrumb a {
    color: rgba(255,255,255,.9);
    text-decoration: none;
}

.review-breadcrumb .active {
    color: #fff;
    font-weight: 700;
}


/* Hero bottom curve */

.hero-wave {
    position: absolute;

    left: -5%;
    bottom: -1px;

    width: 110%;
    height: 85px;

    background: var(--review-bg);

    border-radius: 50% 50% 0 0 / 100% 100% 0 0;

    z-index: 3;
}


/* =========================================================
   MAIN CONTENT
========================================================= */

.review-content-wrapper {
    position: relative;

    max-width: 1320px;

    margin: auto;

    padding: 35px 20px 100px;
}


/* =========================================================
   TOP INTRO
========================================================= */

.review-intro {
    text-align: center;

    max-width: 760px;

    margin: 0 auto 45px;
}

.review-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 8px 15px;

    margin-bottom: 15px;

    border-radius: 50px;

    background: var(--review-primary-light);

    border: 1px solid rgba(24,184,167,.15);

    color: var(--review-primary-dark);

    font-size: 12px;
    font-weight: 800;

    letter-spacing: 1.2px;

    text-transform: uppercase;
}

.review-intro h2 {
    margin: 0 0 16px;

    font-family: var(--review-font-heading);

    font-size: clamp(32px, 4vw, 48px);

    line-height: 1.15;

    font-weight: 800;

    color: var(--review-heading);

    letter-spacing: -1.5px;
}

.review-intro h2 span {
    color: var(--review-primary);

    position: relative;
}

.review-intro p {
    max-width: 650px;

    margin: auto;

    color: var(--review-text);

    font-size: 15px;

    line-height: 1.8;
}


/* =========================================================
   RATING DASHBOARD
========================================================= */

.rating-dashboard {
    position: relative;

    display: grid;

    grid-template-columns:
        1fr
        1.4fr
        1fr;

    align-items: center;

    gap: 0;

    max-width: 900px;

    margin: 0 auto 60px;

    padding: 25px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.98),
            rgba(247,250,252,.98)
        );

    border: 1px solid var(--review-border);

    border-radius: 28px;

    box-shadow: var(--review-shadow);

    overflow: hidden;
}

.rating-dashboard::before {
    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    top: -90px;
    right: -50px;

    border-radius: 50%;

    background: rgba(24,184,167,.06);
}


/* Rating blocks */

.rating-box {
    position: relative;
    z-index: 2;

    text-align: center;

    padding: 10px 20px;
}

.rating-box + .rating-box {
    border-left: 1px solid var(--review-border);
}

.rating-number {
    display: block;

    color: var(--review-heading);

    font-family: var(--review-font-heading);

    font-size: 38px;

    line-height: 1;

    font-weight: 800;
}

.rating-stars {
    display: flex;

    justify-content: center;

    gap: 4px;

    margin: 9px 0 7px;
}

.rating-stars i {
    color: var(--review-gold);

    font-size: 15px;
}

.rating-label {
    display: block;

    color: var(--review-muted);

    font-size: 12px;

    font-weight: 600;

    letter-spacing: .4px;
}


/* Center rating */

.rating-main .rating-number {
    font-size: 46px;

    color: var(--review-primary-dark);
}


/* =========================================================
   REVIEW GRID
========================================================= */

.reviews-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 32px;
}


/* =========================================================
   REVIEW CARD
========================================================= */

.review-card {
    position: relative;

    display: flex;
    flex-direction: column;

    min-width: 0;

    background: #fff;

    border: 1px solid var(--review-border);

    border-radius: var(--review-radius);

    overflow: hidden;

    box-shadow: var(--review-shadow-sm);

    opacity: 0;

    animation: reviewCardReveal .7s ease forwards;

    transition:
        transform .45s cubic-bezier(.25,.46,.45,.94),
        box-shadow .45s ease,
        border-color .35s ease;
}

.review-card:hover {
    transform: translateY(-9px);

    border-color: rgba(24,184,167,.28);

    box-shadow:
        var(--review-shadow-lg),
        0 0 35px rgba(24,184,167,.08);
}


@keyframes reviewCardReveal {

    from {
        opacity: 0;
        transform: translateY(35px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


.review-card:nth-child(1) {
    animation-delay: .05s;
}

.review-card:nth-child(2) {
    animation-delay: .12s;
}

.review-card:nth-child(3) {
    animation-delay: .19s;
}

.review-card:nth-child(4) {
    animation-delay: .26s;
}

.review-card:nth-child(5) {
    animation-delay: .33s;
}

.review-card:nth-child(6) {
    animation-delay: .40s;
}

.review-card:nth-child(7) {
    animation-delay: .47s;
}

.review-card:nth-child(8) {
    animation-delay: .54s;
}


/* =========================================================
   CARD IMAGE
========================================================= */

.review-image {
    position: relative;

    height: 315px;

    overflow: hidden;

    background: #edf2f4;
}

.review-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;

    transition:
        transform .8s cubic-bezier(.25,.46,.45,.94),
        filter .6s ease;
}

.review-card:hover .review-image img {
    transform: scale(1.09);

    filter: brightness(.72);
}


/* Image bottom gradient */

.review-image::after {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            180deg,
            rgba(0,0,0,.03) 35%,
            rgba(0,0,0,.55) 100%
        );

    pointer-events: none;
}


/* =========================================================
   VERIFIED
========================================================= */

.verified-badge {
    position: absolute;

    top: 17px;
    left: 17px;

    z-index: 5;

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 9px 13px;

    background: rgba(255,255,255,.94);

    color: var(--review-primary-dark);

    border-radius: 50px;

    font-size: 11px;

    font-weight: 800;

    box-shadow: 0 8px 25px rgba(0,0,0,.12);

    backdrop-filter: blur(10px);
}

.verified-badge i {
    color: var(--review-primary);

    font-size: 13px;
}


/* =========================================================
   IMAGE REVIEW LABEL
========================================================= */

.image-review-label {
    position: absolute;

    z-index: 5;

    left: 20px;
    bottom: 18px;

    right: 20px;

    color: #fff;

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1px;

    text-transform: uppercase;
}


/* =========================================================
   QUOTE
========================================================= */

.quote-icon {
    position: absolute;

    right: 20px;
    bottom: -25px;

    z-index: 7;

    width: 58px;
    height: 58px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            var(--review-orange),
            var(--review-orange-dark)
        );

    color: #fff;

    border: 4px solid #fff;

    border-radius: 50%;

    box-shadow:
        0 10px 25px rgba(244,162,97,.35);

    font-size: 20px;

    transition:
        transform .35s ease,
        box-shadow .35s ease;
}

.review-card:hover .quote-icon {
    transform: rotate(8deg) scale(1.08);

    box-shadow:
        0 14px 32px rgba(244,162,97,.45);
}


/* =========================================================
   IMAGE VIEW BUTTON
========================================================= */

.image-view {
    position: absolute;

    inset: 0;

    z-index: 4;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            rgba(12,156,142,.25),
            rgba(12,100,94,.68)
        );

    opacity: 0;

    transition: opacity .4s ease;
}

.review-card:hover .image-view {
    opacity: 1;
}

.image-view button {
    display: inline-flex;

    align-items: center;

    gap: 9px;

    padding: 13px 20px;

    background: #fff;

    color: var(--review-primary-dark);

    border: 0;

    border-radius: 50px;

    font-size: 12px;

    font-weight: 800;

    box-shadow: 0 15px 35px rgba(0,0,0,.18);

    transform: translateY(18px);

    transition:
        transform .4s ease,
        background .3s ease,
        color .3s ease;
}

.review-card:hover .image-view button {
    transform: translateY(0);
}

.image-view button:hover {
    background: var(--review-orange);

    color: #fff;
}


/* =========================================================
   CARD BODY
========================================================= */

.review-card-body {
    position: relative;

    display: flex;
    flex-direction: column;

    flex: 1;

    padding: 35px 28px 27px;
}


/* =========================================================
   AUTHOR
========================================================= */

.review-author {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding-right: 38px;

    margin-bottom: 15px;
}

.author-details h3 {
    margin: 0 0 5px;

    color: var(--review-heading);

    font-family: var(--review-font-heading);

    font-size: 20px;

    font-weight: 800;

    line-height: 1.2;
}

.author-location {
    display: flex;

    align-items: center;

    gap: 5px;

    color: var(--review-muted);

    font-size: 12px;

    font-weight: 500;
}

.author-location i {
    color: var(--review-primary);
}


/* =========================================================
   STARS
========================================================= */

.card-stars {
    display: flex;

    gap: 3px;

    flex-shrink: 0;
}

.card-stars i {
    font-size: 13px;

    color: #D9DEE5;
}

.card-stars i.fas {
    color: var(--review-gold);
}


/* =========================================================
   REVIEW TEXT
========================================================= */

.review-text {
    position: relative;

    margin: 0 0 22px;

    color: var(--review-text);

    font-size: 14px;

    line-height: 1.8;

    display: -webkit-box;

    -webkit-line-clamp: 4;

    -webkit-box-orient: vertical;

    overflow: hidden;
}

.review-text::before {
    content: "“";

    position: absolute;

    left: -8px;
    top: -20px;

    color: rgba(24,184,167,.08);

    font-family: Georgia, serif;

    font-size: 75px;

    font-weight: 900;

    pointer-events: none;
}


/* =========================================================
   CARD FOOTER
========================================================= */

.review-footer {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-top: auto;

    padding-top: 18px;

    border-top: 1px solid var(--review-border);
}

.member-tag {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: var(--review-muted);

    font-size: 10px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .8px;
}

.member-tag i {
    color: var(--review-primary);
}


/* =========================================================
   READ BUTTON
========================================================= */

.btn-read-review {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 10px 17px;

    border-radius: 50px;

    background:
        linear-gradient(
            135deg,
            var(--review-primary),
            var(--review-primary-dark)
        );

    color: #fff;

    border: 0;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

    box-shadow:
        0 8px 20px rgba(24,184,167,.22);

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.btn-read-review:hover {
    color: #fff;

    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(24,184,167,.35);
}

.btn-read-review i {
    transition: transform .3s ease;
}

.btn-read-review:hover i {
    transform: translateX(4px);
}


/* =========================================================
   MODAL
========================================================= */

.review-modal {
    overflow: hidden;

    border: 0;

    border-radius: 30px;

    background: #fff;

    box-shadow:
        0 30px 100px rgba(0,0,0,.25);
}

.review-modal .modal-header {
    padding: 25px 28px 15px;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f7fbfa
        );
}

.modal-profile {
    display: flex;

    align-items: center;

    gap: 13px;
}

.modal-avatar {
    width: 48px;
    height: 48px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    background:
        linear-gradient(
            135deg,
            var(--review-primary),
            var(--review-primary-dark)
        );

    color: #fff;

    border-radius: 50%;

    font-family: var(--review-font-heading);

    font-size: 18px;

    font-weight: 800;
}

.modal-profile h5 {
    margin: 0 0 4px;

    font-family: var(--review-font-heading);

    font-size: 19px;

    font-weight: 800;

    color: var(--review-heading);
}

.modal-profile small {
    color: var(--review-muted);
}

.modal-profile small i {
    color: var(--review-primary);
}


/* Modal body */

.review-modal .modal-body {
    padding: 20px 28px 30px;
}


/* =========================================================
   CAROUSEL
========================================================= */

.review-carousel {
    position: relative;

    overflow: hidden;

    border-radius: 20px;

    background: #eef2f3;

    box-shadow: var(--review-shadow);
}

.review-carousel img {
    width: 100%;

    height: 400px;

    object-fit: cover;
}

.review-carousel .carousel-control-prev,
.review-carousel .carousel-control-next {
    width: 48px;
    height: 48px;

    top: 50%;

    margin: -24px 15px 0;

    border-radius: 50%;

    background: rgba(0,0,0,.45);

    backdrop-filter: blur(10px);

    opacity: .9;
}


/* =========================================================
   FULL REVIEW
========================================================= */

.full-review-box {
    margin-top: 25px;

    padding: 23px;

    background: var(--review-bg);

    border: 1px solid var(--review-border);

    border-radius: 18px;
}

.full-review-box-label {
    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 10px;

    color: var(--review-primary-dark);

    font-size: 11px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .8px;
}

.full-review-box p {
    margin: 0;

    color: var(--review-heading);

    font-size: 15px;

    line-height: 1.85;
}


/* Modal bottom */

.modal-review-footer {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-top: 20px;
}


/* Google */

.google-review-btn {
    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 11px 18px;

    border: 1px solid var(--review-border);

    border-radius: 50px;

    background: #fff;

    color: var(--review-heading);

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

    transition: .3s ease;
}

.google-review-btn:hover {
    color: var(--review-primary-dark);

    border-color: rgba(24,184,167,.3);

    transform: translateY(-2px);

    box-shadow: var(--review-shadow-sm);
}


/* =========================================================
   CTA
========================================================= */

.review-cta {
    position: relative;

    margin-top: 75px;

    padding: 65px 40px;

    overflow: hidden;

    text-align: center;

    border-radius: 34px;

    background:
        linear-gradient(
            125deg,
            #087E73,
            #18B8A7 55%,
            #E8893C
        );

    box-shadow:
        0 25px 65px rgba(24,184,167,.20);
}

.review-cta::before {
    content: "";

    position: absolute;

    width: 350px;
    height: 350px;

    right: -120px;
    top: -180px;

    border-radius: 50%;

    background: rgba(255,255,255,.09);
}

.review-cta::after {
    content: "";

    position: absolute;

    width: 250px;
    height: 250px;

    left: -90px;
    bottom: -150px;

    border-radius: 50%;

    background: rgba(255,255,255,.08);
}

.cta-content {
    position: relative;

    z-index: 3;

    max-width: 700px;

    margin: auto;
}

.cta-icon {
    width: 58px;
    height: 58px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 18px;

    border-radius: 50%;

    background: rgba(255,255,255,.14);

    border: 1px solid rgba(255,255,255,.2);

    color: #fff;

    font-size: 21px;
}

.review-cta h2 {
    margin: 0 0 12px;

    color: #fff;

    font-family: var(--review-font-heading);

    font-size: clamp(28px, 4vw, 40px);

    font-weight: 800;

    letter-spacing: -1px;
}

.review-cta p {
    margin: 0 auto 25px;

    max-width: 570px;

    color: rgba(255,255,255,.88);

    font-size: 14px;

    line-height: 1.8;
}

.cta-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    padding: 13px 25px;

    background: #fff;

    color: var(--review-primary-dark);

    border-radius: 50px;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    box-shadow:
        0 10px 30px rgba(0,0,0,.18);

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.cta-button:hover {
    color: var(--review-primary-dark);

    transform: translateY(-3px);

    box-shadow:
        0 15px 35px rgba(0,0,0,.25);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.review-empty {
    max-width: 550px;

    margin: 20px auto 50px;

    padding: 60px 30px;

    text-align: center;

    background: #fff;

    border: 1px solid var(--review-border);

    border-radius: 28px;

    box-shadow: var(--review-shadow);
}

.empty-icon {
    width: 75px;
    height: 75px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 20px;

    background: var(--review-primary-light);

    color: var(--review-primary);

    border-radius: 50%;

    font-size: 28px;
}

.review-empty h3 {
    margin: 0 0 8px;

    font-family: var(--review-font-heading);

    color: var(--review-heading);

    font-weight: 800;
}

.review-empty p {
    margin: 0;

    color: var(--review-muted);

    font-size: 14px;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .review-hero {
        min-height: 420px;
    }

    .review-hero-content {
        padding: 80px 20px 100px;
    }

    .rating-dashboard {
        grid-template-columns:
            repeat(3, 1fr);

        max-width: 100%;
    }

    .reviews-grid {
        gap: 24px;
    }

    .review-image {
        height: 270px;
    }

    .review-card-body {
        padding: 32px 22px 24px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .review-hero {
        min-height: 420px;
    }

    .review-hero-content {
        padding: 75px 18px 95px;
    }

    .review-hero h1 {
        font-size: 42px;

        letter-spacing: -1.3px;
    }

    .review-hero-description {
        font-size: 14px;

        line-height: 1.7;
    }

    .hero-wave {
        height: 55px;
    }

    .review-content-wrapper {
        padding:
            30px 15px 70px;
    }

    .review-intro {
        margin-bottom: 35px;
    }

    .review-intro h2 {
        font-size: 32px;
    }

    .review-intro p {
        font-size: 14px;
    }


    /* Rating */

    .rating-dashboard {
        display: grid;

        grid-template-columns: 1fr;

        gap: 5px;

        padding: 18px;

        border-radius: 23px;
    }

    .rating-box {
        padding: 13px;
    }

    .rating-box + .rating-box {
        border-left: 0;

        border-top: 1px solid var(--review-border);
    }

    .rating-main {
        order: -1;
    }


    /* Cards */

    .reviews-grid {
        grid-template-columns: 1fr;

        gap: 24px;
    }

    .review-image {
        height: 245px;
    }

    .review-card-body {
        padding: 32px 20px 22px;
    }

    .review-author {
        align-items: flex-start;

        flex-direction: column;

        gap: 10px;

        padding-right: 40px;
    }

    .card-stars {
        margin-top: 0;
    }

    .review-text {
        font-size: 14px;
    }

    .review-footer {
        align-items: stretch;

        flex-direction: column;

        gap: 13px;
    }

    .btn-read-review {
        width: 100%;
    }


    /* Modal */

    .review-modal {
        border-radius: 22px;
    }

    .review-modal .modal-header {
        padding: 20px 18px 12px;
    }

    .review-modal .modal-body {
        padding: 15px 18px 25px;
    }

    .review-carousel img {
        height: 280px;
    }

    .modal-review-footer {
        align-items: stretch;

        flex-direction: column;
    }

    .google-review-btn {
        justify-content: center;
    }


    /* CTA */

    .review-cta {
        margin-top: 50px;

        padding: 45px 20px;

        border-radius: 25px;
    }

    .review-cta h2 {
        font-size: 28px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .review-hero h1 {
        font-size: 36px;
    }

    .hero-mini-label {
        font-size: 10px;

        padding: 8px 13px;
    }

    .review-intro h2 {
        font-size: 28px;
    }

    .rating-number {
        font-size: 34px;
    }

    .rating-main .rating-number {
        font-size: 40px;
    }

    .review-image {
        height: 220px;
    }

    .quote-icon {
        width: 50px;
        height: 50px;

        right: 15px;

        font-size: 18px;
    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .review-card {
        animation: none;

        opacity: 1;
    }

    .review-card,
    .review-card img,
    .quote-icon,
    .image-view,
    .image-view button {
        transition: none;
    }

}

</style>


<!-- =========================================================
     PREMIUM HERO
========================================================= -->

<section class="review-hero">

    <div class="review-hero-content">

        <div class="hero-mini-label">
            <i class="fas fa-sparkles"></i>
            Trusted Travel Experiences
        </div>

        <h1>
            Stories From Our
            <span>Happy Members</span>
        </h1>

        <p class="review-hero-description">
            Discover real experiences, memorable journeys and
            unforgettable moments shared by travellers who explored
            the world with Delvia Holidays International.
        </p>

        <ul class="review-breadcrumb">

            <li>
                <a href="index.php">Home</a>
            </li>

            <li>
                <a href="#">Pages</a>
            </li>

            <li class="active">
                Member Reviews
            </li>

        </ul>

    </div>

    <div class="hero-wave"></div>

</section>


<!-- =========================================================
     MAIN REVIEWS
========================================================= -->

<section class="reviews-page">

    <div class="review-content-wrapper">


        <!-- =====================================================
             INTRO
        ====================================================== -->

        <div class="review-intro">

            <div class="review-eyebrow">
                <i class="fas fa-star"></i>
                Member Testimonials
            </div>

            <h2>
                What Our
                <span>Members Say</span>
            </h2>

            <p>
                Every journey tells a story. Read genuine experiences
                from our members and discover why travellers choose
                Delvia Holidays International for their holidays.
            </p>

        </div>


        <?php if (!empty($testimonials)): ?>

            <?php

            $totalRating = 0;
            $totalReviews = count($testimonials);

            foreach ($testimonials as $t) {
                $totalRating += (float) $t['rating'];
            }

            $avgRating = $totalReviews > 0
                ? round($totalRating / $totalReviews, 1)
                : 0;

            ?>


            <!-- =================================================
                 RATING DASHBOARD
            ================================================== -->

            <div class="rating-dashboard">

                <!-- Left -->

                <div class="rating-box">

                    <span class="rating-number">
                        <?= esc($totalReviews); ?>
                    </span>

                    <div class="rating-stars">

                        <?php for ($i = 1; $i <= 5; $i++): ?>

                            <i class="fas fa-star"></i>

                        <?php endfor; ?>

                    </div>

                    <span class="rating-label">
                        Member Reviews
                    </span>

                </div>


                <!-- Center -->

                <div class="rating-box rating-main">

                    <span class="rating-number">
                        <?= esc($avgRating); ?>
                    </span>

                    <div class="rating-stars">

                        <?php for ($i = 1; $i <= 5; $i++): ?>

                            <i class="fas fa-star"></i>

                        <?php endfor; ?>

                    </div>

                    <span class="rating-label">
                        Average Member Rating
                    </span>

                </div>


                <!-- Right -->

                <div class="rating-box">

                    <span class="rating-number">
                        100%
                    </span>

                    <div class="rating-stars">

                        <i class="fas fa-check-circle"></i>

                    </div>

                    <span class="rating-label">
                        Verified Experiences
                    </span>

                </div>

            </div>


            <!-- =================================================
                 REVIEWS GRID
            ================================================== -->

            <div class="reviews-grid">

                <?php foreach ($testimonials as $key => $testimonial): ?>

                    <?php

                    $reviewImage = !empty($testimonial['image'])
                        ? base_url(
                            'uploads/review_img/' .
                            esc($testimonial['image'])
                        )
                        : '';

                    ?>

                    <!-- =================================================
                         REVIEW CARD
                    ================================================== -->

                    <article class="review-card">


                        <!-- IMAGE -->

                        <div class="review-image">

                            <?php if ($reviewImage): ?>

                                <img
                                    src="<?= $reviewImage; ?>"
                                    alt="<?= esc($testimonial['name']); ?> holiday review"
                                    loading="lazy"
                                >

                            <?php endif; ?>


                            <!-- Verified -->

                            <span class="verified-badge">

                                <i class="fas fa-check-circle"></i>

                                Verified Member

                            </span>


                            <!-- Image label -->

                            <span class="image-review-label">

                                <i class="fas fa-plane-departure me-1"></i>

                                Delvia Travel Experience

                            </span>


                            <!-- Quote -->

                            <span class="quote-icon">

                                <i class="fas fa-quote-right"></i>

                            </span>


                            <!-- Hover -->

                            <div class="image-view">

                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#reviewModal<?= $key; ?>"
                                >

                                    <i class="fas fa-expand"></i>

                                    View Experience

                                </button>

                            </div>

                        </div>


                        <!-- CARD BODY -->

                        <div class="review-card-body">


                            <!-- Author -->

                            <div class="review-author">

                                <div class="author-details">

                                    <h3>
                                        <?= esc($testimonial['name']); ?>
                                    </h3>

                                    <div class="author-location">

                                        <i class="fas fa-location-dot"></i>

                                        <?= esc($testimonial['location']); ?>

                                    </div>

                                </div>


                                <!-- Stars -->

                                <div class="card-stars">

                                    <?php for ($i = 1; $i <= 5; $i++): ?>

                                        <i
                                            class="<?= $i <= $testimonial['rating']
                                                ? 'fas'
                                                : 'far'; ?> fa-star"
                                        ></i>

                                    <?php endfor; ?>

                                </div>

                            </div>


                            <!-- Text -->

                            <p class="review-text">

                                <?= esc(
                                    strlen($testimonial['testimonial']) > 190
                                        ? substr(
                                            $testimonial['testimonial'],
                                            0,
                                            190
                                        ) . '...'
                                        : $testimonial['testimonial']
                                ); ?>

                            </p>


                            <!-- Footer -->

                            <div class="review-footer">

                                <span class="member-tag">

                                    <i class="fas fa-shield-check"></i>

                                    Member Experience

                                </span>


                                <button
                                    type="button"
                                    class="btn-read-review"
                                    data-bs-toggle="modal"
                                    data-bs-target="#reviewModal<?= $key; ?>"
                                >

                                    Read Full Review

                                    <i class="fas fa-arrow-right"></i>

                                </button>

                            </div>

                        </div>

                    </article>


                    <!-- =================================================
                         REVIEW MODAL
                    ================================================== -->

                    <div
                        class="modal fade"
                        id="reviewModal<?= $key; ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content review-modal">


                                <!-- HEADER -->

                                <div class="modal-header border-0">

                                    <div class="modal-profile">

                                        <div class="modal-avatar">

                                            <?= strtoupper(
                                                substr(
                                                    $testimonial['name'],
                                                    0,
                                                    1
                                                )
                                            ); ?>

                                        </div>

                                        <div>

                                            <h5>
                                                <?= esc($testimonial['name']); ?>
                                            </h5>

                                            <small>

                                                <i class="fas fa-location-dot me-1"></i>

                                                <?= esc($testimonial['location']); ?>

                                            </small>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>


                                <!-- BODY -->

                                <div class="modal-body">


                                    <!-- IMAGE CAROUSEL -->

                                    <?php if (!empty($testimonial['images'])): ?>

                                        <div
                                            id="carousel<?= $key; ?>"
                                            class="carousel slide review-carousel"
                                            data-bs-ride="carousel"
                                        >

                                            <div class="carousel-inner">

                                                <?php foreach (
                                                    $testimonial['images']
                                                    as $i => $img
                                                ): ?>

                                                    <div
                                                        class="carousel-item <?= $i === 0
                                                            ? 'active'
                                                            : ''; ?>"
                                                    >

                                                        <img
                                                            src="<?= base_url(
                                                                'uploads/review_img/' .
                                                                esc($img)
                                                            ); ?>"
                                                            alt="<?= esc($testimonial['name']); ?> travel experience"
                                                            loading="lazy"
                                                        >

                                                    </div>

                                                <?php endforeach; ?>

                                            </div>


                                            <?php if (
                                                count($testimonial['images']) > 1
                                            ): ?>

                                                <button
                                                    class="carousel-control-prev"
                                                    type="button"
                                                    data-bs-target="#carousel<?= $key; ?>"
                                                    data-bs-slide="prev"
                                                >

                                                    <span
                                                        class="carousel-control-prev-icon"
                                                    ></span>

                                                    <span class="visually-hidden">
                                                        Previous
                                                    </span>

                                                </button>


                                                <button
                                                    class="carousel-control-next"
                                                    type="button"
                                                    data-bs-target="#carousel<?= $key; ?>"
                                                    data-bs-slide="next"
                                                >

                                                    <span
                                                        class="carousel-control-next-icon"
                                                    ></span>

                                                    <span class="visually-hidden">
                                                        Next
                                                    </span>

                                                </button>

                                            <?php endif; ?>

                                        </div>

                                    <?php endif; ?>


                                    <!-- FULL REVIEW -->

                                    <div class="full-review-box">

                                        <div class="full-review-box-label">

                                            <i class="fas fa-quote-left"></i>

                                            Member Experience

                                        </div>

                                        <p>
                                            <?= esc(
                                                $testimonial['testimonial']
                                            ); ?>
                                        </p>

                                    </div>


                                    <!-- MODAL FOOTER -->

                                    <div class="modal-review-footer">


                                        <!-- Rating -->

                                        <div class="card-stars">

                                            <?php for (
                                                $i = 1;
                                                $i <= 5;
                                                $i++
                                            ): ?>

                                                <i
                                                    class="<?= $i <= $testimonial['rating']
                                                        ? 'fas'
                                                        : 'far'; ?> fa-star"
                                                ></i>

                                            <?php endfor; ?>

                                            <span
                                                class="ms-2"
                                                style="
                                                    color:#667085;
                                                    font-size:12px;
                                                    font-weight:700;
                                                "
                                            >
                                                <?= esc(
                                                    $testimonial['rating']
                                                ); ?>/5
                                            </span>

                                        </div>


                                        <!-- Google -->

                                        <a
                                            href="https://g.page/r/Cd0k83uDI7IbEAE/"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="google-review-btn"
                                        >

                                            <i class="fab fa-google"></i>

                                            View on Google

                                            <i class="fas fa-external-link-alt"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="review-empty">

                <div class="empty-icon">

                    <i class="fas fa-comment-slash"></i>

                </div>

                <h3>
                    No Reviews Yet
                </h3>

                <p>
                    There are currently no member reviews available.
                    Check back soon for new travel experiences.
                </p>

            </div>

        <?php endif; ?>


        <!-- =================================================
             CTA
        ================================================== -->

        <div class="review-cta">

            <div class="cta-content">

                <div class="cta-icon">

                    <i class="fas fa-plane-departure"></i>

                </div>

                <h2>
                    Your Next Journey Starts Here
                </h2>

                <p>
                    Join travellers who have already created unforgettable
                    memories with Delvia Holidays International.
                    Your next adventure could be our next great story.
                </p>

                <a
                    href="#"
                    class="cta-button"
                >

                    Plan Your Trip

                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</section>


<?php include 'footer.php'; ?>