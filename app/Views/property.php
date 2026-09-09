<?php include 'header.php'; ?>

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Destinations</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Property</li>
        </ol>    
    </div>
</div>
<!-- Header End -->


<section class="mainDestination travelBgWithOutpd">
    <div class="container">
        <div class="row">

            <!-- Resorts Listing -->
            <div class="col-md-12">
                <div class="destinationListOuterWrapper">
                    <div id="filtered_data">
                        <div class="row">
                            <?php foreach ($resorts as $resort) { ?>
                                <div class="col-md-6 mb-4 px-3">
                                    <div class="destination-item">
                                        <div class="destination-img">
                                            <img src="<?= base_url('uploads/resorts/' . $resort['main_image']); ?>" alt="<?= $resort['name']; ?>" class="img-fluid">
                                        </div>
                                        <div class="destination-content">
                                            <h4><?= $resort['name']; ?></h4>

                                            <!-- Truncated Description -->
                                            <p class="resort-description" data-full="<?= ($resort['descr']); ?>">
                                                <?php
                                                    $words = explode(' ', $resort['descr']);
                                                    $short_descr = implode(' ', array_slice($words, 0, 20));
                                                ?>
                                                <?= $short_descr; ?>...
                                            </p>
                                            <button class="btn btn-link read-more" type="button">
                                                <a href="<?= base_url('resort/' . $resort['id']); ?>">Read More</a>
                                            </button>

                                            <!-- Details and Includes Section -->
                                            <div class="detailsEnclude"><br>
                                                <h6>Details and Includes</h6>
                                                <div class="row text-center desti_icon_main">
                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bad.png') ?>" alt="Hotel" class="img-fluid icon-bordered">
                                                            <p>Hotel</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bus.png') ?>" alt="Transfer" class="img-fluid icon-bordered">
                                                            <p>Transfer</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bag.png') ?>" alt="Luggage" class="img-fluid icon-bordered">
                                                            <p>Luggage</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Details and Includes -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Resorts Listing -->

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
