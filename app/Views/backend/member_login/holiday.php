<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Holiday Status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>

<?php include 'profile_header.php'; ?>

<!-- DASHBOARD -->
<section class="holiday">
    <div class="db">
        <?php include 'profile_sidebar.php'; ?>
        <div class="db-2">
            <div class="db-2-com db-2-main">
                <h4>MEMBER HOLIDAYS</h4>
                <div class="db-2-main-com db-2-main-com-table">
                 <table class="responsive-table">
                    <tbody class="head_tbl">
                        <tr>
                            <td>Length of Holidays</td>
                            <td>Valid From</td>
                            <td>Valid To</td>
                            <td>Status</td>
                            <td>Detail</td>
                        </tr>
                
                        <?php if (!empty($holi_res)) : ?>
                            <?php
                            // Group by v_from and v_to
                            $grouped = [];
                            foreach ($holi_res as $item) {
                                $key = $item['v_from'] . '_' . $item['v_to'];
                                $grouped[$key][] = $item;
                            }
                            ?>
                
                            <?php foreach ($grouped as $group) : ?>
                                <?php
                                $first = $group[0];
                                $date_from = date("d-m-Y", strtotime($first['v_from']));
                                $date_to   = date("d-m-Y", strtotime($first['v_to']));
                                ?>
                                
                                <?php foreach ($group as $row) : ?>
                                    <tr>
                                        <td><?= $row['night'] ?>N / <?= $row['day'] ?>D</td>
                                        <td><?= $date_from ?></td>
                                        <td><?= $date_to ?></td>
                                        <td>
                                            <button class="<?= ($row['status'] == 'Available') ? 'db-done' : 'db-not-done' ?>">
                                                <?= $row['status'] ?>
                                            </button>
                                        </td>
                                        <td>
                                            <?php if (!empty($row['hotel'])) : ?>
                                                <?= $row['hotel'] ?> (<?= $row['location'] ?>)<br>
                                                <?= $row['other'] ?><br>
                                                Booked Date: <?= date("d-m-Y", strtotime($row['book_date'])) ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
