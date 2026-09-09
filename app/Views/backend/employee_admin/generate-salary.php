<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generate Employee Salary</title>
  <?= $this->include('backend/common_links/css_links') ?>

  <style>
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
    <div class="navbar nav_title" style="border:0;">
      <a href="#" class="site_title"><span>Employee Admin</span></a>
    </div>
    <div class="clearfix"></div>
    <?php include("sidebar.php"); ?>
  </div>
</div>

<?php include("header.php") ?>

<div class="right_col" role="main">
<div class="page-title">
  <div class="title_left">
    <h3>Generate Employee Salary</h3>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
      <div class="alert alert-warning"><?= session()->getFlashdata('warning') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
<div class="col-md-12">
<div class="x_panel">
<div class="x_title">
  <h4>Salary Slip Details</h4>
  <div class="clearfix"></div>
</div>

<div class="x_content">

<form method="post" action="<?= site_url('employee/generate_emp_salary_process') ?>" class="form-horizontal">

<?= csrf_field() ?>

<!-- EMPLOYEE -->
<div class="form-group">
  <label class="col-md-2 required-field">Employee ID</label>
  <div class="col-md-4">
    <input type="text" name="empID" class="form-control" value="<?= esc($empID ?? '') ?>" readonly>
  </div>

  <label class="col-md-2 required-field">Month</label>
  <div class="col-md-4">
    <select name="sal_month" class="form-control" required>
      <option value="">-- Select Month --</option>
      <?php foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m): ?>
        <option value="<?= $m ?>"><?= $m ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 required-field">Year</label>
  <div class="col-md-4">
    <select name="sal_year" class="form-control" required>
      <option value="2026">2026</option>
      <option value="2025">2025</option>
      <option value="2024">2024</option>
    </select>
  </div>
</div>

<!-- DAYS -->
<div class="form-group">
  <label class="col-md-2 required-field">Working Days</label>
  <div class="col-md-4">
    <input type="number" id="working_days" name="wd" value="30" class="form-control">
  </div>

  <label class="col-md-2 required-field">Payable Days</label>
  <div class="col-md-4">
    <input type="number" id="payable_days" name="pd" class="form-control" readonly>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2">LWP</label>
  <div class="col-md-4">
    <input type="number" id="lwp" name="lwp" class="form-control">
  </div>
</div>

<!-- SALARY -->
<div class="form-group">
  <label class="col-md-2 required-field">Net Salary</label>
  <div class="col-md-4">
    <input type="number" id="net_salary" name="netsalary" class="form-control">
  </div>

  <label class="col-md-2 required-field">Payable Salary</label>
  <div class="col-md-4">
    <input type="number" id="payable_salary" name="payablesalary" class="form-control" readonly>
  </div>
</div>

<!-- COMPONENTS -->
<div class="form-group">
  <label class="col-md-2">Basic (50%)</label>
  <div class="col-md-4">
    <input type="number" id="basic_pay" name="basic_pay" class="form-control" readonly>
  </div>

  <label class="col-md-2">HRA (20%)</label>
  <div class="col-md-4">
    <input type="number" id="hra" name="hra" class="form-control" readonly>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2">Conveyance (15%)</label>
  <div class="col-md-4">
    <input type="number" id="ca" name="ca" class="form-control" readonly>
  </div>

  <label class="col-md-2">Allowance (15%)</label>
  <div class="col-md-4">
    <input type="number" id="allowance" name="allowance" class="form-control" readonly>
  </div>
</div>

<!-- EXTRA -->
<div class="form-group">
  <label class="col-md-2">Incentive</label>
  <div class="col-md-4">
    <input type="number" name="incentive" class="form-control">
  </div>

  <label class="col-md-2">Arrears</label>
  <div class="col-md-4">
    <input type="number" id="arrears_amount" name="arrears" class="form-control">
  </div>
</div>

<!-- DEDUCTIONS -->
<div class="form-group">
  <label class="col-md-2">ESI</label>
  <div class="col-md-4">
    <input type="number" name="esi" class="form-control">
  </div>

  <label class="col-md-2">PF</label>
  <div class="col-md-4">
    <input type="number" name="pf" class="form-control">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2">TDS</label>
  <div class="col-md-4">
    <input type="number" name="tds" class="form-control">
  </div>

  <label class="col-md-2">Advance</label>
  <div class="col-md-4">
    <input type="number" id="advance_amount" name="advance" class="form-control">
  </div>
</div>

<div class="form-group">
  <div class="col-md-9 col-md-offset-2">
    <button class="btn btn-success">Submit</button>
  </div>
</div>

</form>

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