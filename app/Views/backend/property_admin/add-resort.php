<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Resort</title>
  <?= $this->include("backend/common_links/css_links"); ?>

  <style>
    .modal-body,.modal-footer,.modal-content{width:100%;float:left}
    .list-inline{width:100%;text-align:center}
    ul.count2 li{margin-bottom:20px!important}
    ul.widget_profile_box li:last-child{width:100%!important;text-align:center}
    ul.widget_profile_box li .profile_img{margin:0}
    .modal-title{float:left}
    .mb-2{margin-bottom:10px!important}
    .mt-2{margin-top:10px!important}
    .brdr{border-bottom:1px solid #ccc;margin-bottom:20px;padding-bottom:20px}
    .error{color:red;font-size:12px}
    .loader-cart{display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:9999}
    .loader-cart img{width:50px;height:50px}
  </style>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">

<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border:0">
      <a href="#" class="site_title"><span>Property Admin</span></a>
    </div>
    <div class="clearfix"></div>
    <?php include("sidebar.php"); ?>
  </div>
</div>

<?= include("header.php"); ?>

<div class="right_col" role="main">
<div class="row">
<div class="col-md-12">
<div class="x_panel">
<div class="x_title">
  <h2>Add Resort</h2>
  <ul class="nav navbar-right panel_toolbox">
    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
  </ul>
  <div class="clearfix"></div>
</div>

<div class="x_content">
<form id="addResortForm" action="<?= base_url('webmaster/property_admin/store'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
<?= csrf_field(); ?>

<div class="form-group">
  <label class="control-label col-md-2">Category</label>
  <div class="col-md-4">
    <select name="desti_category" id="category" class="form-control" required>
      <option value="">Select Category</option>
      <option value="Domestic">Domestic</option>
      <option value="International">International</option>
    </select>
  </div>

  <label class="control-label col-md-2">Destination</label>
  <div class="col-md-4">
    <select name="desti_id" id="city" class="form-control" required>
      <option value="">Select City</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Name</label>
  <div class="col-md-4">
    <input type="text" name="name" class="form-control" required>
  </div>

  <label class="control-label col-md-2">Property Site</label>
  <div class="col-md-4">
    <input type="text" name="external_url" class="form-control">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Longitude</label>
  <div class="col-md-4">
    <input type="text" name="longi" class="form-control">
  </div>

  <label class="control-label col-md-2">Latitude</label>
  <div class="col-md-4">
    <input type="text" name="lati" class="form-control">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Address</label>
  <div class="col-md-8">
    <input type="text" name="address" class="form-control" required>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Main Image</label>
  <div class="col-md-4">
    <input type="file" name="main_image" class="form-control" accept="image/*" required>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Description</label>
  <div class="col-md-8">
    <textarea name="descr" class="form-control" rows="5" required></textarea>
  </div>
</div>

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


<?= $this->include("backend/common_links/js_links"); ?>

<script>
$(document).ready(function () {

$('#addResortForm').submit(function (e) {
e.preventDefault();

var formData = new FormData(this);
$('.loader-cart').show();

$.ajax({
url: $(this).attr('action'),
type: 'POST',
data: formData,
contentType: false,
processData: false,
dataType: 'json',
complete:function(){
$('.loader-cart').hide();
},
success:function(response){
if(response.status === 'success'){
alert(response.message);
$('#addResortForm')[0].reset();
}else{
alert(response.message);
}
},
error:function(xhr){
let msg = 'Resort already exists. Please choose a different name.';
try{
let res = JSON.parse(xhr.responseText);
if(res.message){
msg = res.message;
}
}catch(e){
if(xhr.responseText){
msg = xhr.responseText;
}
}
alert(msg);
}
});

});

$('#category').change(function () {
var category = $(this).val();
if(category){
$.ajax({
url:"<?= base_url('webmaster/getCitiesByCategory'); ?>",
type:"POST",
data:{category:category},
dataType:"json",
success:function(response){
let html = '<option value="">Select City</option>';
if(response.status === 'success'){
response.cities.forEach(function(city){
html += '<option value="'+city.id+'">'+city.name+'</option>';
});
}
$('#city').html(html);
},
error:function(){
$('#city').html('<option value="">Select City</option>');
}
});
}else{
$('#city').html('<option value="">Select City</option>');
}
});

});
</script>


</div>
</div>
</body>
</html>
