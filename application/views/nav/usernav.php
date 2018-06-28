<div class="bgded" style="background color: darkgray">
  <div class="overlay">
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="row">
      <header>
        <!-- ################################################################################################ -->
        <div id="logo" class="col-md-3 col-md-offset-1">
          <h1 style="color: lightpink">E-SHOPPING</h1>
        </div>
        <br>
        <nav id="mainav" class="col-md-3 col-md-offset-2">
          <ul class="clear">
            <li style="color: white"><?= anchor('User','Home'); ?></li>
            <li class="active"><a class="drop" href="#">Pages</a>
              <ul>
                <li class="active"><a style="color: black" class="drop" href="#">Computer System</a>
                  <ul>
                    <li><?= anchor('User/desktop','Desktop','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/laptop','Laptop','style="color: black"'); ?></li>
                    <li><?= anchor('User/gaminglaptop','Gaming Laptop','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/mobile','Mobile','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li><a style="color: black" class="drop" href="#">Components</a>
                  <ul>
                    <li class="active"><?= anchor('User/harddisk','Hard Disk','style="color: black"'); ?></li>
                    <li><?= anchor('User/motherboard','Motherboard','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/Processor','Processor','style="color: black"'); ?></li>
                    <li><?= anchor('User/ram','RAM','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li class="active"><a style="color: black" class="drop" href="#">Electronics</a>
                  <ul>
                    <li><?= anchor('User/camera','Camera','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/headphone','Headphone','style="color: black"'); ?></li>
                    <li><?= anchor('User/ipad','ipad','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/tablet','Tablet','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li><a style="color: black" class="drop" href="#">Gaming</a>
                  <ul>
                    <li class="active"><?= anchor('User/gamingtools','Gaming Tools','style="color: black"'); ?></li>
                    <li><?= anchor('User/pcgames','PCgames','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/xbox','Xbox','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li class="active"><a style="color: black" class="drop" href="#">Networking</a>
                  <ul>
                    <li><?= anchor('User/router','Router','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/switch','Switch','style="color: black"'); ?></li>
                    <li><?= anchor('User/hub','Hub','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li><a style="color: black" class="drop" href="#">Software and Service</a>
                  <ul>
                    <li class="active"><?= anchor('User/os','OS','style="color: black"'); ?></li>
                    <li class="active"><?= anchor('User/antivirus','Anti-Virus','style="color: black"'); ?></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- ################################################################################################ -->
        <div class="col-md-2">
          <center>
            <br>
          <p style="color: white"><?= "--".$this->session->userdata('uname')."--"; ?></p>
          <?php if ($this->session->userdata('uimg') == 'img'): ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/default.jpg' ?>">
          <?php else: ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/'.$this->session->userdata('uimg') ?>">
          <?php endif ?>
          <nav id="mainav">
            <ul>
              <li style="color: white"><a class="drop" href="#">Account</a>
                <ul>
                  <li><?= anchor('User/logout','Logout','style="color: black"'); ?></li>
                  <li><?= anchor('User/terminate/'.$this->session->userdata('uid'),'Terminate','style="color: black"'); ?></li>
                </ul>
              </li>
            </ul>
          </nav>
          </center>
        </div>
      </header>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
