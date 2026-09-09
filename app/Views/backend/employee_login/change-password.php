<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    </head>
    <?= $this->include('backend/common_links/css_links') ?> 
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><span>Change password</span></a>
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
                        <h3>Change Password</h3>
                        <div class="msg"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Emp. ID: <?= htmlspecialchars($employee['empID'], ENT_QUOTES, 'UTF-8') ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <form id="add_form" class="form-horizontal form-label-left">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="empID" value="<?= esc($employee['empID']) ?>">
                                    <input type="hidden" name="empID" value="<?= esc($employee['id']) ?>">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Password <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" id="old_pwd" name="old_pwd" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" id="new_pwd" name="new_pwd" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" id="cnew_pwd" name="cnew_pwd" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success submit" name="submit">Update</button>
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
    <?= $this->include('backend/common_links/js_links') ?>
 <script>
$(document).ready(function () {
    $('#add_form').on('submit', function (e) {
        e.preventDefault();
        $('.loader-cart').show();

        var formData = new FormData(this);

        $.ajax({
            url: '<?= site_url('employee/update_password') ?>',
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (response) {
                $('.loader-cart').hide();

                if (response.status == 0) {
                    alert(response.message);
                } else {
                    alert(response.message);
                    $('#add_form')[0].reset();
                }
            }
        });
    });
});
</script>

</body>
</html>
