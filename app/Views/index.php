<?php
$title = "Delvia Holidays International";
$description = "Turn your travel dreams into reality with Delvia Holidays International. Read real customer reviews and enjoy exclusive holidays with luxury stays across the world.";
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Travel - Premium Experience</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="main-content">

        <section class="video-hero">
            <div class="video-track" id="videoTrack">

                <div class="video-slide">
                    <video muted playsinline preload="auto">
                        <source src="asset/vid/3.mp4" type="video/mp4">
                    </video>

                </div>

                <div class="video-slide">
                    <video muted playsinline preload="auto">
                        <source src="asset/vid/2.mp4" type="video/mp4">
                    </video>

                    
                </div>

                <div class="video-slide">
                    <video muted playsinline preload="auto">
                        <source src="asset/vid/1.mp4" type="video/mp4">
                    </video>

                    
                </div>

                <div class="video-slide">
                    <video muted playsinline preload="auto">
                        <source src="asset/vid/4.mp4" type="video/mp4">
                    </video>

                    
                </div>

            </div>

            <button class="video-arrow prev" id="prevVideo">
                &#10094;
            </button>

            <button class="video-arrow next" id="nextVideo">
                &#10095;
            </button>

            <div class="video-dots" id="videoDots"></div>
        </section>



        <!-- ========== 4. POPULAR DESTINATIONS ========== -->
        <section class="section section-white" id="destinations">
            <div class="container">
                <div class="section-header center reveal">
                    
                    <h2 class="section-title">Popular Destinations</h2>
                    <p class="section-subtitle">Discover the world's most breathtaking locations handpicked for you.</p>
                </div>
                <div class="destinations-grid reveal-stagger">
                    <div class="dest-card wide">
                        <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800&q=80" alt="Paris"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=800&q=80'">
                        <div class="dest-overlay"></div>
                        <div class="dest-info">
                            <h4>Paris</h4><span>France • 12 Tours</span>
                        </div>
                    </div>
                    <div class="dest-card">
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80" alt="Bali"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1501179691627-eeaa65ea017c?w=600&q=80'">
                        <div class="dest-overlay"></div>
                        <div class="dest-info">
                            <h4>Bali</h4><span>Indonesia • 18 Tours</span>
                        </div>
                    </div>
                    <div class="dest-card">
                        <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=600&q=80"
                            alt="Maldives" loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=600&q=80'">
                        <div class="dest-overlay"></div>
                        <div class="dest-info">
                            <h4>Maldives</h4><span>Maldives • 8 Tours</span>
                        </div>
                    </div>
                    <div class="dest-card">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80"
                            alt="Maldives Beach" loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=600&q=80'">
                        <div class="dest-overlay"></div>
                        <div class="dest-info">
                            <h4>Bora Bora</h4><span>Polynesia • 6 Tours</span>
                        </div>
                    </div>
                    <div class="dest-card">
                        <img src="https://images.unsplash.com/photo-1549144511-f099e5a7a889?w=600&q=80" alt="Tokyo"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1542051841857-5f90071e7989?w=600&q=80'">
                        <div class="dest-overlay"></div>
                        <div class="dest-info">
                            <h4>Tokyo</h4><span>Japan • 15 Tours</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- ========== 3. POPULAR TRIPS ========== -->
        <section class="section section-light" id="popular-trips">
            <div class="container">
                <div class="section-header center reveal">
                    
                    <h2 class="section-title">Popular Trips</h2>
                    <p class="section-subtitle">Our most sought-after luxury packages loved by travelers worldwide.</p>
                </div>
                <div class="trips-grid reveal-stagger">
                    <!-- Trip Card 1 -->
                    <div class="trip-card">
                        <div class="trip-card-image">
                            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80"
                                alt="Bali" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1501179691627-eeaa65ea017c?w=600&q=80'">

                            <button class="trip-favorite" aria-label="Add to favorites">♡</button>
                        </div>
                        <div class="trip-card-body">
                            <div class="trip-location">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z" />
                                </svg>
                                Indonesia
                            </div>
                            <h4>Bali Paradise Escape</h4>
                            <div class="trip-meta">
                                <span class="trip-rating">★ 4.9</span>
                                <span>⏱ 7 Days</span>
                                <span>👤 2-6 People</span>
                            </div>
                            <div class="trip-footer">
                                <span class="trip-price">$2,499 <small>/ person</small></span>
                                <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Trip Card 2 -->
                    <div class="trip-card">
                        <div class="trip-card-image">
                            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=600&q=80"
                                alt="Paris" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600&q=80'">

                            <button class="trip-favorite" aria-label="Add to favorites">♡</button>
                        </div>
                        <div class="trip-card-body">
                            <div class="trip-location">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z" />
                                </svg>
                                France
                            </div>
                            <h4>Romantic Paris Getaway</h4>
                            <div class="trip-meta">
                                <span class="trip-rating">★ 4.8</span>
                                <span>⏱ 5 Days</span>
                                <span>👤 2 People</span>
                            </div>
                            <div class="trip-footer">
                                <span class="trip-price">$3,199 <small>/ person</small></span>
                                <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Trip Card 3 -->
                    <div class="trip-card">
                        <div class="trip-card-image">
                            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=600&q=80"
                                alt="Maldives" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=600&q=80'">

                            <button class="trip-favorite" aria-label="Add to favorites">♡</button>
                        </div>
                        <div class="trip-card-body">
                            <div class="trip-location">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z" />
                                </svg>
                                Maldives
                            </div>
                            <h4>Maldives Overwater Bliss</h4>
                            <div class="trip-meta">
                                <span class="trip-rating">★ 5.0</span>
                                <span>⏱ 6 Days</span>
                                <span>👤 2-4 People</span>
                            </div>
                            <div class="trip-footer">
                                <span class="trip-price">$5,899 <small>/ person</small></span>
                                <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>










        <!-- ========== 6. ACTIVITIES ========== -->
        <section class="section section-white" id="activities">
            <div class="container">
                <div class="section-header center reveal">
                    
                    <h2 class="section-title">Curated Activities</h2>
                    <p class="section-subtitle">Unforgettable experiences that make every journey extraordinary.
                    </p>
                </div>
                <div class="activities-grid reveal-stagger">
                    <div class="activity-card">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80"
                            alt="Snorkeling" loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=500&q=80'">
                        <div class="activity-overlay">
                            <h5> Snorkeling</h5>
                        </div>
                    </div>
                    <div class="activity-card">
                        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=500&q=80" alt="Hiking"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1551632811-561732d1e306?w=500&q=80'">
                        <div class="activity-overlay">
                            <h5> Mountain Hiking</h5>
                        </div>
                    </div>
                    <div class="activity-card">
                        <img src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?w=500&q=80" alt="Safari"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1516426122078-c23e76319801?w=500&q=80'">
                        <div class="activity-overlay">
                            <h5> Safari Tour</h5>
                        </div>
                    </div>
                    <div class="activity-card">
                        <img src="https://images.unsplash.com/photo-1549144511-f099e5a7a889?w=500&q=80" alt="Cultural"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1528127269322-539801943592?w=500&q=80'">
                        <div class="activity-overlay">
                            <h5> Cultural Tours</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== 7. STATISTICS COUNTER ========== -->
        <section class="counter-section section" id="stats">
            <div class="container">
                <div class="counters-grid reveal-stagger">
                    <div class="counter-item">

                        <div class="counter-number"><span class="count" data-target="150">0</span><span
                                class="suffix">+</span></div>
                        <div class="counter-label">Destinations</div>
                    </div>
                    <div class="counter-item">

                        <div class="counter-number"><span class="count" data-target="2500">0</span><span
                                class="suffix">+</span></div>
                        <div class="counter-label">Luxury Hotels</div>
                    </div>
                    <div class="counter-item">

                        <div class="counter-number"><span class="count" data-target="98000">0</span><span
                                class="suffix">+</span></div>
                        <div class="counter-label">Happy Clients</div>
                    </div>
                    <div class="counter-item">

                        <div class="counter-number"><span class="count" data-target="25">0</span><span
                                class="suffix">+</span></div>
                        <div class="counter-label">Years Experience</div>
                    </div>
                </div>
            </div>
        </section>



        <!-- ========== 9. TRAVEL BLOG ========== -->
        <section class="section section-white" id="blog">
            <div class="container">
                <div class="section-header center reveal">
                    
                    <h2 class="section-title">Travel Stories & Tips</h2>
                    <p class="section-subtitle">Inspiration and insights for your next luxury adventure.</p>
                </div>
                <div class="blog-grid reveal-stagger">
                    <div class="blog-card">
                        <div class="blog-card-image">
                            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=600&q=80"
                                alt="Beach" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80'">
                            <span class="blog-date">Aug 12, 2026</span>
                        </div>
                        <div class="blog-card-body">
                            <span class="blog-category">Destinations</span>
                            <h4>Top 10 Hidden Beaches in Southeast Asia</h4>
                            <a href="#" class="blog-read-more">Read More →</a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-card-image">
                            <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?w=600&q=80"
                                alt="Mountains" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600&q=80'">
                            <span class="blog-date">Jul 28, 2026</span>
                        </div>
                        <div class="blog-card-body">
                            <span class="blog-category">Adventure</span>
                            <h4>A Guide to Luxury Hiking in the Alps</h4>
                            <a href="#" class="blog-read-more">Read More →</a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-card-image">
                            <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&q=80"
                                alt="Dubai" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1501179691627-eeaa65ea017c?w=600&q=80'">
                            <span class="blog-date">Jul 15, 2026</span>
                        </div>
                        <div class="blog-card-body">
                            <span class="blog-category">Lifestyle</span>
                            <h4>Dubai: The Ultimate Luxury Shopping Guide</h4>
                            <a href="#" class="blog-read-more">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================
     AWARDS & ACHIEVEMENTS
