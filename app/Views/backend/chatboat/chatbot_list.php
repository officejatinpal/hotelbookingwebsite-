<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add YouTube Video</title>
  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .modal-body, .modal-footer, .modal-content {
      width: 100%;
      float: left;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .error {
      color: red;
      font-size: 12px;
    }
    .loader-cart {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
    }
    .loader-cart img {
      width: 50px;
      height: 50px;
    }
    
    .table th {
    text-align: center;
    vertical-align: middle;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
}

.btn i {
    margin-right: 3px;
}
  </style>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <!-- Sidebar -->
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><span>Property Admin</span></a>
          </div>
          <div class="clearfix"></div>
        <?php include(APPPATH . 'Views/backend/property_admin/sidebar.php'); ?>        </div>
      </div>

      <!-- Header -->
      <?php include(APPPATH . 'Views/backend/property_admin/header.php'); ?>
      
      <!-- Main Content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add YouTube Video</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              
              
        <?php if(session()->getFlashdata('msg')): ?>
        <p><?= session()->getFlashdata('msg') ?></p>
        <?php endif; ?>
        
              <div class="x_content">

        <h2>Chatbot List</h2>
        
        <a href="/admin/chatbot/create">Add New</a>
        
       <div class="x_content">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                 <thead>
        <tr>
            <th>ID</th>
            <th>Keywords</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
            </thead>
        <tbody>
        <?php foreach($chatbots as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['keywords'] ?></td>
            <td><?= $row['answer'] ?></td>
            <td>
                <a href="/webmaster/chatbot/edit/<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                <a href="/webmaster/chatbot/delete/<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        
          </tbody>
            </table>
        
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Loader -->
      <div class="loader-cart">
        <img src="<?= base_url('assets/images/dark-loader.gif'); ?>" alt="Loading...">
      </div>

      <!-- JS -->
      <?= $this->include("backend/common_links/js_links"); ?>

    </div>
  </div>
</body>
</html>

