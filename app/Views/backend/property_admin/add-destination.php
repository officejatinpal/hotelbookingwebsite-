<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Destination</title>
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
    .mb-2 { margin-bottom: 10px !important; }
    .mt-2 { margin-top: 10px !important; }
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
                <h2>Add Destination</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Form Starts -->
                <form action="<?= base_url('webmaster/submit/add_destinationt') ?>" method="post" class="form-horizontal form-label-left">

                  <div class="form-group">

                    <!-- CATEGORY -->
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Category</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="category" id="category" required class="form-control">
                        <option value="">-- Select Category --</option>
                        <option value="Domestic">Domestic</option>
                        <option value="International">International</option>
                      </select>
                      <div class="cateErr"></div>
                    </div>

                    <!-- DIRECTION NAME -->
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Direction Name</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select id="directions" name="directions" class="form-control">
                        <option value="">-- Select Direction --</option>
                      </select>
                      <div class="nameErr"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Destination Name</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text" id="name" name="name" class="form-control" value="">
                      <div class="nameErr"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Featured</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="featured" required class="form-control">
                        <option value="0">No</option>
                      </select>
                      <div class="feaErr"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                  </div>

                </form>
                <!-- Form Ends -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="loader-cart" style="display: none;">
      <img src="<?=base_url('assets/images/dark-loader.gif')?>">
    </div>

    <?= $this->include("backend/common_links/js_links"); ?>

    <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove();
        });
      }, 2000);

      // CATEGORY → DIRECTION AUTO UPDATE
      document.getElementById('category').addEventListener('change', function () {
          let cat = this.value;
          let directionSelect = document.getElementById('directions');

          directionSelect.innerHTML = '<option value="">-- Select Direction --</option>';

          let domestic = ["North", "South", "East", "West", "Central", "North-East"];
          let international = ["Asia", "Europe", "Middle East", "Africa", "USA"];

          let list = [];

          if (cat === "Domestic") {
              list = domestic;
          } else if (cat === "International") {
              list = international;
          }

          list.forEach(function (item) {
              let opt = document.createElement('option');
              opt.value = item;
              opt.textContent = item;
              directionSelect.appendChild(opt);
          });
      });
    </script>

  </body>
</html>
