<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search Invoice</title>

    <?= $this->include('backend/common_links/css_links') ?>

    <style type="text/css">
      .modal-body, .modal-footer, .modal-content { width: 100%; float: left; }
      .list-inline { width: 100%; text-align: center; }
      ul.count2 li { margin-bottom: 20px !important; }
      ul.widget_profile_box li:last-child {
        width: 100% !important; text-align: center;
      }
      ul.widget_profile_box li .profile_img { margin: 0px; }
      .modal-title { float: left; }
      .mb-2 { margin-bottom: 10px !important; }
      .mt-2 { margin-top: 10px !important; }
      .brdr {
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
        padding-bottom: 20px;
      }
      
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
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>Search Invoice</span></a>
            </div>
            <div class="clearfix"></div>
            <?php if ($isAdmin): ?>
            <?= $this->include('backend/member_admin/sidebar.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/sidebar.php') ?>
        <?php endif; ?>
          </div>
        </div>
        
        <?php if ($isAdmin): ?>
        <?= $this->include('backend/member_admin/header.php') ?>
            
        <?php elseif ($isEmployee): ?>
            <?= $this->include('backend/employee_login/header.php') ?>
        <?php endif; ?>

        <div class="right_col" role="main">
          <div class="page-title">
            <div class="title_left">
              <h3>Search Invoice</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- Search Form -->
                  <div class="row brdr">
                    <div class="col-md-8 col-md-offset-2">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Search By</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="search_key" id="search_key" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="" selected>-- Select --</option>
                            <option value="receipt_num">Receipt / Invoice No.</option>
                            <option value="mem_ms_num" selected>Membership No.</option>                     
                          </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" id="search_value" name="search_value" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="button" id="search_data" class="btn btn-success" name="Search">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Search by Date -->
                  <div class="row brdr">
                    <div class="col-md-8 col-md-offset-2">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Search By</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="search_key_date" id="search_key_date" class="form-control col-md-7 col-xs-12">
                            <option value="date">Date</option>                     
                          </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="date" id="search_value_date" name="search_value_date" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="button" id="search_data_date" class="btn btn-success" name="Search">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Table to display search results -->
            <div class="table-responsive">
                <table id="new_data" class="table table-striped table-bordered export_table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Invoice Detail</th>
                        <th>Membership No.</th>
                        <th>Type</th>
                        <th>Payment Detail</th>
                        <th>Executive</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="invoice_table_body">
                      <!-- Data will be populated here via JavaScript -->
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

    <div class="loader-cart" style="display: none;">
        <img src="<?=base_url('assets/images/dark-loader.gif')?>">
    </div>

    <?= $this->include('backend/common_links/js_links') ?>
    
    <script>
    $(document).ready(function () {
        function renderTableRows(data) {
            return data.map((item, index) => {
                const statusColor = item.status === '1' ? 'green' : 'red';
                const statusText = item.status === '1' ? 'Active' : 'Inactive';

                return `
                    <tr id="row${item.id}">
                        <td>${index + 1}</td>
                        <td><b>Date:</b> ${item.gen_date}<br><b>No.:</b> ${item.receipt_num}</td>
                        <td>${item.mem_ms_num}</td>
                        <td>${item.payment_type}</td>
                        <td><b>MODE:</b> ${item.mode}<br><b>BANK:</b> ${item.bank}<br><b>TID:</b> ${item.tid || 'N/A'}</td>
                        <td><b>Manager:</b> ${item.mngr_id}<br><b>Sale Person:</b> ${item.salep_id}</td>
                        <td><span style="color: ${statusColor};"><b>${statusText}</b></span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="view-invoice/${item.id}" target="_blank">
                                <span class="fa fa-eye"></span> View
                            </a>
                            <button class="btn btn-primary btn-sm send-invoice mt-1" data-invoice-id="${item.id}">
                                Send Invoice
                            </button>
                            <br />
                            <a class="btn btn-primary btn-sm mt-1" href="invoice/editData/${item.id}">
                                <span class="fa fa-pencil"></span> Edit
                            </a>
                          
                            <div class="response-message mt-1"></div>
                        </td>
                    </tr>`;
            }).join('');
        }

        function fetchInvoices(url, data) {
            $('#invoice_table_body').html('<tr><td colspan="8">Loading...</td></tr>');
            $.post(url, data, function (response) {
                if (response.status === 'success' && response.data.length > 0) {
                    $('#invoice_table_body').html(renderTableRows(response.data));
                } else {
                    $('#invoice_table_body').html('<tr><td colspan="8">No results found.</td></tr>');
                }
            }).fail(() => alert('An error occurred while fetching data.'));
        }

        $('#search_data').on('click', function () {
            const searchKey = $('#search_key').val();
            const searchValue = $('#search_value').val();
            if (!searchKey || !searchValue) return alert('Please fill all required fields.');
            fetchInvoices('<?= base_url('invoice/search') ?>', { search_key: searchKey, search_value: searchValue });
        });

        $('#search_data_date').on('click', function () {
            const searchDate = $('#search_value_date').val();
            if (!searchDate) return alert('Please select a date.');
            fetchInvoices('<?= base_url('invoice/search-by-date') ?>', { search_value_date: searchDate });
        });

        // Send Invoice
        $(document).on('click', '.send-invoice', function () {
            let button = $(this);
            let invoiceId = button.data("invoice-id");
            let responseMessage = button.siblings(".response-message");

            if (!invoiceId) return responseMessage.html('<div class="alert alert-danger">Invalid Invoice ID</div>');

            button.prop("disabled", true).text("Processing...");
            $.get("<?= base_url('send-invoice') ?>/" + invoiceId, function (response) {
                responseMessage.html(`<div class="alert alert-${response.status === 'success' ? 'success' : 'danger'}">${response.message}</div>`);
            }).fail(() => responseMessage.html('<div class="alert alert-danger">Error processing invoice.</div>'))
            .always(() => setTimeout(() => button.prop("disabled", false).text("Send Invoice"), 5000));
        });

    });
    </script>

  </body>
</html>
