<?php include "header.php" ?>





<!-- Packages Section -->
<section class="packages-page">
    <div class="container">
        <!-- Heading -->
        <div class="packages-heading">
            <span class="section-badge">
                <i class="fas fa-suitcase-rolling"></i> Explore Destinations
            </span>
            <h1>Awesome <span>Packages</span></h1>
            <p>
                At Delvia Holidays, we offer tailored holiday packages to match your dream vacation, 
                from romantic beach getaways to mountain treks and city tours. Explore top destinations worldwide with 
                comfortable stays, exciting activities, and hassle-free transfers. Flexible options and personalized 
                packages ensure a perfect fit for your needs. Book now and let us handle the details for your unforgettable adventure!
            </p>
        </div>

        <!-- Filter Dropdown -->
        <div class="filter-section">
            <label for="cityFilter"><i class="fas fa-filter me-2 text-primary"></i> Filter by City:</label>
            <select id="cityFilter" onchange="filterPackagesByCity()">
                <option value="">All Cities</option>
                <?php 
                $uniqueCities = [];
                foreach ($packages as $package): 
                    $normalizedCity = strtolower($package['location']);
                    if (!in_array($normalizedCity, $uniqueCities)): 
                        $uniqueCities[] = $normalizedCity; ?>
                        <option value="<?= esc($package['location']) ?>"><?= esc($package['location']) ?></option>
                    <?php endif; 
                endforeach; ?>
            </select>
        </div>

        <!-- Packages List -->
        <div id="packagesContainer" class="row g-4">
            <?php foreach ($packages as $package): ?>
                <div class="col-lg-4 col-md-6 package-item" data-city="<?= esc($package['location']) ?>">
                    <div class="package-card position-relative">
                        <!-- Package Image -->
                        <div class="package-img">
                            <img src="<?= base_url('uploads/packages/' . $package['image']) ?>" 
                                 alt="<?= esc($package['title']) ?>" 
                                 loading="lazy">
                            <div class="package-price">
                                $<?= esc($package['price']) ?>
                            </div>
                            <div class="package-overlay">
                                <a href="<?= base_url('packages/view/' . $package['slug']) ?>" class="package-view-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>

                        <!-- Package Details -->
                        <div class="package-content">
                            <h5><?= esc($package['title']) ?></h5>
                            <p><?= esc($package['meta_description']) ?></p>
                            <div class="package-meta">
                                <span><i class="fa fa-map-marker-alt"></i><?= esc($package['location']) ?></span>
                                <span><i class="fa fa-calendar-alt"></i><?= esc($package['duration']) ?></span>
                                <span><i class="fa fa-user"></i><?= esc($package['persons']) ?> Person</span>
                            </div>
                            <div class="package-rating">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <small class="fa <?= $i < $package['rating'] ? 'fa-star testimonilrating' : 'fa-star' ?>"></small>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="package-actions">
                            <a href="<?= base_url('packages/book/' . $package['slug']) ?>" class="btn btn-primary">
                                Book Now
                            </a>
                            <a href="<?= base_url('packages/view/' . $package['slug']) ?>" class="btn btn-outline-primary">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    function filterPackagesByCity() {
        const selectedCity = document.getElementById('cityFilter').value.toLowerCase();
        const packages = document.querySelectorAll('.package-item');

        packages.forEach(package => {
            const city = package.getAttribute('data-city').toLowerCase();
            if (!selectedCity || city === selectedCity) {
                package.style.display = '';
            } else {
                package.style.display = 'none';
            }
        });
    }
</script>

<?php include "footer.php" ?>