<!DOCTYPE html>
<html lang="en">

<body>
<!-- ===================== FOOTER START ===================== -->
<div class="container-fluid footer py-5">
    <div class="container py-5">

        <!-- ================= ROW 1 ================= -->
        <div class="row g-4">

            <!-- Get In Touch -->
            <div class="col-lg-5 col-md-12 ">
                <div class="footer-item d-flex flex-column">

                    <h4 class="mb-4 text-white">Get In Touch</h4>

                    <a href="https://maps.app.goo.gl/KoTRnXyjgvr485Lp8">
                        <i class="fas fa-home me-2"></i>
                        Building No. 5, Third Floor, Raja Dhirsain Marg (Main Rd),
                        Sant Nagar, East of Kailash, New Delhi, Delhi 110065
                    </a>

                    <a href="mailto:info@delviaholidaysinternational.com" style="font-size:13px;">
                        <i class="fas fa-envelope me-2"></i>
                        info@delviaholidaysinternational.com
                    </a>

                    <a href="tel:01135236123">
                        <i class="fas fa-phone me-2"></i>
                        011 3523 6123
                    </a>

                    <a href="tel:01141633722">
                        <i class="fas fa-phone me-2"></i>
                        011 4163 3722
                    </a>

                    <div class="d-flex align-items-center mt-3">

                        <i class="fas fa-share fa-2x text-white me-2"></i>

                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://www.facebook.com/delviaholidays/"><i class="fab fa-facebook-f"></i></a>

                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://x.com/delviaholidays"><i class="fab fa-twitter"></i></a>

                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://www.instagram.com/delviaholidays/"><i class="fab fa-instagram"></i></a>

                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://www.linkedin.com/company/delviaholidays"><i class="fab fa-linkedin-in"></i></a>

                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="https://www.youtube.com/@delviaholidays"><i class="fab fa-youtube"></i></a>

                    </div>

                </div>
            </div>

            <!-- Company -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-item d-flex flex-column">

                    <h4 class="mb-4 text-white">Company</h4>

                    <a href="<?= base_url('gallery') ?>"><i class="fas fa-angle-right me-2"></i>Entertainment</a>

                    <a href="<?= base_url('reviews') ?>"><i class="fas fa-angle-right me-2"></i>Testimonials</a>

                    <a href="<?= base_url('video-reviews') ?>"><i class="fas fa-angle-right me-2"></i>Video Testimonials</a>

                    <a href="<?= base_url('holiday-packages') ?>"><i class="fas fa-angle-right me-2"></i>Packages</a>

                    <a href="<?= base_url('vouchers') ?>"><i class="fas fa-angle-right me-2"></i>Vouchers</a>

                </div>
            </div>

            <!-- Support -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-item d-flex flex-column">

                    <h4 class="mb-4 text-white">Support</h4>

                    <a href="<?= base_url('contact') ?>"><i class="fas fa-angle-right me-2"></i>Contact</a>

                    <a href="<?= base_url('refund-policy') ?>"><i class="fas fa-angle-right me-2"></i>Refund Policy</a>

                    <a href="<?= base_url('privacy-policy') ?>"><i class="fas fa-angle-right me-2"></i>Privacy Policy</a>

                    <a href="<?= base_url('term-and-condition') ?>"><i class="fas fa-angle-right me-2"></i>Terms & Conditions</a>

                    <a href="<?= base_url('payment') ?>"><i class="fas fa-angle-right me-2"></i>Payment</a>

                </div>
            </div>

        </div>
        <!-- END ROW 1 -->



    </div>
</div>
<!-- ===================== FOOTER END ===================== -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- ==================== JAVASCRIPT LIBRARIES (UNCHANGED) ==================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Note: easing, waypoints, owlcarousel, lightbox, and main.js would be loaded via base_url() in production -->
    <!-- <script src="<?= base_url('asset/lib/easing/easing.min.js') ?>"></script> -->
    <!-- <script src="<?= base_url('asset/lib/waypoints/waypoints.min.js') ?>"></script> -->
    <!-- <script src="<?= base_url('asset/lib/owlcarousel/owl.carousel.min.js') ?>"></script> -->
    <!-- <script src="<?= base_url('asset/lib/lightbox/js/lightbox.min.js') ?>"></script> -->
    <!-- <script src="<?= base_url('asset/js/main.js') ?>"></script> -->

    <!-- ==================== MINIMAL JS FOR FADE-UP ANIMATIONS ==================== -->
    <script>
        /**
         * Footer Fade-Up Animation
         * Uses Intersection Observer - lightweight, no dependencies
         * Does NOT interfere with any existing JavaScript functionality
         */
        (function() {
            // Wait for DOM to be ready
            function initFooterAnimations() {
                const footerItems = document.querySelectorAll('.footer .footer-item');

                if (!footerItems.length) return;

                // Add fade-up-ready class to all footer items
                footerItems.forEach(function(item) {
                    item.classList.add('fade-up-ready');
                });

                // Intersection Observer for scroll-triggered fade-up
                if ('IntersectionObserver' in window) {
                    const observerOptions = {
                        root: null,
                        rootMargin: '0px 0px -40px 0px',
                        threshold: 0.1
                    };

                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('fade-up-visible');
                                // Stop observing once visible
                                observer.unobserve(entry.target);
                            }
                        });
                    }, observerOptions);

                    footerItems.forEach(function(item) {
                        observer.observe(item);
                    });
                } else {
                    // Fallback: show all items immediately
                    footerItems.forEach(function(item) {
                        item.classList.add('fade-up-visible');
                    });
                }
            }

            // Run on DOMContentLoaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initFooterAnimations);
            } else {
                initFooterAnimations();
            }

            // Also handle the copyright section fade
            function initCopyrightFade() {
                const copyright = document.querySelector('.container-fluid.copyright');
                if (!copyright) return;

                copyright.style.opacity = '0';
                copyright.style.transform = 'translateY(15px)';
                copyright.style.transition = 'all 0.7s cubic-bezier(0.25, 0.8, 0.25, 1)';

                if ('IntersectionObserver' in window) {
                    const copyrightObserver = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                entry.target.style.opacity = '1';
                                entry.target.style.transform = 'translateY(0)';
                                copyrightObserver.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.2 });

                    copyrightObserver.observe(copyright);
                } else {
                    copyright.style.opacity = '1';
                    copyright.style.transform = 'translateY(0)';
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCopyrightFade);
            } else {
                initCopyrightFade();
            }
        })();
    </script>
    <!-- ==================== END OF FADE-UP JS ==================== -->

</body>
</html>