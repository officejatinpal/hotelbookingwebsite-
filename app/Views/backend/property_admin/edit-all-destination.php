<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Destinations</title>

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
              <a href="#" class="site_title"><span>Admin Panel</span></a>
            </div>
            <div class="clearfix"></div>

            <?php include("sidebar.php"); ?>
          </div>
        </div>

        <?php include("header.php"); ?>

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
                  <form action="<?= site_url('webmaster/destination/update') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $destination['id'] ?>">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $destination['name'] ?>" required>

                    <label for="slug">Slug:</label>
                    <input type="text" name="slug" value="<?= $destination['slug'] ?>" required>

                    <label for="category">Category:</label>
                    <select name="category">
                        <option value="">-- Select Category --</option>
                        <option value="Domestic" <?= $destination['category'] == 'Domestic' ? 'selected' : '' ?>>Domestic</option>
                        <option value="International" <?= $destination['category'] == 'International' ? 'selected' : '' ?>>International</option>
                    </select>

                    <label for="featured">Featured:</label>
                    <select name="featured">
                        <option value="1" <?= $destination['featured'] == 1 ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= $destination['featured'] == 0 ? 'selected' : '' ?>>No</option>
                    </select>

                    <label for="status">Status:</label>
                    <select name="status">
                        <option value="1" <?= $destination['status'] == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $destination['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <button type="submit">Update Destination</button>
                </form>
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
