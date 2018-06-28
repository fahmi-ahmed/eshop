<div class="row" style="background-color: white; min-height: 500px;">
  <?= br(2);?>
  <div class="col-md-4 col-md-offset-2">
    <?= form_open('Staff/relation','class="form-signin"');?>
          <div class="form-group">
            <?php $attributes = 'id="delivery" class="form-control"';
            echo form_dropdown('delivery', $delivery, set_value('delivery'), $attributes); ?>
            <b style="color: red;"><?php echo form_error('delivery'); ?></b>
          </div>
          <div class="col-md-2 col-md-offset-9">
            <button class="btn btn-default" type="submit">create relations</button>
          </div>
          <?php if ($msg): ?>
            <p><?= $msg; ?></p>
          <?php endif; ?>
    <?= form_close(); ?>
  </div>
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
