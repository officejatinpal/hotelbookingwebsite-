<?php include 'header.php'; ?>

<!-- Header Start -->
<div class="container-fluid">
</div>
<!-- Header End -->

<!-- ================= SLIDER / GALLERY ================= -->
<section class="slider container-fluid">
    <div class="owl-carousel destinationDetail">

        <?php if (!empty($gallery)): ?>
            <?php foreach ($gallery as $img): ?>
                <div class="item card">
                    <div class="card-image">
                        <a href="<?= base_url('uploads/resorts/' . $img['image']); ?>"
                           data-fancybox="gallery"
                           data-caption="<?= esc($detail['name']); ?>">

                            <img src="<?= base_url('uploads/resorts/' . $img['image']); ?>"
                                 alt="<?= esc($detail['name']); ?> Image"
                                 class="slider-image">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Fallback image -->
            <div class="item card">
                <img src="<?= base_url('asset/img/no-image.jpg'); ?>" class="slider-image">
            </div>
        <?php endif; ?>

    </div>
</section>
<!-- ================= SLIDER END ================= -->

<!-- ================= DETAILS SECTION ================= -->
<section class="destiDetailContent">
    <div class="container">
        <div class="destiDetailContentInner">
            <div class="destiMainCon">

                <div class="secTitle">
                    <h1><?= esc($detail['name']); ?></h1>

                    <p class="resort-description" data-full="<?= ($detail['descr']); ?>">
                        <?= ($detail['descr']); ?>
                    </p>
                </div>

                <!-- ================= AMENITIES ================= -->
                <div class="amenities">
                    <h6>Amenities</h6>
                    <div class="amen_icon_main row">

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/wifi.png'); ?>">
                                <p>Wi-Fi</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/parking.png'); ?>">
                                <p>Parking</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/cutlery.png'); ?>">
                                <p>Food</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/ac.png'); ?>">
                                <p>Air Conditioned</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/swimming-pool.png'); ?>">
                                <p>Swimming Pool</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="amen_icon">
                                <img src="<?= base_url('asset/icons/room-service.png'); ?>">
                                <p>Room Service</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ================= ADDRESS ================= -->
                <div class="amenities">
                    <h6>Address</h6>
                    <p><?= esc($detail['address']); ?></p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ================= DETAILS END ================= -->

<!-- ================= JS ================= -->
<script>
$(document).ready(function(){
    $(".destinationDetail").owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: true,
        nav: false,
        responsive: {
            0: { items: 1 },
            768: { items: 1 },
            1024: { items: 1 }
        }
    });
});
</script>

<!-- ================= CSS ================= -->
<style>
.slider {
    width: 100%;
    margin: 0 auto;
}

.owl-carousel .item {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    overflow: hidden;
    border-radius: 10px;
}

.card-image {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.slider-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

@media (max-width: 768px) {
    .owl-carousel .item {
        height: 250px;
    }
}
</style>

<?php include 'footer.php'; ?>
