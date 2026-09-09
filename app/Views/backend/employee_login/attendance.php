<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Attendance</title>
     <?= $this->include('backend/common_links/css_links') ?>
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
        .brdr {
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        
        /* ================= MOBILE FIX ================= */
@media (max-width: 768px) {

    /* Remove sidebar gap */
    .nav-md .container.body .right_col {
        margin-left: 0 !important;
        width: 100% !important;
    }

    /* Title */
    .page-title h3 {
        text-align: center;
        font-size: 16px;
    }

    /* Form Fix (stack) */
    .form-group {
        display: block !important;
    }

    .form-group label {
        width: 100% !important;
        margin-bottom: 5px;
    }

    .form-group .col-md-3,
    .form-group .col-md-1 {
        width: 100% !important;
        margin-bottom: 10px;
    }

    /* Button full width */
    #search_data {
        width: 100%;
    }

    /* Table scroll */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        min-width: 700px;
    }

    /* Image Fix */
    table img {
        width: 60px;
        height: auto;
        border-radius: 5px;
    }

    /* Padding */
    td, th {
        font-size: 12px;
        padding: 6px !important;
    }
}

    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>View Attendance</span></a>
                    </div>

                    <div class="clearfix"></div>

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
                            <h3>Attendance</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <p>Employee ID: <?= esc(session()->get('empID')); ?></p>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row brdr">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Month</label>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <select name="search_month" id="month" required="required" class="form-control col-md-7 col-xs-12">
                                                        <option value="0">-- Select Month --</option>
                                                        <?php
                                                        $months = [
                                                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                                                        ];
                                                        foreach ($months as $value => $name):
                                                            $selected = (date('m') == $value) ? 'selected' : '';
                                                            echo "<option value=\"$value\" $selected>$name</option>";
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Year</label>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <select name="search_year" id="yearpicker" class="form-control col-md-7 col-xs-12">
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <button type="button" id="search_data" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                    <div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered export_table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Login Time</th>
                                                <th>Logout Time</th>
                                                <th>Live Image</Picture></th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="new_data">
                                            <?php if (!empty($employe)): ?>
                                                <?php $count = 1; ?>
                                                <?php foreach ($employe as $attendance): ?>
                                                    <?php
                                                    $out_time = ($attendance['out_time']) ? date("h:i A", strtotime($attendance['out_time'])) : "";
                                                    ?>
                                                    <tr id="row<?= esc($attendance['id']); ?>">
                                                        <td><?= esc($count++); ?></td>
                                                        <td><?= date('d-m-Y', strtotime($attendance['atten_date'])); ?></td>
                                                        <td><?= date('h:i A', strtotime($attendance['in_time'])); ?></td>
                                                        <td><?= date('h:i A', strtotime($attendance['out_time'])); ?></td>
                                                        <td><img src="<?= base_url('uploads/attendance/' . $attendance['atten_image']); ?>"></td>
                                                        <td><?= esc($attendance['status']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><b>NO DATA FOUND</b></td>
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
            <!-- /page content -->

        </div>
    </div>

    <?= $this->include('backend/common_links/js_links') ?>
    
<script type="text/javascript">
 $(document).ready(function () {
    // Populate year picker
    for (let i = new Date().getFullYear(); i > 2022; i--) {
        $('#yearpicker').append($('<option />').val(i).html(i));
    }

    // Search button click event
    $("#search_data").click(function () {
        $('.loader-cart').show();

        let month = $('#month').val();
        let year = $('#yearpicker').val();
        let empID = '<?= esc(session()->get('empID')); ?>';

        $.ajax({
            method: "POST",
            url: "<?= base_url('employee/attendence_search') ?>",
            data: { "search_month": month, "search_year": year, "search_empID": empID },
            success: function (res) {
                $('.loader-cart').hide();
                $("#new_data").html(res);
            }
        });
    });
});
    </script>
</body>
</html>