================================ -->

        <section class="dh-awards-section">

            <div class="dh-awards-heading">
                

                <h2>Photo Gallery</h2>

                <div class="dh-awards-line"></div>
            </div>

            <div class="dh-awards-slider">

                <div class="dh-awards-track">

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\1.jpg" alt="Award 1">
                    </div>

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\2.jpg" alt="Award 2">
                    </div>

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\3.jpg" alt="Award 3">
                    </div>

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\4.jpg" alt="Award 4">
                    </div>

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\5.jpg" alt="Award 5">
                    </div>

                    <div class="dh-award-card">
                        <img src="asset\img\scroller\6.jpg" alt="Award 6">
                    </div>

                </div>

            </div>

        </section>


        <section class="travel-partners">

            <div class="container">

                <div class="section-heading">
                    <span class="sub-title">Tour & Travels</span>
                    <h2>Our Travel <span>Associates</span></h2>
                    <div class="title-line"></div>
                </div>

            </div>

            <div class="partner-slider">

                <div class="partner-track">

                    <!-- First Set -->
                    <div class="partner-card"><img src="asset\img\travelPartners\1.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\2.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\3.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\4.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\5.jpeg"></div>

                    <!-- Duplicate Set -->
                    <div class="partner-card"><img src="asset\img\travelPartners\1.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\2.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\3.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\4.jpeg"></div>
                    <div class="partner-card"><img src="asset\img\travelPartners\5.jpeg"></div>

                </div>

            </div>

        </section>

        <!--==================================================
        TESTIMONIAL SECTION START
