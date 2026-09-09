    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Voucher</title>
    
        <?= $this->include('backend/common_links/css_links') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    
        <style>
            label.t-title{
                display:block;
                font-size:16px;
                text-transform:capitalize;
                margin-top:20px;
            }
            .chosen-container{ width:100%!important; }
        </style>
    
    <?php
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $types = !empty($voucher['voucher_type'])
        ? explode(',', $voucher['voucher_type'])
        : [];
    
    ?>
    
    </head>
    
    <body class="nav-md">
    <div class="container body">
    <div class="main_container">
    
    <!-- LEFT SIDEBAR -->
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title">
                <a href="#" class="site_title"><span>Edit Voucher</span></a>
            </div>
            <div class="clearfix"></div><br>
    
            <?php if ($isAdmin): ?>
                <?= $this->include('backend/member_admin/sidebar.php') ?>
            <?php elseif ($isEmployee): ?>
                <?= $this->include('backend/employee_login/sidebar.php') ?>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- HEADER -->
    <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
    <?php elseif ($isEmployee): ?>
        <?= $this->include('backend/employee_login/header.php') ?>
    <?php endif; ?>
    
    <!-- PAGE CONTENT -->
    <div class="right_col" role="main">
    
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Voucher</h3>
        </div>
    </div>
    
    <?php if (session()->has('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>
    
    <div class="row">
    <div class="col-md-12">
    <div class="x_panel">
    
    <div class="x_title">
        <a href="<?= base_url('search-voucher') ?>" class="btn btn-primary">Back</a>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    
    <div class="x_content">
    
    <form action="<?= base_url('update_gift_voucher/'.$voucher['id']) ?>"
          method="post"
          class="form-horizontal form-label-left">
    
    <input type="hidden" name="member_num" id="hidden_member_num"
           value="<?= esc($voucher['member_num']) ?>">
    
    <!-- CATEGORY + SUBSIDIARY -->
    <div class="form-group">
    <label class="control-label col-md-1">Category</label>
    <div class="col-md-4">
    <select name="category" id="cate" class="form-control chosen_class">
        <option value="Member" <?= $voucher['category']=='Member'?'selected':'' ?>>Member</option>
        <option value="Non-Member" <?= $voucher['category']=='Non-Member'?'selected':'' ?>>Non-Member</option>
    </select>
    </div>
    
    <label class="control-label col-md-2">Subsidiary</label>
    <div class="col-md-4">
    <select name="subsidiary_id" id="subsidiary" class="form-control chosen_class">
    <option value="">-- Select --</option>
    <?php foreach($subsidiaries as $sub): ?>
    <option value="<?= $sub['id'] ?>"
    <?= $sub['id']==$voucher['subsidiary_id']?'selected':'' ?>>
    <?= $sub['name'] ?>
    </option>
    <?php endforeach; ?>
    </select>
    </div>
    </div>
    
    <!-- BRANCH + MEMBER -->
    <div class="form-group">
    <label class="control-label col-md-1">Branch</label>
    <div class="col-md-4">
    <select name="branch_id" id="branch" class="form-control chosen_class">
    <?php foreach($branches as $br): ?>
    <option value="<?= $br['id'] ?>"
    <?= $br['id']==$voucher['branch_id']?'selected':'' ?>>
    <?= $br['name'] ?>
    </option>
    <?php endforeach; ?>
    </select>
    </div>
    
    <label class="control-label col-md-2">Member</label>
    <div class="col-md-4">
    <select id="ms_num" class="form-control chosen_class">
    <option value="<?= $voucher['member_num'] ?>" selected>
    <?= $voucher['member_num']==0?'Not Required':$voucher['member_num'] ?>
    </option>
    </select>
    </div>
    </div>
    
    <hr>
    
    <!-- MEMBER DETAILS -->
    <label class="t-title">Member Details</label>
    
    <div class="form-group">
    <label class="control-label col-md-1">Name</label>
    <div class="col-md-4">
    <input type="text" name="name" id="mem_name"
           value="<?= esc($voucher['name']) ?>" class="form-control">
    </div>
    
    <label class="control-label col-md-2">Mobile</label>
    <div class="col-md-4">
    <input type="number" name="phone" id="mem_mobile"
           value="<?= esc($voucher['phone']) ?>" class="form-control">
    </div>
    </div>
    
    <div class="form-group">
    <label class="control-label col-md-1">Email</label>
    <div class="col-md-4">
    <input type="email" name="email" id="mem_email"
           value="<?= esc($voucher['email']) ?>" class="form-control">
    </div>
    </div>
    
    <hr>
    
    <!-- VOUCHER DETAILS -->
    <label class="t-title">Voucher Details</label>
    
    <div class="form-group">
    <label class="control-label col-md-1">Issue Date</label>
    <div class="col-md-4">
    <input type="date" name="issue_date"
           value="<?= esc($voucher['issue_date']) ?>" class="form-control">
    </div>
    </div>
    
    <hr>
    
    <!-- VOUCHER TYPE -->
    <label class="t-title">Voucher Type</label>
    
    <div class="form-group">
    <div class="col-md-6">
    <label>
    <input type="checkbox" id="chkHoliday" name="voucher_type[]" value="holiday"
    <?= in_array('holiday',$types)?'checked':'' ?>>
    Holiday Voucher
    </label>
    </div>
    
    <div class="col-md-6">
    <label>
    <input type="checkbox" id="chkMovie" name="voucher_type[]" value="movie"
    <?= in_array('movie',$types)?'checked':'' ?>>
    Movie Voucher
    </label>
    </div>
    </div>
    
    <div class="form-group" id="holidayFields" style="display:none;">
    <label class="control-label col-md-1">Destination</label>
    <div class="col-md-10">
    <textarea name="holiday" rows="4"
    class="form-control"><?= esc($voucher['holiday']) ?></textarea>
    </div>
    </div>
    
    <div class="form-group" id="movieFields" style="display:none;">
    <label class="control-label col-md-1">Movie Offer</label>
    <div class="col-md-10">
    <textarea name="movie" rows="3"
    class="form-control"><?= esc($voucher['movie']) ?></textarea>
    </div>
    </div>
    
    <div class="ln_solid"></div>
    
    <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
    <button type="submit" class="btn btn-success">Update Voucher</button>
    <a href="<?= base_url('search-voucher') ?>" class="btn btn-default">Cancel</a>
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
    
    <?= $this->include('backend/common_links/js_links') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    
    <script>
    $(document).ready(function(){
        $(".chosen_class").chosen({width:"100%"});
    
        if($("#chkHoliday").is(":checked")) $("#holidayFields").show();
        if($("#chkMovie").is(":checked")) $("#movieFields").show();
    
        $("#chkHoliday").change(function(){ $("#holidayFields").toggle(this.checked); });
        $("#chkMovie").change(function(){ $("#movieFields").toggle(this.checked); });
    });
    </script>
    
    </body>
    </html>
