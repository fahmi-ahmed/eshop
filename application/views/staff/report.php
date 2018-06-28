  <!-- load library jquery dan highcharts -->
  
  <!-- end load library -->

  <?php
      /* Mengambil query report*/
      foreach($report as $result){
          // for ($i=0; $i < count($report); $i++) {
              # code...
          $bulan[] =  $result->sellername; //ambil bulan
          $value[] = (float)  $result->salesamount; //ambil nilai
          }
      // }
      /* end mengambil query*/

  ?>

  <!-- Load chart dengan menggunakan ID -->
  <div id="report"></div>
  <!-- END load chart -->

  <!-- Script untuk memanggil library Highcharts -->
  <script type="text/javascript">
  $(function () {
      $('#report').highcharts({
          chart: {
              type: 'column',
              margin: 75,
              options3d: {
                  enabled: false,
                  alpha: 10,
                  beta: 25,
                  depth: 70
              }
          },
          title: {
              text: 'Sales Report',
              style: {
                      fontSize: '18px',
                      fontFamily: 'Verdana, sans-serif'
              }
          },
          subtitle: {
             text: 'Sellers',
             style: {
                      fontSize: '15px',
                      fontFamily: 'Verdana, sans-serif'
              }
          },
          plotOptions: {
              column: {
                  depth: 25
              }
          },
          credits: {
              enabled: false
          },
          xAxis: {
              categories:  <?php echo json_encode($bulan);?>
          },
          exporting: {
              enabled: false
          },
          yAxis: {
              title: {
                  text: 'salesamount'
              },
          },
          tooltip: {
               formatter: function() {
                   return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
               }
            },
          series: [{
              name: 'Report Data',
              data: <?php echo json_encode($value);?>,
              shadow : true,
              dataLabels: {
                  enabled: true,
                  color: '#045396',
                  align: 'center',
                  formatter: function() {
                       return Highcharts.numberFormat(this.y, 0);
                  }, // one decimal
                  y: 0, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }]
      });
  });
  </script>
