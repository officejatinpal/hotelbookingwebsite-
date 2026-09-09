<div class="x_content">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Category</th>
                    <th>Destination</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="voucher_table_body">
                <?php $count = 1; foreach ($packages as $package): ?>
                    <tr id="row<?= $package['id'] ?>">
                        <td><?= $count++ ?></td>
                        <?php
                            // Truncate title to 5 words
                            $titleWords = explode(' ', $package['title']);
                            $truncatedTitle = implode(' ', array_slice($titleWords, 0, 5));

                            // Truncate slug to 5 words
                            $slugWords = explode(' ', $package['slug']);
                            $truncatedSlug = implode(' ', array_slice($slugWords, 0, 5));
                        ?>

                        <td>
                            <b>Name:</b> <?= $truncatedTitle ?>...<br>
                            <b>Slug:</b> <?= $truncatedSlug ?>...<br>
                        </td>

                        <td>
                            <?php
                                // Limit content to 20 words
                                $content = strip_tags($package['content']); // Remove HTML tags if any
                                $words = explode(' ', $content); // Split content into an array of words
                                $limitedContent = implode(' ', array_slice($words, 0, 20)); // Get the first 20 words
                            ?>
                            <?= $limitedContent ?>...
                        </td>
                        <td>
                            <img src="<?= base_url('uploads/packages/' . $package['image']) ?>" alt="Main Image" style="width: 100px; height: 100px;">
                        </td>

                        <td>
                            <div id="msg<?= $package['id'] ?>" class="text-center">
                                <span style="color: <?= $package['status'] == 1 ? 'green' : 'red' ?>;">
                                    <b><?= $package['status'] == 1 ? 'ACTIVE' : 'INACTIVE' ?></b>
                                </span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" class="switch-input change_status" 
                                       id="<?= $package['id'] ?>" 
                                       <?= $package['status'] == 1 ? 'checked' : '' ?>>
                                <span class="switch-label" data-on="Active" data-off="Deactive"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="<?= base_url('webmaster/blog/edit/' . ($blog['id'] ?? '')); ?>"><span class="fa fa-pencil"></span> Edit</a><br>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Function to handle the status change event
    const handleStatusChange = () => {
        document.querySelectorAll('.change_status').forEach(element => {
            element.addEventListener('click', function () {
                const id = this.getAttribute('id');
                const status = this.checked ? 1 : 0;

                if (confirm("Are you sure you want to change the status?")) {
                    fetch("<?= site_url('webmaster/packagestatus') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ mem_id: id, mem_status: status })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('msg' + id).innerHTML = status === 1
                                ? "<span style='color: green;'><b>Active</b></span>"
                                : "<span style='color: red;'><b>Inactive</b></span>";
                            alert(data.message);
                        } else {
                            alert(data.message);
                            document.getElementById(id).checked = !status;
                        }
                    })
                    .catch(() => {
                        alert("Error updating status. Please try again.");
                        document.getElementById(id).checked = !status;
                    });
                } else {
                    this.checked = !status;
                }
            });
        });
    };

    // Initialize the status change handler on page load
    handleStatusChange();
</script>
