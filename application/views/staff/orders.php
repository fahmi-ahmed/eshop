<div class="row" style="background-color: white; min-height: 600px">
  <?= br(2);?>
  <div class="col-md-8 col-md-offset-1">
  <table class="table table-striped">
    <thead>
      <th>
        <td>#</td>
        <td>buyer</td>
        <td>product</td>
        <td>amount</td>
        <td>mobile</td>
        <td>kebele</td>
        <td>house number</td>
        <td>payment status</td>
        <td>order date</td>
      </th>
    </thead>
<?php foreach ($result as $row): ?>
  <tbody>
    <tr>
      <td><?= $row->id ;?></td>
      <td><?= $row->buyer ;?></td>
      <td><?= $row->seller ;?></td>
      <td><?= $row->product ;?></td>
      <td><?= $row->amount ;?></td>
      <td><?= $row->mobile ;?></td>
      <td><?= $row->kebele ;?></td>
      <td><?= $row->houseno ;?></td>
      <?php if ($row->paystat == 0): ?>
        <td><?= 'not paid' ;?></td>
      <?php else: ?>
        <td><?= 'paid' ;?></td>
      <?php endif; ?>
      <td><?= date("m/d/y", strtotime($row->date));?></td>
      <?php if ($row->paystat == 0): ?>
        <td><?= anchor('Staff/check/'.$row->id,'check','class="btn btn-default"');?></td>
      <?php else: ?>
        <td><?= anchor('Staff/forward/'.$row->id,'forward','class="btn btn-default"');?></td>
      <?php endif; ?>
    </tr>
  </tbody>
<?php endforeach; ?>
</table>
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
