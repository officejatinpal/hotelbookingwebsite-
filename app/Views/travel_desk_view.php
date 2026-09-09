 <?php

$title = isset($desk['title']) ? $desk['title'] : ' - Delvia Holidays International';
$description = !empty($desk['meta_description']) ? $desk['meta_description'] : $defaultDescription;

include 'header.php';
?>

<title><?= esc($title) ?></title>
<meta name="description" content="<?= esc($description) ?>">

<body>
        <!-- Breadcrumb -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Travel View</h3>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">View</li>
                </ol>
            </div>
        </div>
    </header>
    <!-- ========================== HEADER END ========================== -->

    <!-- ========================== BLOG PAGE START ========================== -->
    <main>
        <div class="blog-container">
            <h1 class="blog-title"><?= esc($desk['title']); ?></h1>
            <?php if (!empty($desk['image'])): ?>
                <div class="blog-image-container">
                    <img src="<?= base_url('uploads/traveldesk/' . $desk['image']); ?>" alt="<?= $desk['title']; ?>" class="blog-image">
                </div>
            <?php endif; ?>
            <p class="blog-meta">Published on: <?= date('F j, Y', strtotime($desk['created_at'])); ?></p>
            <div class="blog-content">
                <?= nl2br(preg_replace('/\s+/', ' ', $desk['content'])); ?>
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