===================================================-->
        <section class="testimonial-section">
            <div class="testimonial-container">

                <!-- Section Header -->
                <div class="testimonial-header">
                    <span class="testimonial-badge">
                        <i class="fa-solid fa-heart"></i>
                        Client Reviews
                    </span>

                    <h2>
                        What Our <span>Clients Say</span>
                    </h2>

                    <p>
                        Real experiences from people who trusted us and enjoyed
                        our services.
                    </p>
                </div>

                <!-- Testimonials -->
                <div class="testimonial-grid">

                    <!-- Card 1 -->
                    <div class="testimonial-card">
                        <div class="testimonial-top">
                            <div class="quote-icon">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>

                            <div class="testimonial-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <p class="testimonial-text">
                            "The entire experience was amazing. Everything was
                            perfectly organized and the service was excellent.
                            I would definitely recommend them."
                        </p>

                        <div class="testimonial-user">
                            <div class="user-avatar">
                                <img src=" " alt="Sarah Williams">
                            </div>

                            <div class="user-info">
                                <h4>Sarah Williams</h4>
                                <span>Travel Customer</span>
                            </div>

                            <div class="verified-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="testimonial-card featured">
                        <div class="testimonial-top">
                            <div class="quote-icon">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>

                            <div class="testimonial-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <p class="testimonial-text">
                            "Absolutely loved the service! The booking process
                            was simple, fast and smooth. Everything was exactly
                            as promised."
                        </p>

                        <div class="testimonial-user">
                            <div class="user-avatar">
                                <img src="" alt="James Anderson">
                            </div>

                            <div class="user-info">
                                <h4>James Anderson</h4>
                                <span>Happy Customer</span>
                            </div>

                            <div class="verified-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="testimonial-card">
                        <div class="testimonial-top">
                            <div class="quote-icon">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>

                            <div class="testimonial-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <p class="testimonial-text">
                            "Fantastic customer support and attention to detail.
                            They made our trip stress-free and truly memorable.
                            Highly recommended!"
                        </p>

                        <div class="testimonial-user">
                            <div class="user-avatar">
                                <img src="" alt="Emily Johnson">
                            </div>

                            <div class="user-info">
                                <h4>Emily Johnson</h4>
                                <span>Verified Traveller</span>
                            </div>

                            <div class="verified-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </section>


        <!--==================================================
        TESTIMONIAL SECTION END
