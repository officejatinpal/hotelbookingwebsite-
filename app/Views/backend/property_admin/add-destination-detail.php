<?php
if(isset($dd_res) && ($dd_res != false))
{
    $btnname = "Update";
    $task = "update";
    $title = 'Update Detail : '.$desti_name;
       
    $dd_id = $dd_res[0]->id ;
    $dd_title = $dd_res[0]->title ;
    $dd_slug = $dd_res[0]->slug ;
    $dd_detail = $dd_res[0]->detail ;
    $dd_image = $dd_res[0]->image ;
}
else
{
    $btnname = "Submit";
    $task = "insert"; 
    $title = 'Add Destination Detail : '.$desti_name;

    $dd_id = $dd_title = $dd_slug = $dd_detail = $dd_image = '';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title><?=WEB_TITLE?></title>
    <link rel="icon" href="<?=base_url('assets/images/favicon.ico')?>" type="image/x-icon">

    <?php $this->load->view("common_links/css_links.php"); ?>    

    <style type="text/css">
      label.t-title {
        display: block;
    font-size: 16px;
    text-transform: capitalize;
    position: relative;
    top: -10px;
    left: 5px
  }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span></span>Propery Admin</a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <?php include("sidebar.php");?>

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
            
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
<?php include("header.php");?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!-- <div class="page-title">
              <div class="title_left">
                <h3><?=$title?></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h3><?=$title?></h3>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

    <form id="add_form"  class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Title</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12" value='<?=$dd_title?>'>
                          <div class="titleErr"></div>                          
                        </div>
                      </div>   

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Image</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input  type="file" name="image" accept="image/*" class="form-control col-md-7 col-xs-12">
                          <div class="imgErr"></div>        
                        </div>

                  <?php if(isset($dd_res) && ($dd_res!=false)){ ?>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Current Image</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <img src="<?=DESTI_IMG_PATH.$dd_image?>" width="50%">
                        </div>
                  <?php } ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Detail</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <!-- <textarea cols="30" rows="5"  class="ckeditor" name="detail"  id="editor" class="form-control textarea" required><?=$dd_detail?></textarea> -->
                          <textarea cols="30" rows="10" class="form-control col-md-7 col-xs-12" name="detail" id="detail"><?=$dd_detail?></textarea>
                          <div class="detailErr"></div>        
                        </div>
                      </div>       
                          <input type="hidden" name="desti_id" value="<?=$desti_id?>">

                      <?php if ($task == 'update') { ?>
                          <input type="hidden" name="dd_id" value="<?=$dd_id?>">
                          <input type="hidden" name="old_image" value="<?=$dd_image?>">
                      <?php } ?>

                      <!-- <div class="ln_solid"></div> -->
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">  

						  <button class="btn btn-primary" type="reset">Reset</button>   
                                       
                          <button type="submit" class="btn btn-success submit" id="<?=$task?>" name="<?=$btnname?>" > <?=$btnname?> </button>
                        </div>
                      </div>

</form>
                  </div>
                </div>
              </div>
            </div>

            
        <!-- /page content -->

        <!-- footer content -->
        
        <!-- /footer content -->
      </div>
    </div>

   
    <div class="loader-cart" style="display: none;">
        <img src="<?=base_url('assets/images/dark-loader.gif')?>">
    </div>

    <?php $this->load->view("common_links/js_links.php"); ?>

    <script type="text/javascript">
      $(document).ready(function(){
               
        $('.submit').on('click', function(e){
          e.preventDefault();

          var task = $(this).attr("id");
          var url = '<?=base_url()."webmaster/destination_detail_process/"?>'+task;

          $('.loader-cart').show();

          // var form = document.getElementById('add_form');  //returns a HTML DOM Object
          // var form = $('#add_form');                       //returns a jQuery Object
          var form = $('#add_form')[0];                       //returns a HTML DOM Object
          var formData = new FormData(form);
          // or
          // var formData = new FormData(this);

          $.ajax({

              url: url,
              type: 'POST',
              data: formData,
              dataType:'JSON',
              contentType: false,
              processData: false,
              success: function(response) {

                $('.loader-cart').hide();

                if(response['status']==0) {

                  if(response['title'] != '') {
                    $('.titleErr').html('<div style="color: red">'+response['title']+'</div>');
                  } else {
                    $('.titleErr').html('');
                  }

                  if(response['detail'] != '') {
                    $('.detailErr').html('<div style="color: red">'+response['detail']+'</div>');
                  } else {
                    $('.detailErr').html('');
                  }
                  
                  if(response['Image'] != '') {
                    $('.imgErr').html('<div style="color: red">'+response['Image']+'</div>');
                  } else {
                    $('.imgErr').html('');
                  }

                  alert('Please fill all required fields')
                }
                else
                {
                    alert(response['message']);
                    
                    if(response['status']==1) {

                    //   if (task=='insert') {
                    //     $('.feaErr, .cateErr , .nameErr').html('');
                    //     $('#add_form').trigger("reset");                    
                    //   }  
                    //   if (task=='update') {
                        location.reload();
                    //   }                      
                    }
                }
              }
          });
      });          

            

    });

    </script>

    <script type="text/javascript">
      window.setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
        });
      }, 2000);
    </script>

  </body>
</html>
