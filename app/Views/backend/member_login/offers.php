<!DOCTYPE html>
<html lang="en">

<head>
    <title>Member Offer Profile</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>

<?php include 'profile_header.php' ?>
    
 <section class="offers amcfee">
    <div class="db">
        <?php include 'profile_sidebar.php' ?>
        <div class="db-2">
            <div class="db-2-com db-2-main">
                <h4>OFFERS</h4>
                <div class="db-2-main-com db-2-main-com-table">
                    <table class="responsive-table">
                        <tbody>
                            <tr>
                                <td>OFFERS</td>
                                <td>Valid from</td>
                                <td>Valid to</td>
                                <td>Status</td>
                                <td>Detail</td>
                            </tr>

                            <?php if (!empty($offer_res)) {
                                foreach ($offer_res as $row_offer) {
                                    $date_from = date("d-m-Y", strtotime($row_offer['v_from']));
                                    $date_to = date("d-m-Y", strtotime($row_offer['v_to']));
                            ?>
                                <tr>
                                    <td><?= strip_tags($row_offer['offer'], '<p><strong>') ?></td>
                                    <td><?= $date_from ?></td>
                                    <td><?= $date_to ?></td>
                                    <td>
                                        <button class="<?= ($row_offer['status'] == 'Available') ? 'db-done' : 'db-not-done' ?>">
                                            <?= $row_offer['status'] ?>
                                        </button>
                                    </td>

                                    <td>
                                        <?php if (!empty($row_offer['detail'])): ?>
                                            <?= $row_offer['detail'] ?>
                                            <?php if (!empty($row_offer['book_date'])): ?>
                                                <br>Booked Date - <?= $row_offer['book_date'] ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--END DASHBOARD-->

</body>

</html>