<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php
    if (!isset($title)) {
        $path = trim($_SERVER['REQUEST_URI'], '/');
        if ($path == '') {
            $title = 'Delvia Holidays International';
        } else {
            $title = ucwords(str_replace('-', ' ', $path)) . ' | Delvia Holidays International';
        }
    }
    ?>

    <?php
    $destinationModel = new \App\Models\DestinationModel();

    // Domestic
    $domesticData = $destinationModel
        ->select('directions, name')
        ->where('category', 'Domestic')
        ->where('status', 1)
        ->orderBy('directions')
        ->findAll();

    $domesticMenu = [];
    foreach ($domesticData as $row) {
        $domesticMenu[$row['directions']][] = $row['name'];
    }

    // International
    $internationalData = $destinationModel
        ->select('directions, name')
        ->where('category', 'International')
        ->where('status', 1)
        ->orderBy('directions')
        ->findAll();

    $internationalMenu = [];
    foreach ($internationalData as $row) {
        $internationalMenu[$row['directions']][] = $row['name'];
    }
    ?>

    <title><?= $title ?></title>

    <?php
    if (!isset($description)) {
        $path = trim($_SERVER['REQUEST_URI'], '/');
        if ($path != '') {
            $pageName = ucwords(str_replace('-', ' ', $path));
            $description = $pageName . ' at Delvia Holidays International – Explore premium holiday memberships, luxury stays, and unforgettable travel experiences.';
        }
    }
    ?>
    <meta name="description" content="<?= $description ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="<?= base_url('asset/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">

    <!-- Yahan aapki 3 CSS files linked hain -->
    <link href="<?= base_url('asset/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/additional.css') ?>" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <?php
    $canonical = strtok("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?');
    ?>
    <link rel="canonical" href="<?php echo $canonical; ?>" />

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Delvia Holidays International",
  "alternateName": "Delvia Holidays",
  "url": "https://delviaholidaysinternational.com",
  "logo": "https://delviaholidaysinternational.com/asset/img/delviaholiday-logo.svg",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91-011 3523 6123",
    "contactType": "customer service",
    "areaServed": "IN",
    "availableLanguage": ["English", "Hindi"]
  },
  "sameAs": [
    "https://www.facebook.com/delviaholidays/",
    "https://www.instagram.com/delviaholidays/",
    "https://www.youtube.com/@delviaholidays",
    "https://x.com/delviaholidays",
    "https://www.pinterest.com/delviaholidays/",
    "https://www.linkedin.com/company/delviaholidays"
  ]
}
</script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6GGXD11DCW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6GGXD11DCW');
    </script>
</head>

