<?php $empID = service('uri')->getSegment(3); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employee Salary Record</title>

<?= $this->include('backend/common_links/css_links.php') ?>

<style>
.brdr {
    border-bottom: 1px solid #ccc;
    margin-bottom: 20px;
    padding-bottom: 20px;
}

.salary-block {
    background: #f8f9fa;
    padding: 8px;
    border-radius: 6px;
}

.salary-block div {
    font-size: 13px;
    margin-bottom: 4px;
}

.table td {
    vertical-align: top;
}

@media print {
    body {
        width: 210mm;
        height: 297mm;
        margin: 0 auto;
    }
    .no-print {
        display: none;
    }
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
<?php include("sidebar.php"); ?>
</div>
</div>

<?php include("header.php"); ?>

<div class="right_col" role="main">
<div class="page-title">
<div class="title_left">
<h3>All Employee Salary Records</h3>
</div>
</div>

<div class="clearfix"></div>

<div class="row">
<div class="col-md-12">
<div class="x_panel">

<div class="x_content">

<div class="row brdr">

<a href="<?= base_url('employee/generate_emp_salary/' . $empID) ?>"
   class="btn btn-primary">
   Generate Salary Slip
</a>

</div>

<p><strong>Total Records:</strong> <?= $total ?></p>

<div class="table-responsive">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>Sr.</th>
<th>Slip No</th>
<th>Employee</th>
<th>Period</th>
<th>Days</th>
<th>Salary Details</th>
<th>Deductions</th>
<th>Final Salary</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php if (!empty($salaries)): ?>
<?php $sr = ($page - 1) * $limit + 1; ?>
<?php foreach ($salaries as $salary): ?>
<tr>

<td><?= $sr++; ?></td>
<td><?= $salary['slip_num']; ?></td>

<td>
<strong>ID:</strong> <?= $salary['empID']; ?><br>
<strong>Date:</strong> <?= $salary['gen_date']; ?>
</td>

<td>
<?= $salary['sal_month']; ?> <?= $salary['sal_year']; ?>
</td>

<td>
Working: <?= $salary['wd']; ?><br>
Payable: <?= $salary['pd']; ?><br>
LWP: <?= $salary['lwp']; ?><br>
Arrears: <?= $salary['arrears']; ?>

</td>

<!-- Salary Details -->
<td>
<div class="salary-block">
<div><strong>Basic:</strong> Rs <?= $salary['basic_pay']; ?></div>
<div><strong>HRA:</strong> Rs <?= $salary['hra']; ?></div>
<div><strong>CA:</strong> Rs <?= $salary['ca']; ?></div>
<div><strong>Incentive:</strong> Rs <?= $salary['incentive']; ?></div>
<div><strong>Allowance:</strong> Rs <?= $salary['allowance']; ?></div>
</div>
</td>

<!-- Deductions -->
<td>
<div class="salary-block">
<div><strong>ESI:</strong> Rs <?= $salary['esi']; ?></div>
<div><strong>PF:</strong> Rs <?= $salary['pf']; ?></div>
<div><strong>TDS:</strong> Rs <?= $salary['tds']; ?></div>
<div><strong>Advance:</strong> Rs <?= $salary['advance']; ?></div>
</div>
</td>

<!-- Final Salary -->
<td>
<div class="salary-block">
<div><strong>Net:</strong> Rs <?= $salary['netsalary']; ?></div>
<div>
<strong>Payable:</strong>
<span class="text-success">
Rs <?= $salary['netsalary']; ?>
</span>
</div>
</div>
</td>

<td>
<a href="<?= site_url('salary/edit/'.$salary['id']); ?>"
class="btn btn-sm btn-primary">
Edit
</a>

<a href="<?= site_url('salary/view_pdf/' . esc($salary['slip_num'])); ?>" class="btn btn-info" target="_blank">View</a><br>
<a href="<?= site_url('salary/download_pdf/' . esc($salary['slip_num'])) ?>" class="btn btn-info">Download</a>
                                                                    
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
<td colspan="9">No data found.</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>

<!-- Pagination -->
<?php
$nextPage = $page + 1;
$prevPage = $page - 1;
$remaining = $total - ($limit * $page);
?>

<div class="no-print">
<p>Showing page <?= $page ?> of <?= ceil($total / $limit) ?></p>

<?php if ($page > 1): ?>
<a href="<?= site_url('salary/viewSalaries?page='.$prevPage.'&empID='.$empID); ?>"
class="btn btn-secondary">Previous</a>
<?php endif; ?>

<?php if ($remaining > 0): ?>
<a href="<?= site_url('salary/viewSalaries?page='.$nextPage.'&empID='.$empID); ?>"
class="btn btn-primary">
Next <?= min($limit, $remaining) ?> Records
</a>
<?php endif; ?>
</div>

</div>
</div>
</div>
</div>

<?= $this->include('backend/common_links/js_links') ?>

</div>
</div>
</body>
</html>