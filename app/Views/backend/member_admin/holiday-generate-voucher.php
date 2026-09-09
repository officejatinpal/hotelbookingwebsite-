<!DOCTYPE html>
      <html lang="en">
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <!-- Meta, title, CSS, favicons, etc. -->
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          
          <title>Generate Confrimation Voucher</title>

          <?= $this->include('backend/common_links/css_links') ?>

          <style type="text/css">
            label.t-title {
              display: block;
          font-size: 16px;
          text-transform: capitalize;
          position: relative;
          top: -10px;
          left: 5px
        }
          </style>
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

                  <!-- menu profile quick info -->
                  <!-- <div class="profile clearfix">
                    <div class="profile_pic">
                      <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                      <span>Welcome,</span>
                      <h2>John Doe</h2>
                    </div>
                  </div> -->
                  <!-- /menu profile quick info -->

                  <br />

                  <?php include("sidebar.php");?>

                  <!-- /menu footer buttons -->
                  <div class="sidebar-footer hidden-small">
                  
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                  </div>
                  <!-- /menu footer buttons -->
                </div>
              </div>
              <!-- top navigation -->
                <?php include("header.php");?>
              <!-- /top navigation -->

              <!-- page content -->
              <div class="right_col" role="main">
                <div class="">
                  <div class="page-title">
                    <div class="title_left">
                      <h3>Confirmation Voucher of <?= $user['ms_num']; ?> </h3>
                      <div class="msg"></div>
                    </div>

                    <!-- <div class="title_right">
                      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                          </span>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <!-- <h2>Add Slide</h2> -->
                          <!--<div class="btn-group" id="buttonlist"> -->
                          <!--  <a class="btn btn-primary " href="">View Invitation</a>  -->
                          <!--</div>-->
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                  
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <br />
                    <form id="" action="<?= base_url('/holidaystorevoucher') ?>" method="post" class="form-horizontal form-label-left">
                      
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Confirmed By</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="confirm_by" class="form-control col-md-7 col-xs-12" value="">
                            <div class="confErr"></div>
                        </div>
                        <?php if (!empty($holiday) && is_array($holiday)): ?>
                    <?php foreach ($holiday as $holidayItem): ?>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ID No.</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="number" name="tbl_id" class="form-control col-md-7 col-xs-12" value="<?= htmlspecialchars($holidayItem['id']); ?>" readonly>
                            <div class="deductamtErr"></div>
                        </div>
                       <?php endforeach; ?>
                      <?php endif; ?>
                        </div>                       
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Booking ID</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="book_id" class="form-control col-md-7 col-xs-12" value="<?= isset($bookingID) ? $bookingID : '' ?>" />
                            <div class="bookIdErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Deduction Amount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="number" name="deduction_amount" class="form-control col-md-7 col-xs-12" value="">
                            <div class="deductamtErr"></div>
                        </div>                                           
                    </div>

                    <div class="form-group">                        
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Booking Amount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="number" name="book_amount" class="form-control col-md-7 col-xs-12" value="">
                            <div class="bookamtErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Received Amount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="number" name="received_amount" class="form-control col-md-7 col-xs-12" value="">
                            <div class="receiamtErr"></div>
                        </div>
                    </div>
                    <hr>
                    <?php if ($user): ?>
                    <label class="t-title">Person Detail</label>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Guest Name</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control col-md-7 col-xs-12">
                            <div class="nameErr"></div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mem. No.</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="ms_num" value="<?= $user['ms_num']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                            <div class="memnErr"></div>
                        </div>
                    </div>
                 <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Email</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                            <div class="emailErr"></div>                        
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mobile</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="mobile" value="<?= $user['mobile']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                            <div class="mobErr"></div>
                        </div>
                    </div>
                <?php endif; ?>
          <hr>
          <label class="t-title">Property Detail</label>        
          <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Destination</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="destination" class="form-control col-md-7 col-xs-12" value="">
                  <div class="destiErr"></div>
              </div>             
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Property Name</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="property_name" class="form-control col-md-7 col-xs-12" value="">
                  <div class="propErr"></div>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Location</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="location" class="form-control col-md-7 col-xs-12" value="">
                  <div class="locErr"></div>
              </div>
              
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Contact</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="contact_num" class="form-control col-md-7 col-xs-12" value="">
                  <div class="contErr"></div>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Book Through</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <select name="book_through" id="book_through" required class="form-control col-md-7 col-xs-12">
                      <option value="Direct">Direct</option>
                      <option value="Vendor">Vendor</option>
                  </select>
                  <div class="thrErr"></div>
              </div>
              
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Book From</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="book_from" class="form-control col-md-7 col-xs-12" value="">
                  <div class="frmErr"></div>
              </div>
          </div>

          <hr>
          <label class="t-title">Room Detail</label>
          <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Room Type</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="room_type" class="form-control col-md-7 col-xs-12" value="">
                  <div class="rtErr"></div>
              </div>                        

              <label class="control-label col-md-2 col-sm-2 col-xs-12">No. of Rooms</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" min="1" name="no_of_room" class="form-control col-md-7 col-xs-12" value="">
                  <div class="rnErr"></div>
              </div>                        
          </div>
          <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Includes</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="includes" class="form-control col-md-7 col-xs-12" value="">
                  <div class="inclErr"></div>
              </div>
                    </div>
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">No. of Adults</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="number" min="1" name="adults" class="form-control col-md-7 col-xs-12" value="">
                        <div class="adultErr"></div>
                    </div>
                    
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">No. of Children</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="kids" class="form-control col-md-7 col-xs-12" value="">
                        <div class="childErr"></div>
                    </div>
                </div>
                          <hr>
                          <label class="t-title">Check-In/Check-Out Detail</label>
                          <div class="form-group">
                              <label class="control-label col-md-1 col-sm-1 col-xs-12">Check-In Date</label>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <input type="date" name="check_in" class="form-control col-md-7 col-xs-12" value="">
                                  <div class="chinErr"></div>
                              </div>
                              
                              <label class="control-label col-md-2 col-sm-2 col-xs-12">Check-Out Date</label>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <input type="date" name="check_out" class="form-control col-md-7 col-xs-12" value="">
                                  <div class="choutErr"></div>
                              </div>
                          </div>

                                <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12">In Time</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="time" name="check_in_time" class="form-control col-md-7 col-xs-12" value="">
                            <div class="cinTErr"></div>
                            </div>
                            
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Out Time</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="time" name="check_out_time" class="form-control col-md-7 col-xs-12" value="">
                            <div class="coutTErr"></div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="" class="btn btn-primary">Cancel</a>
                                </div>
                            </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  
              <!-- /page content -->

              <!-- footer content -->
              
              <!-- /footer content -->
            </div>
          </div>

        
          <div class="loader-cart" style="display: none;">
              <img src="<?=base_url('assets/images/dark-loader.gif')?>">
          </div>

          <?= $this->include('backend/common_links/js_links.php') ?> 


        </body>
      </html>
