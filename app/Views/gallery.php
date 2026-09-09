   <?php
$description = "Explore the photo and video gallery of Delvia Holidays International. Get a glimpse of luxury resorts, holiday destinations, and memorable travel experiences.";
include 'header.php';
?>

<!-- =========================================
     Gallery Section
========================================= -->

<section class="gallery-page">

    <div class="container gallery-container">

        <!-- Heading -->

        <div class="gallery-heading">


            <h2>
                Memorable Moments
                <span>Captured</span>
            </h2>

            <p>
                Explore beautiful destinations, luxury stays and unforgettable
                travel experiences through our collection of memorable moments.
            </p>

        </div>


        <!-- Gallery Grid -->

        <div class="gallery-grid">

            <?php if (!empty($galleryImages)): ?>

                <?php foreach ($galleryImages as $image): ?>

                    <?php
                        $imageUrl = base_url(
                            'uploads/gallery/' . $image['filename']
                        );

                        $altText = !empty($image['alt'])
                            ? $image['alt']
                            : 'Delvia Holidays travel gallery';
                    ?>

                    <div class="gallery-item">

                        <img
                            class="gallery-image"
                            src="<?= $imageUrl; ?>"
                            alt="<?= esc($altText); ?>"
                            loading="lazy"
                        >

                        <div class="gallery-overlay">

                            <a
                                href="<?= $imageUrl; ?>"
                                class="gallery-view"
                                data-lightbox="gallery"
                                title="<?= esc($altText); ?>"
                                aria-label="View gallery image"
                            >
                                <i class="fas fa-expand"></i>
                            </a>

                            <div class="gallery-caption">

                                <h4>
                                    <?= esc($altText); ?>
                                </h4>

                                <span>
                                    Delvia Holidays International
                                </span>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="gallery-empty">

                    <div class="gallery-empty-icon">
                        <i class="fas fa-images"></i>
                    </div>

                    <h3>No Images Available</h3>

                    <p>
                        Gallery images will appear here once they are uploaded.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>


<?php include "footer.php"; ?>
