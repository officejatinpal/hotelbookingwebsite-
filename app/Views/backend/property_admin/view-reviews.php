<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testimonials</title>

    <?= $this->include("backend/common_links/css_links"); ?>

    <style>
        .thumb {
            height: 60px;
            width: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

    <!-- SIDEBAR -->
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title">
                <a href="#" class="site_title"><span>Property Admin</span></a>
            </div>
            <?php include("sidebar.php"); ?>
        </div>
    </div>

    <!-- HEADER -->
    <?= include("header.php"); ?>

    <!-- PAGE CONTENT -->
    <div class="right_col" role="main">
        <div class="x_panel">

            <div class="x_title">
                <h2>Testimonials</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <!-- FLASH MESSAGE -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($testimonials)): ?>
                        <?php $i=1; foreach ($testimonials as $t): ?>
                            <tr>
                                <td><?= $i++; ?></td>

                                <td>
                                    <img src="<?= base_url('uploads/review_img/'.$t['image']) ?>"
                                         class="thumb">
                                </td>

                                <td><?= esc($t['name']); ?></td>
                                <td><?= esc($t['location']); ?></td>

                                <td>
                                    <?= str_repeat('★', $t['rating']); ?>
                                </td>

                                <td>
                                    <?= esc(substr($t['testimonial'], 0, 50)); ?>...
                                </td>

                                <td>
                                    <a href="<?= base_url('edit/'.$t['id']) ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm"
                                    onclick="deleteTestimonial(<?= $t['id'] ?>)">
                                Delete
                            </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                No testimonials found
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?= $this->include("backend/common_links/js_links"); ?>

</div>
</div>

<script>
function deleteTestimonial(id){
    if(confirm("Are you sure you want to delete this testimonial?")){
        window.location.href = "<?= base_url('testimonial/delete/') ?>" + id;
    }
}
</script>

</body>
</html>
