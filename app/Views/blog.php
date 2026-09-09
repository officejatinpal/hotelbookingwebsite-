<?php
$description = "Read the latest travel tips, destination guides, and holiday inspiration on Delvia Holidays International blog. Plan memorable vacations with ease.";
include 'header.php';
?>

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Blogs</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Blogs</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">

            <?php foreach ($blogs as $blog): ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">

                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img
                                class="img-fluid w-100 rounded-top"
                                src="<?= base_url('uploads/blogs/'.$blog['image']); ?>"
                                alt="<?= esc($blog['title']); ?>"
                                style="height:298px; object-fit:cover;"
                            >

                            <div class="blog-icon">
                                <a href="<?= base_url('blog/'.$blog['slug']); ?>" class="my-auto">
                                    <i class="fas fa-link fa-2x text-white"></i>
                                </a>
                            </div>
                        </div>

                        <!-- BLOG INFO STRIP (FIXED) -->
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0 bg-white">
                            <small class="flex-fill text-center ck border-end py-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i>
                                <?= date('d M Y', strtotime($blog['created_at'])); ?>
                            </small>

                            <!-- FIX: a → span -->
                            <span class="flex-fill text-center border-end ck py-2">
                                <i class="fa fa-thumbs-up text-primary me-2"></i>1.7K
                            </span>

                            <span class="flex-fill text-center ck py-2">
                                <i class="fa fa-comments text-primary me-2"></i>1K
                            </span>
                        </div>
                    </div>

                    <div class="blogs-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-2">
                            <strong>Published By:</strong> <?= esc($blog['author']); ?>
                        </p>

                        <a href="<?= base_url('blog/'.$blog['slug']); ?>" class="h5">
                            <?= esc($blog['title']); ?>
                        </a>

                        <p class="my-2">
                            <?= substr(strip_tags($blog['content']), 0, 100); ?>...
                        </p>

                        <a href="<?= base_url('blog/'.$blog['slug']); ?>"
                           class="btn btn-primary rounded-pill py-2 px-4">
                           Read More
                        </a>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<style>
    /* Google Fonts Import */
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&family=Outfit:wght@500;600;700&display=swap');

    :root {
        --primary: #18B8A7;
        --primary-dark: #0fa395;
        --primary-light: #e6f9f7;
        --secondary: #F4A261;
        --secondary-dark: #e89240;
        --white: #FFFFFF;
        --bg-light: #F9FAFB;
        --heading: #1F2937;
        --text: #6B7280;
        --text-light: #9CA3AF;
        --border: #E5E7EB;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 10px rgba(0, 0, 0, 0.04);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12), 0 8px 20px rgba(0, 0, 0, 0.06);
        --shadow-xl: 0 30px 70px rgba(0, 0, 0, 0.15), 0 12px 30px rgba(0, 0, 0, 0.08);
        --shadow-glow: 0 0 40px rgba(24, 184, 167, 0.2), 0 10px 30px rgba(24, 184, 167, 0.12);
        --radius-sm: 10px;
        --radius: 16px;
        --radius-md: 20px;
        --radius-lg: 24px;
        --radius-xl: 32px;
        --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --font-heading: 'Outfit', 'Poppins', sans-serif;
        --font-body: 'Inter', sans-serif;
    }

    body {
        font-family: var(--font-body);
        background-color: var(--bg-light);
    }

    /* ===== Breadcrumb Section ===== */
    .bg-breadcrumb {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        position: relative;
        overflow: hidden;
    }
    .bg-breadcrumb::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .bg-breadcrumb::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 350px;
        height: 350px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .bg-breadcrumb h3 {
        font-family: var(--font-heading);
        font-weight: 700;
    }
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }
    .breadcrumb-item a:hover {
        color: white;
    }
    .breadcrumb-item.active {
        color: white;
        font-weight: 500;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.6);
    }

    /* ===== Blog Cards ===== */
    .blog-item {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform var(--transition), box-shadow var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--border);
    }
    .blog-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .blog-img {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }
    .blog-img-inner {
        position: relative;
        overflow: hidden;
    }
    .blog-img-inner img {
        transition: transform var(--transition-smooth);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }
    .blog-item:hover .blog-img-inner img {
        transform: scale(1.07);
    }

    .blog-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        transition: all var(--transition);
        z-index: 2;
    }
    .blog-item:hover .blog-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
    .blog-icon a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: var(--secondary);
        border-radius: 50%;
        box-shadow: var(--shadow-md);
        transition: background var(--transition), transform var(--transition);
    }
    .blog-icon a:hover {
        background: var(--secondary-dark);
        transform: rotate(10deg) scale(1.05);
    }

    .blog-info {
        background: var(--bg-light);
        border-color: var(--border) !important;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text);
    }
    .blog-info i {
        color: var(--primary) !important;
    }
    .blog-info .border-end {
        border-color: var(--border) !important;
    }

    .blogs-content {
        background: var(--white);
        border: none !important;
        border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        padding: 1.8rem !important;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .blogs-content p strong {
        color: var(--heading);
    }
    .blogs-content p:first-of-type {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .blogs-content a.h5 {
        font-family: var(--font-heading);
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--heading);
        text-decoration: none;
        display: inline-block;
        transition: color var(--transition);
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }
    .blogs-content a.h5:hover {
        color: var(--primary);
    }

    .blogs-content p.my-2 {
        color: var(--text);
        line-height: 1.7;
        flex-grow: 1;
    }

    /* Read More Button */
    .blogs-content .btn-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: var(--white) !important;
        font-weight: 600;
        font-family: var(--font-body);
        letter-spacing: 0.5px;
        transition: all var(--transition);
        box-shadow: var(--shadow-sm);
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        margin-top: auto;
    }
    .blogs-content .btn-primary::after {
        content: '\f061'; /* Font Awesome arrow-right */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        margin-left: 8px;
        transition: transform var(--transition);
    }
    .blogs-content .btn-primary:hover {
        background-color: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    .blogs-content .btn-primary:hover::after {
        transform: translateX(4px);
    }

    /* Utility: keep info text dark */
    .ck {
        color: var(--heading) !important;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .bg-breadcrumb h3 {
            font-size: 2.5rem;
        }
    }
</style>

<?php include "footer.php"; ?>