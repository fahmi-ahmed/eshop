<!-- JAVASCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= base_url('bootstrap/docs/assets/js/vendor/jquery.min.js'); ?>"><\/script>')</script>
<script src="<?= base_url('bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?= base_url('bootstrap/docs/assets/js/docs.min.js');?>"></script>
<script src="<?= base_url('bootstrap/docs/assets/js/vendor/jquery.min.js');?>"></script>
<script src="<?= base_url('bootstrap/dist/js/jquery.min.js');?>"></script>
<script src="<?= base_url('bootstrap/dist/js/jquery.backtotop.js');?>"></script>
<script src="<?= base_url('bootstrap/dist/js/jquery.mobilemenu.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/ckfinder/ckfinder.js');?>"></script>

<script src="<?= base_url('assets/js/jquery-3.3.1.js');?>"></script>
<script src="<?= base_url('assets/js/highcharts.js');?>"></script>
<script src="<?= base_url('assets/js/highcharts.src.js');?>"></script>

<script type="text/javascript" src="<?= base_url('assets/fusion/fusioncharts.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/fusion/fusioncharts.theme.ocean.js');?>"></script>

<script type="text/javascript">
  pro_carousel();
  function pro_carousel() {
      var i;
      var x = document.getElementsByClassName("pro_slides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      slideIndexn++;
      if (slideIndexn > x.length) {slideIndexn = 1}
      x[slideIndexn-1].style.display = "block";
      setTimeout(pro_carousel, 5000); // Change image every 5 seconds
  }
</script>

<script type="text/javascript">
  $('#type').change(function(){
      var type_id = $(this).val();
      $("#subtype > option").remove();
      $.ajax({
          type: "POST",
          url: "<?php echo site_url('Staff/populate_subtype'); ?>",
          data: {id: type_id},
          dataType: 'json',
          success:function(data){
              $.each(data,function(k, v){
                  var opt = $('<option />');
                  opt.val(k);
                  opt.text(v);
                  $('#subtype').append(opt);
              });
              //$('#subtype').append('<option value="' + id + '">' + name + '</option>');
          }
      });
  });
</script>

<script type="text/javascript">
  document.getElementById("droplistc").onclick = function() {
    if(document.getElementById("droplistc").checked) {
      document.getElementById("listc").style.display = "block";
    }else {
      document.getElementById("listc").style.display = "none";
    }
  };
  document.getElementById("listc").style.display = "none";

  document.getElementById("droplistl").onclick = function() {
    if(document.getElementById("droplistl").checked) {
      document.getElementById("listl").style.display = "block";
    }else {
      document.getElementById("listl").style.display = "none";
    }
  };
  document.getElementById("listl").style.display = "none";

  document.getElementById("droplistd").onclick = function() {
    if(document.getElementById("droplistd").checked) {
      document.getElementById("listd").style.display = "block";
    }else {
      document.getElementById("listd").style.display = "none";
    }
  };
  document.getElementById("listd").style.display = "none";

  document.getElementById("droplistgl").onclick = function() {
    if(document.getElementById("droplistgl").checked) {
      document.getElementById("listgl").style.display = "block";
    }else {
      document.getElementById("listgl").style.display = "none";
    }
  };
  document.getElementById("listgl").style.display = "none";

  document.getElementById("droplistm").onclick = function() {
    if(document.getElementById("droplistm").checked) {
      document.getElementById("listm").style.display = "block";
    }else {
      document.getElementById("listm").style.display = "none";
    }
  };
  document.getElementById("listm").style.display = "none";

  document.getElementById("droplisth").onclick = function() {
    if(document.getElementById("droplisth").checked) {
      document.getElementById("listh").style.display = "block";
    }else {
      document.getElementById("listh").style.display = "none";
    }
  };
  document.getElementById("listh").style.display = "none";

  document.getElementById("droplistpcg").onclick = function() {
    if(document.getElementById("droplistpcg").checked) {
      document.getElementById("listpcg").style.display = "block";
    }else {
      document.getElementById("listpcg").style.display = "none";
    }
  };
  document.getElementById("listpcg").style.display = "none";

  document.getElementById("droplistmb").onclick = function() {
    if(document.getElementById("droplistmb").checked) {
      document.getElementById("listmb").style.display = "block";
    }else {
      document.getElementById("listmb").style.display = "none";
    }
  };
  document.getElementById("listmb").style.display = "none";

  document.getElementById("droplistr").onclick = function() {
    if(document.getElementById("droplistr").checked) {
      document.getElementById("listr").style.display = "block";
    }else {
      document.getElementById("listr").style.display = "none";
    }
  };
  document.getElementById("listr").style.display = "none";

  document.getElementById("droplisthp").onclick = function() {
    if(document.getElementById("droplisthp").checked) {
      document.getElementById("listhp").style.display = "block";
    }else {
      document.getElementById("listhp").style.display = "none";
    }
  };
  document.getElementById("listhp").style.display = "none";

  document.getElementById("droplistip").onclick = function() {
    if(document.getElementById("droplistip").checked) {
      document.getElementById("listip").style.display = "block";
    }else {
      document.getElementById("listip").style.display = "none";
    }
  };
  document.getElementById("listip").style.display = "none";

  document.getElementById("droplistt").onclick = function() {
    if(document.getElementById("droplistt").checked) {
      document.getElementById("listt").style.display = "block";
    }else {
      document.getElementById("listt").style.display = "none";
    }
  };
  document.getElementById("listt").style.display = "none";

  document.getElementById("droplistgt").onclick = function() {
    if(document.getElementById("droplistgt").checked) {
      document.getElementById("listgt").style.display = "block";
    }else {
      document.getElementById("listgt").style.display = "none";
    }
  };
  document.getElementById("listgt").style.display = "none";

  document.getElementById("droplistx").onclick = function() {
    if(document.getElementById("droplistx").checked) {
      document.getElementById("listx").style.display = "block";
    }else {
      document.getElementById("listx").style.display = "none";
    }
  };
  document.getElementById("listx").style.display = "none";

</script>

</body>
</html>
