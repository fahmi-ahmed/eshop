<div class="row" style="background-color: white">
  <br>
  <br>
</div>
<div class="row" style="background-color: white">
  <div class="col-md-8 col-md-offset-2">
    <h2><?php echo "confirm your Deletion?" ?></h2>
    <?php echo form_open('Satff/delete'); ?>
    <?php foreach ($query as $row) : ?>
    <div class="row">
    <h1><?= $row->topic; ?></h1>
    </div>
    <div class="row">
    <?= word_limiter($row->disc,'200'); ?>
    </div>
    <br /><br />
    <?php echo form_submit('submit','delete', 'class="btn btn-default"'); ?>
    or <?php echo anchor('Staff/article','cancel');?>
    <?php echo form_hidden('id', $row->id); ?>
    <?php endforeach; ?>
    <?php echo form_close() ; ?>
  </div>
</div>
<div class="row" style="background-color: white">
  <br>
  <br>
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
