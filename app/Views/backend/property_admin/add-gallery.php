<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Resort</title>
  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .modal-body, .modal-footer, .modal-content {
      width: 100%;
      float: left;
    }
    .list-inline {
      width: 100%;
      text-align: center;
    }
    ul.count2 li {
      margin-bottom: 20px !important;
    }
    ul.widget_profile_box li:last-child {
      width: 100% !important;
      text-align: center;
    }
    ul.widget_profile_box li .profile_img {
      margin: 0px;
    }
    .modal-title {
      float: left;
    }
    .mb-2 {
      margin-bottom: 10px !important;
    }
    .mt-2 {
      margin-top: 10px !important;
    }
    .brdr {
      border-bottom: 1px solid #ccc;
      margin-bottom: 20px;
      padding-bottom: 20px;
    }
    .error {
      color: red;
      font-size: 12px;
    }
    .loader-cart {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
    }
    .loader-cart img {
      width: 50px;
      height: 50px;
    }
  </style>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <!-- Sidebar -->
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><span>Property Admin</span></a>
          </div>
          <div class="clearfix"></div>
                        <?php include("sidebar.php"); ?>
        </div>
      </div>

      <!-- Header -->
      <?= include("header.php"); ?>

      <!-- Page Content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Resort</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?= implode('<br>', session()->getFlashdata('errors')); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
            <form action="<?= base_url('webmaster/gallery/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?> <!-- Add CSRF protection -->
                <div class="mb-3">
                    <label class="fw-bold" for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    <small class="form-text text-muted">Allowed file types: JPG, PNG. Max size: 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <span id="formError" class="error-message" style="color: red; display: none;"></span>

      <!-- Loader -->
      <div class="loader-cart">
        <img src="<?= base_url('assets/images/dark-loader.gif'); ?>">
      </div>

      <!-- Footer Scripts -->
      <?= $this->include("backend/common_links/js_links"); ?>


    </div>
  </div>
</body>
</html>
