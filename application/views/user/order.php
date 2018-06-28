<div class="row" style="background-color: white; height: 500px">
  <?= br(3);?>
  <?php foreach ($result as $row): ?>
    <div class="col-md-2 col-md-offset-0">
      <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/'.$table.'/'.$row->img ?>">
    </div>
    <div class="col-md-4">
      <h3><?= $row->brand; ?></h3>
      <p><?= $row->name; ?></p>
      <p><?= $row->price; ?></p>
      <p><?= '('.$row->amount.') left';?></p>
      <p><?= 'Seller: '. $row->sellername; ?></p>
      <?= form_open('User/order','class="form-signin"'); ?>
        <input class="form-control" style="width: 200px" type="number" name="amount" placeholder="order amount">
        <b style="color: red;"><?php echo form_error('amount'); ?></b>
        <br>
        <?= form_hidden('table',$table);?>
        <?= form_hidden('id',$id);?>
        <center><button class="btn btn-default" type="submit" id="pay">Order</button></center>
        <br>
        <br>
        <?php if ($error): ?>
          <p><?= $error; ?></p>
        <?php endif; ?>
      <?= form_close(); ?>
    </div>
  <?php endforeach; ?>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
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
