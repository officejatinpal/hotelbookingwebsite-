<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add YouTube Video</title>
  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .modal-body, .modal-footer, .modal-content {
      width: 100%;
      float: left;
    }
    .form-group {
      margin-bottom: 15px;
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

      <!-- Main Content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add YouTube Video</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <!-- FLASH MESSAGES -->
              <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
              <?php elseif (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
              <?php elseif (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
              <?php endif; ?>

              <div class="x_content">
      <form action="<?= base_url('webmaster/save-video'); ?>" method="POST"
      enctype="multipart/form-data" class="form-horizontal form-label-left">
                  <!-- Video TITLE -->
                  <div class="form-group">
                    <label class="control-label col-md-2">Video Title</label>
                    <div class="col-md-4">
                      <input type="text" name="video_title" id="title" class="form-control"
                             value="<?= old('video_title'); ?>" required>
                      <div class="error"><?= session('errors.video_title') ?? '' ?></div>
                    </div>
                  </div>
                  
                  <!-- YOUTUBE URL -->
                  <div class="form-group">
                    <label class="control-label col-md-2">YouTube Video URL</label>
                    <div class="col-md-4">
                      <input type="text" name="video_url" class="form-control"
                             value="<?= old('video_url'); ?>" placeholder="https://www.youtube.com/watch?v=xxxx"
                             required>
                      <div class="error"><?= session('errors.video_url') ?? '' ?></div>
                    </div>
                  </div>

                  <!-- BUTTONS -->
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                  </div>

                </form>

              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Loader -->
      <div class="loader-cart">
        <img src="<?= base_url('assets/images/dark-loader.gif'); ?>" alt="Loading...">
      </div>

      <!-- JS -->
      <?= $this->include("backend/common_links/js_links"); ?>

    </div>
  </div>
</body>
</html>
