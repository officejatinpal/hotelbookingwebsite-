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
           <?php if ($isAdmin): ?>
        <?= $this->include('backend/employee_admin/header.php') ?>
        
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>
        
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

            <form action="<?= base_url('employee/update/'.$employee['id']) ?>" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Branch Detail -->
        <label class="t-title">Branch Detail</label>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Subsidiary</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="subsidiary_id" id="subsidiary_id" required class="form-control col-md-7 col-xs-12 chosen_class subsidiary_list">
                    <option value="">-- Select Subsidiary --</option>
                    <?php foreach ($subsidiaries as $subsidiary): ?>
                        <option value="<?= esc($subsidiary['id']) ?>" <?= $employee['subsidiary_id'] == $subsidiary['id'] ? 'selected' : '' ?>>
                            <?= esc($subsidiary['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="subsiErr error"><?= session('errors.subsidiary_id') ?></div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12">Branch</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="branch_id" id="branch_id" required class="form-control col-md-7 col-xs-12 chosen_class branch_list">
                    <option value="">-- Select Branch --</option>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?= esc($branch['id']) ?>" <?= $employee['branch_id'] == $branch['id'] ? 'selected' : '' ?>>
                            <?= esc($branch['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="branErr error"><?= session('errors.branch_id') ?></div>
            </div>
        </div>

        <!-- Department and Designation -->
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Department</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="department_id" id="department_id" required class="form-control col-md-7 col-xs-12 chosen_class department_list">
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= esc($department['id']) ?>" <?= $employee['department_id'] == $department['id'] ? 'selected' : '' ?>>
                            <?= esc($department['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="departErr error"><?= session('errors.department_id') ?></div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12">Designation</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="designation_id" id="designation_id" required class="form-control col-md-7 col-xs-12 chosen_class designation_list">
                    <option value="">-- Select Designation --</option>
                    <?php foreach ($designations as $designation): ?>
                        <option value="<?= esc($designation['id']) ?>" <?= $employee['designation_id'] == $designation['id'] ? 'selected' : '' ?>>
                            <?= esc($designation['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="designErr error"><?= session('errors.designation_id') ?></div>
            </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-12">Reporting</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" id="reporting_name" name="reporting_name" class="form-control col-md-7 col-xs-12" value="<?= old('reporting_name', $employee['reporting_name']) ?>">
            <div class="empidErr error" style="color: red;"><?= session('errors.empID') ?></div>
        </div>
        </div>
        <!-- Employee ID and Joining Date -->
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Emp. ID</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="empID" name="empID" class="form-control col-md-7 col-xs-12" value="<?= old('empID', $employee['empID']) ?>">
                <div class="empidErr error"><?= session('errors.empID') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Joining Date</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="date" id="join_date" name="join_date" class="form-control col-md-7 col-xs-12" value="<?= old('join_date', $employee['join_date']) ?>">
                <div class="jdErr error"><?= session('errors.join_date') ?></div>
            </div>
        </div>
        <hr>

        <!-- Employee Detail -->
        <label class="t-title">Employee Detail</label>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12" value="<?= old('name', $employee['name']) ?>">
                <div class="nameErr error"><?= session('errors.name') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">E-mail</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?= old('email', $employee['email']) ?>">
                <div class="emailErr error"><?= session('errors.email') ?></div>
            </div>
        </div>

        <!-- Mobile and DOB -->
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Mobile</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="mobile" name="mobile" class="form-control col-md-7 col-xs-12" value="<?= old('mobile', $employee['mobile']) ?>">
                <div class="mobileErr error"><?= session('errors.mobile') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">DOB</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="date" id="dob" name="dob" class="form-control col-md-7 col-xs-12" value="<?= old('dob', $employee['dob']) ?>">
                <div class="dobErr error"><?= session('errors.dob') ?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Alt Mobile</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="alt_mobile" name="alt_mobile" class="form-control col-md-7 col-xs-12" value="<?= old('alt_mobile', $employee['alt_mobile']) ?>">
                <div class="altMobileErr error"><?= session('errors.alt_mobile') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select id="gender" name="gender" class="form-control col-md-7 col-xs-12">
                    <option value="">Select Gender</option>
                    <option value="male" <?= old('gender', $employee['gender']) == 'male' ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= old('gender', $employee['gender']) == 'female' ? 'selected' : '' ?>>Female</option>
                    <option value="other" <?= old('gender', $employee['gender']) == 'other' ? 'selected' : '' ?>>Other</option>
                </select>
                <div class="genderErr error"><?= session('errors.gender') ?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Marital Status</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select id="marital_status" name="marital_status" class="form-control col-md-7 col-xs-12">
                    <option value="">Select Marital Status</option>
                    <option value="single" <?= old('marital_status', $employee['marital_status']) == 'single' ? 'selected' : '' ?>>Single</option>
                    <option value="married" <?= old('marital_status', $employee['marital_status']) == 'married' ? 'selected' : '' ?>>Married</option>
                </select>
                <div class="maritalStatusErr error"><?= session('errors.marital_status') ?></div>
            </div>
            
        </div>
    <div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Password</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" value="<?= old('password', $employee['en_password']) ?>">
        <div class="passwordErr error"><?= session('errors.password') ?></div>
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Confirm Password</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <input type="text" id="en_password" name="en_password" class="form-control col-md-7 col-xs-12" value="<?= old('en_password', $employee['en_password']) ?>"><?= session('errors.en_password') ?></div>
    </div>
        <hr>


        <!-- Emergency Contact -->
        <label class="t-title">Emergency Contact</label>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Emergency Person</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="emer_person" name="emer_person" class="form-control col-md-7 col-xs-12" value="<?= old('emer_person', $employee['emer_person']) ?>">
                <div class="emerPersonErr error"><?= session('errors.emer_person') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Emergency Contact</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="emer_num" name="emer_num" class="form-control col-md-7 col-xs-12" value="<?= old('emer_num', $employee['emer_num']) ?>">
                <div class="emerNumErr error"><?= session('errors.emer_num') ?></div>
            </div>
        </div>
        <hr>

        <!-- Address -->
        <label class="t-title">Address</label>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Address</label>
            <div class="col-md-11 col-sm-11 col-xs-12">
                <textarea id="address" name="address" class="form-control col-md-7 col-xs-12"><?= old('address', $employee['address']) ?></textarea>
                <div class="addressErr error"><?= session('errors.address') ?></div>
            </div>
        </div>
        <hr>

        <!-- Bank Details -->
        <label class="t-title">Bank Details</label>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Bank</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="bank" name="bank" class="form-control col-md-7 col-xs-12" value="<?= old('bank', $employee['bank']) ?>">
                <div class="bankErr error"><?= session('errors.bank') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Branch</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="branch" name="branch" class="form-control col-md-7 col-xs-12" value="<?= old('branch', $employee['branch']) ?>">
                <div class="branchErr error"><?= session('errors.branch') ?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Account Number</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="acc_num" name="acc_num" class="form-control col-md-7 col-xs-12" value="<?= old('acc_num', $employee['acc_num']) ?>">
                <div class="accNumErr error"><?= session('errors.acc_num') ?></div>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">IFSC</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="ifsc" name="ifsc" class="form-control col-md-7 col-xs-12" value="<?= old('ifsc', $employee['ifsc']) ?>">
                <div class="ifscErr error"><?= session('errors.ifsc') ?></div>
            </div>
        </div>
        <hr>

        <!-- Documents -->
        <label class="t-title">Documents</label>
        
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-2 col-xs-12">PAN</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="pan" name="pan" class="form-control col-md-7 col-xs-12" 
                       value="<?= old('pan', $employee['pan']) ?>">
                <div class="panErr error"><?= session('errors.pan') ?></div>
            </div>
        
            <label class="control-label col-md-2 col-sm-1 col-xs-12">Aadhar</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="aadhar" name="aadhar" class="form-control col-md-7 col-xs-12" 
                       value="<?= old('aadhar', $employee['aadhar']) ?>">
                <div class="aadharErr error"><?= session('errors.aadhar') ?></div>
            </div>
        </div>
        <hr>
                <!-- Status -->
                <label class="t-title">Status</label>
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Status</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select id="status" name="status" class="form-control col-md-7 col-xs-12">
                            <option value="1" <?= old('status', $employee['status']) == '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= old('status', $employee['status']) == '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <div class="statusErr error"><?= session('errors.status') ?></div>
                    </div>
                </div>
                <!-- Image -->
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Image</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="file" id="profile_pic" name="profile_pic" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" name="old_profile_pic" value="<?= esc($employee['profile_pic']) ?>">
                        <?php if ($employee['profile_pic']): ?>
                            <img src="<?= base_url('uploads/employee/' . ($employee['profile_pic'] ?? 'default.png')) ?>" alt="Employee Image" width="100">
                        <?php endif; ?>
                        <div class="imageErr error"><?= session('errors.image') ?></div>
                    </div>
                </div>
                <hr>
                <!-- Submit Button -->
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?= base_url('backend/employee_admin/all_employee') ?>" class="btn btn-default">Back</a>
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
<script>
$(document).on('change', '#department_id', function () {
    var departmentId = $(this).val();

    $('#designation_id').html('<option value="">-- Select Designation --</option>').trigger('chosen:updated');

    if (departmentId) {
        $.ajax({
            url: '<?= base_url('/employee/getDesignations') ?>',
            type: 'POST',
            dataType: 'json',
            data: { department_id: departmentId },
            success: function (designations) {
                $.each(designations, function (i, designation) {
                    $('#designation_id').append(
                        '<option value="'+designation.id+'">'+designation.name+'</option>'
                    );
                });
                $('#designation_id').trigger('chosen:updated');
            }
        });
    }
});

</script>
</body>
</html>
