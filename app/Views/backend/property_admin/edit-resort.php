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
          <?= include("sidebar.php"); ?>
        </div>
      </div>

      <!-- Header -->
      <?= include("header.php"); ?>
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Resort</h2>
                <div class="clearfix"></div>
              </div>
              
              <?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success">
    <?= session()->getFlashdata('success'); ?>
  </div>
<?php endif; ?>

              <div class="x_content">
                <form id="editResortForm" action="<?= base_url('webmaster/update/' . $resort['id']); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                  <?= csrf_field(); ?>

                  <div class="form-group">
                    <label class="control-label col-md-2">Category</label>
                    <div class="col-md-4">
                      <select name="desti_category" id="category" class="form-control">
                        <option value="">Select Category</option>
                        <option value="Domestic" <?= $resort['desti_category'] == 'Domestic' ? 'selected' : '' ?>>Domestic</option>
                        <option value="International" <?= $resort['desti_category'] == 'International' ? 'selected' : '' ?>>International</option>
                      </select>
                    </div>

                    <label class="control-label col-md-2">Destination</label>
                    <div class="col-md-4">
                      <select name="desti_id" id="city" class="form-control">
                        <option value="">Select City</option>
                        <?php foreach ($cities as $city): ?>
                          <option value="<?= $city['id'] ?>" <?= $resort['desti_id'] == $city['id'] ? 'selected' : '' ?>><?= $city['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Name</label>
                    <div class="col-md-4">
                      <input type="text" name="name" class="form-control" value="<?= esc($resort['name']) ?>" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2">Property Site</label>
                    <div class="col-md-4">
                      <input type="text" name="external_url" class="form-control" value="<?= esc($resort['external_url']) ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Longitude</label>
                    <div class="col-md-4">
                      <input type="text" name="longi" class="form-control" value="<?= esc($resort['longi']) ?>">
                    </div>
                    <label class="control-label col-md-2">Latitude</label>
                    <div class="col-md-4">
                      <input type="text" name="lati" class="form-control" value="<?= esc($resort['lati']) ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Address</label>
                    <div class="col-md-8">
                      <input type="text" name="address" class="form-control" value="<?= esc($resort['address']) ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Main Image</label>
                    <div class="col-md-4">
                      <input type="file" name="main_image" class="form-control" accept="image/*">
                      <?php if (!empty($resort['main_image'])): ?>
                        <img src="<?= base_url('uploads/resorts/' . $resort['main_image']); ?>" width="100" class="mt-2">
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Description</label>
                    <div class="col-md-8">
                      <textarea name="descr" class="form-control" rows="5" required><?= esc($resort['descr']) ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->include("backend/common_links/js_links"); ?>
    </div>
  </div>
</body>
</html>
