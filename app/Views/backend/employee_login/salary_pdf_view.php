<?php

$workingDays = $salaryData['wd'] ?? 0;
$leaveDays   = $salaryData['lwp'] ?? 0;

// Per day salary
$perDaySalary = $workingDays > 0 ? ($salaryData['netsalary'] / $workingDays) : 0;

// Leave deduction
$leaveDeductionAmount = $perDaySalary * $leaveDays;

// Additions
$arrearsAmount   = $salaryData['arrears'] ?? 0;
$arrearsIncentive   = $salaryData['incentive'] ?? 0;

// Gross Salary (fixed)
$grossSalary =
    ($salaryData['basic_pay'] ?? 0) +
    ($salaryData['hra'] ?? 0) +
    ($salaryData['ca'] ?? 0) +
    ($salaryData['allowance'] ?? 0);

// Total Earnings (Gross + Additions)
$totalEarnings = $grossSalary + $arrearsAmount + $arrearsIncentive;

// Deductions
$totalDeductions =
    ($salaryData['pf'] ?? 0) +
    ($salaryData['esi'] ?? 0) +
    ($salaryData['tds'] ?? 0) +
    ($salaryData['advance'] ?? 0) +
    $leaveDeductionAmount;

// Final Net Salary
$netSalary = $totalEarnings - $totalDeductions;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Salary Slip</title>

<style>
body {
    font-family: DejaVu Sans, Arial;
    font-size: 12px;
    color: #000;
}

.wrapper {
    width: 95%;
    border: 1px solid #000;
    padding: 15px;
    margin-left: auto;
    margin-right: auto;
}

.header-table {
    width: 100%;
    border-collapse: collapse;
}

.header-table td {
    vertical-align: top;
}

.logo img {
    height: 60px;
}

.company {
    text-align: right;
}

.company h3 {
    margin: 0;
    color: #0b5394;
}

.hr-line {
    border-top: 1px solid #000;
    margin: 10px 0;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table td {
    padding: 3px 0;
    vertical-align: top;
}

.salary-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

.salary-table th,
.salary-table td {
    border: 1px solid #000;
    padding: 5px;
}

.salary-table th {
    background: #eeeeee;
}

.text-right {
    text-align: right;
}

.total-row {
    font-weight: bold;
    background: #f4f4f4;
}

.net-row {
    font-weight: bold;
    background: #e8f5e9;
}

.note {
    margin-top: 12px;
    font-size: 11px;
}
</style>
</head>

<body>

<div class="wrapper">

<!-- HEADER -->
<table class="header-table">
<tr>
    
<td class="logo">
    <img src="<?= base_url('asset/logo.png') ?>">
</td>

<td class="company">
    <h3>Delvia Vacations International Pvt. Ltd.</h3>
    Building No. 5, Third Floor Raja Dhirsain Marg, Main Rd<br>
    Sant Nagar, East of Kailash, New Delhi, Delhi 110065
</td>
</tr>
</table>

<div class="hr-line"></div>

<!-- EMPLOYEE DETAILS -->
<table class="info-table">
<tr>
<td width="50%">
    <strong>Employee ID</strong> : <?= $salaryData['empID'] ?? '' ?><br>
    <strong>Employee Name</strong> : <?= $employee['name'] ?? '' ?><br>
<strong>Designation</strong> : <?= $employee['designation_name'] ?? '' ?><br>
    <strong>Period</strong> : <?= $salaryData['sal_month'] ?? '' ?>, <?= $salaryData['sal_year'] ?? '' ?><br>
    <strong>Salary Days</strong> : <?= $salaryData['pd'] ?? 0 ?><br>
    <strong>Leaves</strong> : <?= $salaryData['lwp'] ?? 0 ?><br>
</td>

<td width="25%">
    <strong>Bank Name</strong> : <?= $employee['bank'] ?? '' ?><br>
    <strong>IFSC</strong> : <?= $employee['ifsc'] ?? '' ?><br>
    <strong>Branch</strong> : <?= $employee['branch'] ?? '' ?><br>
    <strong>Account No.</strong> : <?= $employee['acc_num'] ?? '' ?><br>
    <strong>Joining Date</strong> : <?= $employee['join_date'] ?? '' ?><br>
    <strong>Working Days</strong> : <?= $salaryData['wd'] ?? 0 ?>
</td>
</tr>
</table>

<div class="hr-line"></div>

<!-- SALARY TABLE -->
<table class="salary-table">
<tr>
<th>Earnings</th>
<th class="text-right">Rs.</th>
<th>Deductions</th>
<th class="text-right">Rs.</th>
</tr>

<tr>
<td>Basic Pay</td>
<td class="text-right"><?= number_format($salaryData['basic_pay'],2) ?></td>
<td>PF</td>
<td class="text-right"><?= number_format($salaryData['pf'],2) ?></td>
</tr>

<tr>
<td>House Rent Allowance</td>
<td class="text-right"><?= number_format($salaryData['hra'],2) ?></td>
<td>ESI</td>
<td class="text-right"><?= number_format($salaryData['esi'],2) ?></td>
</tr>

<tr>
<td>Conveyance Allowance</td>
<td class="text-right"><?= number_format($salaryData['ca'],2) ?></td>
<td>TDS</td>
<td class="text-right"><?= number_format($salaryData['tds'],2) ?></td>
</tr>

<tr>
<td>Allowance</td>
<td class="text-right"><?= number_format($salaryData['allowance'],2) ?></td>
<td>Advance</td>
<td class="text-right"><?= number_format($salaryData['advance'],2) ?></td>
</tr>

<tr>
<td class="total-row"><strong>Gross Salary</strong></td>
<td class="text-right total-row"><?= number_format($grossSalary,2) ?></td>
<td>Leave Deduction</td>
<td class="text-right"><?= number_format($leaveDeductionAmount,2) ?></td>
</tr>

<tr>
<td>Incentive</td>
<td class="text-right"><?= number_format($arrearsIncentive,2) ?></td>
<td>Loan Deduction</td>
<td class="text-right">0.00</td>
</tr>

<tr>
<td>Arrears</td>
<td class="text-right"><?= number_format($arrearsAmount,2) ?></td>
<td></td>
<td></td>
</tr>

<tr class="total-row">
<td>Total Earnings</td>
<td class="text-right"><?= number_format($totalEarnings,2) ?></td>
<td>Total Deductions</td>
<td class="text-right"><?= number_format($totalDeductions,2) ?></td>
</tr>

<tr class="net-row">
<td colspan="3">Net Salary</td>
<td class="text-right"><?= number_format($netSalary,2) ?></td>
</tr>

</table>
<div class="hr-line"></div>

<div class="note">
<strong>Note :</strong> This is a computer generated salary slip. Signature is not mandatory.
</div>

</div>

</body>
</html>