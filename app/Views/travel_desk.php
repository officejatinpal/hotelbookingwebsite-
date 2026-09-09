<?php
$title = "Travel Desk | Delvia Holidays International";
$description = "Get instant travel assistance with Delvia Holidays International. Our Travel Desk helps with bookings, itineraries, flight support, and holiday planning. Hassle-free trips guaranteed.";
include 'header.php';
?>




<!-- ==================== HERO ==================== -->
<section class="travel-hero">
    <div class="hero-badge">
         24/7 Travel Desk</div>
    <h1>Your Journey, <span>Simplified</span></h1>
    <p class="hero-subtitle">
        From flight bookings to curated itineraries, our travel experts ensure every trip is seamless and memorable.
    </p>
</section>

<!-- ==================== TRAVEL CARDS ==================== -->
<section class="travel-section">
    <div class="section-header">
        <span class="accent-line"></span>
        <h2>Explore Our Travel Services</h2>
        <p>Discover handpicked destinations, expert guides, and hassle‑free planning tools.</p>
    </div>

    <div class="travel-grid">
        <?php foreach ($travels as $travel): ?>
            <div class="travel-card">
                <!-- Image with overlay link -->
                <div class="travel-card-img">
                    <img src="<?= base_url('uploads/traveldesk/'.$travel['image']); ?>" alt="<?= htmlspecialchars($travel['title']); ?>" loading="lazy">
                    <div class="img-overlay">
                        <a href="<?= base_url('desk/'.$travel['slug']); ?>" aria-label="View details">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
                </div>
                <!-- Card body -->
                <div class="travel-card-body">
                    <a href="<?= base_url('desk/'.$travel['slug']); ?>" class="card-title">
                        <?= htmlspecialchars($travel['title']); ?>
                    </a>
                    <p class="card-excerpt">
                        <?= htmlspecialchars(substr($travel['content'], 0, 100)); ?>...
                    </p>
                    <a href="<?= base_url('desk/'.$travel['slug']); ?>" class="btn-read">
                        Read More <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include "footer.php"; ?>