<!DOCTYPE html>
<html lang="en">

<head>
    <title>Holiday Member Fee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>

    <?php include 'profile_header.php' ?>

    <!-- DASHBOARD -->
    <section class="amcfee">
        <div class="db">
            <?php include 'profile_sidebar.php' ?>

            <div class="db-2">
                <div class="db-2-com db-2-main">
                    <h4>MEMBERSHIP PAYMENT DETAILS</h4>

                    <div class="db-2-main-com db-2-main-com-table">
                        <table class="responsive-table">
                            <tbody>
                                <tr>
                                    <td>Receipt No.</td>
                                    <td>Receipt Date</td>
                                    <td>Payment Mode</td>
                                    <td>Bank Name</td>
                                    <td>Cheque/Card No.</td>
                                    <td>Payment Type</td>
                                    <td>Amount</td>
                                </tr>

                                <?php if (!empty($amc_res)) : ?>
                                    <?php foreach ($amc_res as $row_fee) : ?>
                                        <tr>
                                            <td><?= $row_fee['receipt_num'] ?></td>
                                            <td><?= $row_fee['gen_date'] ?></td>
                                            <td><?= $row_fee['mode'] ?></td>
                                            <td><?= $row_fee['bank'] ?></td>
                                            <td><?= $row_fee['card_num'] ?></td>
                                            <td><?= $row_fee['payment_type'] ?></td>
                                            <td>Rs. <?= number_format($row_fee['amount']) ?>/-</td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center;">
                                            <strong>NO DATA FOUND</strong>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <!-- TOTAL CALCULATION (ADVANCE REMOVED) -->
                        <div class="total_mem">
                            <?php if (!empty($member)) :

                                $ms_amount = $member['ms_amount'] ?? 0; // Total membership fee

                                // Sum only holiday payments
                                $holiday_paid = 0;
                                if (!empty($amc_res)) {
                                    foreach ($amc_res as $row_fee) {
                                        $holiday_paid += (float)$row_fee['amount'];
                                    }
                                }

                                $final_paid = $holiday_paid;
                                $due = max(0, $ms_amount - $final_paid);
                            ?>

                                <p><b>Total Membership Fee:</b> Rs. <?= number_format($ms_amount) ?>/-</p>
                                <p><b>Total Amount Paid:</b> Rs. <?= number_format($final_paid) ?>/-</p>
                                <p><b>Remaining Due:</b> Rs. <?= number_format($due) ?>/-</p>

                            <?php endif ?>
                        </div>
                        <!-- END TOTAL -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DASHBOARD -->

</body>
</html>