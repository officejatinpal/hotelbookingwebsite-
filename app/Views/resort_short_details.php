<?php include 'header.php'; ?>
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Destination Properties</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Property</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<section class="resort-page">
    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-md-12"> 
                <div class="destinationListOuterWrapper">
                    <div id="filtered_data">
                        <div class="row g-3">

                            <?php foreach ($resorts as $resort) { ?>
                                <div class="col-md-4 mb-4"> 
                                    <div class="destination-item">
                                        <div class="destination-img">
                                            <img src="<?= base_url('uploads/resorts/' . $resort['main_image']); ?>" 
                                            alt="<?= $resort['name']; ?>" 
                                            class="img-fluid top-rounded-img">
                                        </div>

                                        <div class="destination-content">
                                            <h4><?= $resort['name']; ?></h4>

                                            <p class="resort-description">
                                                <?= implode(' ', array_slice(explode(' ', $resort['descr']), 0, 20)); ?>...
                                            </p>

                                            <!--<?php if (!empty($resort['external_url'])): ?>
                                                <a class="btn btn-primary" 
                                                   href="<?= $resort['external_url']; ?>" 
                                                   target="_blank">
                                                   Read more
                                                </a>
                                            <?php endif; ?>-->
                                            
                                            <a class="btn btn-primary" href="<?= base_url('property/' . $resort['slug']); ?>">Read more</a>
                                            </button>

                                            <div class="detailsEnclude mt-3">
                                                <h6>Details and Includes</h6>
                                                <div class="row text-center desti_icon_main">
                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bad.png') ?>" class="img-fluid icon-bordered">
                                                            <p>Hotel</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bus.png') ?>" class="img-fluid icon-bordered">
                                                            <p>Transfer</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/bag.png') ?>" class="img-fluid icon-bordered">
                                                            <p>Luggage</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="desti_icon">
                                                            <img src="<?= base_url('asset/icons/location1.png') ?>" class="img-fluid icon-bordered">
                                                            <p><?= $resort['destination_name']; ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php include 'footer.php'; ?>
