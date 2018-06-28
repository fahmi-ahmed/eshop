<div class="row" style="background-color:white; height: 500px;">
  <br>
  <?= form_open('Staff/new','class="form-signin"');?>
    <div class="row">
      <div class="col-md-6 col-md-offset-1">
        <h2>ADD new product!</h2>
        <br>
        <p><?= 'from '.$this->session->userdata('sname'); ?></p>
        <div class="form-group">
          <?php $attributes = 'id="type" class="form-control"';
          echo form_dropdown('type', $type, set_value('type'), $attributes); ?>
          <b style="color: red;"><?php echo form_error('type'); ?></b>
        </div>
        <div class="form-group">
          <?php $attributes = 'id="subtype" class="form-control"';
          echo form_dropdown('subtype', $subtype, set_value('subtype'), $attributes); ?>
          <b style="color: red;"><?php echo form_error('subtype'); ?></b>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 col-md-offset-9">
        <button class="btn btn-default" type="submit" >NEXT</button>
      </div>
    </div>
  <?= form_close(); ?>
  <br>
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
