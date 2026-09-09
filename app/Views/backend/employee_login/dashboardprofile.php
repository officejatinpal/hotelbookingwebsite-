<!DOCTYPE html>
<html lang="en">
    
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Profile</title>
   <?= $this->include('backend/common_links/css_links') ?>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><?= ucwords(htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8')) ?></a>
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
              <h3>My Profile</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Emp. ID: <?= htmlspecialchars($employee['empID'], ENT_QUOTES, 'UTF-8') ?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->                          
                        <img class="img-responsive avatar-view" style="width: 260px;" src="<?= base_url('uploads/employee/' . $employee['profile_pic']) ?>" alt="<?= htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8') ?>">
                      </div>
                    </div>
                    <hr>
                    <h5><?= ucwords(htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8')) ?></h5>
                    <hr>
                    <ul class="list-unstyled user_data">
                      <li><b>Emp ID&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;<?= htmlspecialchars($employee['empID'], ENT_QUOTES, 'UTF-8') ?></li>
                      <li><b>Subsidiary&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;<?= htmlspecialchars($subsidiaryName, ENT_QUOTES, 'UTF-8') ?></li>
                      <li><b>Branch&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;<?= htmlspecialchars($branchName, ENT_QUOTES, 'UTF-8') ?></li>
                      <li><b>Department&nbsp;:</b>&nbsp;&nbsp;<?= htmlspecialchars($departmentName, ENT_QUOTES, 'UTF-8') ?></li>
                      <li><b>Designation :</b>&nbsp;&nbsp;<?= htmlspecialchars($designationTitle, ENT_QUOTES, 'UTF-8') ?></li>
                    </ul>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Personal</a></li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Bank</a></li>
                      </ul>
                      <div id="myTabContent" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="profile-tab">
                          <!-- start user details -->
                          <table class="data table table-striped no-margin">
                            <thead>
                              <tr>
                                <th>Category</th>
                                <th>Details</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr><td><b>Email</b></td><td><?= htmlspecialchars($employee['email'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Mobile</b></td><td><?= htmlspecialchars($employee['mobile'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Alternate Mobile</b></td><td><?= htmlspecialchars($employee['alt_mobile'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Joining Date</b></td><td><?= date('d-m-Y', strtotime($employee['join_date'])) ?></td></tr>
                              <tr><td><b>Date of Birth</b></td><td><?= date('d M, Y', strtotime($employee['dob'])) ?></td></tr>
                              <tr><td><b>Gender</b></td><td><?= htmlspecialchars($employee['gender'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Marital Status</b></td><td><?= htmlspecialchars($employee['marital_status'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Emergency<br>Contact</b></td><td><b>Name :</b> <?= htmlspecialchars($employee['emer_person'], ENT_QUOTES, 'UTF-8') ?><br><b>Phone:</b> <?= htmlspecialchars($employee['emer_num'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Address</b></td><td><?= htmlspecialchars($employee['address'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                            </tbody>
                          </table>
                          <!-- end user details -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <!-- start bank details -->
                          <table class="data table table-striped no-margin">
                            <thead>
                              <tr>
                                <th>Category</th>
                                <th>Details</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr><td><b>Bank</b></td><td><?= htmlspecialchars($employee['bank'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Branch</b></td><td><?= htmlspecialchars($employee['branch'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>A/c No.</b></td><td><?= htmlspecialchars($employee['acc_num'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>IFSC</b></td><td><?= htmlspecialchars($employee['ifsc'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>PAN</b></td><td><?= htmlspecialchars($employee['pan'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                              <tr><td><b>Aadhar No.</b></td><td><?= htmlspecialchars($employee['aadhar'], ENT_QUOTES, 'UTF-8') ?></td></tr>
                            </tbody>
                          </table>
                          <!-- end bank details -->
                        </div>
                      </div>
                    </div>
                  </div>
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
