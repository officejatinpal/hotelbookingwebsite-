<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>View Department</title>

    <?= $this->include("backend/common_links/css_links"); ?>

    <style>
        .modal-body, .modal-footer, .modal-content { width:100%; float:left; }
        .list-inline { width:100%; text-align:center; }
        ul.count2 li { margin-bottom:20px !important; }
        ul.widget_profile_box li:last-child { width:100% !important; text-align:center; }
        ul.widget_profile_box li .profile_img { margin:0px; }
        .modal-title { float:left; }
        .mb-2 { margin-bottom:10px !important; }
        .mt-2 { margin-top:10px !important; }
        .brdr { border-bottom:1px solid #ccc; margin-bottom:20px; padding-bottom:20px; }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- Sidebar -->
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border:0;">
                    <a href="#" class="site_title"><span></span></a>
                </div>
                <div class="clearfix"></div>

                <?php include("sidebar.php"); ?>
            </div>
        </div>

        <!-- Header -->
        <?php include("header.php"); ?>

        <!-- Page Content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left"><h3>Branch</h3></div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Preview</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($slides as $slide): ?>
                                            <tr>
                                                <td><?= $slide['id'] ?></td>

                                                <td>
                                                    <?php if ($slide['type'] == 'image'): ?>
                                                        <img src="<?= base_url('asset/img/slide/' . $slide['file_name']) ?>" width="120" style="border-radius:6px;">
                                                    <?php else: ?>
                                                        <video width="180" controls style="border-radius:6px;">
                                                            <source src="<?= base_url('asset/img/slide/' . $slide['file_name']) ?>" type="video/mp4">
                                                        </video>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= ucfirst($slide['type']) ?></td>

                                                <td>
                                                    <?php if ($slide['is_active']): ?>
                                                        <span style="color:green;font-weight:bold;">Active</span>
                                                    <?php else: ?>
                                                        <span style="color:red;font-weight:bold;">Inactive</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <a href="<?= site_url('webmaster/carousel/delete/' . $slide['id']) ?>"
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Delete this slide?')">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<?= $this->include("backend/common_links/js_links"); ?>

</body>
</html>
