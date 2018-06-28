<?= br(3); ?>
<div class="container-in">
  <?= form_open('Home/login','class="form-signin"'); ?>
  	<div class="row">
      <h3 style="color: white;">LOGIN</h3>
      <input style="color: white;" class="form-control" type="email" name="email" placeholder="email:" autofocus>
      <b style="color: red;"><?php echo form_error('email'); ?></b>
      <br>
      <input style="color: white;" class="form-control" type="password" name="password" placeholder="password:">
      <b style="color: red;"><?php echo form_error('password'); ?></b>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-default" type="submit" >LOGIN</button></center>
        <hr />
        <center><b><small style="color: white;">if you are not registered yet register below</small></b></center>
        <center><?= anchor('Home/register','Register','class="btn btn-default"'); ?></center>
        <?= anchor('Home','Back','class="btn btn-default"'); ?>
      </div>
    </div>
  <?= form_close(); ?>
</div>
