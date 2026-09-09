<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

<?php
$title = "International Destinations | Delvia Holidays International";
$description = "Discover international destinations with Delvia Holidays International. Enjoy luxury resorts & hotels worldwide for unforgettable holiday experiences.";
?>

<title><?= $title ?></title>

<meta name="description" content="<?= $description ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 
    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <!-- CSS -->
    <link href="<?= base_url('asset/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/additional.css') ?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta name="p:domain_verify" content="24bc455261e801e49304af60b0469f13"/>
    <link rel="canonical" href="<?= current_url() ?>" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- X (Twitter) Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Delvia Holidays International - Discover Exclusive Holidays">
<meta name="twitter:description" content="Plan your next dream vacation with Delvia Holidays. Luxury resorts, premium packages, and unforgettable experiences await.">
<meta name="twitter:image" content="https://delviaholidaysinternational.com/asset/img/Homeaboutes.jpg">
<meta name="twitter:site" content="@DelviaHolidays">
<link rel="icon" type="image/png" href="<?= base_url('favicon.ico') ?>">
<link rel="apple-touch-icon" href="apple-touch-icon.png">


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Delvia Holidays International",
  "image": "https://delviaholidaysinternational.com/asset/img/delviaholidayt-logo.svg",
  "url": "https://delviaholidaysinternational.com/",
  "telephone": "+91-XXXXXXXXXX",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "B2, First Floor, F-26/3, Ram Dulari Tundelkar Ji Rd, Pocket D, Okhla Phase II, Okhla Industrial Estate",
    "addressLocality": "New Delhi",
    "postalCode": "110020",
    "addressCountry": "IN"
  },
  "openingHours": "Mo-Sa 11:00-16:00",
  "priceRange": "₹₹"
}
</script>

 <script type="application/ld+json">
      {"aggregateRating":
      {"ratingCount":502,
      "ratingValue":4.9,
      "reviewCount":502,
      "@type":"AggregateRating"},
      "brand":{"@type":"Travle & Tourism",
      "name":"Delvia Holidays International",
      "url":"https://delviaholidaysinternational.com/"},
      "category":"Travle & Tourism",
      "description": "Delvia Holidays International is a trusted name in travel and hospitality, specializing in exclusive holiday memberships, luxury stays, and tailor-made travel experiences. With access to premium resorts, hotels, and global destinations, we provide stress-free holidays for families, couples, and corporates. Our mission is to blend luxury, comfort, and affordability to create unforgettable travel experiences. Whether it’s a beach escape, a romantic honeymoon, or a corporate retreat, Delvia Holidays International makes your journey memorable.",
      "image": "https://delviaholidaysinternational.com/asset/img/delviaholidayt-logo.svg",
      "name": "Delvia Holidays International",
      "url": "https://delviaholidaysinternational.com/",
      "@context":"http://schema.org",
      "@type":"Product"}
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6GGXD11DCW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6GGXD11DCW');
</script>

<style>
/* =========================================================
   DESTINATIONS PAGE - PREMIUM DESIGN
========================================================= */

:root {
    --primary: #18B8A7;
    --primary-dark: #0fa395;
    --primary-light: #e6f9f7;
    --secondary: #F4A261;
    --secondary-dark: #e89240;
    --white: #FFFFFF;
    --bg-light: #F9FAFB;
    --heading: #1F2937;
    --text: #6B7280;
    --text-light: #9CA3AF;
    --border: #E5E7EB;

    --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow: 0 4px 6px rgba(0,0,0,.05), 0 2px 4px rgba(0,0,0,.04);
    --shadow-md: 0 10px 25px rgba(0,0,0,.08), 0 4px 10px rgba(0,0,0,.04);
    --shadow-lg: 0 20px 50px rgba(0,0,0,.12), 0 8px 20px rgba(0,0,0,.06);
    --shadow-glow: 0 0 40px rgba(24,184,167,.20), 0 10px 30px rgba(24,184,167,.12);

    --radius-sm: 10px;
    --radius: 16px;
    --radius-md: 20px;
    --radius-lg: 24px;
    --radius-xl: 32px;

    --transition: .3s cubic-bezier(.4,0,.2,1);
    --transition-smooth: .5s cubic-bezier(.25,.46,.45,.94);

    --font-heading: 'Outfit','Poppins',sans-serif;
    --font-body: 'Inter',sans-serif;
}

/* GENERAL PAGE */
.destinations-page {
    background:
        radial-gradient(circle at 10% 10%, rgba(24,184,167,.06), transparent 30%),
        radial-gradient(circle at 90% 50%, rgba(244,162,97,.05), transparent 30%),
        var(--bg-light);
}

