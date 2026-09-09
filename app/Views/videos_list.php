<?php
$title = "Member Holiday Experience Video Reviews | Delvia Holidays International";
$description = "Watch member holiday experience video reviews of Delvia Holidays International and explore genuine holiday experiences, member stories, and luxury travel services.";

include 'header.php';
?>



    



<!-- ========================================================
     VIDEO REVIEWS SECTION
========================================================= -->

<section class="video-reviews-page">

    <div class="container">


        <!-- =================================================
             HEADING
        ================================================== -->

        <div class="video-reviews-heading">

            <span class="section-badge">

                <i class="fas fa-play-circle"></i>

                Member Stories

            </span>


            <h1>

                Real

                <span>
                    Member Experiences
                </span>

            </h1>


            <p>

                Watch genuine holiday experiences shared by our
                valued members. See how Delvia Holidays International
                turns dreams into unforgettable memories.

            </p>

        </div>


        <!-- =================================================
             VIDEO GRID
        ================================================== -->

        <?php if (!empty($videos)): ?>


            <div class="video-reviews-grid">


                <?php foreach ($videos as $v): ?>


                    <article class="video-card">


                        <!-- =================================================
                             VIDEO
                        ================================================== -->

                        <div class="video-card-media">

                            <iframe
                                src="https://www.youtube.com/embed/<?= esc($v['video_url']); ?>"
                                loading="lazy"
                                title="<?= esc($v['video_title']); ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>

                        </div>


                        <!-- =================================================
                             TITLE
                        ================================================== -->

                        <div class="video-card-title">

                            <h5>
                                <?= esc($v['video_title']); ?>
                            </h5>

                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="video-empty">

                <div class="video-empty-icon">

                    <i class="fas fa-video-slash"></i>

                </div>

                <h3>
                    No Video Reviews Available
                </h3>

                <p>
                    No video reviews are available yet.
                    Please check back again soon.
                </p>

            </div>


        <?php endif; ?>


    </div>

</section>


<?php include "footer.php"; ?>