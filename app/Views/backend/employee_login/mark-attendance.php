<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mark Attendance</title>
 <?= $this->include('backend/common_links/css_links') ?>
    <!-- Webcam JS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <?php include("sidebar.php"); ?>
                </div>
            </div>

            <!-- top navigation -->
            <?php include("header.php"); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h4>Mark Attendance on <b><?= date('d M, Y') ?></b></h4>
                        <div class="msg"></div>
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
                                <br />
                                <form action="<?= base_url('employee/attendance_success') ?>" class="form-horizontal form-label-left" method="POST">
                                <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Webcam</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div id="my_camera"></div>
                                                    <button type="button" class="btn btn-dark" onClick="take_snapshot()"><i class="fa fa-camera" aria-hidden="true"></i> Take Snapshot</button>
                                                    <input type="hidden" name="image" class="image-tag" />
                                                    <input type="hidden" name="empID" value="<?= esc(session()->get('empID')); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Captured</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <br><br>
                                                    <div id="results">Your captured image will appear here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success submit" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <!-- /footer content -->
        </div>
    </div>
    <?= $this->include('backend/common_links/js_links') ?>
    <!-- Configure and attach camera -->
    <script language="JavaScript">
    Webcam.set({
        width: 200,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    let imageCaptured = false; // Track if an image has been captured

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img width="200" height="200" src="' + data_uri + '"/>';
            imageCaptured = true; // Set to true when an image is captured
        });
    }

    // Prevent form submission if no image has been captured
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!imageCaptured) {
            event.preventDefault(); // Stop form submission
            alert('Please take a snapshot before submitting attendance.'); // Show alert
        }
    });
</script>

</body>
</html>
