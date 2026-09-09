<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add Slide</title>

    <?= $this->include("backend/common_links/css_links"); ?>

    <style>
        .mb-2 { margin-bottom: 10px !important; }
        .mt-2 { margin-top: 10px !important; }
        .brdr { border-bottom: 1px solid #ccc; padding-bottom: 20px; margin-bottom: 20px; }
        .form-label { font-weight: 600; }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- Sidebar -->
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title">
                    <a href="#" class="site_title"><span>Property Admin</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- Sidebar Menu -->
                <?php include("sidebar.php"); ?>
            </div>
        </div>

        <!-- Top Navigation -->
        <?php include("header.php"); ?>

        <!-- Page Content -->
        <div class="right_col" role="main">

            <div class="page-title">
                <div class="title_left">
                    <h3>Add Carousel Slide</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>New Slide</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <!-- Flash Messages -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <!-- Form -->
                            <form action="<?= site_url('webmaster/store') ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="form-label">Slide Type</label>
                                    <select name="type" required class="form-control">
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Upload File</label>
                                    <input type="file" name="file_name" class="form-control" accept="image/*,video/*" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Caption (Optional)</label>
                                    <textarea name="caption" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Slide Order</label>
                                    <input type="number" name="sort_order" value="0" min="0" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Active</label><br>
                                    <input type="checkbox" name="is_active" checked> Yes
                                </div>

                                <button type="submit" class="btn btn-success">Add Slide</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Loader -->
<div class="loader-cart" style="display:none;">
    <img src="<?= base_url('assets/images/dark-loader.gif') ?>">
</div>

<?= $this->include("backend/common_links/js_links"); ?>

</body>
</html>
