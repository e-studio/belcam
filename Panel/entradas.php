<?php
session_start();
if(!$_SESSION["valido"]){
  header("location:index.php");
  exit();
}

require_once "includes/controller.php";
require_once "includes/crud.php";
?>

<!DOCTYPE html>
<html>
<?php
    include "includes/menus/head.php";
  ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php
    include "includes/menus/header.php";
    include "includes/menus/menuAdmin.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de Entradas
      </h1>
      <br>

      <div class="col-md-12">

      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="regEntradas.php" method="post">
              <div class="box-body">


                <div class="col-xs-2">
                  <label># Operacion</label>
                  <input type="text" required name="operacion" class="form-control">
                </div>
                <div class="col-xs-3">
                  <label>Proveedor</label>
                  <input type="text" required name="proveedor" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Cod. Prod.</label>
                  <input type="text" required name="codProd" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Unidad</label>
                  <input type="text" required name="unidad" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Remolque</label>
                  <input type="text" required name="unidad1" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Op</label>
                  <input type="text" required name="op" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Kg.</label>
                  <input type="text" required name="kg" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>U.M.</label>
                  <input type="text" required name="um" class="form-control">
                </div>
                <br><br><br><br><br><br>
                <div class="col-xs-2">
                  <label>Precio</label>
                  <input type="text" required name="precio" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Calidad</label>
                  <input type="text" required name="calidad" class="form-control">
                </div>
                <div class="col-xs-3">
                  <label>Origen</label>
                  <input type="text" required name="origen" class="form-control">
                </div>
                <div class="col-xs-3">
                  <label>Destino</label>
                  <input type="text" required name="destino" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Flete</label>
                  <input type="text" required name="flete" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Maniobra</label>
                  <input type="text" required name="maniobra" class="form-control">
                </div>

                <div class="col-xs-2">
                  <label>Costo Total</label>
                  <input type="text" required name="costoTotal" class="form-control">
                </div>
                <div class="col-xs-2">
                  <label>Total Costo</label>
                  <input type="text" required name="totalCosto" class="form-control">
                </div>




              </div>

              <div class="box-footer" align="right">
                <br><br>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              <div>
                <p><strong> NOTA: ingrese todos los valores numericos SIN signo de pesos y comas ($ , ) </strong></p>
              </div>
            </form>
          </div>

      </div>



    </section>

    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://belcam.com.mx">Productos del Campo Beltr&aacute;n </a>.</strong> Todos los derechos reservados.
  </footer>

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

<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>

<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- jvectormap-->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>


<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
