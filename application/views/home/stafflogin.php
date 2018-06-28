<?= br(3); ?>
<div class="container-in">
  <?= form_open('Home/staff','class="form-signin" name="login"'); ?>
  	<div class="row">
      <h3 style="color: white;">LOGIN</h3>
      <input style="color: white;" class="form-control" type="email" name="email" placeholder="email:" autofocus>
      <b style="color: red;"><?php echo form_error('email'); ?></b>
      <br>
      <input id="pass" style="color: white;" class="form-control" type="password" name="password" placeholder="password:" onblur="check()">
      <b style="color: silver;" id="error"></b>
      <b style="color: red;"><?php echo form_error('password'); ?></b>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-default" type="submit" >LOGIN</button></center>
        <?= anchor('Home','Back','class="btn btn-default"'); ?>
      </div>
    </div>
  <?= form_close(); ?>
</div>

<script src="<?= base_url('bootstrap/dist/js/jquery.min.js');?>"></script>

<script type="text/javascript">
  function check() {
    if(document.login.pass.value == 12345){
      document.getElementById('error').innerHTML = "we have detected you are using a default password we advise you to change it, once you got in!";
    }
  }
</script>
