<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Add Member</title>

    <?= $this->include('backend/common_links/css_links') ?>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

<?php 
$isAdmin    = session()->get('role') === 'admin';
$isEmployee = session()->get('isEmployeeLoggedIn') === true;
?>

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>Add Member</span></a>
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
        <!-- top navigation -->
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>
        
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!-- <h2>Add Slide</h2> -->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                    <?php if (session('errors')): ?>
                          <div class="alert alert-danger">
                              <ul>
                                  <?php foreach (session('errors') as $error): ?>
                                      <li><?= esc($error) ?></li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>
                      <?php endif; ?>
                        <!-- Display Success Message (if any) -->
                        <?php if (session()->has('success')): ?>
                            <div class="alert alert-success">
                                <?= session('success') ?>
                            </div>
                        <?php endif; ?> 
                        
                  <div class="x_content">
                    
                      <form action="<?= base_url("yourcontroller/store"); ?>"  method="post" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Type</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select name="status" class="form-control col-md-7 col-xs-12 chosen_class">                            
                            <option value="1" >Active Member</option>
                            <option value="2" >Not Login Sale</option>
                            <option value="0" >Deactive Member</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Subsidiary</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select name="subsidiary_id" required="required" class="form-control col-md-7 col-xs-12 chosen_class" id="subsidiary_id">
                            <option value="<?= old('subsidiary_id') ?>">-- Select Subsidiary --</option>
                            <?php foreach ($subsidiaries as $subsidiary): ?>
                                <option value="<?= $subsidiary['id']; ?>"><?= $subsidiary['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="subsiErr"></div>
                    </div>
                    
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Branch</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select name="branch_id" required="required" class="form-control col-md-7 col-xs-12 chosen_class" id="branch_id">
                            <option value="<?= old('branch_id') ?>">-- Select Branch --</option>
                        </select>
                        <div class="locErr"></div>
                    </div>
                </div>

                <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Manager</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="mngr_id" value="<?= old('mngr_id') ?>" id="mngr_id" required="required" class="form-control col-md-7 col-xs-12 chosen_class">
                        </div>
                        
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Sale Executive</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="salep_id" value="<?= old('salep_id') ?>" id="salep_id" required="required" class="form-control col-md-7 col-xs-12 chosen_class">
                              <div class="saleErr"></div>
                        </div>
                      </div>
                <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Venue</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="venue" value="<?= old('venue') ?>" id="venue" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                    <hr>
                      <label class="t-title">Membership Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Membership No.</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="ms_num" value="<?= old('ms_num') ?>" id="ms_num" required="required" class="form-control col-md-7 col-xs-12">
                          <?php if (session('errors.ms_num')): ?>
                            <div class="empidErr error" style="color: red;"><?= session('errors.ms_num') ?></div>
                            <?php endif; ?>
                          <div class="msnumErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Membership Category</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="ms_category" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_category') ?>">
                          <div class="mscateErr"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Exchange Card No.</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="exchange_num" class="form-control col-md-7 col-xs-12" value="<?= old('exchange_num') ?>">
                          <small>(Optional)</small>
                          <div class="exnumErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Days & Nights</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="day_night" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('day_night') ?>">
                          <small>Example : 6N/7D</small>
                          <div class="ndErr"></div>
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Membership Years</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="ms_year" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_year') ?>">
                          <div class="msyrErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Joining Date</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="date" name="join_date" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('join_date') ?>">
                          <div class="jdErr"></div>
                        </div>
                      </div>
                     <hr>
                      <label class="t-title">Member Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('name') ?>">
                          <div class="nameErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="email" name="email" value="<?= old('email') ?>" id="email" class="form-control col-md-7 col-xs-12">
                          <?php if (session('errors.email')): ?>
                            <div class="emailErr error" style="color: red;"><?= session('errors.email') ?></div>
                            <?php endif; ?>                        
                            </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Mobile</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="mobile" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('mobile') ?>">
                          <?php if (session('errors.mobile')): ?>
                            <div class="empidErr error" style="color: red;"><?= session('errors.mobile') ?></div>
                            <?php endif; ?>
                          <div class="mobErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Alt. Mobile</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="alt_mobile" class="form-control col-md-7 col-xs-12" value="<?= old('alt_mobile') ?>">
                           <small>(Optional)</small>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Birth Date</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="date" name="dob" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('dob') ?>">
                          <div class="dobErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Marriage Anniversary</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="date" name="marriage_anniversary" class="form-control col-md-7 col-xs-12" value="<?= old('marriage_anniversary') ?>">
                           <small>(Optional)</small>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Spouse</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="spouse" class="form-control col-md-7 col-xs-12" value="<?= old('spouse') ?>">
                           <small>(Optional)</small>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Last Holiday</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="last_holiday" class="form-control col-md-7 col-xs-12" value="<?= old('last_holiday') ?>">
                           <small>(Optional)</small>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Address</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        <textarea cols="30" rows="1" name="address" class="form-control textarea" required><?= old('address') ?></textarea>
                        <div class="addErr"></div>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="password" name="password" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('password') ?>">
                          <div class="pwdErr"></div>
                        </div>
                      </div>                                
                        <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Conform Password</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="en_password" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('en_password') ?>">
                            <div class="enPwdErr"></div>
                        </div>
                    </div>
                      <hr>
                      <label class="t-title">First Child Detail  <small>(Optional)</small></label>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="f_child_name"  class="form-control col-md-7 col-xs-12" value="<?= old('f_child_name') ?>">
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Age </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="f_child_age"  class="form-control col-md-7 col-xs-12" value="<?= old('f_child_age') ?>">
                          <small>(in Yrs)</small>
                        </div>
                      </div>

                      
                      <!-- <hr> -->
                      <label class="t-title">Second Child Detail  <small>(Optional)</small></label>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="s_child_name" class="form-control col-md-7 col-xs-12" value="<?= old('s_child_name') ?>">
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Age </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="s_child_age" class="form-control col-md-7 col-xs-12" value="<?= old('s_child_age') ?>">
                          <small>(in Yrs)</small>
                        </div>
                      </div>

                      <hr>
                      <label class="t-title">Payment Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Membership Price</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="ms_amount" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_amount') ?>">
                          <small>(in INR)</small>
                          <div class="msamtErr"></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Advance Paid</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="ms_advance" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_advance') ?>">
                          <small>(in INR)</small>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Amount Due</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="ms_due" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_due') ?>">
                          <small>(in INR)</small>
                        </div>
                      </div>

                      
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">AMC Price</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" name="ms_amc" required="required" class="form-control col-md-7 col-xs-12" value="<?= old('ms_amc') ?>">
                          <small>(in INR)</small>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success submit" id="">Submit</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    
<script>
$(document).ready(function() {
    // When Subsidiary is selected, load the Branches
    $('#subsidiary_id').change(function() {
        var subsidiary_id = $(this).val();
        if (subsidiary_id != '') {
            $.ajax({
                url: '<?= base_url('member/getBranchesBySubsidiary') ?>/' + subsidiary_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#branch_id').empty().append('<option>-- Select Branch --</option>');
                    $.each(response, function(index, branch) {
                        $('#branch_id').append('<option value="' + branch.id + '">' + branch.name + '</option>');
                    });
                },
                error: function() {
                    alert('Failed to load branches. Please try again.');
                }
            });
        } else {
            $('#branch_id').empty().append('<option>-- Select Branch --</option>');
        }
    });
});
</script>

<script>
  function calculateDue() {
    let amount = parseFloat(document.querySelector('input[name="ms_amount"]').value) || 0;
    let advance = parseFloat(document.querySelector('input[name="ms_advance"]').value) || 0;
    let due = amount - advance;
    document.querySelector('input[name="ms_due"]').value = due.toFixed(2);
  }

  // Trigger on input change
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('input[name="ms_amount"]').addEventListener('input', calculateDue);
    document.querySelector('input[name="ms_advance"]').addEventListener('input', calculateDue);
  });
</script>


  </body>
</html>
