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
                <form action="<?= base_url('webmaster/packagestore'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">                
                    <!-- Resort Title -->
                    <div class="form-group">
                      <label for="title" class="control-label col-md-2">Title</label>
                      <div class="col-md-4">
                          <input type="text" id="title" name="title" class="form-control" value="<?= old('title'); ?>" required>
                          <div id="titleError" class="error"><?= session('errors.title') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group">
                      <label for="slug" class="control-label col-md-2">Slug</label>
                      <div class="col-md-4">
                          <input type="text" id="slug" name="slug" class="form-control" value="<?= old('slug'); ?>" required>
                          <div id="slugError" class="error"><?= session('errors.slug') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Meta Description -->
                    <div class="form-group">
                      <label for="meta_description" class="control-label col-md-2">Meta Description</label>
                      <div class="col-md-8">
                          <input type="text" id="meta_description" name="meta_description" class="form-control" value="<?= old('meta_description'); ?>" required>
                          <div id="metaDescriptionError" class="error"><?= session('errors.meta_description') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                      <label for="price" class="control-label col-md-2">Price</label>
                      <div class="col-md-4">
                          <input type="number" id="price" name="price" class="form-control" value="<?= old('price'); ?>" required>
                          <div id="priceError" class="error"><?= session('errors.price') ?? '' ?></div>
                      </div>
                    </div>
                            <!-- Rating -->
                            <div class="form-group">
                      <label for="price" class="control-label col-md-2">Rating</label>
                      <div class="col-md-4">
                          <input type="number" id="rating" name="rating" class="form-control" value="<?= old('rating'); ?>" required>
                          <div id="priceError" class="error"><?= session('errors.rating') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Rating -->
                     <div class="form-group">
                      <label for="price" class="control-label col-md-2">Persons</label>
                      <div class="col-md-4">
                          <input type="number" id="persons" name="persons" class="form-control" value="<?= old('persons'); ?>" required>
                          <div id="priceError" class="error"><?= session('errors.persons') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Location -->
                    <div class="form-group">
                      <label for="location" class="control-label col-md-2">Location</label>
                      <div class="col-md-4">
                          <input type="text" id="location" name="location" class="form-control" value="<?= old('location'); ?>" required>
                          <div id="locationError" class="error"><?= session('errors.location') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Duration -->
                    <div class="form-group">
                      <label for="duration" class="control-label col-md-2">Duration (in days)</label>
                      <div class="col-md-4">
                          <input type="number" id="duration" name="duration" class="form-control" value="<?= old('duration'); ?>" required>
                          <div id="durationError" class="error"><?= session('errors.duration') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                      <label for="category" class="control-label col-md-2">Category</label>
                      <div class="col-md-4">
                          <select id="category" name="category" class="form-control" required>
                              <option value="luxury" <?= old('category') == 'luxury' ? 'selected' : '' ?>>Luxury</option>
                              <option value="budget" <?= old('category') == 'budget' ? 'selected' : '' ?>>Budget</option>
                              <option value="premium" <?= old('category') == 'premium' ? 'selected' : '' ?>>Premium</option>
                          </select>
                          <div id="categoryError" class="error"><?= session('errors.category') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                      <label for="status" class="control-label col-md-2">Status</label>
                      <div class="col-md-4">
                          <select id="status" name="status" class="form-control" required>
                              <option value="1" <?= old('status') == '1' ? 'selected' : '' ?>>Active</option>
                              <option value="0" <?= old('status') == '0' ? 'selected' : '' ?>>Inactive</option>
                          </select>
                          <div id="statusError" class="error"><?= session('errors.status') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="form-group">
                      <label for="image" class="control-label col-md-2">Featured Image</label>
                      <div class="col-md-4">
                          <input type="file" id="image" name="image" class="form-control" accept="image/*">
                          <div id="imageError" class="error"><?= session('errors.image') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group">
                      <label for="content" class="control-label col-md-2">Content</label>
                      <div class="col-md-8">
                          <textarea id="content" name="content" class="form-control" rows="5" required><?= old('content'); ?></textarea>
                          <div id="contentError" class="error"><?= session('errors.content') ?? '' ?></div>
                      </div>
                    </div>

                    <!-- Submit and Reset Buttons -->
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

      <!-- Footer Scripts -->
      <?= $this->include("backend/common_links/js_links"); ?>

      <!-- Slug Generator Script -->
      <script>
        document.getElementById('title').addEventListener('input', function() {
          const slug = this.value.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
          document.getElementById('slug').value = slug;
        });
      </script>
    </div>
  </div>
</body>
</html>
