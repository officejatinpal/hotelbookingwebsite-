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
                  <?= $this->include('backend/property_admin/destination_table'); ?>
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