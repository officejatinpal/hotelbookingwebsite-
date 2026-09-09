<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Member</title>
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
        
    /* MOBILE RESPONSIVE FIX */
    @media (max-width: 768px) {
    
    
    /* LABEL FULL WIDTH */
    .control-label {
    width: 100% !important;
    text-align: left !important;
    margin-bottom: 5px;
    }
    
    /* INPUT SPACING */
    .form-group > div {
    width: 100% !important;
    margin-bottom: 10px;
    }
    
    /* FORM GROUP GAP */
    .form-group {
    margin-bottom: 15px;
    }
    }
    </style>
    
    <?php 
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept  = (int) session()->get('department_id');
    ?>
    
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- Sidebar -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><span>Search Member</span></a>
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
        <!-- top navigation -->
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>

            <div class="right_col" role="main">
                <div class="x_panel">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>All Members</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="btn-group" id="buttonlist"> 
                                        <a class="btn btn-primary" href="#">Add Member</a>
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
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Search By</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <select name="search_key" id="search_key" required class="form-control">
            <option value="">-- Select --</option>
            <option value="name">Name</option>
            <option value="email">E-mail</option>
            <option value="mobile">Mobile</option>
            <option value="ms_num" selected>Membership No</option>
            </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" id="search_value" name="search_value" required class="form-control" placeholder="search_value">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
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
                <th>Membership Detail</th>
                <th>Member Detail</th>
                <th>Family Detail</th>
                <th>Payment Detail</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody id="voucher_table_body">
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
    
    
<?= $this->include('backend/common_links/js_links') ?>
    <script>
   
    const handleStatusChange = () => {
        document.querySelectorAll('.change_status').forEach(element => {
            element.addEventListener('click', function () {
                const id = this.getAttribute('id'); 
                const status = this.checked ? 1 : 0; 
                
                if (confirm("Are you sure you want to change the status?")) {
                    
                    fetch("<?= site_url('user/updateStatus') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ mem_id: id, mem_status: status }) 
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok " + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Response from server:", data); 
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
                    .catch(error => {
                        console.error("Error in Fetch request:", error); 
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
        fetch("<?= site_url('user/searchmembervalue') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ search_key: searchKey, search_value: searchValue })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log("Voucher data fetched:", data); 
            const tbody = document.getElementById('voucher_table_body');
            tbody.innerHTML = ''; 

            if (data.success && data.users && data.users.length > 0) {
                let count = 1;
                data.users.forEach(user => {
                    const row = document.createElement('tr');
                    row.setAttribute('id', `row${user.id}`); 

                    row.innerHTML = `
                        <td>${count++}</td>
                        <td>
                            <b>Subsidiary:</b> Delvia Holidays Pvt. Ltd.<br>
                            <b>Joining:</b> ${user.join_date}<br>
                            <b>Branch:</b> ${user.branch_id}<br>
                            <b>Venue:</b> ${user.venue}<br>
                            <b>Mem. No.:</b> ${user.ms_num}<br>
                            <b>Mem. Cate.:</b> ${user.ms_category}<br>
                            <b>Manager:</b> ${user.mngr_id}<br>
                            <b>Sale Person:</b> ${user.salep_id}
                        </td>
                        <td>
                            <b>Name:</b> ${user.name}<br>
                            <b>DOB:</b> ${user.dob}<br>
                            <b>Mobile:</b> ${user.mobile}<br>
                            <b>Alt. Mobile:</b> ${user.alt_mobile}<br>
                            <b>Email:</b> ${user.email}<br>
                            <b>Address:</b> ${user.address}
                        </td>
                        <td>
                            <b>Spouse:</b> ${user.spouse}<br>
                            <b>Marriage:</b> ${user.marriage_anniversary}<br>
                            <b>First Child:</b> ${user.f_child_name} (${user.f_child_age})<br>
                            <b>Second Child:</b> ${user.s_child_name} (${user.s_child_age})
                        </td>
                        <td>
                            <b>Total:</b> ₹${user.ms_amount}<br>
                            <b>Paid:</b> ₹${user.ms_advance}<br>
                            <b>Due:</b> ₹${user.ms_due}<br>
                            <b>AMC:</b> ₹${user.ms_amc}
                        </td>
                        <td>
                            <div id="msg${user.id}" class="text-center">
                                <span style="color: ${user.status == 1 ? 'green' : 'red'};">
                                    <b>${user.status == 1 ? 'ACTIVE' : 'INACTIVE'}</b>
                                </span>
                            </div>
                        
                            <?php if ($isAdmin): ?>
                            <label class="switch">
                                <input type="checkbox" class="switch-input change_status" 
                                    id="${user.id}" 
                                    ${user.status == 1 ? 'checked' : '' }>
                                <span class="switch-label" data-on="Active" data-off="Deactive"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a class="btn btn-info btn-sm" href="<?= site_url('generate-invoice/') ?>${user.ms_num}" target="_blank">Generate Invoice</a><br>
                            <a class="btn btn-warning btn-sm" href="<?= base_url('view-holiday/') ?>${user.ms_num}" target="_blank">View Holidays</a><br>
                            <a class="btn btn-info btn-sm" href="<?= site_url('member-offers/') ?>${user.ms_num}" target="_blank">View Offers</a><br>
                             <a class="btn btn-info btn-sm" href="<?= site_url('add-document/') ?>${user.ms_num}" target="_blank">Upload Document</a><br>
                             <a class="btn btn-info btn-sm" href="<?= site_url('add-comment/') ?>${user.ms_num}" target="_blank">Comment</a>
                    <?php if ($isAdmin || ($isEmployee && in_array($userDept, [2, 6]))): ?>
                            <a class="btn btn-primary btn-sm" 
                              <a class="btn btn-info btn-sm" href="<?= site_url('member-edit/') ?>${user.id}" target="_blank">Edit</a>
                       <?php endif; ?>
                        </td>
                    `;
                    tbody.appendChild(row);
                });

                handleStatusChange();
            } else {
                const noDataRow = document.createElement('tr');
                noDataRow.innerHTML = `
                    <td colspan="8" class="text-center">No results found.</td>
                `;
                tbody.appendChild(noDataRow);
            }
        })
        .catch(error => {
            console.error("Error fetching voucher data:", error); 
            alert("Error fetching data. Please try again.");
        });
    };

    // Search functionality
    document.getElementById('search_data').addEventListener('click', () => {
        const searchKey = document.getElementById('search_key').value;
        const searchValue = document.getElementById('search_value').value;

        if (!searchKey || !searchValue) {
            alert('Please select a search criterion and enter a value.');
            return;
        }

        fetchVoucherData(searchKey, searchValue);
    });

    handleStatusChange();
    
</script>


</body>
</html>
