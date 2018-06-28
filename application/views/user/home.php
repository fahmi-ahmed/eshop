<div class="wrapper row3">
  <main class="container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content">
      <!-- ################################################################################################ -->
      <h1>What is getting the most attention!</h1>
      <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <?php foreach ($result as $row): ?>
                <img class="first-slide" src="<?php echo base_url().'/proimages/laptop/'.$row->img ?>">
                <div class="carousel-caption">
                  <p><?= $row->name.', '.$row->processor.', '.$row->hdd.', '.$row->ram ;?></p>
                  <p><?= $row->connectivity.', '.$row->usb.', '.$row->cam ;?></p>
                  <p><?= '('.$row->amount.') left'; ?></p>
                  <p><?= anchor('User/order/laptop/'.$row->id,'Order','class="btn btn-default"'); ?></p>
                </div>
              <?php endforeach ?>
            </div>
            <div class="item">
              <?php foreach ($result1 as $row): ?>
                <img class="second-slide" src="<?php echo base_url().'/proimages/gaminglaptop/'.$row->img ?>">
                <div class="carousel-caption">
                  <p><?= $row->name.', '.$row->processor.', '.$row->hdd.', '.$row->ram ;?></p>
                  <p><?= $row->resolution.', '.$row->graphics.', '.$row->batterylife ;?></p>
                  <p><?= '('.$row->amount.') left'; ?></p>
                  <p><?= anchor('User/order/gaminglaptop/'.$row->id,'Order','class="btn btn-default"'); ?></p>
                </div>
              <?php endforeach ?>
            </div>
            <div class="item">
              <?php foreach ($result2 as $row): ?>
                <img class="third-slide" src="<?php echo base_url().'/proimages/mobile/'.$row->img ?>">
                <div class="carousel-caption">
                  <p><?= $row->name.', '.$row->processor.', '.$row->memory.', '.$row->ram ;?></p>
                  <p><?= $row->display.', '.$row->camera.', '.$row->batterylife ;?></p>
                  <p><?= '('.$row->amount.') left'; ?></p>
                  <p><?= anchor('User/order/mobile/'.$row->id,'Order','class="btn btn-default"'); ?></p>
                </div>
              <?php endforeach ?>
            </div>
            <div class="item">
              <?php foreach ($result3 as $row): ?>
                <img class="fourth-slide" src="<?php echo base_url().'/proimages/motherboard/'.$row->img ?>">
                <div class="carousel-caption">
                  <p><?= $row->name.', '.$row->expansionslot.', '.$row->ramslot.', '.$row->cpusocket ;?></p>
                  <p><?= $row->bios.', '.$row->cmosbattery.', '.$row->connector.', '.$row->usb.', '.$row->powerconnector ;?></p>
                  <p><?= '('.$row->amount.') left'; ?></p>
                  <p><?= anchor('User/order/motherboard/'.$row->id,'Order','class="btn btn-default"'); ?></p>
                </div>
              <?php endforeach ?>
            </div>
            <div class="item">
              <?php foreach ($result4 as $row): ?>
                <img class="fifth-slide" src="<?php echo base_url().'/proimages/pcgames/'.$row->img ?>">
                <div class="carousel-caption">
                  <p><?= $row->name ;?></p>
                  <p><?= '('.$row->amount.') left'; ?></p>
                  <p><?= anchor('User/order/pcgames/'.$row->id,'Order','class="btn btn-default"'); ?></p>
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
      <hr>
      <div class="row">
        <h2>Hot Topics</h2>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
              <div class="row">
                <?php for ($i = 0; $i < count($topiclist); ++$i) { ?>
                    <div class="col-md-8 col-md-offset-1">
                        <h3><?= $topiclist[$i]->topic; ?></h3>
                        <hr>
                        <p><?= word_limiter($topiclist[$i]->disc,'100'); ?></p>
                        <p><?= 'posted by:- '.$topiclist[$i]->sellername; ?></p>
                        <?= anchor('User/selectedtopic/'.$topiclist[$i]->id,'Read more &raquo;','class="btn btn-md btn-default"'); ?>
                    </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <center><?= $pagination; ?></center>
            </div>
        </div>
      </div>
      <hr>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
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