/* BREADCRUMB HERO */
.bg-breadcrumb {
    position: relative;
    background:
        linear-gradient(rgba(15,163,149,.92), rgba(24,184,167,.85)),
        url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
    padding: 100px 0 80px;
    overflow: hidden;
}

.bg-breadcrumb::after {
    content: "";
    position: absolute;
    bottom: -60px;
    left: 0;
    right: 0;
    height: 120px;
    background: var(--bg-light);
    border-radius: 50% 50% 0 0;
    transform: scaleX(1.2);
}

.bg-breadcrumb .container {
    position: relative;
    z-index: 2;
}

.bg-breadcrumb h3 {
    font-family: var(--font-heading);
    font-weight: 800;
    letter-spacing: -1px;
    margin-bottom: 20px;
    animation: fadeInUp .8s ease-out;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    font-family: var(--font-body);
    font-size: 15px;
    animation: fadeInUp .8s ease-out .2s both;
}

.breadcrumb-item a {
    color: rgba(255,255,255,.85);
    text-decoration: none;
    transition: color var(--transition);
}

.breadcrumb-item a:hover {
    color: var(--secondary);
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #fff;
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "\f105";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: rgba(255,255,255,.7);
    padding: 0 8px;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* CATEGORY TITLE SECTION */
.category-title-wrap {
    background: var(--white);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow);
    padding: 25px 30px;
    margin: -40px auto 40px;
    max-width: 900px;
    text-align: center;
    position: relative;
    z-index: 3;
    border: 1px solid var(--border);
}

.category-title {
    font-family: var(--font-heading);
    font-size: 28px;
    font-weight: 700;
    color: var(--heading);
    margin: 0;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.category-title i {
    color: var(--primary);
    font-size: 24px;
}

/* FILTER SIDEBAR */
.filter-sidebar {
    position: sticky;
    top: 100px;
    background: var(--white);
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    padding: 20px;
    transition: var(--transition);
}

.filter-sidebar:hover {
    box-shadow: var(--shadow-md);
}

.filter-title {
    font-family: var(--font-heading);
    font-size: 18px;
    font-weight: 700;
    color: var(--heading);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-title i {
    color: var(--primary);
}

.filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.filter-list li {
    margin-bottom: 12px;
}

.custom-control-input {
    cursor: pointer;
}

.custom-control-label {
    cursor: pointer;
    font-family: var(--font-body);
    font-size: 14px;
    color: var(--text);
    padding-left: 5px;
    transition: color var(--transition);
}

.custom-control-input:checked ~ .custom-control-label {
    color: var(--primary);
    font-weight: 600;
}

/* DESTINATION CARD */
.destination-item {
    background: var(--white);
    border-radius: var(--radius-md);
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    transition: transform var(--transition-smooth), box-shadow var(--transition-smooth), border-color var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.destination-item:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-glow);
    border-color: rgba(24,184,167,.25);
}

.destination-img {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.destination-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .7s cubic-bezier(.25,.46,.45,.94), filter .5s ease;
}

.destination-item:hover .destination-img img {
    transform: scale(1.1);
    filter: brightness(.75);
}

.destination-img::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40%;
    background: linear-gradient(to top, rgba(0,0,0,.6), transparent);
    opacity: 0;
    transition: opacity var(--transition);
}

.destination-item:hover .destination-img::after {
    opacity: 1;
}