<body>

    <!-- HEADER START -->
    <header class="main-header" id="mainHeader">
        <!-- ========== TOP BAR ========== -->
        <div class="top-bar d-none d-lg-flex">
            <div class="container-fluid px-4 px-xl-5 d-flex justify-content-between align-items-center">
                <!-- Left -->
                <div class="top-bar-left d-flex align-items-center gap-4">
                    <a href="tel:+9101135236123" class="top-contact">
                        <i class="fas fa-phone-alt me-1"></i> +91-011 3523 6123
                    </a>
                    <a href="mailto:info@delviaholidays.com" class="top-contact">
                        <i class="fas fa-envelope me-1"></i> info@delviaholidays.com
                    </a>
                    <span class="top-contact">
                        <i class="fas fa-map-marker-alt me-1"></i> India
                    </span>
                </div>
                <!-- Right -->
                <div class="top-bar-right d-flex align-items-center gap-3">
                    <div class="social-icons d-flex gap-2">
                        <a href="https://www.facebook.com/delviaholidays/" aria-label="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/delviaholidays/" aria-label="Instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@delviaholidays" aria-label="YouTube"><i
                                class="fab fa-youtube"></i></a>
                        <a href="https://x.com/delviaholidays" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.pinterest.com/delviaholidays/" aria-label="Pinterest"><i
                                class="fab fa-pinterest"></i></a>
                        <a href="https://www.linkedin.com/company/delviaholidays" aria-label="LinkedIn"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="lang-switch">
                        <select class="form-select-sm" aria-label="Language">
                            <option selected>EN</option>
                            <option>HI</option>
                        </select>
                    </div>
                    <div class="currency-switch">
                        <select class="form-select-sm" aria-label="Currency">
                            <option selected>INR ₹</option>
                            <option>USD $</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== MAIN NAVBAR ========== -->
        <nav class="navbar navbar-expand-lg px-4 px-lg-5 py-2 py-lg-0 w-100 main-navbar" id="navbarMain">
            <a href="<?= base_url() ?>" class="navbar-brand p-0">
                <img src="<?= base_url('asset/img/delviaholiday-logo.svg') ?>" alt="Logo" class="header-logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
               
                <div class="navbar-nav mx-auto py-0 main-menu-links">
                     
                    <a href="<?= base_url() ?>" class="nav-item nav-link active">Home</a>
                    <a href="<?= base_url('about') ?>" class="nav-item nav-link">About</a>
                    <a href="<?= base_url('services') ?>" class="nav-item nav-link">Services</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Destination</a>
                        <div class="dropdown-menu main-menu shadow-lg border-0 m-0">
                            <!-- Domestic -->
                            <div class="dropend submenu-parent">
                                <a href="#" class="dropdown-item dropdown-toggle">Domestic</a>
                                <div class="submenu">
                                    <?php foreach ($domesticMenu as $direction => $cities): ?>
                                        <div class="dropend submenu-parent">
                                            <a href="#" class="dropdown-item dropdown-toggle"> <?= ucfirst($direction) ?>
                                                India </a>
                                            <div class="submenu">
                                                <?php foreach ($cities as $city): ?>
                                                    <?php
                                                    $city_slug = strtolower(trim(str_replace(' ', '-', $city)));
                                                    $direction_slug = strtolower(trim(str_replace(' ', '-', $direction)));
                                                    ?>
                                                    <a class="dropdown-item"
                                                        href="<?= base_url('destination/domestic/' . $direction_slug . '/' . $city_slug) ?>">
                                                        <?= ucfirst($city) ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- International -->
                            <div class="dropend submenu-parent">
                                <a href="#" class="dropdown-item dropdown-toggle">International</a>
                                <div class="submenu">
                                    <?php foreach ($internationalMenu as $direction => $cities): ?>
                                        <div class="dropend submenu-parent">
                                            <a href="#" class="dropdown-item dropdown-toggle"> <?= ucfirst($direction) ?>
                                            </a>
                                            <div class="submenu">
                                                <?php foreach ($cities as $city): ?>
                                                    <?php
                                                    $city_slug = strtolower(trim(str_replace(' ', '-', $city)));
                                                    $direction_slug = strtolower(trim(str_replace(' ', '-', $direction)));
                                                    ?>
                                                    <a class="dropdown-item"
                                                        href="<?= base_url('destination/international/' . $direction_slug . '/' . $city_slug) ?>">
                                                        <?= ucfirst($city) ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?= base_url('membership') ?>" class="nav-item nav-link">Membership</a>
                    <a href="<?= base_url('travel-desk') ?>" class="nav-item nav-link">Travel Desk</a>
                    
                    <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
                </div>

                <!-- Action Buttons + Search -->
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0 header-actions">
                    <!-- Search Toggle -->
                    <button class="search-toggle-btn" id="searchToggle" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>

                    <a href="<?= base_url('payment') ?>" class="btn btn-pay-now">Pay Now</a>
                    <a href="<?= base_url('login') ?>" class="btn btn-login-outline">Login</a>
                </div>
            </div>
        </nav>

        <!-- Hidden Search Form -->
        <div class="header-search-form" id="headerSearchForm">
            <div class="container">
                <form action="<?= base_url('search') ?>" method="get" class="d-flex">
                    <input type="text" name="q" class="form-control" placeholder="Search destinations, blogs..."
                        aria-label="Search">
                    <button type="submit" class="btn-search-submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>
    <!-- MOBILE BACKDROP OVERLAY -->
    <div class="mobile-backdrop" id="mobileBackdrop"></div>
    <!-- HEADER END -->

    <script>
        // ---- Sticky Header ----
        const header = document.getElementById('mainHeader');
        const navbar = document.getElementById('navbarMain');
        if (header && navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 30) {
                    header.classList.add('sticky-active');
                } else {
                    header.classList.remove('sticky-active');
                }
            });
        }

        // ---- Search Toggle ----
        const searchToggle = document.getElementById('searchToggle');
        const searchForm = document.getElementById('headerSearchForm');
        if (searchToggle && searchForm) {
            searchToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                searchForm.classList.toggle('show');
            });
            document.addEventListener('click', (event) => {
                if (!searchForm.contains(event.target) && event.target !== searchToggle && !searchToggle.contains(event.target)) {
                    searchForm.classList.remove('show');
                }
            });
        }

        // ---- Mobile Sidebar Overlay ----
        const mobileBackdrop = document.getElementById('mobileBackdrop');
        const navbarCollapse = document.getElementById('navbarCollapse');
        const toggler = document.querySelector('.navbar-toggler');

        if (navbarCollapse && mobileBackdrop) {
            // Show/hide overlay based on Bootstrap collapse events
            navbarCollapse.addEventListener('show.bs.collapse', () => {
                mobileBackdrop.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            navbarCollapse.addEventListener('hide.bs.collapse', () => {
                mobileBackdrop.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Clicking backdrop closes the menu
            mobileBackdrop.addEventListener('click', () => {
                if (navbarCollapse.classList.contains('show')) {
                    toggler.click(); // trigger collapse hide
                }
            });

            // Click on the close pseudo-element (✕) inside sidebar
            navbarCollapse.addEventListener('click', (e) => {
                if (e.target === navbarCollapse) {
                    toggler.click();
                }
            });
        }

        // ---- Existing Mobile Submenu Accordion (unchanged) ----
        document.querySelectorAll('.submenu-parent > a').forEach(link => {
            link.addEventListener('click', function (e) {
                if (window.innerWidth <= 991) {
                    e.preventDefault();

                    let submenu = this.nextElementSibling;

                    let siblings = this.parentElement.parentElement.querySelectorAll(':scope > .submenu-parent .submenu');
                    siblings.forEach(sm => {
                        if (sm !== submenu) sm.classList.remove('open');
                    });

                    submenu.classList.toggle('open');
                }
            });
        });

        // Mobile Close Button

        const mobileClose = document.getElementById("mobileMenuClose");

        

        if (mobileClose) {

            mobileClose.addEventListener("click", function () {

                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);

                if (bsCollapse) {
                    bsCollapse.hide();
                }

            });

        }
    </script>