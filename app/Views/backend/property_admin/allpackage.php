<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Destinations</title>

    <!-- Include CSS Links -->
    <?= $this->include("backend/common_links/css_links"); ?>

    <style>
      .modal-body,
      .modal-footer,
      .modal-content {
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

            <!-- Sidebar Menu -->
            <?php include("sidebar.php"); ?>
          </div>
        </div>
        <!-- Top Navigation -->
        <?php include("header.php"); ?>
        <!-- Page Content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Destinations</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div id="table-data">
                      <?= $this->include('backend/property_admin/view-table-packages'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Loader -->
    <div class="loader-cart" style="display: none;">
      <img src="<?= base_url('assets/images/dark-loader.gif') ?>" alt="Loading...">
    </div>

    <!-- Include JS Links -->
    <?= $this->include("backend/common_links/js_links"); ?>

  </body>
</html>
