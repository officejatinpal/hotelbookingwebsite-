<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salary Report</title>
 <?= $this->include('backend/common_links/css_links') ?>
    <!-- Include common CSS links -->
<style>
.action-btns {
    display: flex;
    gap: 8px;
}

/* Equal width buttons */
.action-btns .btn {
    flex: 1;
    font-size: 13px;
    padding: 6px;
}

/* Mobile Fix */
@media (max-width: 768px) {

    .action-btns {
        flex-direction: row; /* side by side */
    }

    .action-btns .btn {
        width: 100%;
    }

    /* Remove unwanted spacing */
    td {
        padding: 8px !important;
    }
}</style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Salary Slip</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Include sidebar -->
                    <?php include("sidebar.php"); ?>
                </div>
            </div>

            <!-- Include top navigation -->
            <?php include("header.php"); ?>

            <!-- Page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h4>Salary Slips EmpID - <?= $employee['empID'] ?></h4>
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
                                <div class="x_content">
                                    <div class="row brdr">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Select Year</label>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <select name="search_year" id="yearpicker" class="form-control col-md-7 col-xs-12">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                          <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered export_table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Generated Date</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Salary</th>
                                            <th>Slip No.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new_data">
                                        <?php if (!empty($salaries)): ?>
                                            <?php $count = 1; ?>
                                            <?php foreach ($salaries as $salary): ?>
                                                <tr id="row<?= esc($salary['id']); ?>">
                                                    <td><?= $count++ ?></td>
                                                    <td><?= esc($salary['gen_date']); ?></td>
                                                    <td><?= esc($salary['sal_month']); ?></td>
                                                    <td><?= esc($salary['sal_year']); ?></td>
                                                    <td><?= esc($salary['basic_pay']); ?></td>
                                                    <td><?= esc($salary['slip_num']); ?></td>
                                                    
                                                <td>
                                                <div class="action-btns">
                                                    <a href="<?= site_url('salary/view_pdf/' . esc($salary['slip_num'])); ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="<?= site_url('salary/download_pdf/' . esc($salary['slip_num'])) ?>" class="btn btn-success btn-sm">Download</a>
                                                </div>
                                            </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center"><b>NO DATA FOUND</b></td>
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

    <?= $this->include('backend/common_links/js_links') ?>
            <!-- Include common JS links -->

            <script type="text/javascript">
                    // First, add the "Select Year" option
                    $('#yearpicker').append($('<option />').val('').html('Select Year'));

                    // Populate the year picker with years starting from the current year down to 2018
                    for (var i = new Date().getFullYear(); i >= 2024; i--) {
                        $('#yearpicker').append($('<option />').val(i).html(i));
                    }

                // Handle the year picker change event
                $("#yearpicker").change(function() {
                    $('.loader-cart').show();
                    var year = $('#yearpicker').val();

                            $.ajax({
                method: "POST",
                url: "<?= base_url('employee/salary_search') ?>",
                data: {"search_sal_year": year},
                success: function(res) {
                    $('.loader-cart').hide();
                    $("#new_data").html(res); 
                },
                error: function() {
                    $('.loader-cart').hide();
                    $("#new_data").html("<tr><td colspan='7' class='text-center'><b>Error loading data</b></td></tr>");
                }
            });
        });
            </script>
        </div>
    </div>
</body>
</html>
