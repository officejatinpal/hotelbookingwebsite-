<?php if (!empty($employe)): ?>
    <?php $count = 1; ?>
    <?php foreach ($employe as $attendance): ?>
        <?php
        $out_time = ($attendance['out_time']) ? date("h:i A", strtotime($attendance['out_time'])) : "";
        ?>
        <tr id="row<?= esc($attendance['id']); ?>">
            <td><?= esc($count++); ?></td>
            <td><?= date('d-m-Y', strtotime($attendance['atten_date'])); ?></td>
            <td><?= date('h:i A', strtotime($attendance['in_time'])); ?></td>
            <td><?= date('h:i A', strtotime($attendance['out_time'])); ?></td>
            <td><img src="<?= base_url('uploads/attendance/' . esc($attendance['atten_image'])); ?>" width="100%"></td>
            <td><?= esc($attendance['status']); ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5"><b>NO DATA FOUND</b></td>
    </tr>
<?php endif; ?>
