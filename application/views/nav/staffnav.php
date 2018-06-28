<div class="bgded" style="background-color: lightgray">
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
            <li style="color: white"><?= anchor('Staff','Post Topics'); ?></li>
            <li class="active"><a class="drop" href="#">manage</a>
              <ul>
                <li><a style="color: black" class="drop" href="#">add product</a>
                  <ul>
                    <li class="active"><?= anchor('Staff/old','already exisiting','style="color: black"'); ?></li>
                    <li><?= anchor('Staff/new','new product','style="color: black"'); ?></li>
                  </ul>
                </li>
                <li class="active"><?= anchor('Staff/orders','orders','style="color: black"'); ?></li>
                <li><?= anchor('Staff/products','Products','style="color: black"'); ?></li>
                <li class="active"><?= anchor('Staff/stat','status','style="color: black"'); ?></li>
                <li><?= anchor('Staff/relation','relations','style="color: black"'); ?></li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- ################################################################################################ -->
        <div class="col-md-2">
          <center>
            <br>
          <p style="color: white"><?= "--".$this->session->userdata('sname')."--"; ?></p>
          <?php if ($this->session->userdata('simg') == 'img'): ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/default.jpg' ?>">
          <?php else: ?>
              <img style="height: 50px; width: 50px; border-radius: 100%;" src="<?php echo base_url().'/img/user/'.$this->session->userdata('simg') ?>">
          <?php endif ?>
          <nav id="mainav">
            <ul>
              <li class="active"><a class="drop" href="#">Account</a>
                <ul>
                  <li><?= anchor('Staff/editaccount/'.$this->session->userdata('sid'),'Edit','style="color: black"'); ?></li>
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
