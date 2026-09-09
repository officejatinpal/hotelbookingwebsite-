<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Member</title>

    <?= $this->include('backend/common_links/css_links') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <style>
      label.t-title {
        display: block;
        font-size: 16px;
        text-transform: capitalize;
        position: relative;
        top: -10px;
        left: 5px;
      }
    </style>
    
        
    <?php 
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept  = (int) session()->get('department_id');
    ?>
    
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- Sidebar -->
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border:0;">
                    <a href="#" class="site_title"><span>Member Admin</span></a>
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

        <!-- Page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Member</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <?php if (session('errors')): ?>
                      <div class="alert alert-danger">
                        <ul>
                          <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endif; ?>

                    <?php if (session()->has('success')): ?>
                      <div class="alert alert-success"><?= session('success') ?></div>
                    <?php endif; ?>
                     <form action="<?= base_url("yourcontroller/update/" . $record['id']); ?>" method="post" class="form-horizontal form-label-left">
                      <!-- Type -->
                      <div class="form-group">
                        <label class="control-label col-md-1">Type</label>
                        <div class="col-md-4">
                          <select name="status" class="form-control chosen_class">
                            <option value="1" <?= $record['status'] == 1 ? 'selected' : '' ?>>Active Member</option>
                            <option value="2" <?= $record['status'] == 2 ? 'selected' : '' ?>>Not Login Sale</option>
                            <option value="0" <?= $record['status'] == 0 ? 'selected' : '' ?>>Deactive Member</option>
                          </select>
                        </div>
                      </div>
                    
                      <!-- Subsidiary, Branch -->
                      <div class="form-group">
                        <label class="control-label col-md-1">Subsidiary</label>
                        <div class="col-md-4">
                          <select name="subsidiary_id" required class="form-control chosen_class" id="subsidiary_id">
                            <option value="">-- Select Subsidiary --</option>
                            <?php foreach ($subsidiaries as $subsidiary): ?>
                              <option value="<?= $subsidiary['id']; ?>" <?= $subsidiary['id'] == $record['subsidiary_id'] ? 'selected' : '' ?>><?= $subsidiary['name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <label class="control-label col-md-2">Branch</label>
                        <div class="col-md-4">
                          <select name="branch_id" required class="form-control chosen_class" id="branch_id">
                            <option value="<?= $record['branch_id']; ?>">-- Select Branch --</option>
                          </select>
                          <input type="hidden" id="selected_branch_id" value="<?= $record['branch_id']; ?>">

                        </div>
                      </div>
                    
                    <!-- Manager, Sale Executive -->
                    <div class="form-group">
                        <label class="control-label col-md-1">Manager</label>
                        <div class="col-md-4">
                            <input type="text" name="mngr_id" value="<?= $record['mngr_id']; ?>" 
                                   class="form-control" placeholder="Enter Manager Name" required>
                        </div>
                    
                        <label class="control-label col-md-2">Sale Executive</label>
                        <div class="col-md-4">
                            <input type="text" name="salep_id" value="<?= $record['salep_id']; ?>" 
                                   class="form-control" placeholder="Enter Sale Executive" required>
                        </div>
                    </div>

                       <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Venue</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                         <input type="text" name="venue" value="<?= old('venue', $record['venue']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <!-- Membership Detail -->
                      <hr><label class="t-title">Membership Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Membership No.</label>
                        <div class="col-md-4">
                          <input type="text" name="ms_num" value="<?= old('ms_num', $record['ms_num']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Membership Category</label>
                        <div class="col-md-4">
                          <input type="text" name="ms_category" value="<?= old('ms_category', $record['ms_category']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Exchange Card No.</label>
                        <div class="col-md-4">
                          <input type="text" name="exchange_num" value="<?= old('exchange_num', $record['exchange_num']) ?>" class="form-control">
                        </div>
                        <label class="control-label col-md-2">Days & Nights</label>
                        <div class="col-md-4">
                          <input type="text" name="day_night" value="<?= old('day_night', $record['day_night']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Membership Years</label>
                        <div class="col-md-4">
                          <input type="number" name="ms_year" value="<?= old('ms_year', $record['ms_year']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Joining Date</label>
                        <div class="col-md-4">
                          <input type="date" name="join_date" value="<?= old('join_date', $record['join_date']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <!-- Member Detail -->
                      <hr><label class="t-title">Member Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Name</label>
                        <div class="col-md-4">
                          <input type="text" name="name" value="<?= old('name', $record['name']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Email</label>
                        <div class="col-md-4">
                          <input type="email" name="email" value="<?= old('email', $record['email']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Mobile</label>
                        <div class="col-md-4">
                          <input type="text" name="mobile" value="<?= old('mobile', $record['mobile']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Alt. Mobile</label>
                        <div class="col-md-4">
                          <input type="number" name="alt_mobile" value="<?= old('alt_mobile', $record['alt_mobile']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <!-- DOB, Spouse, Address -->
                      <div class="form-group">
                        <label class="control-label col-md-1">Birth Date</label>
                        <div class="col-md-4">
                          <input type="date" name="dob" value="<?= old('dob', $record['dob']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Marriage Anniversary</label>
                        <div class="col-md-4">
                          <input type="date" name="marriage_anniversary" value="<?= old('marriage_anniversary', $record['marriage_anniversary']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Spouse</label>
                        <div class="col-md-4">
                          <input type="text" name="spouse" value="<?= old('spouse', $record['spouse']) ?>" class="form-control">
                        </div>
                        <label class="control-label col-md-2">Last Holiday</label>
                        <div class="col-md-4">
                          <input type="text" name="last_holiday" value="<?= old('last_holiday', $record['last_holiday']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Address</label>
                        <div class="col-md-4">
                          <textarea name="address" required class="form-control"><?= old('address', $record['address']) ?></textarea>
                        </div>
                        <label class="control-label col-md-2">Password</label>
                        <div class="col-md-4">
                          <input type="password" name="password" value="<?= old('password', $record['en_password']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Confirm Password</label>
                        <div class="col-md-4">
                          <input type="text" name="en_password" value="<?= old('en_password', $record['en_password']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <!-- Children -->
                      <hr><label class="t-title">First Child Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Name</label>
                        <div class="col-md-4">
                          <input type="text" name="f_child_name" value="<?= old('f_child_name', $record['f_child_name']) ?>" class="form-control">
                        </div>
                        <label class="control-label col-md-2">Age</label>
                        <div class="col-md-4">
                          <input type="number" name="f_child_age" value="<?= old('f_child_age', $record['f_child_age']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <label class="t-title">Second Child Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Name</label>
                        <div class="col-md-4">
                          <input type="text" name="s_child_name" value="<?= old('s_child_name', $record['s_child_name']) ?>" class="form-control">
                        </div>
                        <label class="control-label col-md-2">Age</label>
                        <div class="col-md-4">
                          <input type="number" name="s_child_age" value="<?= old('s_child_age', $record['s_child_age']) ?>" class="form-control">
                        </div>
                      </div>
                    
                      <!-- Payment -->
                      <hr><label class="t-title">Payment Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Membership Price</label>
                        <div class="col-md-4">
                          <input type="number" name="ms_amount" value="<?= old('ms_amount', $record['ms_amount']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">Advance Paid</label>
                        <div class="col-md-4">
                          <input type="number" name="ms_advance" value="<?= old('ms_advance', $record['ms_advance']) ?>" required class="form-control">
                        </div>
                        <label class="control-label col-md-2">Amount Due</label>
                        <div class="col-md-4">
                          <input type="number" name="ms_due" value="<?= old('ms_due', $record['ms_due']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-1">AMC Price</label>
                        <div class="col-md-4">
                          <input type="number" name="ms_amc" value="<?= old('ms_amc', $record['ms_amc']) ?>" required class="form-control">
                        </div>
                      </div>
                    
                      <!-- Buttons -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>


                  </div> <!-- /.x_content -->
                </div> <!-- /.x_panel -->
              </div>
            </div> <!-- /.row -->
          </div>
        </div>

      </div>
    </div>

    <div class="loader-cart" style="display: none;">
      <img src="<?= base_url('assets/images/dark-loader.gif') ?>">
    </div>

    <?= $this->include('backend/common_links/js_links.php') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>
$(document).ready(function() {

  function loadBranches(subsidiary_id, selectedBranchId = null) {

    if (!subsidiary_id) {
      $('#branch_id').html('<option value="">-- Select Branch --</option>');
      return;
    }

    $('#branch_id').html('<option>Loading...</option>');

    $.get('<?= base_url("member/getBranchesBySubsidiary") ?>/' + subsidiary_id, function(response) {

      let options = '<option value="">-- Select Branch --</option>';

      $.each(response, function(index, branch) {
        let selected = (branch.id == selectedBranchId) ? 'selected' : '';
        options += '<option value="' + branch.id + '" ' + selected + '>' + branch.name + '</option>';
      });

      $('#branch_id').html(options).trigger("chosen:updated");
    });
  }

  // ✅ PAGE LOAD (EDIT MODE)
  let initialSubsidiary = $('#subsidiary_id').val();
  let selectedBranchId = $('#selected_branch_id').val();

  if (initialSubsidiary) {
    loadBranches(initialSubsidiary, selectedBranchId);
  }

  // ✅ ON CHANGE
  $('#subsidiary_id').change(function() {
    loadBranches($(this).val(), null);
  });

});
</script>


  </body>
</html>
