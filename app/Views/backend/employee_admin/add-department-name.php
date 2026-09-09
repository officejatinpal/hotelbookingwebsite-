<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Department</title>

    <?= $this->include('backend/common_links/css_links') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <style>
        .t-title{font-size:16px;margin-bottom:5px}
        .mb-2{margin-bottom:10px}
        .mt-2{margin-top:10px}
    </style>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

    <!-- SIDEBAR -->
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border:0">
                <a href="#" class="site_title"><span>Employee Admin</span></a>
            </div>
            <div class="clearfix"></div>
            <?php include('sidebar.php'); ?>
        </div>
    </div>

    <!-- HEADER -->
    <?php include('header.php'); ?>

    <!-- PAGE CONTENT -->
    <div class="right_col" role="main">
        <div class="">

            <!-- ADD DEPARTMENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Add Department</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <?php if(!empty($success)): ?>
                                <div class="alert alert-success"><?= $success ?></div>
                            <?php endif; ?>

                            <?php if(!empty($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="post" action="<?= base_url('employee/add_multiple_department') ?>">

                                <!-- BRANCH -->
                                <div class="form-group">
                                    <label class="t-title">Select Branch</label>
                                    <select name="branch_id" class="form-control chosen-select" required>
                                        <option value="">-- Select Branch --</option>
                                        <?php foreach($branches as $branch): ?>
                                            <option value="<?= $branch['id'] ?>">
                                                <?= esc($branch['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- DYNAMIC DEPARTMENT FIELDS -->
                                <div id="dynamicFields">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <input type="text" name="department_names[]" 
                                                   class="form-control"
                                                   placeholder="Department Name" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success add-more">Add</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">
                                    Submit
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- VIEW DEPARTMENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Department List</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Department Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($departments)): ?>
                                    <?php foreach($departments as $k => $dept): ?>
                                        <tr>
                                            <td><?= $k+1 ?></td>
                                            <td><?= esc($dept['name']) ?></td>
                                            <td>
                                                <a href="<?= base_url('webmaster/edit_department/'.$dept['id']) ?>"
                                                   class="btn btn-info btn-xs">Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No Department Found
                                        </td>
                                    </tr>
                                <?php endif; ?>
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

<?= $this->include('backend/common_links/js_links') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>
$(".chosen-select").chosen();

document.querySelector('.add-more').addEventListener('click', function () {
    const div = document.createElement('div');
    div.className = 'row mb-2';
    div.innerHTML = `
        <div class="col-md-6">
            <input type="text" name="department_names[]" 
                   class="form-control"
                   placeholder="Department Name" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove">Remove</button>
        </div>
    `;
    document.getElementById('dynamicFields').appendChild(div);

    div.querySelector('.remove').onclick = () => div.remove();
});

// auto hide alerts
setTimeout(() => {
    $('.alert').fadeOut('slow');
}, 5000);
</script>

</body>
</html>
