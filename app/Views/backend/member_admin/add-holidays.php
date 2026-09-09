    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Member Holiday Form</title>

        <?= $this->include('backend/common_links/css_links') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

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
                <!-- top navigation -->
                <?php include("header.php"); ?>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Add Holiday</h3>
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
                                    <div class="x_content">
                                        <br />   
                                        <div id="alert" class="alert alert-success" style="display: none;">
                                                Submitted Successfully!
                                            </div>
                                        <form action="<?= base_url('/store-holiday') ?>" method="post" class="form-horizontal form-label-left">
                                            <label class="t-title">Holiday Detail</label>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Membership No. <span class="required">*</span></label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input type="text" name="mem_ms_num" class="form-control col-md-7 col-xs-12" value="<?= old('mem_ms_num') !== null ? old('mem_ms_num') : ($ms_num ?? '') ?>" required readonly>
                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package <span class="required">*</span></label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <select name="pkg_type" class="form-control col-md-7 col-xs-12 chosen_class" required>
                                                        <option value="">-- Select Package Type --</option>
                                                        <option value="4" selected <?= old('pkg_type') == '4' ? : '' ?>>4 Nights & 5 Days</option>
                                                        <option value="6" selected <?= old('pkg_type') == '6' ? 'selected' : '' ?>>6 Nights & 7 Days</option>
                                                    </select>
                                                </div>
                                            </div>

                                        <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            Duration (Years) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="duration_years" id="duration_years" 
                                                    class="form-control col-md-7 col-xs-12" required>
                                                <option value="">-- Select Duration --</option>
                                    
                                                <?php 
                                                $durations = [1, 3, 5, 10, 15, 30];
                                                foreach ($durations as $year): ?>
                                                    <option value="<?= $year ?>">
                                                        <?= $year ?> Year<?= ($year > 1 ? 's' : '') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                    
                                            </select>
                                        </div>
                                    </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">From Date <span class="required">*</span></label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="date" id="v_from" name="v_from" class="form-control col-md-7 col-xs-12" required>
                                                </div>
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">To Date</label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="date" id="v_to" name="v_to" class="form-control col-md-7 col-xs-12" readonly>
                                                </div>
                                            </div>
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
                <?= $this->include('backend/common_links/js_links.php') ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
            <script>
            $(document).ready(function() {
            
                // 🔹 Chosen init
                $('.chosen_class').chosen();
            
                /* =====================================================
                   ONLY DISPLAY PURPOSE
                   From Date + Duration = LAST YEAR To Date (UI only)
                   ===================================================== */
                $('#v_from, #duration_years').on('change', function () {
            
                    var startDateVal   = $('#v_from').val();
                    var durationYears = parseInt($('#duration_years').val());
            
                    if (startDateVal && durationYears) {
            
                        var startDate = new Date(startDateVal);
                        var lastDate  = new Date(startDate);
            
                        // ✅ ONLY FOR DISPLAY (add total years)
                        lastDate.setFullYear(startDate.getFullYear() + durationYears);
            
                        $('#v_to').val(lastDate.toISOString().split('T')[0]);
            
                    } else {
                        $('#v_to').val('');
                    }
                });
            
                /* =====================================================
                   FORM SUBMIT
                   BACKEND LOGIC SAME AS BEFORE (1 YEAR EACH ENTRY)
                   ===================================================== */
                $('form').on('submit', function (e) {
                    e.preventDefault();
            
                    var form          = $(this);
                    var durationYears = parseInt($('#duration_years').val());
                    var startDate     = new Date($('#v_from').val());
            
                    for (var i = 0; i < durationYears; i++) {
            
                        var currentStartDate = new Date(startDate);
                        currentStartDate.setFullYear(startDate.getFullYear() + i);
            
                        var currentEndDate = new Date(currentStartDate);
                        currentEndDate.setFullYear(currentStartDate.getFullYear() + 1);
            
                        // 🔹 SET YEARLY DATES (backend purpose)
                        $('#v_from').val(currentStartDate.toISOString().split('T')[0]);
                        $('#v_to').val(currentEndDate.toISOString().split('T')[0]);
            
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function (response) {
            
                                // 🔹 reset form after last entry
                                form[0].reset();
                                $('.chosen_class').trigger('chosen:updated');
                                $('#v_to').val('');
            
                                $('#alert').fadeIn().delay(3000).fadeOut();
                            },
                            error: function () {
                                alert('Error occurred during submission.');
                            }
                        });
                    }
                });
            
            });
            </script>

            </div>
        </div>
    </body>
    </html>
