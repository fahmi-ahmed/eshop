<div class="row" style="background-color: white">
<?= br(2);?>
</div>
<div class="row" style="background-color: white">
<div class="container-in">
  <?= form_open_multipart('Staff/desktop','class="form-signin"'); ?>
  	<div class="row">
      <div class="col-md-6">
        <p style="color: white">Product image</p>
        <input type="file" style="background-color: white;" name="userfile" size="20">
        <br>
        <input class="form-control" type="text" name="brandname" placeholder="brand_name" autofocus>
        <b style="color: red;"><?php echo form_error('brandname'); ?></b>
      	<br>
       	<input class="form-control" type="text" name="name" placeholder="name">
        <b style="color: red;"><?php echo form_error('name'); ?></b>
      	<br>
        <input class="form-control" type="text" name="processor" placeholder="processor">
        <b style="color: red;"><?php echo form_error('processor'); ?></b>
        <br>
        <input class="form-control" type="text" name="ram" placeholder="RAM">
        <b style="color: red;"><?php echo form_error('ram'); ?></b>
      </div>
      <div class="col-md-6">
        <input class="form-control" type="text" name="graphics" placeholder="graphics">
        <b style="color: red;"><?php echo form_error('graphics'); ?></b>
        <br>
        <input class="form-control" type="text" name="hdd" placeholder="hard disk">
        <b style="color: red;"><?php echo form_error('hdd'); ?></b>
        <br>
        <input class="form-control" type="text" name="price" placeholder="price with currency type">
        <b style="color: red;"><?php echo form_error('price'); ?></b>
        <br>
        <input class="form-control" type="text" name="amount" placeholder="amount">
        <b style="color: red;"><?php echo form_error('amount'); ?></b>
        <?= form_hidden('type', $type); ?>
      </div>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-default" type="submit" >Upload</button></center>
      </div>
    </div>
  <?= form_close(); ?>
</div>
</div>
<div class="row" style="background-color: white">
<?= br(2);?>
</div>
<div class="row">
  <footer style="color: white;">
    <!-- ################################################################################################ -->
    <div class="col-md-3 col-md-offset-1">
      <h4 class="title">Company Details</h4>
      <address class="btmspace-15">
      Ethio Electronic Shop<br>
      Sabian Street &amp; 12<br>
      Sabian<br>
      Postcode/Zip: 5463
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><span class="fa fa-phone"></span> +00 (123) 456 7890</li>
        <li><span class="fa fa-envelope-o"></span> DDES@domain.com</li>
      </ul>
    </div>
    <div class="col-md-4">
      <h4 class="title">Company Info.</h4>
      <ul class="nospace linklist">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h4 class="title">Map</h4>

    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="row">
  <center><div style="color: white">
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Ethio Electronics</a></p>
    <!-- ################################################################################################ -->
  </div></center>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