.destination-content {
    padding: 20px 20px 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.destination-content h4 {
    font-family: var(--font-heading);
    font-size: 20px;
    font-weight: 700;
    color: var(--heading);
    margin-bottom: 10px;
    transition: color var(--transition);
}

.destination-item:hover .destination-content h4 {
    color: var(--primary);
}

.resort-description {
    font-size: 14px;
    color: var(--text);
    line-height: 1.6;
    margin-bottom: 15px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    border-radius: 50px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: .3px;
    transition: var(--transition);
    box-shadow: 0 4px 10px rgba(24,184,167,.3);
    align-self: flex-start;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(24,184,167,.4);
}

/* Details and Includes Icons */
.detailsEnclude {
    margin-top: 15px;
    border-top: 1px solid var(--border);
    padding-top: 15px;
}

.detailsEnclude h6 {
    font-family: var(--font-heading);
    font-size: 14px;
    font-weight: 700;
    color: var(--heading);
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.desti_icon_main {
    align-items: center;
}

.desti_icon {
    text-align: center;
}

.desti_icon img {
    width: 28px;
    height: 28px;
    margin-bottom: 5px;
    filter: drop-shadow(0 1px 2px rgba(0,0,0,.1));
}

.desti_icon p {
    font-size: 11px;
    color: var(--text);
    margin: 0;
    line-height: 1.2;
}

/* Responsive */
@media (max-width: 991px) {
    .destination-img {
        height: 200px;
    }
}

@media (max-width: 767px) {
    .filter-sidebar {
        position: static;
        margin-bottom: 30px;
    }

    .category-title-wrap {
        margin-top: -30px;
        padding: 20px;
    }

    .destination-img {
        height: 180px;
    }
}

@media (max-width: 576px) {
    .destination-img {
        height: 200px;
    }

    .desti_icon img {
        width: 22px;
        height: 22px;
    }
}
</style>

</head>
<body>

<!-- Hero Section Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-lg-0 position-absolute w-100" style="z-index: 10;">
        <a href="<?= base_url() ?>" class="navbar-brand p-0">
            <img src="<?= base_url('asset/img/delviaholiday-logo.svg') ?>" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="<?= base_url() ?>" class="nav-item nav-link">Home</a>
                <a href="<?= base_url('about') ?>" class="nav-item nav-link">About</a>
                <a href="<?= base_url('services') ?>" class="nav-item nav-link">Services</a>
                <a href="<?= base_url('membership') ?>" class="nav-item nav-link">Membership</a>
                <a href="<?= base_url('reviews') ?>" class="nav-item nav-link">Reviews</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Destination</a>
                    <div class="dropdown-menu m-0">
                        <a href="<?= base_url('domestic') ?>" class="dropdown-item">Domestic</a>
                        <a href="<?= base_url('international') ?>" class="dropdown-item">International</a>
                    </div>
                </div>
                <a href="<?= base_url('blogs') ?>" class="nav-item nav-link">Blog</a>
                <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
            </div>
            <a href="<?= base_url('login') ?>" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Login</a>
        </div>
    </nav>


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Destinations</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white"><?= ucwords($category) ?> Destinations</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Main Content -->
<section class="destinations-page py-5">
    <div class="container">
        <!-- Category Title -->
        <div class="category-title-wrap">
            <h2 class="category-title">
                <i class="fas fa-map-marked-alt"></i>
                <?= ucwords($category) ?> Destinations
            </h2>
        </div>

        <div class="row g-4">
            <!-- Sidebar for City Filter -->
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <h4 class="filter-title"><i class="fas fa-filter"></i> Filter by City</h4>
                    <ul class="filter-list">
                        <?php if (!empty($cities)) : ?>
                            <?php foreach ($cities as $city) : ?>
                                <li>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input cities" id="city<?= $city['id']; ?>" value="<?= $city['id']; ?>">
                                        <span class="custom-control-label"><?= $city['name']; ?></span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li>No cities available.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Resorts Listing -->
            <div class="col-md-9">
                <div id="filtered_data">
                    <div class="row g-4">
                        <?php foreach ($resorts as $resort) : ?>
                            <div class="col-md-6">
                                <div class="destination-item h-100">
                                    <div class="destination-img">
                                        <img src="<?= base_url('uploads/resorts/' . $resort['main_image']); ?>" alt="<?= $resort['name']; ?>" class="img-fluid">
                                    </div>
                                    <div class="destination-content">
                                        <h4><?= $resort['name']; ?></h4>
                                        <p class="resort-description">
                                            <?= implode(' ', array_slice(explode(' ', $resort['descr']), 0, 20)); ?>...
                                        </p>
                                        <a href="<?= base_url('property/' . $resort['slug']); ?>" class="btn btn-primary">Read more</a>
                                        <div class="detailsEnclude">
                                            <h6>Details and Includes</h6>
                                            <div class="row text-center desti_icon_main">
                                                <div class="col-2">
                                                    <div class="desti_icon">
                                                        <img src="asset/icons/bad.png" alt="Hotel" class="img-fluid">
                                                        <p>Hotel</p>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="desti_icon">
                                                        <img src="asset/icons/bus.png" alt="Transfer" class="img-fluid">
                                                        <p>Transfer</p>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="desti_icon">
                                                        <img src="asset/icons/bag.png" alt="Luggage" class="img-fluid">
                                                        <p>Luggage</p>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="desti_icon">
                                                        <img src="asset/icons/location1.png" alt="Location" class="img-fluid">
                                                        <p><?= $resort['destination_name']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Script -->
<script>
$(document).ready(function () {
    function applyFilter() {
        let selectedCities = $(".cities:checked").map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: "<?= base_url('international-destination/filterByCity') ?>",
            type: "POST",
            data: { city_ids: selectedCities },
            beforeSend: function () {
                $("#filtered_data").html("<p>Loading resorts...</p>");
            },
            success: function (response) {
                $("#filtered_data").html(response);
            },
            error: function () {
                $("#filtered_data").html("<p>An error occurred while loading resorts. Please try again.</p>");
            },
        });
    }

    $(".cities").on("change", function () {
        applyFilter();
    });

    if ($(".cities:checked").length > 0) {
        applyFilter();
    }
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>