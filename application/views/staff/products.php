<div class="row" style="background-color: white">
  <div class="col-md-3 col-md-offset-1">
    <h2>Camera <input type="checkbox" id="droplistc"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <?= br(2);?>
  <div id="listc">
  <?php foreach ($camera as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/camera/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->lensesize.' '.$row->sdcard; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Laptop <input type="checkbox" id="droplistl"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listl">
  <?php foreach ($laptop as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/laptop/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->processor.' '.$row->hdd; ?></p>
        <p><?= $row->usb.' '.$row->cam; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Desktop <input type="checkbox" id="droplistd"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listd">
  <?php foreach ($desktop as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/desktop/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->processor.' '.$row->hdd; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Gaming Laptop <input type="checkbox" id="droplistgl"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listgl">
  <?php foreach ($gaminglaptop as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/gaminglaptop/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->processor.' '.$row->hdd; ?></p>
        <p><?= $row->ram.' '.$row->resolution; ?></p>
        <p><?= $row->graphics.' '.$row->batterylife; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Mobile <input type="checkbox" id="droplistm"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listm">
  <?php foreach ($mobile as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/mobile/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->processor.' '.$row->memory; ?></p>
        <p><?= $row->display.' '.$row->ram; ?></p>
        <p><?= $row->camera.' '.$row->batterylife; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Harddisk <input type="checkbox" id="droplisth"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listh">
  <?php foreach ($harddisk as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/harddisk/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->size.' '.$row->usb; ?></p>
        <p><?= $row->cache; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>PC Games <input type="checkbox" id="droplistpcg"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listpcg">
  <?php foreach ($pcgames as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/pcgames/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>motherboard <input type="checkbox" id="droplistmb"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listmb">
  <?php foreach ($motherboard as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/motherboard/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->expansionslot.' '.$row->ramslot; ?></p>
        <p><?= $row->cpusocket.' '.$row->bios; ?></p>
        <p><?= $row->cmosbattery.' '.$row->connector; ?></p>
        <p><?= $row->usb.' '.$row->powerconnector; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Ram <input type="checkbox" id="droplistr"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listr">
  <?php foreach ($ram as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/ram/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->size.' '.$row->pin; ?></p>
        <p><?= $row->ramtype.' '.$row->model; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>headphone <input type="checkbox" id="droplisthp"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listhp">
  <?php foreach ($headphone as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/headphone/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->features; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>ipad <input type="checkbox" id="droplistip"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listip">
  <?php foreach ($ipad as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/ipad/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->screensize.' '.$row->connection; ?></p>
        <p><?= $row->memory.' '.$row->tools; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>tablet <input type="checkbox" id="droplistt"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listt">
  <?php foreach ($tablet as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/tablet/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->screensize.' '.$row->processor; ?></p>
        <p><?= $row->memory; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Gamingtools <input type="checkbox" id="droplistgt"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listgt">
  <?php foreach ($gamingtools as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/gamingtools/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->tooltype; ?></p>
        <p><?= $row->memory; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="row" style="background-color: white">
  <hr>
  <div class="col-md-3 col-md-offset-1">
    <h2>Xbox <input type="checkbox" id="droplistx"></h2>
  </div>
</div>
<div class="row" style="background-color: white">
  <div id="listx">
  <?php foreach ($xbox as $row): ?>
    <?php if ($row->amount > 0): ?>
      <div class="col-md-2 col-md-offset-0">
        <img style="height: 200px; width: 200px;" src="<?php echo base_url().'/proimages/xbox/'.$row->img ?>">
      </div>
      <div class="col-md-4">
        <b><h3><?= $row->brand; ?></h3></b>
        <p><?= $row->name; ?></p>
        <p><?= $row->size; ?></p>
        <p><?= $row->memory; ?></p>
        <p><?= $row->amount.' (left)'; ?></p>
        <p><?= $row->price; ?></p>
        <p><?= 'from '. $sellername; ?></p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="row">
  <footer >
    <!-- ################################################################################################ -->
    <div class="col-md-3 col-md-offset-1">
      <h3 class="title">Company Details</h3>
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
      <h3 class="title">Company Info.</h3>
      <ul class="nospace linklist">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h3 class="title">Map</h3>
      <div id="map">

      </div>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="row">
  <center><div>
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Ethio Electronics</a></p>
    <!-- ################################################################################################ -->
  </div></center>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
