<div class="row" style="background-color: white">
  <?= form_open('Staff/editaccount','class="form-signin"'); ?>
  <?php foreach ($result2 as $row) : ?>
    <?= br(2); ?>
      <div>
        <p>Full name: </p>
        <?= form_input('full_name', $row->fname, 'class="form-control"'); ?>
        <b style="color: red;"><?php echo form_error('full_name'); ?></b>
      </div>
      <div>
      	<p>User name: </p>
      	<?= form_input('user_name', $row->uname, 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('user_name'); ?></b>
      </div>
      <div>
      	<p>Email: </p>
      	<?= form_input('email', $row->email, 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('email'); ?></b>
      </div>
      <div>
      	<p>Password: </p>
      	<?= form_input('password', '', 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('password'); ?></b>
      </div>
      <div>
      	<p>Kebele: </p>
      	<?= form_input('kebele', $row->Kebele, 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('kebele'); ?></b>
      </div>
      <div>
      	<p>House Number: </p>
      	<?= form_input('houseno', $row->housenumber, 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('houseno'); ?></b>
      </div>
      <div>
      	<p>Mobile: </p>
      	<?= form_input('mobile', $row->mobile, 'class="form-control"'); ?>
      	<b style="color: red;"><?php echo form_error('mobile'); ?></b>
      </div>
      <hr />
    <div class="row" style="background-color: white">
      <div class="col-md-6 col-md-offset-3">
        <center><button class="btn btn-primary" type="submit" >Update</button></center>
      </div>
    </div>
    <?php echo form_hidden('id', $row->uid); ?>
  <?php endforeach; ?>
  <?= form_close(); ?>
</div>
