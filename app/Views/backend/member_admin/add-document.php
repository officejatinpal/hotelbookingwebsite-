<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Upload Member Document</title>

    <?= $this->include('backend/common_links/css_links') ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <?php 
$isAdmin    = session()->get('role') === 'admin';
$isEmployee = session()->get('isEmployeeLoggedIn') === true;
?>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

    <!-- SIDEBAR -->
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border:0;">
                <a href="#" class="site_title">
                    <span>Member Document</span>
                </a>
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
        
    <!-- PAGE CONTENT -->
    <div class="right_col" role="main">
        <div class="">

            <!-- FLASH MESSAGE -->
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>
                                Upload / Update Document
                                <small>Member No: <?= esc($ms_num) ?></small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <!-- UPLOAD FORM -->
                            <form action="<?= base_url('member/store-document') ?>"
                                  method="post"
                                  enctype="multipart/form-data">

                                <?= csrf_field() ?>

                                <input type="hidden" name="ms_num" value="<?= esc($ms_num) ?>">

                                <div class="form-group">
                                    <label>Select Document (PDF / JPG / PNG)</label>
                                    <input type="file"
                                           name="document"
                                           class="form-control"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-upload"></i> Upload / Update
                                </button>
                            </form>

                            <!-- DOCUMENT SECTION -->
                            <?php
                                $hasDocument = false;
                                if (!empty($documents) && !empty($documents[0]['document'])) {
                                    $hasDocument = true;
                                }
                            ?>

                            <?php if ($hasDocument): ?>

                                <hr>
                                <h4>Uploaded Document</h4>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach ($documents as $key => $doc): ?>
                                        <?php if (!empty($doc['document'])): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= esc($doc['document']) ?></td>

                                            <td>
                                                <button type="button"
                                                        class="btn btn-info btn-sm viewDocBtn"
                                                        data-file="<?= base_url('uploads/member_documents/'.$doc['document']) ?>">
                                                    <i class="fa fa-eye"></i> View
                                                </button>
                                            </td>

                                            <td>
                                                <a href="<?= base_url('member/delete-document/'.$ms_num) ?>"
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Delete this document?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>

<!-- VIEW MODAL -->
<div class="modal fade" id="docModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Document Preview</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <iframe id="docFrame"
                src=""
                style="width:100%; height:600px;"
                frameborder="0"></iframe>
      </div>

    </div>
  </div>
</div>

<?= $this->include('backend/common_links/js_links') ?>

<script>
$(document).on('click', '.viewDocBtn', function () {
    var fileUrl = $(this).data('file');
    $('#docFrame').attr('src', fileUrl);
    $('#docModal').modal('show');
});
</script>

</body>
</html>
