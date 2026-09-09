<?php $count = ($currentPage - 1) * $limit + 1; foreach ($users as $user): ?>
<tr id="row<?= $user['id'] ?>">
    <td><?= $count++ ?></td>
    <td>
        <b>Subsidiary :</b> Delvia Holidays Pvt. Ltd.<br>
        <b>Joining :</b> <?= $user['join_date'] ?><br>
        <b>Branch :</b> <?= $branchMap[$user['branch_id']] ?? 'N/A' ?><br>
        <b>Venue :</b> <?= $user['venue'] ?><br>
        <b>Mem. No. :</b> <?= $user['ms_num'] ?><br>
        <b>Mem. Cate. :</b> <?= $user['ms_category'] ?><br>
        <b>Manager :</b> <?= $user['mngr_id'] ?? 'N/A' ?><br>
        <b>Sale Person :</b> <?= $user['salep_id'] ?? 'N/A' ?>
    </td>
    <td>
        <b>Name : </b><?= $user['name'] ?><br>
        <b>DOB : </b><?= $user['dob'] ?><br>
        <b>Mobile : </b><?= $user['mobile'] ?><br>
        <b>Alt. Mobile : </b><?= $user['alt_mobile'] ?><br>
        <b>Email : </b><?= $user['email'] ?><br>
        <b>Address : </b><?= $user['address'] ?>
    </td>
    <td>
        <b>Spouse : </b><?= $user['spouse'] ?><br>
        <b>Marriage : </b><?= $user['marriage_anniversary'] ?><br>
        <b>First Child : </b><?= $user['f_child_name'] ?> (<?= $user['f_child_age'] ?>)<br>
        <b>Second Child : </b><?= $user['s_child_name'] ?> (<?= $user['s_child_age'] ?>)
    </td>
    <td>
        <b>Total : </b>₹ <?= number_format($user['ms_amount'], 2) ?><br>
        <b>Paid : </b>₹ <?= number_format($user['ms_advance'], 2) ?><br>
        <b>Due : </b>₹ <?= number_format($user['ms_due'], 2) ?><br>
        <b>AMC : </b>₹ <?= number_format($user['ms_amc'], 2) ?>
    </td>
    <td>
        <div id="msg<?= $user['id'] ?>" style="text-align: center;">
            <?= $user['status'] == 1 ? "<span style='color: green;'><b>Active</b></span>" : "<span style='color: red;'><b>Inactive</b></span>" ?>
        </div>
        <label class="switch">
            <input class="switch-input change_status" type="checkbox" id="<?= $user['id'] ?>" <?= $user['status'] == 1 ? "checked" : "" ?>>
            <span class="switch-label" data-on="Active" data-off="Deactive"></span>
            <span class="switch-handle"></span>
        </label>
    </td>
    <td>
        <a class="btn btn-info btn-sm" href="<?= site_url('generate-invoice/' . ($user['ms_num'])) ?>" target="_blank"><span class="fa fa-cog" aria-hidden="true"></span> Generate Invoice</a><br>
        <a class="btn btn-warning btn-sm" href="<?= base_url('view-holiday/' . $user['ms_num']) ?>" target="_blank"><span class="fa fa-eye" aria-hidden="true"></span> View Holidays</a><br>
        <a class="btn btn-info btn-sm" href="<?= site_url('member-offers/' . ($user['ms_num'])) ?>" target="_blank"><span class="fa fa-eye" aria-hidden="true"></span> View Offers</a>
        <a class="btn btn-primary btn-sm" href="<?= site_url('add-document/' . ($user['ms_num'])) ?>" target="_blank"><span class="fa fa-upload" aria-hidden="true"></span> Upload Document </a>
        <a class="btn btn-primary btn-sm" href="<?= site_url('add-comment/' . ($user['ms_num'])) ?>" target="_blank"><span class="fa fa-comment" aria-hidden="true"></span> Comment</a>
        <a class="btn btn-primary btn-sm" href="<?= base_url('member-edit/' . ($user['id'])) ?>" onClick="return confirm('Do you really want to Edit it?')"><span class="fa fa-pencil" aria-hidden="true"></span> Edit</a>
    </td>
</tr>
<?php endforeach; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const handleStatusChange = () => {
        document.querySelectorAll('.change_status').forEach(element => {
            element.addEventListener('click', function () {
                const id = this.getAttribute('id'); // Get member ID
                const status = this.checked ? 1 : 0; // Determine new status (1 for active, 0 for inactive)

                if (confirm("Are you sure you want to change the status?")) {
                    // AJAX request using Fetch API
                    fetch("<?= site_url('user/updateStatus') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ mem_id: id, mem_status: status }) // Send data to the server
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok " + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update status message
                            document.getElementById('msg' + id).innerHTML = status === 1
                                ? "<span style='color: green;'><b>Active</b></span>"
                                : "<span style='color: red;'><b>Inctive</b></span>";
                            alert(data.message); // Notify user
                        } else {
                            alert(data.message); // Server responded with an error message
                            document.getElementById(id).checked = !status; // Revert checkbox
                        }
                    })
                    .catch(error => {
                        console.error("Error in Fetch request:", error); // Debugging: log error
                        alert("Error updating status. Please try again."); // Notify user of failure
                        document.getElementById(id).checked = !status; // Revert checkbox
                    });
                } else {
                    this.checked = !status; // Revert checkbox if user cancels confirmation
                }
            });
        });
    };

    // Initialize event handlers
    handleStatusChange();
});
</script>
