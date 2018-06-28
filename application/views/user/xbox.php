<div class="row" style="background-color: white">
<?= br(2); ?>
    <div class="col-md-8 col-md-offset-6">
    <?php
    $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
    echo form_open("User/searchxbox", $attr);?>
        <div class="form-group">
            <div class="col-md-6">
                <input class="form-control" id="name" name="name" placeholder="Search for xbox by name..." type="text" value="<?= set_value('name'); ?>" />
            </div>
            <div class="col-md-6">
                <button id="btn_search" name="btn_search" type="submit" class="btn btn-default">search</button>
                <a href="<?= base_url('index.php/User/xbox'); ?>" class="btn btn-default">Show All</a>
            </div>
        </div>
    <?php echo form_close(); ?>
    </div>
</div>
<div class="row" style="background-color: white">
  <hr>
        <?php if ($xboxlist): ?>
            <?php for ($i = 0; $i < count($xboxlist); ++$i) { ?>
                  <?php if ($xboxlist[$i]->amount > 0): ?>
                    <div class="col-md-2 col-md-offset-0">
                      <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/xbox/'.$xboxlist[$i]->img ?>">
                    </div>
                    <div class="col-md-4">
                      <p><?= $xboxlist[$i]->brand; ?></p>
                      <p><?= $xboxlist[$i]->name; ?></p>
                      <p><?= $xboxlist[$i]->size; ?></p>
                      <p><?= $xboxlist[$i]->amount.' (left)'; ?></p>
                      <p><?= $xboxlist[$i]->price; ?></p>
                      <p><?= 'from '.$xboxlist[$i]->sellername; ?></p>
                      <p><?= anchor('User/order/xbox/'.$xboxlist[$i]->id,'Order','class="btn btn-default"'); ?></p>
                    </div>
                  <?php endif; ?>
            <?php } ?>
        <?php else: ?>
            <p style="color: red;">No xbox by that name exists, try another!</p>
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
