<div class="container-in">
  <?= form_open_multipart('users/signup','class="form-signin"'); ?>
    <?php if ($data !== 'none'): ?>
      <b style="color: red;"><?= $this->session->flashdata('error'); ?></b>
    <?php endif ?>
  	<div class="row">
      <h1 style="color: white;"><?= $this->lang->line('signup'); ?></h1>
      <div class="col-md-6">
        <b style="color: white;">User Image</b><small style="color: white;">(optional)</small>
        <input style="color: white;" type="file" style="background-color: white;" name="userfile" size="20">
        <br>
       	<input style="color: white;" class="form-control" type="text" name="full_name" placeholder="full_name" autofocus>
        <b style="color: red;"><?php echo form_error('full_name'); ?></b>
      	<br>
        <input style="color: white;" class="form-control" type="text" name="user_name" placeholder="user_name">
        <b style="color: red;"><?php echo form_error('user_name'); ?></b>
      </div>
      <div class="col-md-6">
        <input style="color: white;" class="form-control" type="email" name="email" placeholder="email">
        <b style="color: red;"><?php echo form_error('email'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="password" name="password" placeholder="password">
        <b style="color: red;"><?php echo form_error('password'); ?></b>
        <br>
        <input style="color: white;" class="form-control" type="number" name="mobile" placeholder="mobile">
        <b style="color: red;"><?php echo form_error('mobile'); ?></b>
      </div>
    </div>
    <br />
    <hr />
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <input style="color: white;" class="form-control" type="text" name="std_id" placeholder="std_id(only for students)">
        <br />
        <center><button class="btn btn-primary" type="submit" ><?= $this->lang->line('signup'); ?></button></center>
        <hr />
        <center><b><small style="color: white;"><?= $this->lang->line('login_link'); ?></small></b></center>
        <center><?= anchor('users',$this->lang->line('login'),'class="btn btn-default"'); ?></center>
      </div>
    </div>
  <?= form_close(); ?>
</div>