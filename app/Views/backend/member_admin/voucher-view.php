<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voucher PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .page-break { page-break-after: always; }
        h1 {
            font-size: 24px;        /* Set font size */
            margin-top: 20px;      /* Set top margin */
            text-align: center;     /* Center the text */
        }
        h2 { font-size: 20px; margin-top: 15px; }
        p, li { font-size: 12px; }
        
        .highlight {
            font-weight: bold;     /* Make text bold */
        }
        span
        {
            font-weight: bold;     /* Make text bold */
        }
        
        .logo {
            position: absolute;   /* Position the logo absolutely */
            top: 20px;            /* Adjust the top margin as needed */
            right: 50px;           /* Adjust the left margin as needed */
            width: 100px;         /* Set logo width */
            height: auto;         /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <h1>Booking Confirmation</h1>
           <div class="header">
            <!-- ADD YOUR LOGO URL HERE -->
            <img src="<?= base_url('asset/logo.png') ?>" alt="Logo" class="logo">
        <?php foreach ($vouchers as $index => $voucher): ?>
        <div>
            <p><span>BOOKING ID:</span> <?= esc($voucher['book_id']); ?><br/></p>
            <p><span>CONFIRMED BY:</span> <?= esc($voucher['confirm_by']); ?><br/></p>
            <p><span>DATE:</span> <?= esc($voucher['created_at']); ?><br/></p>
            <hr>
            <p><span>GUEST NAME :</span> <?= esc($voucher['name']); ?><br/></p>
            <p><span>MEMBERSHIP ID :</span> <?= esc($voucher['ms_num']); ?><br/></p>
            <p><span>MEMBER EMAIL ID :</span> <?= esc($voucher['email']); ?><br/></p>
            <p><span>MOBILE NUMBER :</span> <?= esc($voucher['mobile']); ?><br/></p>
            <p><span>DESTINATION :</span> <?= esc($voucher['destination']); ?><br/></p>
            <p><span>PROPERTY NAME :</span> <?= esc($voucher['property_name']); ?><br/></p>
            <p><span>LOCATION :</span> <?= esc($voucher['location']); ?><br/></p>
            <p><span>CONTACT NO. :</span> <?= esc($voucher['contact_num']); ?><br/></p>
            <p><span>NO. OF ROOMS :</span> <?= esc($voucher['no_of_room']); ?><br/></p>
            <p><span>ROOM TYPE :</span> <?= esc($voucher['room_type']); ?><br/></p>
            <p><span>INCLUDES :</span> <?= esc($voucher['includes']); ?><br/></p>
            <p><span>NO. OF ADULTS :</span> <?= esc($voucher['adults']); ?><br/></p>
            <p><span>NO. OF CHILD :</span> <?= esc($voucher['kids']); ?><br/></p>
            <p><span>CHECK IN :</span> <?= esc($voucher['check_in']); ?><br/></p>
            <p><span >CHECK OUT :</span> <?= esc($voucher['check_out']); ?><br/></p>
        </div>

        <hr>
        <p><span class="highlight">TERMS AND CONDITIONS :</span><br/>
            Complementary stay for child below 6 years (without extra bed).<br/>
        </p>
        <p><span class="highlight">Reservation & Cancellation Policies:</span><br/>
            i) Reservation can be done via email but the confirmation will be given only after receiving payment in advance.<br/>
            ii) Confirmation of rooms will be subject to availability at the time of receipt of payment.<br/>
            iii) Check-in time - 02:00 PM & Check-out time - 11:00 AM.<br/>
            iv) Note: The booking can't be cancelled or altered once confirmed.<br/>
            v) The Resort reserves the right to reject any bookings received from non-approved distribution channels.<br/>
            vi) No refund will be made if the cancellation is not received at least 15 days before the date of reservation.<br/>
        </p>

        <p><span class="highlight">Notes:</span><br/>
            * If the booking is cancelled due to force majeure (such as acts of God, war, government regulation, disasters, or civil disorder), the guest can re-book within six months as per resort availability.<br/>
            * No refund will be made and no claims will be entertained for 'NO SHOW' or un-availed facilities.<br/>
        </p>

        <p><b> Thanks and Regards,</b><br/>
        Delvia Holidays International</p>
    </div>
    <?php if (($index + 1) % 3 == 0): ?>

    <div class="page-break"></div>

    <?php endif; ?>
    <?php endforeach; ?>

</body>
</html>
