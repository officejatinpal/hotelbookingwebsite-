                                <div class="x_content">
                                    <div class="row brdr">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Search By</label>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <select name="search_key" id="search_key" required class="form-control">
                                                        <option value="" selected>-- Select --</option>
                                                        <option value="name">Name</option>
                                                        <option value="category">Category</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <input type="text" id="search_value" name="search_value" required class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <button type="button" id="search_data" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                <th>S.No.</th>
                                                <th>Category</th>
                                                <th>Destination</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="voucher_table_body">
                                                <?php $count = 1; foreach ($destinations as $destination): ?>
                                                    <tr id="row<?= $destination['id'] ?>">
                                                        <td><?= $count++ ?></td>
                                                        <td>
                                                            <?= $destination['category'] ?><br>
                                                        </td>
                                                        <td>
                                                            <b>Name:</b> <?= $destination['name'] ?><br>
                                                            <b>Slug:</b> <?= $destination['slug'] ?><br>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            
                                                            if ($destination['featured'] == 1) {
                                                                echo "<span style='color: green;'><b>Yes</b></span>";
                                                            } else {
                                                                echo "<span style='color: red;'><b>No</b></span>";
                                                            }
                                                            ?>
                                                            <br>
                                                        </td>

                                                        <td>
                                                            <div id="msg<?= $destination['id'] ?>" class="text-center">
                                                                <span style="color: <?= $destination['status'] == 1 ? 'green' : 'red' ?>;">
                                                                    <b><?= $destination['status'] == 1 ? 'ACTIVE' : 'INACTIVE' ?></b>
                                                                </span>
                                                            </div>
                                                            <label class="switch">
                                                                <input type="checkbox" class="switch-input change_status" 
                                                                       id="<?= $destination['id'] ?>" 
                                                                       <?= $destination['status'] == 1 ? 'checked' : '' ?>>
                                                                <span class="switch-label" data-on="Active" data-off="Deactive"></span>
                                                                <span class="switch-handle"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="<?= base_url('webmaster/destination/edit/' . ($destination['id'] ?? '')); ?>"><span class="fa fa-pencil"></span> Edit</a><br>
                                                            <a class="btn btn-warning btn-sm" href="<?= base_url('webmaster/destination/details/' . ($destination['id'] ?? '')); ?>"><span class="fa fa-pencil"></span> Details</a>
                                                            </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page content -->
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
                    fetch("<?= site_url('webmaster/destination/toggleStatus') ?>", {
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

    const fetchVoucherData = (searchKey, searchValue) => {
    fetch("<?= site_url('webmaster/destination/searchDestination') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ search_key: searchKey, search_value: searchValue })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('voucher_table_body');
        tbody.innerHTML = ''; // Clear existing rows

        if (data.success && data.destinations.length > 0) {
            let count = 1;
            data.destinations.forEach(destination => {
                // Check if featured value is 1 or 0, and convert it to 'Yes' or 'No'
                const featuredStatus = destination.featured == 1 ? 'Yes' : 'No';

                const row = document.createElement('tr');
                row.setAttribute('id', `row${destination.id}`);

                row.innerHTML = `
                    <td>${count++}</td>
                    <td>${destination.category}</td>
                    <td>
                        <b>Name:</b> ${destination.name}<br>
                        <b>Slug:</b> ${destination.slug || 'N/A'}
                    </td>
                    <td>${featuredStatus}</td> <!-- Display "Yes" or "No" here -->
                    <td>
                        <div id="msg${destination.id}" class="text-center">
                            <span style="color: ${destination.status == 1 ? 'green' : 'red'};">
                                <b>${destination.status == 1 ? 'ACTIVE' : 'INACTIVE'}</b>
                            </span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="switch-input change_status" 
                                   id="${destination.id}" 
                                   ${destination.status == 1 ? 'checked' : ''}>
                            <span class="switch-label" data-on="Active" data-off="Deactive"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="#"><span class="fa fa-pencil"></span> Edit</a><br>
                        <a class="btn btn-warning btn-sm" href="<?= base_url('webmaster/destination/details/' . ($destination['id'] ?? '')); ?>"><span class="fa fa-pencil"></span> Details</a>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Reinitialize event listeners for dynamically added elements
            handleStatusChange();
        } else {
            // If no data is found, show a row indicating this
            const noDataRow = document.createElement('tr');
            noDataRow.innerHTML = `
                <td colspan="6" class="text-center">No results found.</td>
            `;
            tbody.appendChild(noDataRow);
        }
    })
    .catch(error => {
        console.error("Error fetching data:", error); // Debugging
        alert('Error fetching data.');
    });
};

    // Event listener for the Search button
    document.getElementById('search_data').addEventListener('click', function () {
        const searchKey = document.getElementById('search_key').value;
        const searchValue = document.getElementById('search_value').value;

        if (!searchKey || !searchValue) {
            alert('Please select a search criterion and enter a value.');
            return;
        }

        fetchVoucherData(searchKey, searchValue);
    });

    // Initialize the status change handler on page load
    handleStatusChange();
</script>


