<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <?= $this->include('backend/common_links/css_links') ?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    <style type="text/css">
        label.t-title {
            display: block;
            font-size: 16px;
            text-transform: capitalize;
            position: relative;
            top: -10px;
            left: 5px;
        }
        
        .error {
        color: red;
            
        }

    </style>
    
<?php 
$isAdmin    = session()->get('role') === 'employee';
$isEmployee = session()->get('isEmployeeLoggedIn') === true;
?>

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><span>Employee Admin</span></a>
               </div>
                    <div class="clearfix"></div>
                    
                               <?php if ($isAdmin): ?>
            <?= $this->include('backend/employee_admin/sidebar.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/sidebar.php') ?>
        <?php endif; ?>
          </div>
        </div>
        <!-- top navigation -->
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/employee_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>
        
        <!-- /top navigation -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Register Employee</h3>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <?php if (session('errors')): ?>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    <?php foreach (session('errors') as $error): ?>
                                                        <li><?= esc($error) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (session()->has('success')): ?>
                                        <div class="alert alert-success">
                                            <?= session('success') ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                <form action="<?= base_url('/employee/register'); ?>" id='employeeForm' class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                                  <input type="hidden" id="old_branch_id" value="<?= old('branch_id') ?>">
                                    <input type="hidden" id="old_department_id" value="<?= old('department_id') ?>">
                                    <input type="hidden" id="old_designation_id" value="<?= old('designation_id') ?>">


                                    <!-- Branch Detail -->
                                    <label class="t-title">Branch Detail</label>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Subsidiary</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="subsidiary_id" id="subsidiary_id" required class="form-control col-md-7 col-xs-12 chosen_class subsidiary_list">
                                                <option value="">-- Select Subsidiary --</option>
                                                <?php foreach ($subsidiaries as $subsidiary): ?>
                                                    <option value="<?= esc($subsidiary['id']) ?>" <?= old('subsidiary_id') == $subsidiary['id'] ? 'selected' : '' ?>>
                                                        <?= esc($subsidiary['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="subsiErr error"><?= session('errors.subsidiary_id') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Branch</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="branch_id" id="branch_id" required class="form-control col-md-7 col-xs-12 chosen_class branch_list" value="<?= old('branch_id') ?>">
                                                <option value="">-- Select Branch --</option>
                                            </select>
                                            <div class="branErr error"><?= session('errors.branch_id') ?></div>
                                        </div>
                                    </div>
                                    <!-- Department and Designation -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Department</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="department_id" id="department_id" required class="form-control col-md-7 col-xs-12 chosen_class department_list" value="<?= old('department_id') ?>">
                                                <option value="">-- Select Department --</option>
                                            </select>
                                            <div class="departErr error"><?= session('errors.department_id') ?></div>
                                        </div>

                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Designation</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="designation_id" id="designation_id" required class="form-control col-md-7 col-xs-12 chosen_class designation_list" value="<?= old('designation_id') ?>">
                                                <option value="">-- Select Designation --</option>
                                            </select>
                                            <div class="designErr error"><?= session('errors.designation_id') ?></div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Reporting</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="reporting_name" name="reporting_name" class="form-control col-md-7 col-xs-12" value="<?= old('reporting_name') ?>">
                                            <div class="empidErr error"><?= session('errors.empID') ?></div>
                                        </div>
                                        </div>
                                        
                                    <!-- Employee ID and Joining Date -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Emp. ID</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="empID" name="empID" class="form-control col-md-7 col-xs-12" value="<?= old('empID') ?>">
                                            <div class="empidErr error"><?= session('errors.empID') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Joining Date</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="date" id="join_date" name="join_date" class="form-control col-md-7 col-xs-12" value="<?= old('join_date') ?>">
                                            <div class="jdErr error"><?= session('errors.join_date') ?></div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Employee Detail -->
                                    <label class="t-title">Employee Detail</label>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12" value="<?= old('name') ?>">
                                            <div class="nameErr error"><?= session('errors.name') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">E-mail</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?= old('email') ?>">
                                            <div class="emailErr error"><?= session('errors.email') ?></div>
                                        </div>
                                    </div>
                                    <!-- Mobile and DOB -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Mobile</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="mobile" name="mobile" class="form-control col-md-7 col-xs-12" value="<?= old('mobile') ?>">
                                            <div class="mobileErr error"><?= session('errors.mobile') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">DOB</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="date" id="dob" name="dob" class="form-control col-md-7 col-xs-12" value="<?= old('dob') ?>">
                                            <div class="dobErr error"><?= session('errors.dob') ?></div>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Alt Mobile</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="alt_mobile" name="alt_mobile" class="form-control col-md-7 col-xs-12" value="<?= old('alt_mobile') ?>">
                                            <div class="altMobileErr error"><?= session('errors.alt_mobile') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select id="gender" name="gender" class="form-control col-md-7 col-xs-12">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?= old('gender') == 'male' ? 'selected' : '' ?>>Male</option>
                                                <option value="female" <?= old('gender') == 'female' ? 'selected' : '' ?>>Female</option>
                                                <option value="other" <?= old('gender') == 'other' ? 'selected' : '' ?>>Other</option>
                                            </select>
                                            <div class="genderErr error"><?= session('errors.gender') ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">Marital Status</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <select id="marital_status" name="marital_status" class="form-control col-md-7 col-xs-12">
                                                    <option value="">Select Marital</option>
                                                    <option value="single" <?= old('marital_status') == 'single' ? 'selected' : '' ?>>Single</option>
                                                    <option value="married" <?= old('marital_status') == 'married' ? 'selected' : '' ?>>Married</option>
                                                </select>
                                                <div class="maritalErr error"><?= session('errors.marital_status') ?></div>
                                            </div>
                                        </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Password</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" value="<?= old('password') ?>">
                                            <div class="passwordErr error"><?= session('errors.password') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Confirm Password</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="en_password" id="en_password" name="en_password" class="form-control col-md-7 col-xs-12" value="<?= old('en_password') ?>">
                                            <div class="confirmPasswordErr error"><?= session('errors.en_password') ?></div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Address</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12" value="<?= old('address') ?>">
                                            <div class="addressErr error"><?= session('errors.address') ?></div>
                                        </div>
                                    </div>
                                    <!-- Profile Picture -->
                                    <div class="form-group">
                                          <label class="control-label col-md-1 col-sm-1 col-xs-12">Profile Pic</label>
                                          <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="file" id="profile_pic" name="profile_pic" class="form-control" value="<?= old('profile_pic') ?>">
                                          <div class="profilePicErr error"><?= session('errors.profile_pic') ?></div>
                                    </div> 
                                    </div>
                                    <hr>
                                    <!-- Emergency Contact -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Emergency Person</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="emer_person" name="emer_person" class="form-control col-md-7 col-xs-12" value="<?= old('emer_person') ?>">
                                            <div class="emerPersonErr error"><?= session('errors.emer_person') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Emergency Number</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="emer_num" name="emer_num" class="form-control col-md-7 col-xs-12" value="<?= old('emer_num') ?>">
                                            <div class="emerNumErr error"><?= session('errors.emer_num') ?></div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Bank Details -->
                                    <label class="t-title">Bank Details</label>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Bank Name</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="bank" name="bank" class="form-control col-md-7 col-xs-12" value="<?= old('bank') ?>">
                                            <div class="bankErr error"><?= session('errors.bank') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Bank Branch</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="branch" name="branch" class="form-control col-md-7 col-xs-12" value="<?= old('branch') ?>">
                                            <div class="branchErr error"><?= session('errors.branch') ?></div>
                                        </div>
                                    </div>
                                    <!-- Account Number and IFSC -->
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Account No.</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="acc_num" name="acc_num" class="form-control col-md-7 col-xs-12" value="<?= old('acc_num') ?>">
                                            <div class="accNumErr error"><?= session('errors.acc_num') ?></div>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">IFSC Code</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="ifsc" name="ifsc" class="form-control col-md-7 col-xs-12" value="<?= old('ifsc') ?>">
                                            <div class="ifscErr error"><?= session('errors.ifsc') ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Document Details -->
                                    <label class="t-title">Document Details</label>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-2 col-xs-12">PAN No.</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="pan" name="pan" class="form-control col-md-7 col-xs-12" value="<?= old('pan') ?>">
                                            <div class="panErr error"><?= session('errors.pan') ?></div>
                                        </div>
                                    
                                        <label class="control-label col-md-2 col-sm-1 col-xs-12">Aadhar No.</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="aadhar" name="aadhar" class="form-control col-md-7 col-xs-12" value="<?= old('aadhar') ?>">
                                            <div class="aadharErr error"><?= session('errors.aadhar') ?></div>
                                        </div>
                                    </div>
                                    <!-- Status -->
                                    <label class="t-title">Status</label>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Status</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select name="status" required class="form-control col-md-7 col-xs-12">
                                                <option value="1" <?= old('status') == '1' ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= old('status') == '0' ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                            <div class="statusErr error"><?= session('errors.status') ?></div>
                                        </div>                                       
                                    </div>
                                  <!-- Submit -->
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/common_links/js_links') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script type="text/javascript">
    $(".chosen_class").chosen();
</script>

<script>
$(document).ready(function () {

    $('.chosen_class').chosen({width: '100%'});

    let oldSubsidiary  = "<?= old('subsidiary_id') ?>";
    let oldBranch      = $('#old_branch_id').val();
    let oldDepartment  = $('#old_department_id').val();
    let oldDesignation = $('#old_designation_id').val();

    /* ===============================
       SUBSIDIARY → BRANCH
    =============================== */
    if (oldSubsidiary) {
        $('#subsidiary_id').val(oldSubsidiary).trigger('chosen:updated');
        loadBranches(oldSubsidiary, oldBranch);
    }

    $('#subsidiary_id').on('change', function () {
        let subsidiaryId = $(this).val();
        resetDropdown('#branch_id', '-- Select Branch --');
        resetDropdown('#department_id', '-- Select Department --');
        resetDropdown('#designation_id', '-- Select Designation --');

        if (subsidiaryId) {
            loadBranches(subsidiaryId, null);
        }
    });

    function loadBranches(subsidiaryId, selectedBranch) {
        $.ajax({
            url: "<?= base_url('/employee/getBranches') ?>",
            type: "POST",
            dataType: "json",
            data: { subsidiary_id: subsidiaryId },
            success: function (branches) {
                $.each(branches, function (i, branch) {
                    let selected = (branch.id == selectedBranch) ? 'selected' : '';
                    $('#branch_id').append(
                        `<option value="${branch.id}" ${selected}>${branch.name}</option>`
                    );
                });
                $('#branch_id').trigger('chosen:updated');

                if (selectedBranch) {
                    loadDepartments(selectedBranch, oldDepartment);
                }
            }
        });
    }

    /* ===============================
       BRANCH → DEPARTMENT
    =============================== */
    $('#branch_id').on('change', function () {
        let branchId = $(this).val();
        resetDropdown('#department_id', '-- Select Department --');
        resetDropdown('#designation_id', '-- Select Designation --');

        if (branchId) {
            loadDepartments(branchId, null);
        }
    });

    function loadDepartments(branchId, selectedDepartment) {
        $.ajax({
            url: "<?= base_url('/employee/getDepartments') ?>",
            type: "POST",
            dataType: "json",
            data: { branch_id: branchId },
            success: function (departments) {
                $.each(departments, function (i, dept) {
                    let selected = (dept.id == selectedDepartment) ? 'selected' : '';
                    $('#department_id').append(
                        `<option value="${dept.id}" ${selected}>${dept.name}</option>`
                    );
                });
                $('#department_id').trigger('chosen:updated');

                if (selectedDepartment) {
                    loadDesignations(selectedDepartment, oldDesignation);
                }
            }
        });
    }

    /* ===============================
       DEPARTMENT → DESIGNATION
    =============================== */
    $('#department_id').on('change', function () {
        let deptId = $(this).val();
        resetDropdown('#designation_id', '-- Select Designation --');

        if (deptId) {
            loadDesignations(deptId, null);
        }
    });

    function loadDesignations(deptId, selectedDesignation) {
        $.ajax({
            url: "<?= base_url('/employee/getDesignations') ?>",
            type: "POST",
            dataType: "json",
            data: { department_id: deptId },
            success: function (designations) {
                $.each(designations, function (i, desig) {
                    let selected = (desig.id == selectedDesignation) ? 'selected' : '';
                    $('#designation_id').append(
                        `<option value="${desig.id}" ${selected}>${desig.name}</option>`
                    );
                });
                $('#designation_id').trigger('chosen:updated');
            }
        });
    }

    /* ===============================
       HELPER FUNCTION
    =============================== */
    function resetDropdown(selector, placeholder) {
        $(selector).empty()
            .append(`<option value="">${placeholder}</option>`)
            .trigger('chosen:updated');
    }

});
</script>


</body>
</html>
