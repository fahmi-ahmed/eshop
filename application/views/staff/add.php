<div class="row" style="background-color: white">
<?= br(2); ?>
</div>
<div class="row" style="background-color: white">
<div class="container-in">
  <?= form_open('Staff/add','class="form-signin"'); ?>
  	<div class="row">
      <h3 style="color: white;">Register</h3>
      <div class="col-md-6">
       	<input style="color: white;" class="form-control" type="text" name="full_name" placeholder="shop_name:" autofocus>
        <b style="color: red;"><?php echo form_error('full_name'); ?></b>
      	<br>
        <input style="color: white;" class="form-control" type="text" name="kebele" placeholder="Kebele:">
        <b style="color: red;"><?php echo form_error('kebele'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="text" name="houseno" placeholder="house number:">
        <b style="color: red;"><?php echo form_error('houseno'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="text" name="mobile" placeholder="mobile">
        <b style="color: red;"><?php echo form_error('mobile'); ?></b>
        <br>
        <select name="reg" class="form-control">
            <option value="" disabled selected>--Register As--</option>
            <option value="1">Seller</option>
            <option value="2">Delivery</option>
        </select>
        <b style="color: red;"><?php echo form_error('reg'); ?></b>
      </div>
      <div class="col-md-6">
        <input style="color: white;" class="form-control" type="text" name="user_name" placeholder="user_name:">
        <b style="color: red;"><?php echo form_error('user_name'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="email" name="email" placeholder="email:">
        <b style="color: red;"><?php echo form_error('email'); ?></b>
        <br>
        <p style="color: white;" class="form-control">Password is set to 12345 by default</p>
        <br>
        <input style="color: white;" class="form-control" type="text" name="till_number" placeholder="till_number:">
        <b style="color: red;"><?php echo form_error('till_number'); ?></b>
      </div>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-default" type="submit">Register</button></center>
        <hr />
      </div>
    </div>
  <?= form_close(); ?>
</div>
</div>
<div class="row" style="background-color: white">
<?= br(2); ?>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="row">
  <footer style="color: white">
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
