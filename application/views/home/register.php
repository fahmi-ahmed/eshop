<?= br(2); ?>
<div class="container-in">
  <?= form_open('Home/register','class="form-signin"'); ?>
  	<div class="row">
      <h3 style="color: white;">Register</h3>
      <div class="col-md-6">
        <p style="color: white">User image</p>
        <input type="file" style="background-color: white;" name="userfile" size="20">
        <br>
       	<input style="color: white;" class="form-control" type="text" name="full_name" placeholder="full_name:" autofocus>
        <b style="color: red;"><?php echo form_error('full_name'); ?></b>
      	<br>
        <input style="color: white;" class="form-control" type="text" name="kebele" placeholder="Kebele:">
        <b style="color: red;"><?php echo form_error('kebele'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="text" name="houseno" placeholder="house number:">
        <b style="color: red;"><?php echo form_error('houseno'); ?></b>
        <br>
      </div>
      <div class="col-md-6">
        <input style="color: white;" class="form-control" type="text" name="user_name" placeholder="user_name:">
        <b style="color: red;"><?php echo form_error('user_name'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="email" name="email" placeholder="email:">
        <b style="color: red;"><?php echo form_error('email'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="password" name="password" placeholder="password:">
        <b style="color: red;"><?php echo form_error('password'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="text" name="mobile" placeholder="mobile">
        <b style="color: red;"><?php echo form_error('mobile'); ?></b>
      </div>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-default" type="submit" >Register</button></center>
        <hr />
        <center><b><small style="color: white;">already have an account login below</small></b></center>
        <center><?= anchor('Home/login','login','class="btn btn-default"'); ?></center>
        <?= anchor('Home','Back','class="btn btn-default"'); ?>
      </div>
    </div>
  <?= form_close(); ?>
</div>
