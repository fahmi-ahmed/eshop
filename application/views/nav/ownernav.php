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
            <li style="color: white"><?= anchor('Staff/owner','Home'); ?></li>
            <li class="active"><a class="drop" href="#">manage</a>
              <ul>
                <li class="active"><?= anchor('Staff/add','add staff','style="color: black"'); ?></li>
                <li><?= anchor('Staff/terminate','Terminate','style="color: black"'); ?></li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- ################################################################################################ -->
        <div class="col-md-2">
          <center>
          <p style="color: white"><?= "--".$this->session->userdata('oname')."--"; ?></p>
          <?php if ($this->session->userdata('oimg') == 'img'): ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/default.jpg' ?>">
          <?php else: ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/'.$this->session->userdata('oimg') ?>">
          <?php endif ?>
          <nav id="mainav">
            <ul>
              <li style="color: white"><a class="drop" href="#">Account</a>
                <ul>
                  <li><?= anchor('Staff/logout','Logout','style="color: black"'); ?></li>
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
