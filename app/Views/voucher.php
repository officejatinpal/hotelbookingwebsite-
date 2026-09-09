<?php
$title = "Gift Voucher Redemption | Delvia Holidays International";
$description = "Explore Delvia Holidays International gift vouchers and redemption options.";
include 'header.php';
?>




<!-- =========================================================
     BREADCRUMB / HERO
========================================================= -->

<div class="container-fluid bg-breadcrumb">

</div>


<!-- =========================================================
     VOUCHER SECTION
========================================================= -->

<section class="voucher-page py-5">

    <div class="container py-4 py-lg-5">


        <!-- =================================================
             INTRO
        ================================================== -->

        <div class="voucher-intro">

            <div class="voucher-badge">

                <i class="fas fa-gift"></i>

                Gift Voucher Collection

            </div>


            <h2>

                Discover Your

                <span>
                    Travel Rewards
                </span>

            </h2>


            <p>

                Explore our exclusive travel vouchers and discover
                exciting holiday experiences available through
                Delvia Holidays International.

            </p>

        </div>


        <!-- =================================================
             STATS
        ================================================== -->

        <div class="voucher-stats">

            <div class="stats-grid">


                <!-- Stat 1 -->

                <div class="stat-item">

                    <div class="stat-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                    <div class="stat-number">
                        <?= count($vouchers); ?>
                    </div>

                    <div class="stat-label">
                        Active Vouchers
                    </div>

                </div>


                <!-- Stat 2 -->

                <div class="stat-item">

                    <div class="stat-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>

                    <div class="stat-number">
                        50+
                    </div>

                    <div class="stat-label">
                        Destinations
                    </div>

                </div>


                <!-- Stat 3 -->

                <div class="stat-item">

                    <div class="stat-icon">
                        <i class="fas fa-smile"></i>
                    </div>

                    <div class="stat-number">
                        10K+
                    </div>

                    <div class="stat-label">
                        Happy Travelers
                    </div>

                </div>


                <!-- Stat 4 -->

                <div class="stat-item">

                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                    <div class="stat-number">
                        24/7
                    </div>

                    <div class="stat-label">
                        Support
                    </div>

                </div>


            </div>

        </div>


        <!-- =================================================
             VOUCHER GRID
        ================================================== -->

        <?php if (!empty($vouchers)): ?>


            <div class="voucher-grid">


                <?php foreach ($vouchers as $voucher): ?>


                    <?php

                    $fileExt = strtolower(
                        pathinfo(
                            $voucher['image'],
                            PATHINFO_EXTENSION
                        )
                    );

                    $fileUrl = base_url(
                        'uploads/pagevouchers/' .
                        $voucher['image']
                    );

                    $imageExtensions = [
                        'jpg',
                        'jpeg',
                        'png',
                        'gif',
                        'webp'
                    ];

                    ?>


                    <!-- =================================================
                         VOUCHER CARD
                    ================================================== -->

                    <article class="voucher-card">


                        <!-- =================================================
                             MEDIA
                        ================================================== -->

                        <div class="voucher-media">


                            <?php if (
                                in_array(
                                    $fileExt,
                                    $imageExtensions,
                                    true
                                )
                            ): ?>


                                <!-- Voucher Type -->

                                <span class="voucher-type">

                                    <i class="fas fa-image"></i>

                                    Travel Voucher

                                </span>


                                <!-- Voucher Image -->

                                <img
                                    src="<?= esc($fileUrl); ?>"
                                    alt="<?= esc($voucher['title']); ?>"
                                    loading="lazy"
                                >


                                <!-- Image Overlay -->

                                <div class="voucher-overlay">

                                    <a
                                        href="<?= esc($fileUrl); ?>"
                                        class="voucher-view-btn"
                                        data-lightbox="vouchers"
                                        title="<?= esc($voucher['title']); ?>"
                                    >

                                        <i class="fas fa-expand"></i>

                                        View Voucher

                                    </a>

                                </div>


                            <?php elseif ($fileExt === 'pdf'): ?>


                                <!-- PDF -->

                                <div class="pdf-preview">


                                    <span class="pdf-label">

                                        <i class="fas fa-file-pdf"></i>

                                        PDF Voucher

                                    </span>


                                    <iframe
                                        src="<?= esc($fileUrl); ?>"
                                        title="<?= esc($voucher['title']); ?>"
                                        loading="lazy"
                                    ></iframe>


                                </div>


                            <?php else: ?>


                                <!-- Unsupported File -->

                                <div class="pdf-preview">

                                    <div
                                        style="
                                            width:100%;
                                            height:100%;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            flex-direction:column;
                                            gap:10px;
                                            color:#6B7280;
                                        "
                                    >

                                        <i
                                            class="fas fa-file-circle-exclamation"
                                            style="font-size:40px;"
                                        ></i>

                                        <span>
                                            Preview unavailable
                                        </span>

                                    </div>

                                </div>


                            <?php endif; ?>


                        </div>


                        <!-- =================================================
                             CONTENT
                        ================================================== -->

                        <div class="voucher-content">


                            <h3>
                                <?= esc($voucher['title']); ?>
                            </h3>


                            <p>

                                Exclusive voucher experience
                                from Delvia Holidays International.

                            </p>


                            <!-- Bottom -->

                            <div class="voucher-bottom">


                                <div class="voucher-status">

                                    <span class="status-dot"></span>

                                    Available Voucher

                                </div>


                                <?php if (
                                    in_array(
                                        $fileExt,
                                        $imageExtensions,
                                        true
                                    )
                                ): ?>


                                    <!-- Image Arrow -->

                                    <a
                                        href="<?= esc($fileUrl); ?>"
                                        data-lightbox="vouchers"
                                        title="View <?= esc($voucher['title']); ?>"
                                        class="voucher-arrow"
                                    >

                                        <i class="fas fa-arrow-right"></i>

                                    </a>


                                <?php elseif ($fileExt === 'pdf'): ?>


                                    <!-- PDF Arrow -->

                                    <a
                                        href="<?= esc($fileUrl); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="voucher-arrow"
                                        title="Open PDF"
                                    >

                                        <i class="fas fa-arrow-up-right-from-square"></i>

                                    </a>


                                <?php endif; ?>


                            </div>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="voucher-empty">


                <div class="voucher-empty-icon">

                    <i class="fas fa-gift"></i>

                </div>


                <h3>
                    No Vouchers Available
                </h3>


                <p>

                    There are currently no vouchers available.
                    Please check back again soon.

                </p>


            </div>


        <?php endif; ?>


        <!-- =================================================
             HOW TO REDEEM
        ================================================== -->

        <div class="redeem-steps">


            <div class="redeem-title">

                <h3>
                    How to Redeem
                </h3>

                <p>
                    Simple steps to use your travel voucher
                </p>

            </div>


            <div class="steps-grid">


                <!-- Step 1 -->

                <div class="step-card">

                    <div class="step-number">
                        1
                    </div>

                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>

                    <h4>
                        Choose Your Voucher
                    </h4>

                    <p>

                        Browse through our collection and select
                        the voucher that suits your dream holiday.

                    </p>

                </div>


                <!-- Step 2 -->

                <div class="step-card">

                    <div class="step-number">
                        2
                    </div>

                    <div class="step-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                    <h4>
                        Plan Your Trip
                    </h4>

                    <p>

                        Contact our travel experts and plan your
                        perfect itinerary with the voucher applied.

                    </p>

                </div>


                <!-- Step 3 -->

                <div class="step-card">

                    <div class="step-number">
                        3
                    </div>

                    <div class="step-icon">
                        <i class="fas fa-plane-departure"></i>
                    </div>

                    <h4>
                        Enjoy Your Journey
                    </h4>

                    <p>

                        Pack your bags and enjoy a memorable
                        holiday experience with Delvia Holidays.

                    </p>

                </div>


            </div>

        </div>


        <!-- =================================================
             CTA
        ================================================== -->

        <div class="voucher-cta">


            <div class="voucher-cta-content">


                <div>

                    <h3>
                        Ready for Your Next Holiday?
                    </h3>

                    <p>

                        Explore unforgettable destinations and
                        create your next travel experience with us.

                    </p>

                </div>


                <a
                    href="index.php"
                    class="voucher-cta-btn"
                >

                    Explore Holidays

                    <i class="fas fa-arrow-right"></i>

                </a>


            </div>


        </div>


    </div>

</section>

<br>
<?php include "footer.php"; ?>

