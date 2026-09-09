<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

<style>
    body { font-family: Arial, sans-serif; font-size: 11px; line-height: 1.5; color: black; }
    .container { width: 100%; margin: 0 auto; padding: 5px; }

    .header { text-align: center; margin-bottom: 15px; position: relative; }

    .logo {
        position: absolute;
        top: 0;
        right: 0;
        width: 90px;
    }

    .content { margin-bottom: 15px; }
    h1 { font-size: 16px; margin-bottom: 8px; }
    h3 { font-size: 14px; margin-bottom: 5px; }
    p, ul { margin: 4px 0; font-size: 12px; }
    ul { padding-left: 15px; }
    span { font-weight: bold; }

    .footer-note { font-size: 10px; color: #555; text-align:center; margin-top:10px; }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<div class="container">

<?php foreach ($invoices as $invoice): ?>

    <!-- HEADER -->
    <div class="header">
        <?php if (!empty($logo)): ?>
            <img src="<?= $logo ?>" class="logo">
        <?php endif; ?>

        <h1>INVOICE</h1>

        <p><span>Invoice ID:</span> <?= esc($invoice['id'] ?? '') ?></p>
        <p><span>Receipt No.:</span> <?= esc($invoice['receipt_num'] ?? '') ?></p>
        <p><span>Date:</span> <?= esc($invoice['gen_date'] ?? '') ?></p>
        <p><span>GSTIN:</span> 07AAFCB9821L1ZC</p>
    </div>

    <hr>

    <!-- MEMBER DETAILS -->
    <div class="content">
        <h3>MEMBER DETAILS</h3>
        <p><span>Branch:</span> <?= esc($invoice['branch_id'] ?? '') ?></p>
        <p><span>Reg. No.:</span> <?= esc($invoice['mem_ms_num'] ?? '') ?></p>
        <p><span>Name:</span> <?= esc($invoice['mem_name'] ?? '') ?></p>
        <p><span>Email:</span> <?= esc($invoice['mem_email'] ?? '') ?></p>
        <p><span>Address:</span> <?= esc($invoice['mem_address'] ?? '') ?></p>
    </div>

    <hr>

    <!-- PAYMENT DETAILS -->
    <div class="content">
        <h3>PAYMENT DETAILS</h3>
        <p><span>Payment Type:</span> <?= esc($invoice['payment_type'] ?? '') ?></p>
        <p><span>Amount:</span> Rs. <?= esc($invoice['amount'] ?? '') ?></p>
        <p><span>Bank Name:</span> <?= esc($invoice['bank'] ?? '') ?></p>
        <p><span>Payment Mode:</span> <?= esc($invoice['mode'] ?? '') ?></p>
        <p><span>Card No.:</span> **** **** **** <?= substr($invoice['card_num'] ?? '', -4) ?></p>
    </div>

    <hr>

<?php endforeach; ?>

    <!-- ADDITIONAL -->
    <div class="content">
        <h3>ADDITIONAL DETAILS</h3>
        <ul>
            <li>All disputes are subject to Delhi jurisdiction.</li>
            <li>Prices are inclusive of all taxes.</li>
            <li>All cheques are subject to clearing from the bank.</li>
            <li>Holiday amount is Non-Refundable.</li>
        </ul>
    </div>

    <hr>

    <!-- COMPANY -->
    <div class="content">
        <h3>CORPORATE DETAILS</h3>
        <p><span>Delvia Vacations International Pvt. Ltd.</span></p>
        <p><span>CIN No.:</span> U52291DL2014PTC269437</p>
        <p><span>Reg. Office:</span> Building No. 5, Third Floor Raja Dhirsain Marg, Sant Nagar, East of Kailash, New Delhi, Delhi 110065</p>
        <p><span>Email:</span> customercare@delviaholidaysinternational.com</p>
    </div>

    <div class="footer-note">
        Note: This is a computer-generated receipt. Signature is not mandatory.
    </div>

</div>
</body>
</html>