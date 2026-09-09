<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Voucher</title>
    <?= $this->include('backend/common_links/css_links') ?>
    <style>
        .modal-body, .modal-footer, .modal-content {
            width: 100%;
        }
        .list-inline {
            text-align: center;
        }
        ul.count2 li {
            margin-bottom: 20px;
        }
        ul.widget_profile_box li:last-child {
            width: 100%;
            text-align: center;
        }
        .modal-title {
            float: left;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .mt-2 {
            margin-top: 10px;
        }
        .brdr {
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        
        /* ✅ Mobile Responsive Fix */
@media (max-width: 768px) {

    /* Page padding fix */
    .right_col {
        padding: 10px !important;
    }

    /* Search form fix */
    .form-group {
        display: block !important;
    }

    .form-group label {
        width: 100% !important;
        margin-bottom: 5px;
    }

    .form-group .col-md-3,
    .form-group .col-md-4,
    .form-group .col-md-1 {
        width: 100% !important;
        margin-bottom: 10px;
    }

    /* Button full width */
    #search_data {
        width: 100%;
    }

    /* Table scroll fix */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        min-width: 900px; /* scroll enable */
    }

    /* Action buttons fix */
    .btn-sm {
        width: 100%;
        margin-bottom: 5px;
    }

    /* Title fix */
    .title_left h3 {
        font-size: 18px;
    }

    /* Panel padding */
    .x_panel {
        padding: 10px !important;
    }
}
    </style>
    
        <?php 
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    ?>

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- Sidebar -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Search Voucher</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    
            <?php if ($isAdmin): ?>
            <?= $this->include('backend/member_admin/sidebar.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/sidebar.php') ?>
        <?php endif; ?>
        
                </div>
            </div>
            <!-- /Sidebar -->

            <!-- Top navigation -->
            
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>

            <!-- /Top navigation -->
            
            <!-- Page content -->
            <div class="right_col" role="main">
                <div class="x_panel">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>All Vouchers</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="btn-group" id="buttonlist"> 
                                        <a class="btn btn-primary" href="<?= base_url('generate_voucher') ?>">Generate Voucher</a>
                                    </div>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row brdr">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Search By</label>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <select name="search_key" id="search_key" required class="form-control">
                                                        <option value="" selected>-- Select --</option>
                                <option value="issue_date">Date</option>
                                <option value="name">Name</option>
                                <option value="email">E-mail</option>
                                <option value="phone">Mobile</option>
                                <option value="v_num" selected>Voucher No.</option>
                                                    </select>
                                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                 <input type="text" id="search_value" name="search_value" placeholder="YYYY-MM-DD"  required  class="form-control">
                                 
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
                                                    <th>S.No</th>
                                                    <th>Issued Date</th>
                                                    <th>Branch</th>
                                                    <th>Category</th>
                                                    <th>Customer Details</th>
                                                    <th>Voucher</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="voucher_table_body">
                                                <!-- Dynamic voucher rows go here -->
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
    
<?= $this->include('backend/common_links/js_links') ?>

