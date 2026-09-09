<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?= esc($packages['title']); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="<?= ($packages['meta_description']); ?>" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="<?= base_url('asset/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('asset/lib/lightbox/css/lightbox.min.css'); ?>" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?= base_url('asset/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?= base_url('asset/css/style.css'); ?>" rel="stylesheet">
        </head>



    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="tel:0123456789"><small class="me-3 text-light"><i class="fas fa-phone-alt"></i> 0123456789</small></a>
                        <a href="mailto:info@localhost.com"><small class="me-3 text-light"><i class="fas fa-envelope me-2"></i>info@localhost.com</small></a>
                        <a href="login"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                        <!--<div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                     <img src="img/logo.png" alt="Logo"> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="/" class="nav-item nav-link">Home</a>
                        <a href="<?= base_url('about') ?>" class="nav-item nav-link">About</a>
                        <a href="<?= base_url('services') ?>" class="nav-item nav-link">Services</a>
                        <a href="<?= base_url('holiday-packages') ?>" class="nav-item nav-link">Holiday Package</a>
                        <a href="<?= base_url('membership') ?>" class="nav-item nav-link">Membership</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Destination</a>
                            <div class="dropdown-menu m-0">
                                <a href="<?= base_url('domestic') ?>" class="dropdown-item">Domestic</a>
                                <a href="<?= base_url('international') ?>" class="dropdown-item">International</a>
                            </div>
                        </div>
                        <a href="<?= base_url('blog') ?>" class="nav-item nav-link">Blog</a>
                        <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="booking" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
                </div>
            </nav>

     <!-- Header Start -->
     <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Our Packages</h3>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Package</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
   <!-- Blog Container -->
<div class="blog-container">
<h1 class="blog-title"><?= esc($packages['title']); ?></h1>

    <?php if (isset($packages['image']) && $packages['image']): ?>
        <div class="blog-image-container">
            <img src="<?= base_url('uploads/packages/' . $packages['image']); ?>" alt="<?= $packages['title']; ?>" class="blog-image">
        </div>
    <?php endif; ?>

    <p class="blog-meta">Published on: <?= date('F j, Y', strtotime($packages['created_at'])); ?></p>
    <div class="blog-content">
    <?php
        $content = nl2br($packages['content']);
        $content = preg_replace('/\s+/', ' ', $content);

        echo $content;
    ?>

    <!-- Amenities Section -->
<div class="amenities">
    <h6>Amenities</h6>
    <div class="amen_icon_main row"> <!-- Add row for grid structure -->
        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/wifi.png'); ?>">
                <p>Wi Fi</p>
            </div>
        </div>
        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/parking.png'); ?>">
                <p>Parking</p>
            </div>
        </div>
        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/cutlery.png'); ?>">
                <p>Food</p>
            </div>
        </div>

        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/ac.png'); ?>">
                <p>Air Conditioned</p>
            </div>
        </div>
        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/swimming-pool.png'); ?>">
                <p>Swimming Pool</p>
            </div>
        </div>
        <div class="col-md-4 col-6"> <!-- Each column will take 4/12 on medium screens and 6/12 on smaller screens -->
            <div class="amen_icon">
                <img src="<?= base_url('asset/icons/room-service.png'); ?>">
                <p>Room Service</p>
            </div>
        </div>
    </div>
</div>
</div>

</div>


        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Company</h4>
                            <a href="<?= base_url('about') ?>"><i class="fas fa-angle-right me-2"></i> About</a>
                            <a href="<?= base_url('entertainment') ?>"><i class="fas fa-angle-right me-2"></i> Entertainment</a>
                            <a href="<?= base_url('blog') ?>"><i class="fas fa-angle-right me-2"></i> Blog</a>
                            <a href="<?= base_url('gallery') ?>"><i class="fas fa-angle-right me-2"></i> Our Gallery</a>
                            <a href="<?= base_url('voucher') ?>"><i class="fas fa-angle-right me-2"></i> Voucher</a>
                            <a href="<?= base_url('review') ?>"><i class="fas fa-angle-right me-2"></i> Client Review</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Support</h4>
                            <a href="<?= base_url('contact') ?>"><i class="fas fa-angle-right me-2"></i> Contact</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                            <a href="<?= base_url('privacy-policy') ?>"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="<?= base_url('terms-and-conditions') ?>"><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                            <a href="<?= base_url('sitemap') ?>"><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <div class="row gy-3 gx-2 mb-4">
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">Arabic</option>
                                                <option value="2">German</option>
                                                <option value="3">Greek</option>
                                                <option value="3">New York</option>
                                            </select>
                                            <label for="select1">English</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">USD</option>
                                                <option value="2">EUR</option>
                                                <option value="3">INR</option>
                                                <option value="3">GBP</option>
                                            </select>
                                            <label for="select1">$</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="text-white mb-3">Payments</h4>
                            <div class="footer-bank-card">
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                <!--<a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>-->
                                <a href="#"> <img src="<?= base_url('asset/img/appstore.png'); ?>" class="store"></a>
                                <a href="#"> <img src="<?= base_url('asset/img/googleplay.png'); ?>" class="store"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('asset/lib/easing/easing.min.js'); ?>"></script>
        <script src="<?= base_url('asset/lib/waypoints/waypoints.min.js'); ?>"></script>
        <script src="<?= base_url('asset/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>
        <script src="<?= base_url('asset/lib/lightbox/js/lightbox.min.js'); ?>"></script>
        
        <!-- Template Javascript -->
        <script src="<?= base_url('asset/js/main.js'); ?>"></script>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('asset/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('asset/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>


    <style>
 /* General container styles */
.blog-container {
    width: 80%;
    margin: 30px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    font-family: 'Roboto', sans-serif;
    color: #333;
}

/* Blog image container */
.blog-image-container {
    max-width: 100%;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 25px;
    max-height: 500px;

}

/* Blog image styling */
.blog-image {
    width: 100%; /* Full width for the image */
    height: auto;
    display: block;
    border-radius: 10px;
    object-fit: cover;
}

/* Blog title */
.blog-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #222;
    margin-bottom: 15px;
    text-align: center;
}

/* Blog meta */
.blog-meta {
    font-size: 1.1rem;
    color: #777;
    text-align: center;
    margin-bottom: 30px;
}

/* Blog content */
.blog-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #555;
    text-align: justify;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
}

/* Ensure proper padding and margin for paragraphs */
.blog-content p {
    margin-bottom: 20px;
}

/* Make the blog look good on smaller screens */
@media (max-width: 768px) {
    .blog-container {
        width: 90%;
        padding: 20px;
    }

    .blog-title {
        font-size: 2rem;
    }

    .blog-meta {
        font-size: 1rem;
    }

    .blog-content {
        font-size: 1rem;
        padding: 15px;
    }

    .blog-image {
        width: 100%; /* Full width for small screens */
    }
}
        </style>

</html>