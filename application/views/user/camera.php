<div class="row" style="background-color: white">
<?= br(2); ?>
    <div class="col-md-8 col-md-offset-6">
    <?php
    $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
    echo form_open("User/searchcamera", $attr);?>
        <div class="form-group">
            <div class="col-md-4">
                <input class="form-control" id="name" name="name" placeholder="Search for camera..." type="text" value="<?= set_value('name'); ?>" />
            </div>
            <div class="col-md-8">
              <select name="searchby">
                  <option value="" disabled selected>--Search by--</option>
                  <option value="1">name</option>
                  <option value="2">brand</option>
                  <option value="3">lensesize</option>
              </select>
              <b style="color: red;"><?php echo form_error('searchby'); ?></b>
                <button id="btn_search" name="btn_search" type="submit" class="btn btn-default">search</button>
                <a href="<?= base_url('index.php/User/camera'); ?>" class="btn btn-default">Show All</a>
            </div>
        </div>
    <?php echo form_close(); ?>
    </div>
</div>
<div class="row" style="background-color: white">
    <hr>
        <?php if ($cameralist): ?>
            <?php for ($i = 0; $i < count($cameralist); ++$i) { ?>
                  <?php if ($cameralist[$i]->amount > 0): ?>
                    <div class="col-md-2 col-md-offset-0">
                      <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/camera/'.$cameralist[$i]->img ?>">
                    </div>
                    <div class="col-md-4">
                      <p><?= $cameralist[$i]->brand; ?></p>
                      <p><?= $cameralist[$i]->name; ?></p>
                      <p><?= $cameralist[$i]->lensesize.' '.$cameralist[$i]->sdcard; ?></p>
                      <p><?= $cameralist[$i]->amount.' (left)'; ?></p>
                      <p><?= $cameralist[$i]->price; ?></p>
                      <p><?= 'from '.$cameralist[$i]->sellername; ?></p>
                      <p><?= anchor('User/order/camera/'.$cameralist[$i]->id,'Order','class="btn btn-default"'); ?></p>
                    </div>
                  <?php endif; ?>
            <?php } ?>
        <?php else: ?>
            <p style="color: red; padding-left: 20px;">No result found, try another!</p>
        <?php endif ?>
</div>

<div class="row">
    <div class="col-md-8">
        <center><?= $pagination; ?></center>
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
