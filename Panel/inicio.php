<?php
 session_start();
 if(!$_SESSION["valido"]){
  header("location:index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<?php
    include "includes/menus/head.php";
  ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
    require_once "includes/controller.php";
    require_once "includes/crud.php";
    include "includes/menus/header.php";
    include "includes/menus/menuAdmin.php";
    $inventario = new MvcController();
    $operaciones = new MvcController();
  ?>

  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel
        <small>Version 1.0</small>
      </h1>
    </section>


    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                $operaciones -> ctlCuentaCompras("salidas");
                ?>
              </h3>

              <p>Ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="listaVentas.php" class="small-box-footer">Mas... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                $operaciones -> ctlCuentaCompras("entradas");
                ?>
              </h3>

              <p>Compras</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="listaCompras.php" class="small-box-footer">Mas... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reporte Mensual</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <div class="col-md-6">
                  <p class="text-center">
                    <strong>Ventas</strong>
                  </p>
                  <div class="chart">
                    <canvas id="graficaVentas" style="height: 180px;"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                  <p class="text-center">
                    <strong>Compras</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="graficaCompras" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL INGRESOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COSTO</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL GANANCIA</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <!-- <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">   <!-- Seccion de Inventarios -->
        <div class="col-md-5">
          <div class="box">
            <div class="box-body">
              <div class="box-header with-border">
              <h3 class="box-title">Inventarios</h3>
            </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="progress-group">
                    <span class="progress-text">Alfalfa</span>
                    <?php
                      $inventario -> ctlBuscarInventario("AL");
                    ?>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Avena</span>
                    <?php
                      $inventario -> ctlBuscarInventario("AV");
                    ?>

                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Rastrojo</span>
                    <?php
                      $inventario -> ctlBuscarInventario("RA");
                    ?>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Zacate</span>
                    <?php
                      $inventario -> ctlBuscarInventario("ZA");
                    ?>
                  </div>
                  <!-- /.progress-group -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




    </section>

  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include "includes/menus/footer.php";
  ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- ChartJS
<script src="bower_components/chart.js/Chart.js"></script>-->
<script src="dist/Chart.js"></script>
<script src="dist/Chart.min.js"></script>

<!-- Morris.js charts
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>-->

<!-- Sparkline
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>-->

<!-- jvectormap
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->


<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker-->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker-->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes
<script src="dist/js/demo.js"></script>-->
<?php
  $grafica = new MvcController();
  $grafica -> grafica1Controller();
?>

<script>
  var ctx = document.getElementById('graficaVentas').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Ene', 'Feb', 'Marzo', 'Abril', 'Mayo', 'Jun'],
          datasets: [{
              label: '# of Votes',
              data: [12, 0, 3, 5, 2, 3],
              backgroundColor: [
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)'
              ],
              borderColor: [
                  'rgba(255, 99, 0, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          },
          {
              label: '# of Horses',
              data: [7, 15, 6, 16, 10, 3],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }

          ]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>
<script>
  var ctx2 = document.getElementById('graficaCompras').getContext('2d');
  var myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
          labels: ['Ene', 'Feb', 'Marzo', 'Abril', 'Mayo', 'Jun'],
          datasets: [{
              label: '# of Votes',
              data: [12, 0, 3, 5, 2, 3],
              backgroundColor: [
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)',
                  'rgba(255, 99, 0, 0.5)'
              ],
              borderColor: [
                  'rgba(255, 99, 0, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          },
          {
              label: '# of Horses',
              data: [7, 15, 6, 16, 10, 3],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }

          ]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>


</body>
</html>
