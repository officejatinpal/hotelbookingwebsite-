<table class="table table-striped table-bordered export_table">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Designation</th>
            <th>Employee</th>
            <th>Contact Detail</th>
            <th>Bank Detail</th>
            <th>Documents</th>
            <th>Status</th>
            <th>Image</th>
            <th>Actions</th> <!-- New column for actions -->
        </tr>
    </thead>
    <tbody>
        <?php 
        $start = ($currentPage - 1) * $limit; // Calculate the starting index for the current page
        foreach ($employees as $index => $employee): ?>
            <tr>
                <td><?= $start + $index + 1 ?></td>
                <td>
                    <div class="emp-info">
                        <span><b>Emp. ID:</b> <?= $employee['empID'] ?></span><br>
                        <span><b>Joining:</b> <?= $employee['join_date'] ?></span>
                    </div>
                    <div class="emp-info">
                        <span><b>Branch: </b> <?= $employee['branch_name'] ?></span><br>
                        <span><b>Department:</b> <?= $employee['department_name'] ?></span><br>
                        <span><b>Designation:</b> <?= $employee['designation_name'] ?></span><br>
                        <span><b>Reporting:</b> <?= $employee['reporting_name'] ?></span>
                    </div>
                </td>
                <td>
                    <div class="emp-info">
                        <span><b>Name:</b> <?= $employee['name'] ?></span><br>
                        <span><b>DOB:</b> <?= $employee['dob'] ?></span><br>
                        <span><b>Gender:</b> <?= $employee['gender'] ?></span>
                    </div>
                </td>
                <td>
                    <div class="emp-info">
                        <span><b>Email:</b> <?= $employee['email'] ?></span><br>
                        <span><b>Mobile:</b> <?= $employee['mobile'] ?></span><br>
                        <span><b>Alt. Mobile:</b> <?= $employee['alt_mobile'] ?></span><br>
                        <span><b>Address:</b> <?= $employee['address'] ?></span><br>
                        <span><b>Emergency:</b> <?= $employee['emer_person'] ?> (<?= $employee['emer_num'] ?>)</span>
                    </div>
                </td>
                <td>
                    <div class="emp-info">
                        <span><b>Bank:</b> <?= $employee['bank'] ?></span><br>
                        <span><b>Branch:</b> <?= $employee['branch'] ?></span><br>
                        <span><b>A/c No.:</b> <?= $employee['acc_num'] ?></span><br>
                        <span><b>IFSC:</b> <?= $employee['ifsc'] ?></span>
                    </div>
                </td>
                <td>
                    <div class="emp-info">
                        <span><b>PAN:</b> <?= $employee['pan'] ?></span><br>
                        <span><b>Aadhar:</b> <?= $employee['aadhar'] ?></span>
                    </div>
                </td>
                <td>
                    <button class="toggle-status <?= ($employee['status'] == 1) ? 'active-btn' : 'inactive-btn'; ?>" data-id="<?= $employee['id']; ?>">
                        <?= ($employee['status'] == 1) ? 'Activate' : 'Deactivate'; ?>
                    </button>
                </td>
                <td>
                <img src="<?= base_url('uploads/employee/' . ($employee['profile_pic'] ?? 'default.png')) ?>" alt="Profile Pic" style="width: 50px; height: auto;">
                </td>
                <td>
                    <!-- New Edit button -->
                    <a href="<?= base_url('employee/edit/' . $employee['id']) ?>" class="btn btn-primary">Edit</a>
                    
                    <a href="<?= base_url('employee/all-generated-salary-slip/' . $employee['empID']) ?>" class="btn btn-primary">Slip</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('.toggle-status').on('click', function() {
        var empID = $(this).data('id'); // Get employee ID from data-id attribute
        var button = $(this); // Store reference to the button

        $.ajax({
            url: '<?= base_url('employee/toggleStatus') ?>/' + empID,
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    // Update button text and class based on the new status
                    if (response.status == 1) {
                        button.text('Activate');
                        button.removeClass('inactive-btn').addClass('active-btn');
                    } else {
                        button.text('Deactivate');
                        button.removeClass('active-btn').addClass('inactive-btn');
                    }
                    alert('Employee status updated successfully!');
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

<style>
.active-btn {
    background-color: #28a745; /* Green */
    color: #fff;
    border: none;
    padding: 6px 14px;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.3s ease; /* Smooth animation */
}

.inactive-btn {
    background-color: #dc3545; /* Red */
    color: #fff;
    border: none;
    padding: 6px 14px;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.3s ease;
}

/* Moving (sliding) effect on toggle */
.toggle-status:active {
    transform: translateX(4px); /* Small slide */
}

.toggle-status:hover {
    opacity: 0.9;
}
</style>

