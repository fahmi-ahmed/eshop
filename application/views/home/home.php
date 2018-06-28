<div class="row">
  <div id="logo" class="col-md-4 col-md-offset-2">
    <b><h1 style="color: lightpink;">E-SHOPPING</h1></b>
  </div>
  <div class="col-md-2 col-md-offset-4" style="padding-top:15px;">
    <p><?= anchor('Home/staff','Staff login','class="btn btn-default"'); ?></p>
  </div>
</div>
<div class="wrapper coloured">
  <!-- ################################################################################################ -->
  <div class="row">
    <center><section id="cta" class="clear">
      <div class="col-md-8 col-md-offset-2">
        <h5 class="uppercase nospace">Want to buy your electronics with out leaving your home, if so you are in the right place!</h5>
        <p class="nospace">join us and order what you want</p>
        <p style="width: 150px"><?= anchor('home/register','Register','class="btn btn-default"'); ?></p>
        <p class="nospace">if you have an account just login below!</p>
        <p style="width: 150px"><?= anchor('home/login','Login','class="btn btn-default"'); ?></p>
      </div>
    </section></center>
  </div>
</div>
<br>
<div class="row" style="background-color: white">
  <br>
  <br>
</div>
<?= br(2);?>
<!-- Carousel
================================================== -->
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <?php foreach ($result as $row): ?>
        <img class="first-slide" src="<?php echo base_url().'/proimages/laptop/'.$row->img ?>">
        <div class="carousel-caption">
          <p><?= $row->name.', '.$row->processor.', '.$row->hdd.', '.$row->ram ;?></p>
          <p><?= $row->connectivity.', '.$row->usb.', '.$row->cam ;?></p>
          <p><?= '('.$row->amount.') left'; ?></p>
        </div>
      <?php endforeach ?>
    </div>
    <div class="item">
      <?php foreach ($result1 as $row): ?>
        <img class="third-slide" src="<?php echo base_url().'/proimages/mobile/'.$row->img ?>">
        <div class="carousel-caption">
          <p><?= $row->name.', '.$row->processor.', '.$row->memory.', '.$row->ram ;?></p>
          <p><?= $row->display.', '.$row->camera.', '.$row->batterylife ;?></p>
          <p><?= '('.$row->amount.') left'; ?></p>
        </div>
      <?php endforeach ?>
    </div>
    <div class="item">
      <?php foreach ($result2 as $row): ?>
        <img class="fifth-slide" src="<?php echo base_url().'/proimages/pcgames/'.$row->img ?>">
        <div class="carousel-caption">
          <p><?= $row->name ;?></p>
          <p><?= '('.$row->amount.') left'; ?></p>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><!-- /.carousel -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
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
    <div class="col-md-5 col-md-offset-1">
      <h4 class="title">Contact Us</h4>
      <address class="btmspace-15">
      Ethio Electronic Shop<br>
      AA  Street &amp; 12<br>
      AA <br>
      Postcode/Zip: 5463
      </address>
      <ul class="nospace">
        <li class="btmspace-10"><span class="fa fa-phone"></span> +00 (123) 456 7890</li>
        <li><span class="fa fa-envelope-o"></span> Ethio@e-shop.com</li>
      </ul>
    </div>
    <div class="col-md-5">
      <h4 class="title">About Us</h4>
      <ul class="nospace linklist">
        <li>E-shopping is a place where you can buy and sell products online</li>
        <li>We aim to create a easy way of shopping experiance for our clients</li>
        <li>Developed by Team of DDU students</li>
        <ul>
          <li>Lead Web Designer-(Helina Habtamu)</li>
          <li>Lead Database Designer-(Bethelhem Afework)</li>
          <li>Lead Coder-(Fahmi Ahmed)</li>
        </ul>
      </ul>
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
