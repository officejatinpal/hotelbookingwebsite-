<table class="table table-striped table-bordered export_table">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Resort</th>
            <th>Address</th>
            <th>Main Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $start = ($currentPage - 1) * $limit;
        foreach ($resorts as $index => $resort): ?>
            <tr>
                <td><?= $start + $index + 1 ?></td>
                <td>
                    <div class="emp-info">
                        <span><b>Name:</b> <?= $resort['name'] ?></span><br>
                        <span><b>Location:</b> <?= $resort['destination_name'] ?></span>
                    </div>
                </td>
                <td>
                    <div class="emp-info">
                        <span><b>Address:</b> <?= $resort['address'] ?></span><br>
                        <span><b>Longitude:</b> <?= $resort['longi'] ?></span><br>
                        <span><b>Latitude:</b> <?= $resort['lati'] ?></span>
                    </div>
                </td>
                <td>
                    <img src="<?= base_url('uploads/resorts/' . $resort['main_image']) ?>" alt="Main Image" style="width: 100px; height: 100px;">
                </td>
             <td>
                <button class="toggle-status <?= ($resort['status'] == 1) ? 'active-btn' : 'inactive-btn'; ?>" data-id="<?= $resort['id']; ?>">
                    <?= ($resort['status'] == 1) ? 'Active' : 'Inactive'; ?>
                </button>
            </td>
                <td>
                    <a href="<?= base_url('webmaster/edit_resort/' . $resort['id']) ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<style>
    .active-btn {
    background-color: green;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
}

.inactive-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
}

</style>
<script>
$(document).ready(function() {
    $('.toggle-status').on('click', function() {
        var empID = $(this).data('id'); // Get employee ID from data-id attribute
        var button = $(this); // Store reference to the button

        $.ajax({
            url: '<?= base_url('webmaster/toggleStatus') ?>/' + empID,
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    // Update button text and class based on the new status
                    if (response.status == 1) {
                        button.text('Active');
                        button.removeClass('inactive-btn').addClass('active-btn');
                    } else {
                        button.text('Inactive');
                        button.removeClass('active-btn').addClass('inactive-btn');
                    }

                    alert('Property status updated successfully!');
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Failed to update status');
            }
        });
    });
});
</script>
