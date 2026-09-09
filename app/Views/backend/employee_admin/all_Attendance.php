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
    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Employee Admin</span></a>
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
                                    <p>All Employees Attendance </p>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
 <div class="x_content">
    <div class="row brdr">
        <div class="col-md-12">
            <form class="form-horizontal">
                <div class="form-group">

                    <!-- Emp ID -->
                    <label class="control-label col-md-1 col-sm-2 col-xs-12">
                        Emp ID
                    </label>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <input type="text" name="search_empID" id="empID"
                               class="form-control"
                               placeholder="Enter Emp ID">
                    </div>

                    <!-- Month -->
                    <label class="control-label col-md-1 col-sm-2 col-xs-12">
                        Month
                    </label>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <select name="search_month" id="month"
                                class="form-control" required>
                            <option value="">-- Month --</option>
                            <?php
                            $months = [
                                1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
                                5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',
                                9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'
                            ];
                            foreach ($months as $value => $name):
                                $selected = (date('n') == $value) ? 'selected' : '';
                                echo "<option value='$value' $selected>$name</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <!-- Year -->
                    <label class="control-label col-md-1 col-sm-2 col-xs-12">
                        Year
                    </label>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <select name="search_year" id="yearpicker"
                                class="form-control"></select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <button type="button" id="search_data"
                                class="btn btn-success">
                            Search
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

    <div class="loader-cart" style="display: none;">
        <img src="<?= base_url('assets/images/dark-loader.gif') ?>">
    </div>

    <?= $this->include('backend/common_links/js_links') ?>

<script type="text/javascript">
 $(document).ready(function () {
    
    $('#yearpicker').append($('<option />').val('').html('Select Year'));
    // Populate year picker
    for (let i = new Date().getFullYear(); i > 2022; i--) {
        $('#yearpicker').append($('<option />').val(i).html(i));
    }

    // Search button click event
    $("#search_data").click(function () {
        $('.loader-cart').show();

        let month = $('#month').val();
        let year = $('#yearpicker').val();
        let empID = $('#empID').val(); // Get Employee ID from input

        $.ajax({
            method: "POST",
            url: "<?= base_url('employee/attendence_search') ?>",
            data: { "search_month": month, "search_year": year, "search_empID": empID }, // Include empID
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
