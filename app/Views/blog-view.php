 <?php

$title = isset($blog['title']) ? $blog['title'] : 'Blog - Delvia Holidays International';
$description = !empty($blog['meta_description']) ? $blog['meta_description'] : $defaultDescription;

include 'header.php';
?>

<title><?= esc($title) ?></title>
<meta name="description" content="<?= esc($description) ?>">

<body>
        <!-- Breadcrumb -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Our Blog</h3>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Blog</li>
                </ol>
            </div>
        </div>
    </header>
    <!-- ========================== HEADER END ========================== -->

    <!-- ========================== BLOG PAGE START ========================== -->
    <main>
        <div class="blog-container">
            <h1 class="blog-title"><?= esc($blog['title']); ?></h1>
            <?php if (!empty($blog['image'])): ?>
                <div class="blog-image-container">
                    <img src="<?= base_url('uploads/blogs/' . $blog['image']); ?>" alt="<?= $blog['title']; ?>" class="blog-image">
                </div>
            <?php endif; ?>
            <p class="blog-meta">Published on: <?= date('F j, Y', strtotime($blog['created_at'])); ?></p>
            <div class="blog-content">
                <?= nl2br(preg_replace('/\s+/', ' ', $blog['content'])); ?>
            </div>
        </div>
    </main>
    <!-- ========================== BLOG PAGE END ========================== -->

    <!-- ========================== FOOTER START ========================== -->
    <footer>
        <!-- Existing footer content from your code -->
         <?= include("footer.php"); ?>
    </footer>
    <!-- ========================== FOOTER END ========================== -->


