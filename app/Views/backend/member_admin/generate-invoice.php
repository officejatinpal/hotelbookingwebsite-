<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate Invoice</title>

    <!-- Include Common CSS Links -->
    <?= $this->include('backend/common_links/css_links') ?>

    <!-- Chosen Plugin for Dropdown -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

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
    
    <?php 
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    ?>

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
 
         <!-- Sidebar -->
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border:0;">
                    <a href="#" class="site_title"><span>Generate Invoice</span></a>
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
        
        <!-- Top Navigation -->
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="msg"></div>
              </div>
            </div>
            <div class="clearfix"></div>

            <!-- Edit Invoice Form Section -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="btn-group" id="buttonlist">
                      <a class="btn btn-primary" href="<?= base_url('/search_invoice') ?>">Search Invoice</a>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                <?php if (session()->has('success')): ?>
                  <div class="alert alert-success" role="alert">
                      <?= session('success'); ?>
                  </div>
                <?php endif; ?>
            
                <?php if (session()->has('error')): ?>
                  <div class="alert alert-danger" role="alert">
                      <?= session('error'); ?>
                  </div>
                <?php endif; ?>
            
                <?php if (isset($errors) && is_array($errors)): ?>
                  <div class="alert alert-danger" role="alert">
                      <ul>
                          <?php foreach ($errors as $error): ?>
                              <li><?= esc($error); ?></li>
                          <?php endforeach; ?>
                      </ul>
                  </div>
                <?php endif; ?>
    
                  <div class="x_content">
                    <form action="<?= site_url('invoiceDataFrom') ?>" class="form-horizontal form-label-left" method="post">
                      
                      <!-- Member Details -->
                      <label class="t-title">Member Detail</label>
                      <table class="table table-striped table-bordered export_table">
                        <tbody>
                          <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $user): ?>
                              <tr>
                                <th>Subsidiary</th>
                                <td>
                                  <input type="text" name="subsidiary_id" value="<?= $user['subsidiary_name'] ?>" readonly class="form-control">
                                </td>
                                <th>GST No.</th>
                                <td>
                                  <input type="text" name="gst" value="<?= $user['gst'] ?>" readonly class="form-control">
                                </td>
                              </tr>
                              <tr>
                                <th>Branch</th>
                                <td>
                                  <input type="text" name="branch_id" value="<?= $user['branch_name'] ?>" readonly class="form-control">
                                </td>
                                <th>Membership No.</th>
                                <td>
                                  <input type="text" name="mem_ms_num" value="<?= $user['ms_num'] ?>" readonly class="form-control">
                                </td>
                              </tr>
                              <tr>
                                <th>Name</th>
                                <td>
                                  <input type="text" name="mem_name" value="<?= $user['name'] ?>" readonly class="form-control">
                                </td>
                                <th>Email</th>
                                <td>
                                  <input type="email" name="mem_email" value="<?= $user['email'] ?>" readonly class="form-control">
                                </td>
                              </tr>
                              <tr>
                                <th>Mobile</th>
                                <td>
                                  <input type="text" name="mobile" value="<?= $user['mobile'] ?>" readonly class="form-control">
                                </td>
                                <th>Address</th>
                                <td>
                                  <input type="text" name="address" value="<?= $user['address'] ?>" readonly class="form-control">
                                </td>
                              </tr>
                                <th>Manager</th>
                                <td>
                                  <input type="text" name="mngr_id" value="<?= $user['mngr_id'] ?>" readonly class="form-control">
                                </td>
                                <th>Sale Executive</th>
                                <td>
                                  <input type="text" name="salep_id" value="<?= $user['salep_id'] ?>" readonly class="form-control">
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="4">No user data found.</td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                      <hr>
                      
                      <!-- Payment Details -->
                      <label class="t-title">Payment Detail</label>
                      <div class="form-group">
                        <label class="control-label col-md-1">Receipt Date</label>
                        <div class="col-md-4">
                          <input type="date" name="gen_date" class="form-control" value="<?= isset($invoice['gen_date']) ? $invoice['gen_date'] : '' ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1">Bank</label>
                        <div class="col-md-4">
                          <input type="text" name="bank" class="form-control" value="<?= isset($invoice['bank']) ? $invoice['bank'] : '' ?>">
                        </div>

                        <label class="control-label col-md-2">TID</label>
                        <div class="col-md-4">
                          <input type="text" name="tid" class="form-control" value="<?= isset($invoice['tid']) ? $invoice['tid'] : '' ?>">
                          <small>(Optional)</small>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1">Mode</label>
                        <div class="col-md-4">
                          <input type="text" name="mode" class="form-control" value="<?= isset($invoice['mode']) ? $invoice['mode'] : '' ?>">
                        </div>

                        <label class="control-label col-md-2">Card No.</label>
                        <div class="col-md-4">
                          <input type="text" name="card_num" class="form-control" value="<?= isset($invoice['card_num']) ? $invoice['card_num'] : '' ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1">Payment Type</label>
                        <div class="col-md-4">
                          <select name="payment_type" class="form-control" required>
                            <option value="">-- Select Payment Type --</option>
                            <option value="Holiday Amount" <?= isset($invoice['payment_type']) && $invoice['payment_type'] === 'Holiday Amount' ? 'selected' : '' ?>>Holiday Amount</option>
                             <option value="AMC" <?= isset($invoice['payment_type']) && $invoice['payment_type'] === 'AMC' ? 'selected' : '' ?>>Annual Maintenance Cost</option>
                            <option value="Utility Charges" <?= isset($invoice['payment_type']) && $invoice['payment_type'] === 'Utility Charges' ? 'selected' : '' ?>>Utility Charges</option>
                          </select>
                        </div>

                        <label class="control-label col-md-2">Amount (INR)</label>
                        <div class="col-md-4">
                          <input type="number" name="amount" class="form-control" value="<?= isset($invoice['amount']) ? $invoice['amount'] : '' ?>" required>
                        </div>
                      </div>
                      
                      <!-- Form Actions -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
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
    </div>
     <?= $this->include('backend/common_links/js_links') ?>
  </body>
</html>
