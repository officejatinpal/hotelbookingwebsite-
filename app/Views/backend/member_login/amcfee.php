<!DOCTYPE html>
<html lang="en">

<head>
    <title>Member AMC Status</title>
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
                    <h4>AMC PAYMENT DETAILS</h4>
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
                                        <td><?=$row_fee['receipt_num']?></td>
                                        <td><?=$row_fee['gen_date'] ?></td>
                                        <td><?=$row_fee['mode'] ?></td>
                                        <td><?=$row_fee['bank'] ?></td>
                                        <td><?=$row_fee['card_num'] ?></td>
                                        <td><?=$row_fee['payment_type'] ?></td>
                                            <td><?=$row_fee['amount'] ?> INR</td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7"><strong>NO DATA FOUND</strong></td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DASHBOARD -->
</body>

</html>
