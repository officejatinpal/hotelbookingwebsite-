    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Generate Voucher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->include('backend/common_links/css_links') ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
    /* ===== ONLY MOBILE COLUMN FIX ===== */
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
    ?>
    
    </head>
    <body class="nav-md">
    <div class="container body">
    <div class="main_container">
    
    <!-- Sidebar -->
    <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border:0;">
    <a href="#" class="site_title"><span>Generate Voucher</span></a>
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
    
    <!-- Top Header -->
    <?php if ($isAdmin): ?>
    <?= $this->include('backend/member_admin/header.php') ?>
    
    <?php elseif ($isEmployee): ?>
    <?= $this->include('backend/employee_login/header.php') ?>
    <?php endif; ?>
    
    <!-- Page content -->
    <div class="right_col" role="main">
    <div class="page-title">
    <div class="title_left">
    <h5>Generate Voucher</h5>
    <div class="msg"></div>
    </div>
    </div>
    
    <div class="clearfix"></div>
    
    <?php if (session()->has('success')): ?>
    <div class="alert alert-success" role="alert">
    <?= session('success'); ?>
    </div>
    <?php endif; ?>
    
    <div class="row">
    <div class="col-md-12">
    <div class="x_panel">
    
    <div class="x_title">
    <div class="btn-group" id="buttonlist">
    <a class="btn btn-primary" href="<?= base_url('search-voucher') ?>">Search Voucher</a>
    </div>
    <ul class="nav navbar-right panel_toolbox">
    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
    </div>
    
    <div class="x_content">
    
    <form id="add_form" action="<?= base_url('/store_generate_voucher') ?>" method="post" class="form-horizontal form-label-left">
    
    <!-- Hidden field for Member Number (0 for Non-Member) -->
    <input type="hidden" name="member_num" id="hidden_member_num" value="">
    
    <!-- Category + Subsidiary -->
    <div class="form-group">
    <label class="control-label col-md-1">Category</label>
    <div class="col-md-4">
    <select name="category" id="cate" required class="form-control">
    <option value="">-- Select Category --</option>
    <option value="Member">Member</option>
    <option value="Non-Member">Non-Member</option>
    </select>
    </div>
    
    <label class="control-label col-md-2">Subsidiary</label>
    <div class="col-md-4">
    <select name="subsidiary_id" id="subsidiary" class="form-control">
    <option value="">-- Select Subsidiary --</option>
    <?php foreach ($subsidiaries as $subsidiary): ?>
    <option value="<?= $subsidiary['id']; ?>"><?= $subsidiary['name']; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
    </div>
    
    <!-- Branch + Member -->
    <div class="form-group">
    <label class="control-label col-md-1">Branch</label>
    <div class="col-md-4">
    <select name="branch_id" id="branch" required class="form-control chosen_class">
    <option value="">-- Select Branch --</option>
    </select>
    </div>
    <label class="control-label col-md-2">Member</label>
    <div class="col-md-4">
    <select id="ms_num" class="form-control chosen_class">
    <option value="">-- Select Member --</option>
    </select>
    </div>
    </div>
    
    <hr>
    
    <!-- Member Details -->
    <label class="t-title">Member Details</label>
    
    <div class="form-group">
    <label class="control-label col-md-1">Name</label>
    <div class="col-md-4">
    <input type="text" id="mem_name" name="name" required class="form-control">
    </div>
    
    <label class="control-label col-md-2">Mobile</label>
    <div class="col-md-4">
    <input type="number" id="mem_mobile" name="phone" required class="form-control" maxlength="10" pattern="\d{10}">
    </div>
    </div>
    
    <div class="form-group">
    <label class="control-label col-md-1">Email</label>
    <div class="col-md-4">
    <input type="email" id="mem_email" name="email" required class="form-control">
    </div>
    </div>
    
    <hr>
    
    <!-- Voucher Details -->
    <label class="t-title">Voucher Details</label>
    
    <div class="form-group">
    <label class="control-label col-md-1">Issue Date</label>
    <div class="col-md-4">
    <input type="date" name="issue_date" required class="form-control"
    value="<?= old('issue_date') ? old('issue_date') : date('Y-m-d') ?>">
    </div>
    </div>
    
    <hr>
    
    <!-- Voucher Type -->
    <label class="t-title">Voucher Type</label>
    <div class="form-group">
    <div class="col-md-6">
    <label><input type="checkbox" name="voucher_type[]" value="holiday" id="chkHoliday" checked> Holiday Voucher</label>
    </div>
    <div class="col-md-6">
    <label><input type="checkbox" name="voucher_type[]" value="movie" id="chkMovie" checked> Movie Voucher</label>
    </div>
    </div>
    
    <!-- Holiday Field -->
    <div class="form-group" id="holidayFields" style="display:none;">
    <label class="control-label col-md-1">Destination</label>
    <div class="col-md-10">
    <textarea name="holiday" rows="5" class="form-control"><?= $movie_value ?? 'Shimla, Manali, Goa, Jim Corbett, Nashik, Nainital, Jaipur, Bhimtal, Kerala' ?></textarea>
    </div>
    </div>
    
    <!-- Movie Field -->
    <div class="form-group" id="movieFields" style="display:none;">
    <label class="control-label col-md-1">Movie Offer</label>
    <div class="col-md-10">
    <textarea name="movie" rows="3" class="form-control"><?= $movie_value ?? 'Promo code maximum limit Rs. 400 valid only movie tickets.' ?></textarea>
    </div>
    </div>
    
    <div class="ln_solid"></div>
    
    <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
    <button type="reset" class="btn btn-primary">Reset</button>
    <button type="submit" class="btn btn-success">Submit</button>
    </div>
    </div>
    
    </form>
    
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- /Page Content -->
    
    </div>
    </div>
    
    <div class="loader-cart" style="display:none;">
    <img src="<?= base_url('assets/images/dark-loader.gif') ?>">
    </div>
    
    <?= $this->include('backend/common_links/js_links') ?>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
