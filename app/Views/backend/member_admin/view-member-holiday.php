<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Member Holiday</title>

    <?= $this->include('backend/common_links/css_links') ?>
    
    <style type="text/css">
      .modal-body, .modal-footer, .modal-content {
        width:100%; float: left;
      }
      .list-inline {
        width:100%; text-align: center;
      }
      ul.count2 li {
        margin-bottom:20px !important;
      }
      ul.widget_profile_box li:last-child {
        width: 100% !important; text-align: center;
      }
      ul.widget_profile_box li .profile_img {
        margin:0px;
      }
      .modal-title {
        float:left;
      }
      .mb-2 {
        margin-bottom:10px !important;
      }
      .mt-2 {
        margin-top:10px !important;
      }
    </style>
    <!-- Custom Theme Style -->

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
              <a href="#" class="site_title"><span>Member Holidays</span></a>
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
        <!-- /top navigation -->

         <!-- Page content -->
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Holiday Status - <?= esc($user['name']) ?> - <?= esc($user['ms_num']) ?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="btn-group" id="buttonlist"> 
                      <a class="btn btn-primary " href="<?= site_url('add-holiday/' . ($user['ms_num'])) ?>">Add Member Holiday</a>  
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered export_table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Length of Holiday</th>
                            <th>Validity</th>
                            <th>Booked Date</th>
                            <th>Booking Details</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($holidays): ?>
                            <?php $i = 1; foreach ($holidays as $holiday): ?>
                                <tr>
                                    <td><?= esc($i++) ?></td>
                                    <td><?= esc($holiday['night']) . ' Nights & ' . esc($holiday['day']) . ' Days'; ?></td>
                                    <td><?= esc(date('d-m-Y', strtotime($holiday['v_from']))) ?> to <?= esc(date('d-m-Y', strtotime($holiday['v_to']))) ?></td>
                                    <td><?= esc(date(($holiday['book_date']))) ?></td>
                                    <td><?= esc($holiday['other']) ?></td>
                                    <td><?= esc($holiday['status_display']) ?></td>
                                     <td>
                                        <?php if ($holiday['can_book']): ?>
                                            <button class="btn btn-warning btn-sm bookingModel"
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-target="#myModal"
                                                    data-id="<?= esc($holiday['id']) ?>">
                                                Book
                                            </button>
                                    
                                            <!-- DELETE -->
                                            <a href="<?= site_url('holiday-delete/' . $holiday['id'] . '/' . $user['ms_num']) ?>"
                                               onclick="return confirm('Are you sure you want to delete this holiday offer?')"
                                               class="btn btn-danger btn-sm">
                                               Delete
                                            </a>
                                    
                                        <?php elseif ($holiday['status'] === 'Booked'): ?>
                                    
                                            <a href="<?= site_url('holiday-generate-voucher/' . esc($holiday['id'])) ?>"
                                               class="btn btn-primary btn-sm">
                                               Generate
                                            </a>
                                    
                                            <!-- DELETE AFTER BOOKED -->
                                            <a href="<?= site_url('holiday-delete/' . $holiday['id'] . '/' . $user['ms_num']) ?>"
                                               onclick="return confirm('Are you sure you want to delete this booked holiday?')"
                                               class="btn btn-danger btn-sm">
                                               Delete
                                            </a>
                                    
                                        <?php elseif ($holiday['status'] === 'Generated'): ?>
                                    
                                            <a href="<?= site_url('holiday-view-voucher/' . esc($holiday['id'])) ?>"
                                               class="btn btn-info btn-sm" target="_blank">View</a>
                                            <a href="<?= site_url('holiday-edit-voucher/' . esc($holiday['id'])) ?>"
                                               class="btn btn-secondary btn-sm">Edit</a>
                                            <a href="<?= site_url('holiday-download-voucher/' . esc($holiday['id'])) ?>"
                                               class="btn btn-success btn-sm">Download</a>
                                    
                                            <!-- DELETE AFTER GENERATED-->
                                            <a href="<?= site_url('holiday-delete/' . $holiday['id'] . '/' . $user['ms_num']) ?>"
                                               onclick="return confirm('Delete generated holiday? This will also remove voucher data.')"
                                               class="btn btn-danger btn-sm">
                                               Delete
                                            </a>
                                    
                                        <?php else: ?>
                                            <span class="text-muted"><?= esc($holiday['status_display']) ?></span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No Holiday Available</td>
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
    
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Holiday Booking</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Booking Date</label>
                            <input type="date" class="form-control" id="book_date" required>
                        </div>
                        <input type="hidden" id="holiday_id" value="">
                        <div class="form-group">
                            <label>Package</label>
                            <select class="form-control" id="pkg_type" required>
                                <option value="">-- Select Packages --</option>
                                <option value="1">1 Night & 2 Days</option>
                                <option value="2">2 Nights & 3 Days</option>
                                <option value="3">3 Nights & 4 Days</option>
                                <option value="4">4 Nights & 5 Days</option>
                                <option value="5">5 Nights & 6 Days</option>
                                <option value="6">6 Nights & 7 Days</option>
                                <!-- more options here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control select_city" id="destination" required>
                                <option value="">-- Select City --</option>
                                <?php foreach ($destinations as $destination): ?>
                                    <option value="<?= esc($destination['id']); ?>"><?= esc($destination['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Resort</label>
                            <select class="form-control select_resort" id="hotel" required>
                                <option value="">-- Select Resort --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Other (Optional)</label>
                            <textarea  class="form-control" id="detail"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Important Note: If updating an existing booking, delete remaining holidays added while booking.</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span id="err_msg"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-success book_hotel">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

<?= $this->include('backend/common_links/js_links.php') ?> 

 <script>
$(document).on('click', '.bookingModel', function() {
    var offerId = $(this).data('id');
    $('#holiday_id').val(offerId);
    $('#err_msg').text('');
});

$('#destination').change(function() {
    var desti_id = $(this).val();

    // Always reset with Other option
    $('#hotel').empty()
        .append('<option value="">Select Resort</option>')
        .append('<option value="other">Other (Not Listed)</option>');

    if (desti_id) {
        $.ajax({
            url: '<?= base_url('hotel/getResortsByDestination') ?>',
            type: 'POST',
            dataType: 'json',
            data: { desti_id: desti_id },
            success: function(data) {
                if (data && data.length > 0) {
                    $.each(data, function(key, value) {
                        // Insert resorts BEFORE Other
                        $('#hotel option[value="other"]').before(
                            '<option value="' + value.id + '">' + value.name + '</option>'
                        );
                    });
                }
            },
            error: function() {
                alert('Error loading resorts');
            }
        });
    }
});

/* Submit booking */
$('.book_hotel').click(function() {
    const book_date   = $('#book_date').val();
    const pkg_type    = $('#pkg_type').val();
    const destination = $('#destination').val();
    const hotel       = $('#hotel').val();
    const holiday_id  = $('#holiday_id').val();
    const detail      = $('#detail').val();

    if (!book_date || !pkg_type || !destination || !hotel) {
        $('#err_msg').text('Please fill all required fields.');
        return;
    }

    if (hotel === 'other' && !detail) {
        $('#err_msg').text('Please enter resort name in details.');
        return;
    }

    $.post(
        '<?= site_url("bookholiday") ?>',
        { book_date, pkg_type, destination, hotel, holiday_id, detail },
        function(response) {
            if (response.success) {
                alert('Booking successful!');
                $('#myModal').modal('hide');
                location.reload();
            } else {
                $('#err_msg').text(response.message || 'Booking failed. Try again.');
            }
        },
        'json'
    );
});

/* Ensure Other exists on load */
$(document).ready(function() {
    $('#hotel').empty()
        .append('<option value="">Select Resort</option>')
});
</script>

  </body>
</html>
