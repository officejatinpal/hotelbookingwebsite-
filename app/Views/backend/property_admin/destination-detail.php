<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Destination Details</title>

    <?= $this->include("backend/common_links/css_links"); ?>

    <style type="text/css">
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
    </style>
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span></span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <?php include("sidebar.php"); ?>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include("header.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Destination Details</h3>
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
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered export_table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Detail</th>
                          <th width="30%">Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if (!empty($destinations)): ?>
                      <?php foreach ($destinations as $destination): ?>
                          <tr>
                              <td><?= esc($destination['title']) ?></td>
                              <td><?= esc($destination['detail']) ?></td>
                              <td>
                                  <img src="<?= base_url('backend/assets/admin/images/destination/' . $destination['image']) ?>" width="100%">
                              </td>
                              <td>
                                  <a class="btn btn-warning btn-sm" href="<?= base_url('webmaster/destination/edit/' . ($destination['desti_id'] ?? '')) ?>">
                                      <span class="fa fa-pencil"> Edit
                                  </a>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">
                              <!-- Insert form -->
                              <form action="<?= site_url('webmaster/destination/insert'); ?>" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="desti_id" value="<?= esc($selected_desti_id) ?>"> <!-- Use the selected ID -->
                                  
                                  <div class="form-group">
                                      <label for="title">Title</label>
                                      <input type="text" name="title" id="title" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="detail">Detail</label>
                                      <textarea name="detail" id="detail" class="form-control" required></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label for="image">Image</label>
                                      <input type="file" name="image" id="image" class="form-control">
                                  </div>
                                  <button type="submit" class="btn btn-success">Submit</button>
                              </form>
                          </td>
                      </tr>
                  <?php endif; ?>
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

    <?= $this->include("backend/common_links/js_links"); ?>
  </body>
</html>