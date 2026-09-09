<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Testimonial</title>

  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .error { color: red; font-size: 12px; }
    .mb-3 { margin-bottom: 15px; }
    .preview-img{
        height:80px;
        border-radius:6px;
        object-fit:cover;
        margin-right:6px;
    }
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
        <h2>Edit Testimonial</h2>
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
        <form action="<?= base_url('testimonial/update/' . $testimonial['id']) ?>"
              method="post"
              enctype="multipart/form-data">

          <?= csrf_field(); ?>

          <div class="mb-3">
            <label class="fw-bold">Member Name</label>
            <input type="text" name="name" class="form-control"
                   value="<?= esc($testimonial['name']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Location</label>
            <input type="text" name="location" class="form-control"
                   value="<?= esc($testimonial['location']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Testimonial</label>
            <textarea name="testimonial" class="form-control" rows="4" required><?= esc($testimonial['testimonial']) ?></textarea>
          </div>

          <!-- MAIN IMAGE -->
          <div class="mb-3">
            <label class="fw-bold">Main Image (Optional)</label><br>
            <img src="<?= base_url('uploads/review_img/' . $testimonial['image']) ?>"
                 class="preview-img mb-2">

            <input type="file" name="image" class="form-control"
                   accept="image/png, image/jpeg, image/jpg, image/webp">
            <small class="text-muted">Leave blank to keep existing image</small>
          </div>

          <!-- MULTIPLE GALLERY IMAGES -->
          <div class="mb-3">
            <label class="fw-bold">Gallery Images (Add More)</label><br>

            <?php if (!empty($images)): ?>
              <?php foreach ($images as $img): ?>
                <img src="<?= base_url('uploads/review_img/' . $img['image']) ?>"
                     class="preview-img">
              <?php endforeach; ?>
            <?php endif; ?>

            <input type="file" name="images[]" class="form-control mt-2" multiple
                   accept="image/png, image/jpeg, image/jpg, image/webp">

            <small class="text-muted">
              New images will be added to gallery
            </small>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Rating</label>
            <select name="rating" class="form-control" required>
              <?php for($i=5;$i>=1;$i--): ?>
                <option value="<?= $i ?>"
                    <?= $testimonial['rating']==$i?'selected':'' ?>>
                    <?= str_repeat('★',$i) ?><?= str_repeat('☆',5-$i) ?>
                </option>
              <?php endfor; ?>
            </select>
          </div>

          <button type="submit" class="btn btn-success">
            Update Testimonial
          </button>

          <a href="<?= base_url('view-reviews') ?>" class="btn btn-secondary">
            Cancel
          </a>

        </form>

      </div>
    </div>
  </div>

  <?= $this->include("backend/common_links/js_links"); ?>

</div>
</div>
</body>
</html>
