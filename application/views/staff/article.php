<div class="row" style="background-color: white">
  <?= br(2);?>
</div>
<div class="row" style="background-color: white">
    <div class="col-md-8 col-md-offset-6">
    <?php
    $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
    echo form_open("Staff/search", $attr);?>
        <div class="form-group">
            <div class="col-md-6">
                <input class="form-control" id="topic" name="topic" placeholder="Search for articles..." type="text" value="<?= set_value('topic'); ?>" />
            </div>
            <div class="col-md-6">
                <button id="btn_search" name="btn_search" type="submit" class="btn btn-default">search</button>
                <a href="<?= base_url('index.php/Staff/article'); ?>" class="btn btn-default">Show All</a>
            </div>
        </div>
    <?php echo form_close(); ?>
    </div>
</div>
<div class="row" style="background-color: white">
  <hr>
</div>
<div class="row" style="background-color: white; min-height: 400px">
    <div class="col-md-12 col-md-offset-0">
        <?php if ($topiclist): ?>
            <?php for ($i = 0; $i < count($topiclist); ++$i) { ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <h3><?= $topiclist[$i]->topic; ?></h3>
                        <hr>
                        <p><?= word_limiter($topiclist[$i]->disc,'100'); ?></p>
                        <?php
                            echo anchor('Staff/edit/'.$topiclist[$i]->id,'EDIT','class="btn btn-default"');
                            echo " ";
                            echo " ";
                            echo anchor('Staff/delete/'.$topiclist[$i]->id,'DELET','class="btn btn-default"');
                        ?>
                    </div>
                </div>
                <br>
            <?php } ?>
        <?php else: ?>
            <p style="color: red; padding-left: 20px">No result found, try another!</p>
        <?php endif ?>
    </div>
</div>

<div class="row" style="background-color: white">
    <div class="col-md-8">
        <center><?= $pagination; ?></center>
    </div>
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
