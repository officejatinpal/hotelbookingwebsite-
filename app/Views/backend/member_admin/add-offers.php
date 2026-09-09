<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add Offer</title>

  <?= $this->include('backend/common_links/css_links') ?>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

  <style type="text/css">
    label.t-title {
      display: block;
      font-size: 16px;
      text-transform: capitalize;
      position: relative;
      top: -10px;
      left: 5px;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><span>Member Admin</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <?php include("sidebar.php");?>
          </div>
        </div>

      <!-- Top Navigation -->
      <?php include("header.php");?>
      <!-- /Top Navigation -->

      <!-- Page Content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3></h3>
              <div class="msg"></div>
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
                <?php if (session()->get('message')) : ?>
                  <div class="alert alert-success"><?= session()->get('message') ?></div>
              <?php endif; ?>
                <div class="x_content">
                <form action="<?= base_url('/storedataoffer') ?>" method="post" class="form-horizontal form-label-left">
                      <!-- Offers Detail -->
                      <label class="t-title">Offers Detail</label>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Membership No.<span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="mem_ms_num" class="form-control col-md-7 col-xs-12" value="<?= old('mem_ms_num') !== null ? old('mem_ms_num') : ($ms_num ?? '') ?>" required readonly>
                          <div class="text-danger">
                              <?= isset($validation) ? $validation->getError('mem_ms_num') : '' ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Valid from</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="date" name="v_from" class="form-control col-md-7 col-xs-12" value="<?= old('v_from') ?>" required>
                          <!-- Error display for v_from -->
                          <div class="text-danger">
                              <?= isset($validation) ? $validation->getError('v_from') : '' ?>
                          </div>
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Valid to</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="date" name="v_to" class="form-control col-md-7 col-xs-12" value="<?= old('v_to') ?>" required>
                          <!-- Error display for v_to -->
                          <div class="text-danger">
                              <?= isset($validation) ? $validation->getError('v_to') : '' ?>
                          </div>
                        </div>                        
                      </div>
                    
                    <textarea name="offer" id="offer_editor"
                              class="form-control col-md-7 col-xs-12" required><?= old('offer') ?></textarea>

                     <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Reset</button>   
                          <button type="submit" class="btn btn-success submit">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
  <div class="loader-cart" style="display: none;">
    <img src="<?=base_url('assets/images/dark-loader.gif')?>">
  </div>

  <?= $this->include('backend/common_links/js_links.php') ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('offer_editor');
</script>



</body>
</html>
