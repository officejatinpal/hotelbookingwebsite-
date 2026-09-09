<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Member Comment</title>

    <?= $this->include('backend/common_links/css_links') ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 
$isAdmin    = session()->get('role') === 'admin';
$isEmployee = session()->get('isEmployeeLoggedIn') === true;
?>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

    <!-- SIDEBAR -->
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border:0;">
                <a href="#" class="site_title">
                    <span>Member Comment</span>
                </a>
            </div>
            <div class="clearfix"></div>
            <br />

            <?php if ($isAdmin): ?>
                <?= $this->include('backend/member_admin/sidebar.php') ?>
            <?php elseif ($isEmployee): ?>
                <?= $this->include('backend/employee_login/sidebar.php') ?>
            <?php endif; ?>

        </div>
    </div>

    <!-- TOP NAV -->
    <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
    <?php elseif ($isEmployee): ?>
        <?= $this->include('backend/employee_login/header.php') ?>
    <?php endif; ?>

    <!-- PAGE CONTENT -->
    <div class="right_col" role="main">
        <div class="">

            <!-- FLASH MESSAGE -->
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>
                                Member Comment
                                <small>Member No: <?= esc($ms_num) ?></small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <!-- COMMENT FORM -->
                            <form action="<?= base_url('member/storecomment') ?>" method="post">
                                <?= csrf_field() ?>

                                <input type="hidden" name="ms_num" value="<?= esc($ms_num) ?>">

                                <div class="form-group">
                                    <label>Comment</label>
                                <textarea name="comment"
                                          class="form-control"
                                          rows="5"
                                          placeholder="Enter comment here..."
                                          required><?= esc($comment) ?></textarea>

                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Save / Update Comment
                                </button>
                            </form>

                            <!-- VIEW COMMENT -->
                            <?php if (!empty($comment)): ?>
                                <hr>
                                <h4>Saved Comment</h4>
                                <div class="alert alert-info">
                                    <?= nl2br(esc($comment)) ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>

<?= $this->include('backend/common_links/js_links') ?>

</body>
</html>