<script>
$(document).ready(function(){

    // ✅ SELECT2 INIT
    $(".chosen_class").select2({
        width: '100%',
        dropdownAutoWidth: true,
        dropdownParent: $('.x_panel')
    });

    // ✅ AUTO FOCUS SEARCH (SAFE)
    $(document).on('select2:open', function() {
        let searchField = document.querySelector('.select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    });

    // ✅ SHOW / HIDE FIELDS
    $("#chkHoliday").change(function(){ 
        $("#holidayFields").toggle(this.checked); 
    });

    $("#chkMovie").change(function(){ 
        $("#movieFields").toggle(this.checked); 
    });

    const memberDropdown = $("#ms_num");
    const branchDropdown = $("#branch");

    // ✅ INITIAL STATE
    branchDropdown.prop('disabled', true);

    // ==============================
    // 🔄 CATEGORY CHANGE
    // ==============================
    $("#cate").change(function(){

        const category = $(this).val();
        memberDropdown.empty();

        if(category === "Non-Member") {
            $("#hidden_member_num").val("0");

            memberDropdown.prop('disabled', true)
                .append('<option value="0" selected>-- Not Required --</option>');

        } else {
            $("#hidden_member_num").val("");

            memberDropdown.prop('disabled', false)
                .append('<option value="">-- Select Member --</option>');
        }

        memberDropdown.trigger("change");
    });

    // ==============================
    // 🔄 SUBSIDIARY → BRANCH
    // ==============================
    $("#subsidiary").change(function(){

        const subId = $(this).val();

        if(!subId){
            branchDropdown.empty()
                .append('<option value="">-- Select Branch --</option>')
                .prop('disabled', true)
                .trigger("change");

            // reset member also
            memberDropdown.empty()
                .append('<option value="">-- Select Member --</option>')
                .prop('disabled', true)
                .trigger("change");

            return;
        }

        $.getJSON('<?= base_url("getBranchesBySub") ?>/' + subId, function(data){

            branchDropdown.empty()
                .append('<option value="">-- Select Branch --</option>');

            $.each(data, function(i, branch){
                branchDropdown.append(
                    '<option value="'+branch.id+'">'+branch.name+'</option>'
                );
            });

            branchDropdown.prop('disabled', false).trigger("change");
        });
    });

    // ==============================
    // 🔄 BRANCH → MEMBER
    // ==============================
    branchDropdown.change(function(){

        const branchId = $(this).val();
        const category = $("#cate").val();

        memberDropdown.empty();

        if(category === "Non-Member"){

            memberDropdown.prop('disabled', true)
                .append('<option value="0" selected>-- Not Required --</option>');

            memberDropdown.trigger("change");
            return;
        }

        if(!branchId){
            memberDropdown.empty()
                .append('<option value="">-- Select Member --</option>')
                .prop('disabled', true)
                .trigger("change");
            return;
        }

        memberDropdown.prop('disabled', false)
            .append('<option value="">-- Select Member --</option>');

        $.getJSON('<?= base_url("getmembersByBra") ?>/' + branchId, function(data){

            if(data && data.length > 0){
                $.each(data, function(i, member){
                    memberDropdown.append(
                        '<option value="'+member.ms_num+'">'+
                        (member.name || "Unknown") +' - '+member.ms_num+
                        '</option>'
                    );
                });
            }

            memberDropdown.trigger("change");
        });
    });

    // ==============================
    // 🔄 MEMBER DETAILS AUTO FILL
    // ==============================
    memberDropdown.change(function(){

        const msNum = $(this).val();
        $("#hidden_member_num").val(msNum);

        if(msNum && msNum !== "0"){

            $.getJSON('<?= base_url("getMemberDetails") ?>/' + msNum, function(res){

                $("#mem_name").val(res.name || '');
                $("#mem_mobile").val(res.mobile || '');
                $("#mem_email").val(res.email || '');

            });

        } else {
            $("#mem_name, #mem_mobile, #mem_email").val('');
        }
    });

});
</script>
    
    </body>
    </html>