===================================================-->



        <!-- cta section  -->

        <section class="footer-cta-section">
            <div class="footer-cta-container">

                <div class="footer-cta-content">

                    <span class="footer-cta-badge">
                        <i class="fa-solid fa-paper-plane"></i>
                        Start Your Journey
                    </span>

                    <h2>
                        Ready to Create
                        <span>Beautiful Memories?</span>
                    </h2>

                    <p>
                        Discover amazing destinations, premium stays and
                        unforgettable experiences with us.
                    </p>

                    <div class="footer-cta-buttons">

                        <a href="#" class="footer-cta-btn primary-btn">
                            Explore Now
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                        <a href="#" class="footer-cta-btn secondary-btn">
                            <i class="fa-solid fa-phone"></i>
                            Contact Us
                        </a>

                    </div>

                </div>

                <!-- Decorative Travel Icon -->
                <div class="footer-cta-icon icon-one">
                    <i class="fa-solid fa-plane"></i>
                </div>

                <div class="footer-cta-icon icon-two">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="footer-cta-circle circle-one"></div>
                <div class="footer-cta-circle circle-two"></div>

            </div>
        </section>



    </main>
    <!-- ==================== END MAIN CONTENT ==================== -->

    <script>
        (function () {
            // ============ INTERSECTION OBSERVER FOR SCROLL REVEAL ============
            const revealElements = document.querySelectorAll('.reveal, .reveal-stagger');
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -60px 0px',
                threshold: 0.12,
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));

            // ============ COUNTER ANIMATION ============
            const counterElements = document.querySelectorAll('.count');
            let countersAnimated = false;

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !countersAnimated) {
                        countersAnimated = true;
                        counterElements.forEach(counter => {
                            const target = parseInt(counter.getAttribute('data-target'));
                            const duration = 2200;
                            const startTime = performance.now();

                            function updateCounter(currentTime) {
                                const elapsed = currentTime - startTime;
                                const progress = Math.min(elapsed / duration, 1);
                                const eased = 1 - Math.pow(1 - progress, 4);
                                const current = Math.floor(eased * target);
                                counter.textContent = current.toLocaleString();
                                if (progress < 1) {
                                    requestAnimationFrame(updateCounter);
                                } else {
                                    counter.textContent = target.toLocaleString();
                                }
                            }
                            requestAnimationFrame(updateCounter);
                        });
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const counterSection = document.querySelector('.counter-section');
            if (counterSection) counterObserver.observe(counterSection);

            // ============ TESTIMONIAL SLIDER ============
            const track = document.getElementById('testimonialTrack');
            const slides = track.querySelectorAll('.testimonial-slide');
            const prevBtn = document.getElementById('testPrev');
            const nextBtn = document.getElementById('testNext');
            const dotsContainer = document.getElementById('testimonialDots');
            let currentSlide = 0;
            let autoplayInterval;

            // Create dots
            slides.forEach((_, i) => {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            });
            const dots = dotsContainer.querySelectorAll('.dot');

            function updateSlider() {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
                dots.forEach((d, i) => d.classList.toggle('active', i === currentSlide));
            }

            function goToSlide(index) {
                currentSlide = index;
                updateSlider();
                resetAutoplay();
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
                resetAutoplay();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                updateSlider();
                resetAutoplay();
            }

            function resetAutoplay() {
                clearInterval(autoplayInterval);
                autoplayInterval = setInterval(nextSlide, 4500);
            }

            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);
            autoplayInterval = setInterval(nextSlide, 4500);

            // ============ SMOOTH SCROLL FOR HERO CTA ============
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const targetEl = document.querySelector(targetId);
                    if (targetEl) {
                        e.preventDefault();
                        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            // ============ PARALLAX FLOATING SHAPES ============
            const shapes = document.querySelectorAll('.floating-shape');
            window.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 20;
                const y = (e.clientY / window.innerHeight - 0.5) * 20;
                shapes.forEach((shape, i) => {
                    const factor = (i + 1) * 0.5;
                    shape.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
                });
            });



            // ============ IMAGE ERROR HANDLING ============
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function () {
                    if (!this.dataset.failed) {
                        this.dataset.failed = '1';
                        this.src =
                            'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400" fill="%23e5e7eb"><rect width="600" height="400"/><text x="300" y="210" text-anchor="middle" font-family="sans-serif" font-size="18" fill="%239ca3af">Image Loading...</text></svg>';
                    }
                });
            });

            console.log('Premium Luxury Travel Homepage Ready');
            console.log('All sections animated & responsive');
            console.log('Scroll to see reveal animations, counters & sliders');
        })();





        function nextSlide() {

            currentSlide++;

            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }

            showSlide(currentSlide);

        }

        showSlide(0);

        setInterval(nextSlide, 6000);


        const partnerSwiper = new Swiper(".partnerSwiper", {

            loop: true,

            speed: 4000,

            grabCursor: true,

            allowTouchMove: true,

            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 25,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            }

        });

        /*==================================================
        TESTIMONIAL AUTO SCROLL
==================================================*/

        const slider = document.querySelector(".testimonial-slider");
        const track = document.querySelector(".testimonial-track");

        let isDown = false;
        let startX;
        let scrollLeft;
        let autoScroll;

        /*==============================
                Auto Scroll
        ==============================*/

        function startAutoScroll() {

            autoScroll = setInterval(() => {

                slider.scrollLeft += 1;

                // Infinite Loop
                if (
                    slider.scrollLeft >=
                    (track.scrollWidth - slider.clientWidth)
                ) {

                    slider.scrollLeft = 0;

                }

            }, 15);

        }

        startAutoScroll();

        /*==============================
                Hover Pause
        ==============================*/

        slider.addEventListener("mouseenter", () => {

            clearInterval(autoScroll);

        });

        slider.addEventListener("mouseleave", () => {

            startAutoScroll();

        });

        /*==============================
                Mouse Drag
        ==============================*/

        slider.addEventListener("mousedown", (e) => {

            isDown = true;

            slider.classList.add("active");

            startX = e.pageX - slider.offsetLeft;

            scrollLeft = slider.scrollLeft;

            clearInterval(autoScroll);

        });

        slider.addEventListener("mouseleave", () => {

            isDown = false;

        });

        slider.addEventListener("mouseup", () => {

            isDown = false;

            startAutoScroll();

        });

        slider.addEventListener("mousemove", (e) => {

            if (!isDown) return;

            e.preventDefault();

            const x = e.pageX - slider.offsetLeft;

            const walk = (x - startX) * 2;

            slider.scrollLeft = scrollLeft - walk;

        });

        /*==============================
                Mobile Swipe
        ==============================*/

        let touchStartX = 0;
        let touchScroll = 0;

        slider.addEventListener("touchstart", (e) => {

            clearInterval(autoScroll);

            touchStartX = e.touches[0].pageX;

            touchScroll = slider.scrollLeft;

        });

        slider.addEventListener("touchmove", (e) => {

            const move = e.touches[0].pageX;

            const walk = (move - touchStartX) * 2;

            slider.scrollLeft = touchScroll - walk;

        });

        slider.addEventListener("touchend", () => {

            startAutoScroll();

        });

        /*==============================
                Mouse Wheel
        ==============================*/

        slider.addEventListener("wheel", (e) => {

            e.preventDefault();

            slider.scrollLeft += e.deltaY;

        });


    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const track = document.getElementById("videoTrack");
            const slides = document.querySelectorAll(".video-slide");
            const videos = document.querySelectorAll(".video-slide video");

            const nextBtn = document.getElementById("nextVideo");
            const prevBtn = document.getElementById("prevVideo");
            const dotsContainer = document.getElementById("videoDots");

            let currentIndex = 0;
            let isMoving = false;

            /* Create dots */
            slides.forEach((slide, index) => {

                const dot = document.createElement("button");

                dot.classList.add("video-dot");

                if (index === 0) {
                    dot.classList.add("active");
                }

                dot.addEventListener("click", () => {
                    goToSlide(index);
                });

                dotsContainer.appendChild(dot);
            });

            const dots = document.querySelectorAll(".video-dot");


            function goToSlide(index) {

                if (isMoving) return;

                isMoving = true;

                /* Loop */
                if (index >= slides.length) {
                    index = 0;
                }

                if (index < 0) {
                    index = slides.length - 1;
                }

                currentIndex = index;

                /* Move slider */
                track.style.transform =
                    `translateX(-${currentIndex * 100}%)`;


                /* Stop all videos */
                videos.forEach((video, i) => {

                    if (i !== currentIndex) {
                        video.pause();
                        video.currentTime = 0;
                    }

                });


                /* Active dot */
                dots.forEach((dot, i) => {
                    dot.classList.toggle(
                        "active",
                        i === currentIndex
                    );
                });


                /* Play current video */
                const currentVideo = videos[currentIndex];

                currentVideo.currentTime = 0;

                const playPromise = currentVideo.play();

                if (playPromise !== undefined) {
                    playPromise.catch(() => { });
                }


                setTimeout(() => {
                    isMoving = false;
                }, 1200);
            }


            /* When video finishes */
            videos.forEach((video, index) => {

                video.addEventListener("ended", function () {

                    if (index === currentIndex) {
                        goToSlide(currentIndex + 1);
                    }

                });

            });


            /* Next */
            nextBtn.addEventListener("click", function () {
                goToSlide(currentIndex + 1);
            });


            /* Previous */
            prevBtn.addEventListener("click", function () {
                goToSlide(currentIndex - 1);
            });


            /* Start first video */
            goToSlide(0);

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const cards = document.querySelectorAll(".dh-award-card");

            if (!cards.length) {
                console.log("Awards images not found");
                return;
            }

            let current = 0;

            function updateAwards() {

                const total = cards.length;

                cards.forEach(function (card, index) {

                    // Remove old classes
                    card.classList.remove(
                        "dh-award-center",
                        "dh-award-left",
                        "dh-award-right",
                        "dh-award-left-two",
                        "dh-award-right-two"
                    );

                    let position = index - current;

                    // Circular slider
                    if (position > total / 2) {
                        position -= total;
                    }

                    if (position < -total / 2) {
                        position += total;
                    }


                    if (position === 0) {

                        card.classList.add("dh-award-center");

                    } else if (position === -1) {

                        card.classList.add("dh-award-left");

                    } else if (position === 1) {

                        card.classList.add("dh-award-right");

                    } else if (position === -2) {

                        card.classList.add("dh-award-left-two");

                    } else if (position === 2) {

                        card.classList.add("dh-award-right-two");

                    }

                });
            }


            // First load
            updateAwards();


            // Auto slide
            setInterval(function () {

                current++;

                if (current >= cards.length) {
                    current = 0;
                }

                updateAwards();

            }, 2500);

        });
    </script>



</body>

</html>

<?php include "footer.php" ?>