<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Employee Salary</title>
  <?= $this->include('backend/common_links/css_links') ?>
  <style type="text/css">
    label.t-title {
      display: block;
      font-size: 16px;
      text-transform: capitalize;
      position: relative;
      top: -10px;
      left: 5px;
    }
    .required-field::after {
      content: "*";
      color: red;
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
          <?php include("sidebar.php") ?>
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('logout') ?>">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </div>

      <?php include("header.php") ?>

      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Edit Employee Salary</h3>
              <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
              <?php endif; ?>
              <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('errors') ?></div>
              <?php endif; ?>
              <?php if (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning"><?= session()->getFlashdata('warning') ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h4>Edit Salary Slip Details</h4>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <form id="edit_form" action="<?= site_url('salary/update/' . $salary['id']) ?>" method="post" class="form-horizontal form-label-left">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $salary['id'] ?>">

                    <!-- EMPLOYEE INFO -->
                    <div class="form-group">
                      <label class="control-label col-md-2 required-field">Employee ID</label>
                      <div class="col-md-4">
                        <input type="text" name="empID" class="form-control" value="<?= $salary['empID'] ?>" disabled>
                      </div>

                      <label class="control-label col-md-2 required-field">Month</label>
                      <div class="col-md-4">
                        <select class="form-control" name="sal_month" required>
                          <option value="">-- Select Month --</option>
                          <?php foreach (["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"] as $month): ?>
                            <option value="<?= $month ?>" <?= $salary['sal_month'] == $month ? 'selected' : '' ?>><?= $month ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2 required-field">Year</label>
                      <div class="col-md-4">
                        <select name="sal_year" required class="form-control">
                          <option value="">-- Select Year --</option>
                          <option value="2026" <?= $salary['sal_year'] == '2026' ? 'selected' : '' ?>>2026</option>
                          <option value="2025" <?= $salary['sal_year'] == '2025' ? : '' ?>>2025</option>
                          <option value="2024" <?= $salary['sal_year'] == '2024' ? : '' ?>>2024</option>
                        </select>
                      </div>
                    </div>

                    <!-- DAYS -->
                    <div class="form-group">
                      <label class="control-label col-md-2 required-field">Working Days</label>
                      <div class="col-md-4">
                        <input type="number" name="wd" id="working_days" class="form-control" value="<?= $salary['wd'] ?>" step="any" required>
                      </div>

                      <label class="control-label col-md-2 required-field">Payable Days</label>
                      <div class="col-md-4">
                        <input type="number" name="pd" id="payable_days" class="form-control" value="<?= $salary['pd'] ?>" step="any" readonly required>
                      </div>
                    </div>

  

                    <div class="form-group">
                      <label class="control-label col-md-2">LWP</label>
                      <div class="col-md-4">
                        <input type="number" name="lwp" id="lwp" class="form-control" value="<?= $salary['lwp'] ?>" step="any">
                      </div>
                    </div>

                    <!-- SALARY -->
                    <div class="form-group">
                      <label class="control-label col-md-2 required-field">Net Salary</label>
                      <div class="col-md-4">
                        <input type="number" name="netsalary" id="net_salary" class="form-control" value="<?= $salary['netsalary'] ?>" required>
                      </div>

                      <label class="control-label col-md-2 required-field">Payable Salary</label>
                      <div class="col-md-4">
                        <input type="number" name="payablesalary" id="payable_salary" class="form-control" value="<?= $salary['payablesalary'] ?>" readonly required>
                      </div>
                    </div>

                    <!-- COMPONENTS -->
                    <div class="form-group">
                      <label class="control-label col-md-2">Basic Pay (50%)</label>
                      <div class="col-md-4">
                        <input type="number" name="basic_pay" id="basic_pay" class="form-control" value="<?= $salary['basic_pay'] ?>" readonly>
                      </div>

                      <label class="control-label col-md-2">HRA (20%)</label>
                      <div class="col-md-4">
                        <input type="number" name="hra" id="hra" class="form-control" value="<?= $salary['hra'] ?>" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Conveyance (15%)</label>
                      <div class="col-md-4">
                        <input type="number" name="ca" id="ca" class="form-control" value="<?= $salary['ca'] ?>" readonly>
                      </div>

                      <label class="control-label col-md-2">Allowance (15%)</label>
                      <div class="col-md-4">
                        <input type="number" name="allowance" id="allowance" class="form-control" value="<?= $salary['allowance'] ?>" readonly>
                      </div>
                    </div>

                    <!-- ADDITIONAL -->
                    <div class="form-group">
                      <label class="control-label col-md-2">Incentive</label>
                      <div class="col-md-4">
                        <input type="number" name="incentive" class="form-control" value="<?= $salary['incentive'] ?>">
                      </div>

                      <label class="control-label col-md-2">Arrears</label>
                      <div class="col-md-4">
                    <input type="number" name="arrears" id="arrears_amount" value="<?= $salary['arrears'] ?>" class="form-control">                      
                    </div>
                    </div>

                    <!-- DEDUCTIONS -->
                    <div class="form-group">
                      <label class="control-label col-md-2">ESI</label>
                      <div class="col-md-4">
                        <input type="number" name="esi" class="form-control" value="<?= $salary['esi'] ?>">
                      </div>

                      <label class="control-label col-md-2">PF</label>
                      <div class="col-md-4">
                        <input type="number" name="pf" class="form-control" value="<?= $salary['pf'] ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">TDS</label>
                      <div class="col-md-4">
                        <input type="number" name="tds" class="form-control" value="<?= $salary['tds'] ?>">
                      </div>

                      <label class="control-label col-md-2">Advance</label>
                      <div class="col-md-4">
                        <input type="number" name="advance" id="advance_amount" class="form-control" value="<?= $salary['advance'] ?>">
                      </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                        <button type="submit" class="btn btn-success">Update Salary</button>
                        <a href="<?= site_url('backend/employee_admin/all_employee') ?>" class="btn btn-danger">Cancel</a>
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
  
<script>

// PAYABLE DAYS
function calculatePayableDays() {
    let wd  = parseFloat(document.getElementById('working_days').value) || 0;
    let lwp = parseFloat(document.getElementById('lwp').value) || 0;

    let pd = wd - lwp;
    if (pd < 0) pd = 0;

    document.getElementById('payable_days').value = pd.toFixed(2);
}

// SALARY CALCULATION
function calculateSalary() {

    let gross = parseFloat(net_salary.value) || 0;
    let wd    = parseFloat(working_days.value) || 0;
    let pd    = parseFloat(payable_days.value) || 0;

    let incentive = parseFloat(document.querySelector('[name="incentive"]').value) || 0;
    let arrears   = parseFloat(document.getElementById('arrears_amount').value) || 0;

    let esi     = parseFloat(document.querySelector('[name="esi"]').value) || 0;
    let pf      = parseFloat(document.querySelector('[name="pf"]').value) || 0;
    let tds     = parseFloat(document.querySelector('[name="tds"]').value) || 0;
    let advance = parseFloat(document.getElementById('advance_amount').value) || 0;

    if (wd <= 0) return;

    // 👉 Payable salary (prorated)
    let perDay = gross / wd;
    let payable = perDay * pd;

    let finalSalary =
        payable + incentive + arrears
        - esi - pf - tds - advance;

    if (finalSalary < 0) finalSalary = 0;

    payable_salary.value = finalSalary.toFixed(2);

    // 👉 Components ALWAYS from full salary
    basic_pay.value = (gross * 0.50).toFixed(2);
    hra.value       = (gross * 0.20).toFixed(2);
    ca.value        = (gross * 0.15).toFixed(2);
    allowance.value = (gross * 0.15).toFixed(2);
}

// EVENTS
document.querySelectorAll('input').forEach(el => {
  el.addEventListener('input', () => {
    calculatePayableDays();
    calculateSalary();
  });
});

</script>

</body>
</html>
