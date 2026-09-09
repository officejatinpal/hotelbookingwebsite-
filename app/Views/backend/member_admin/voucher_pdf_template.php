<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gift Voucher</title>
<style>
    /* Reset body margin for PDF */
    body {
        font-family: Arial, sans-serif;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    .voucher {
        width: 100%;
        margin: 5px;
        position: relative;
    }

    .info-row {
        margin-bottom: 5px;
        font-size: 12px;
    }

    .label {
        font-weight: bold;
    }

    .title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0;
    }

    .section-title {
        font-weight: bold;
        margin-top: 13px;
        font-size: 14px;
    }

    .logo {
        position: absolute;
        top: 5px;
        right: 10px;
        width: 90px;
    }

    p {
        margin: 2px 0;
    }

    .page-break {
        page-break-after: always;
    }
    
    .banner-wrapper {
    position: relative;
    width: 100%;
    height: 200px; /* adjust as needed */
    overflow: hidden; /* white bottom area hide */
}

.banner {
    width: 100%;
    height: auto;
    display: block;
}

.banner-overlay {
    position: absolute;
    top: 14px;
    left: 56%;
    transform: translateX(-10%);
    background: rgba(255, 255, 255, 0.7);
    padding: 15px 20px;
    border-radius: 10px;
    width: 40%;
    font-size: 14px;
    line-height: 1.5;
}

.banner-overlay p {
    margin: 5px 0;
}

</style>
</head>
<body>


<div class="voucher">
    
<?php foreach ($vouchers as $index => $voucher): ?>
    <!-- Logo and Member Details -->
    <div class="content">
      <img src="<?= base_url('asset/logo.png') ?>" class="logo">
        <p class="title">Gift Voucher No. - <?= esc($voucher['v_num']) ?></p>
        <p class="info-row"> <span class="label">Branch Name :</span> <?= esc($voucher['branch_name']) ?> </p>
        <p class="info-row"> <span class="label">Branch Name :</span> <?= esc($voucher['issue_date']) ?> </p>
        <p class="info-row"> <span class="label">Category :</span> <?= esc($voucher['category']) ?> </p>
        <br><br>
        
        <?php if (!empty($voucher['holiday'])): ?>
        <div class="banner-wrapper">
       <img src="<?= base_url('asset/img/vouchersbanner/holiday_voucher.png') ?>" class="banner">
       
            <div class="banner-overlay">
            <div class="title">HOLIDAY VOUCHER</div>
            <p><strong>Name:</strong> <?= esc($voucher['name']) ?></p>
            <p><strong>Email:</strong> <?= esc($voucher['email']) ?></p>
            <p><strong>Phone:</strong> <?= esc($voucher['phone']) ?></p>
            <p><strong>Voucher No:</strong> <?= esc($voucher['v_num']) ?></p>
            </div>
        </div>
  <?php endif; ?>
  
    <!-- Holiday Content -->
    <?php if (!empty($voucher['holiday'])): ?>
        <div class="section-title">Holiday Destination:</div>
        <p><?= nl2br(esc($voucher['holiday'])) ?></p>
        <div class="section-title">Validity:</div>
        <p>1 Year</p>

        <div class="section-title">Terms & Conditions :</div>
        <p>
            * Locations and properties are subject to change.<br>
            * Booking is subject to availability.<br>
            * Accommodation is for 2 adults + 2 kids below 6 years (same bed). Food & travel not included.<br>
            * Voucher valid for Delvia Holidays International off-peak stays.<br>
            * Reservation for 2 nights requires 15 working days notice.<br>
            * Must present this voucher and Govt. ID while checking in.<br>
            * Voucher is non-transferable and not exchangeable for cash.<br>
            * If not used within the validity period, the voucher will lapse.<br>
        </p>
    <?php endif; ?>
        <br>
        <!-- Movie Banner -->
          <?php if (!empty($voucher['movie'])): ?>
        <div class="banner-wrapper">
       <img src="<?= base_url('asset/img/vouchersbanner/movie_voucher.png') ?>" class="banner">
       
            <div class="banner-overlay">
            <div class="title">MOVIE VOUCHER</div>
            <p><strong>Name:</strong> <?= esc($voucher['name']) ?></p>
            <p><strong>Email:</strong> <?= esc($voucher['email']) ?></p>
            <p><strong>Phone:</strong> <?= esc($voucher['phone']) ?></p>
            <p><strong>Voucher No:</strong> <?= esc($voucher['v_num']) ?></p>
            </div>
        </div>
  <?php endif; ?>
  
    
    <?php if (!empty($voucher['movie'])): ?>
        <div class="section-title">Movie Offer:</div>
        <p><?= nl2br(esc($voucher['movie'])) ?></p>
        <div class="section-title">Terms & Conditions :</div> 
        <p>
            * Movie voucher booking requires 7 working days notice (Mon–Thu only).<br>
            * Utility charges may apply.<br>
            * Must present this voucher at the cinema.<br>
            * Voucher is non-transferable and not exchangeable for cash.<br>
            * If not used within the validity period, the voucher will lapse.<br>
        </p>
    <?php endif; ?>

    <!-- Office Details for both voucher types -->
    <div class="section-title">Office Details:</div>
        <b>Reg. Office:</b> Building No. 5, Third Floor Raja Dhirsain Marg, Sant Nagar, East of Kailash, New Delhi, Delhi 110065<br>
        <b>Email:</b> voucher@delviaholidaysinternational.com

<?php if($index < count($vouchers)-1): ?>
<div class="page-break"></div>
<?php endif; ?>

<?php endforeach; ?>

</body>
</html>
