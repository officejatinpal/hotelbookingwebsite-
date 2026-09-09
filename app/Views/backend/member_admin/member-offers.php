<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


    <title>Member Offers</title>

    <?= $this->include('backend/common_links/css_links') ?>
    
    <style type="text/css">
      .modal-body, .modal-footer, .modal-content
      {
        width:100%; float: left;
      }
      .list-inline
      {
        width:100%; text-align: center;
      }
      ul.count2 li
      {
        margin-bottom:20px !important;
      }
      ul.widget_profile_box li:last-child
      {
        width: 100% !important; text-align: center;
      }
      ul.widget_profile_box li .profile_img
      {
        margin:0px;
      }
      .modal-title
      {
        float:left;
      }
      .mb-2
      {
        margin-bottom:10px !important;
      }
      .mt-2
      {
        margin-top:10px !important;
      }
    </style>
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    
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
              <a href="#" class="site_title"><span>Member Offers</span></a>
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
                <h3>Offer Status - <?= esc($user['name']) ?> - <?= esc($user['ms_num']) ?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">   
                  <div class="x_title">
                    <div class="btn-group" id="buttonlist"> 
                      <a class="btn btn-primary " href="<?= site_url('add-offers/' . ($user['ms_num'])) ?>" target="_blank">Add Member Offers</a>  
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
                            <th>Offer</th>
                            <th>Validity</th>
                            <th>Booked Date</th>
                            <th>Booking Details</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($offers): ?>
                            <?php $i = 1; foreach ($offers as $offer): ?>
                                <tr>
                                    <td><?= esc($i++) ?></td>
                                    <td><?= $offer['offer'] ?></td>
                                    <td><?= esc($offer['v_from']) ?> to <?= esc($offer['v_to']) ?></td>
                                    <td><?= esc($offer['book_date']) ?></td>
                                    <td><?= esc($offer['detail']) ?></td>
                                    <td><?= esc($offer['status_display']) ?></td>
                                    <td>
                                        <?php if ($offer['can_book']): ?>

                                        <button class="btn btn-warning btn-sm bookingModel"
                                            type="button"
                                            data-toggle="modal"
                                            data-target="#myModal"
                                            data-id="<?= esc($offer['id']) ?>">
                                            Book
                                        </button>
                                    
                                        <a href="<?= site_url('offer/delete/' . $offer['id'] . '/' . $user['ms_num']) ?>"
                                           onclick="return confirm('Are you sure you want to delete this offer?')"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
                                    
                                    <?php elseif ($offer['status_display'] === 'Booked'): ?>
                                    
                                        <a href="<?= site_url('generate-voucher/' . esc($offer['id'])) ?>"
                                           class="btn btn-primary btn-sm">Generate</a>
                                    
                                        <a href="<?= site_url('offer/delete/' . $offer['id'] . '/' . $user['ms_num']) ?>"
                                           onclick="return confirm('Are you sure you want to delete this booked offer?')"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
                                    
                                    <?php elseif ($offer['status_display'] === 'Generated'): ?>
                                    
                                        <a href="<?= site_url('view-voucher/' . esc($offer['id'])) ?>"
                                           class="btn btn-info btn-sm" target="_blank">View</a>
                                        <a href="<?= site_url('edit-voucher/' . esc($offer['id'])) ?>"
                                           class="btn btn-secondary btn-sm">Edit</a>
                                        <a href="<?= site_url('download-voucher/' . esc($offer['id'])) ?>"
                                           class="btn btn-success btn-sm">Download</a>
                                    
                                    <?php elseif ($offer['status_display'] === 'Expired'): ?>
                                    
                                        <a href="<?= site_url('offer/delete/' . $offer['id'] . '/' . $user['ms_num']) ?>"
                                           onclick="return confirm('Are you sure you want to delete this expired offer?')"
                                           class="btn btn-danger btn-sm">
                                           Delete
                                        </a>
                                    
                                    <?php else: ?>
                                    
                                        <span class="text-muted"><?= esc($offer['status_display']) ?></span>
                                    
                                    <?php endif; ?>

                                    </td>

                                        
                                    <td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                        <td colspan="8" class="text-center">No offers available</td>
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
       <div id="myModal"  class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Offer Booking</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Booking Date</label>
                  <input type="date" class="form-control" id="book_date">
                </div>
                <input type="hidden" id="offer_id" value="">
                <div class="form-group">
                  <label>Booking Detail</label>
                  <textarea class="form-control" id="detail"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <span id="err_msg"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                
                <button type="button" class="btn btn-success book_hotel">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?= $this->include('backend/common_links/js_links.php') ?> 

 <script>
      $(document).on('click', '.bookingModel', function() {
        var offerId = $(this).data('id');
        $('#offer_id').val(offerId); // Set the offer ID in the hidden input field
        $('#book_date').val(''); // Clear the booking date
        $('#detail').val(''); // Clear the booking detail
        $('#err_msg').text(''); // Clear any error message
      });

      $('.book_hotel').on('click', function() {
        var bookDate = $('#book_date').val();
        var detail = $('#detail').val();
        var offerId = $('#offer_id').val();

        if (!bookDate || !detail) {
          $('#err_msg').text('Please fill in all fields.');
          return;
        }

        $.ajax({
          url: '<?= base_url('bookoffer') ?>',
          method: 'POST',
          data: {
            offer_id: offerId,
            book_date: bookDate,
            detail: detail
          },
          success: function(response) {
            $('#myModal').modal('hide');
            location.reload(); // Reload the page to show the updated data
          },
          error: function() {
            $('#err_msg').text('An error occurred. Please try again.');
          }
        });
      });
    </script>   
  </body>
</html>
