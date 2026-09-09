<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Testimonial</title>

  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .error { color: red; font-size: 12px; }
    .mb-3 { margin-bottom: 15px; }
  </style>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

  <!-- SIDEBAR -->
  <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title">
        <a href="#" class="site_title"><span>Property Admin</span></a>
      </div>
      <?php include("sidebar.php"); ?>
    </div>
  </div>

  <!-- HEADER -->
  <?= include("header.php"); ?>

  <!-- PAGE CONTENT -->
  <div class="right_col" role="main">
    <div class="x_panel">
      <div class="x_title">
        <h2>Add Testimonial</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <!-- FLASH MESSAGES -->
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

        <!-- FORM -->
        <form action="<?= base_url('webmaster/testimonial/store') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>

          <div class="mb-3">
            <label class="fw-bold">Member Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Location</label>
            <input type="text" name="location" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Testimonial</label>
            <textarea name="testimonial" class="form-control" rows="4" required></textarea>
          </div>

         <!-- MAIN IMAGE -->
            <div class="mb-3">
              <label class="fw-bold">Main Image (Card Image)</label>
              <input type="file" name="image" class="form-control" required
                     accept="image/png, image/jpeg, image/jpg, image/webp">
              <small class="text-muted">This image will show on review card</small>
            </div>
            
            <!-- MULTIPLE GALLERY IMAGES -->
            <div class="mb-3">
              <label class="fw-bold">Gallery Images (Multiple)</label>
              <input type="file" name="images[]" class="form-control" multiple
                     accept="image/png, image/jpeg, image/jpg, image/webp">
              <small class="text-muted">
                These images will appear in slider on "Read Full Review"
              </small>
            </div>


          <div class="mb-3">
            <label class="fw-bold">Rating</label>
            <select name="rating" class="form-control" required>
              <option value="5">★★★★★ (Excellent)</option>
              <option value="4">★★★★☆ (Very Good)</option>
              <option value="3">★★★☆☆ (Good)</option>
              <option value="2">★★☆☆☆ (Fair)</option>
              <option value="1">★☆☆☆☆ (Poor)</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Save Testimonial</button>

        </form>

      </div>
    </div>
  </div>

  <?= $this->include("backend/common_links/js_links"); ?>

</div>
</div>
</body>
</html>