<script>
// Handling status change
const handleStatusChange = () => {
    document.querySelectorAll('.change_status').forEach(element => {
        element.addEventListener('click', function () {
            const id = this.getAttribute('id');
            const status = this.checked ? 1 : 0;

            if (confirm("Are you sure you want to change the status?")) {
                fetch("<?= site_url('voucher/changeStatus') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ mem_id: id, mem_status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('msg' + id).innerHTML = status == 1
                            ? "<span style='color: green;'><b>ACTIVE</b></span>"
                            : "<span style='color: red;'><b>Redeemed</b></span>";
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

// Fetch voucher data
const fetchVoucherData = (searchKey, searchValue) => {
    fetch("<?= site_url('voucher/searchVouchers') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ search_key: searchKey, search_value: searchValue })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('voucher_table_body');
        tbody.innerHTML = ''; // Clear existing rows

        if (data.success && data.vouchers && data.vouchers.length > 0) {
            let count = 1;
            data.vouchers.forEach(voucher => {
                const row = document.createElement('tr');
                row.setAttribute('id', `row${voucher.id}`);

                row.innerHTML = `
                    <td>${count++}</td>
                    <td><b>Issued On:</b> <br> ${voucher.issue_date}</td>
                    <td><b>Branch:</b> ${voucher.branch_name}</td>
                    <td><b>Category:</b> ${voucher.category}</td>
                    <td>
                        <b>Name:</b> ${voucher.name}<br>
                        <b>Phone:</b> ${voucher.phone}<br>
                        <b>Email:</b> ${voucher.email}
                    </td>
                    <td>
                        <b>Voucher No. </b><br>${voucher.v_num}
                    </td>
                    <td>
                        <div id="msg${voucher.id}" class="text-center">
                            <span style="color: ${voucher.status == 1 ? 'green' : 'red'};">
                                <b>${voucher.status == 1 ? 'ACTIVE' : 'Redeemed'}</b>
                            </span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" class="switch-input change_status" 
                                   id="${voucher.id}" 
                                   ${voucher.status == 1 ? 'checked' : ''}>
                            <span class="switch-label" data-on="Active" data-off="Redeemed"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="<?= site_url('invitation-view-voucher/') ?>${voucher.id}" target="_blank">
                            <span class="fa fa-eye"></span> View
                        </a><br>
                        <a class="btn btn-info btn-sm" href="<?= site_url('edit-gift-voucher/') ?>${voucher.id}" target="_blank">
                            <span class="fa fa-edit"></span> Edit
                        </a><br>
                    <button class="btn btn-success btn-sm send_email" data-voucher-id="${voucher.id}" type="button">
                    <span class="fa fa-check"></span> Send Email
                </button>
            
                <!-- ✅ Success message yaha aayega -->
                <div class="email-msg mt-2"></div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            handleStatusChange(); // Rebind status change handlers
        } else {
            tbody.innerHTML = '<tr><td colspan="8" class="text-center">No vouchers found.</td></tr>';
        }
    })
    .catch(() => {
        alert("Error fetching voucher data. Please try again.");
    });
};

// Search button
document.getElementById('search_data').addEventListener('click', () => {
    const searchKey = document.getElementById('search_key').value;
    const searchValue = document.getElementById('search_value').value;

    if (!searchKey || !searchValue) {
        alert("Please select a search key and enter a value.");
        return;
    }

    fetchVoucherData(searchKey, searchValue);
});

document.addEventListener('DOMContentLoaded', () => {
    handleStatusChange();
});

// ----------------------
// Send Email functionality (only if member active)
// ----------------------
document.getElementById('voucher_table_body').addEventListener('click', function(e) {
    if (e.target.closest('.send_email')) {
        const btn = e.target.closest('.send_email');
        const voucherId = btn.getAttribute('data-voucher-id');
        const row = btn.closest('tr');

        // Get member status
        const statusSpan = row.querySelector(`#msg${voucherId} b`);
        const statusText = statusSpan.textContent.trim();

        if (statusText.toLowerCase() !== 'active') {
            // Remove previous status if any
            const existingMsg = btn.parentElement.querySelector('.email_status');
            if (existingMsg) existingMsg.remove();

            const statusSpanMsg = document.createElement('span');
            statusSpanMsg.classList.add('email_status');
            statusSpanMsg.style.color = 'red';
            statusSpanMsg.style.marginLeft = '5px';
            statusSpanMsg.style.fontWeight = 'bold';
            statusSpanMsg.textContent = 'Cannot send email. Member is inactive.';
            btn.parentElement.appendChild(statusSpanMsg);
            return; // Stop execution
        }

        if (!confirm('Are you sure you want to send the email?')) return;

        // Disable button while sending
        btn.disabled = true;

        // Remove previous status if any
        const existingMsg = btn.parentElement.querySelector('.email_status');
        if (existingMsg) existingMsg.remove();

        fetch("<?= site_url('voucher/sendVoucherEmail') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ voucher_id: voucherId })
        })
        .then(response => response.json())
        .then(data => {
            const statusSpanMsg = document.createElement('span');
            statusSpanMsg.classList.add('email_status');
            statusSpanMsg.style.marginLeft = '5px';
            statusSpanMsg.style.fontWeight = 'bold';

            if (data.success) {
                statusSpanMsg.style.color = 'green';
                statusSpanMsg.textContent = 'Email sent successfully!';
            } else {
                statusSpanMsg.style.color = 'red';
                statusSpanMsg.textContent = 'Failed: ' + data.message;
            }

            btn.parentElement.appendChild(statusSpanMsg);
            btn.disabled = false; // re-enable button
        })
        .catch(() => {
            const statusSpanMsg = document.createElement('span');
            statusSpanMsg.classList.add('email_status');
            statusSpanMsg.style.color = 'red';
            statusSpanMsg.style.marginLeft = '5px';
            statusSpanMsg.style.fontWeight = 'bold';
            statusSpanMsg.textContent = 'Error sending email.';
            btn.parentElement.appendChild(statusSpanMsg);
            btn.disabled = false; // re-enable button
        });
    }
});

</script>


</body>
</html>
