<?php
session_start();
if(!$_SESSION["valido"]){
  header("location:index.php");
  exit();
}

require_once "includes/controller.php";
require_once "includes/crud.php";

function opNum(){
  setlocale(LC_ALL,"es_MX");

  $fecha = strftime('%y%m%d');
  $siguiente = new MvcController();
  $siguiente -> ctlBuscaNumOpSalidas($fecha);

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
    include "includes/menus/header.php";
    include "includes/menus/menuAdmin.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ventas
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <form role="form" action="regSalidas.php" method="post">
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Datos de venta</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-2">
                        <label># Operacion</label>
                        <!-- <input type="text" required name="operacion" id="operacion" class="form-control" onchange="buscaSalida(this.value)"> -->
                        <input type="text" id="operacion" name="operacion" value="" class="form-control" onblur="buscaSalida(this.value)">
                      </div>
                      <div class="col-xs-3">
                        <label>Cliente</label>

                        <select class="form-control" required name="cliente" >
                          <option>Selecione</option>
                          <?php $clientes = new MvcController(); $clientes -> ctlBuscaClientes();?>
                        </select>
                      </div>
                      <div class="col-xs-2">
                        <label>Producto</label>
                        <select class="form-control" required name="producto" onblur="buscaCompras(this.value)">

                          <option>Selecione</option>
                          <?php
                            $productos = new MvcController();
                            $productos -> ctlBuscaProductos();
                          ?>
                        </select>
                      </div>

                      <div class="col-xs-2">
                        <label>Destino</label>
                        <input type="text" required name="destino" class="form-control">
                      </div>

                      <div class="col-xs-2">
                        <label>fecha</label>
                        <input type="date" required id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />
                      </div>

                    </div><!-- row -->

                    <div class="row">
                      <br><br>
                      <div class="col-xs-3">
                        <label>Origen</label>
                        <select class="form-control" required name="origen">
                          <option>Selecione</option>
                          <?php $clientes = new MvcController();
                                $clientes -> ctlBuscaMisBodegas();?>
                        </select>
                      </div>

                      <div class="col-xs-3">
                        <label>Unidad</label>
                        <select class="form-control" requered name="unidad">
                          <option>Seleccione</option>
                          <?php
                            $Unidades = new MvcController();
                            $Unidades -> ctlBuscaUnidades();
                          ?>
                        </select>
                      </div>

                      <div class="col-xs-3">
                        <label>Remolque</label>
                        <select class="form-control" requered name="remolque">
                          <option value="">Seleccione</option>
                          <?php

                          ?>
                        </select>
                      </div>
                      <div class="col-xs-3">
                        <label>Operador</label>
                        <select class="form-control" requered name="op">
                          <option>Seleccione</option>
                          <?php
                            $Operadores = new MvcController();
                            $Operadores -> ctlOperadores();
                          ?>
                        </select>
                      </div>

                      <div class="col-xs-3">
                        <label>U.M.</label>
                        <input type="text" required name="um" class="form-control">
                      </div>

                    <div class="col-xs-3">
                      <label>Calidad</label>
                      <input type="text" required name="calidad" class="form-control">
                    </div>
                    <div class="col-xs-3">
                      <label>Flete</label>
                      <input type="text" required id="flete" name="flete" value="0" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Maniobra</label>
                        <input type="text" required id="maniobra" name="maniobra" value="0" class="form-control">
                      </div>

                      </div> <!-- row -->


                    <br><br>

                    <div class="row">
                      <div class="col-xs-3">
                        <label>Precio de Venta</label>
                        <input type="text" required id="precioVenta" name="precio" class="form-control">
                      </div>

                    <div class="col-xs-3">
                        <label>Kg Venta</label>
                        <input type="text" readonly="true" id="kgVenta" name="kgVenta" class="form-control" value="0">
                      </div>
                      <div class="col-xs-3">
                        <label>Total Venta</label>
                        <input type="text" readonly="true" id="totalVenta" name="total" class="form-control">
                      </div>

                   </div>

                    <div class="row">


                      <div class="col-xs-3">
                        <label>Costo Unitario</label>
                        <input type="text" readonly="true" id="costoUnitario" name="costoUnitario" class="form-control">
                      </div>
                      <div class="col-xs-3">
                      </div>

                      <div class="col-xs-3">
                        <label>Costo</label>
                        <input type="text" readonly="true" id="costo" name="costo" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-3">
                      </div>
                      <div class="col-xs-3">
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                          <label>Merma en Kg.</label>
                          <input type="text" id="merma" class="form-control" value="0">
                        </div>
                        <div class="col-xs-3">
                          <p></p>
                        </div>

                        <div class="col-xs-3">
                          <label>Costo Merma</label>
                          <input type="text" readonly="true" id="costoMerma" name="merma" class="form-control" value="0">
                        </div>
                        <div class="col-xs-2">
                        <label><h4><strong>Utilidad de Venta</strong></h4></label><h2><p align="right"id="ventaTitulo"><span>$</span> 0</p></h2>
                        <input type="hidden" id="utViaje" name="utViaje" class="form-control">
                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->
                </div>
          </div>
      </div>  <!-- row -->





      <div class="row">

          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Disponibilidad en almacen</h3>
              </div>

              <div class="box-body">
                 <form role="form">
                 <div class="row">
                      <div class="col-xs-6">

                        <div class="form-group">
                          <select class="form-control" id="operacionCompra">
                            <option>Selecione</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <input type="text" required name="kilos" id="kilos" placeholder="Kilogramos" class="form-control">
                      </div>

                    <div class="col-xs-3">
                        <button type="button" disabled="true" id='btnAgregar' class="btn btn-primary">Agregar</button>
                    </div>
                  </div>

                  <input type="hidden" name="listaCompras" id="listaCompras" class="form-control">
                </form>

                <table class="table table-condensed" id="lista-productos">
                  <thead>
                    <tr>
                      <th style="width: 50%">Origen</th>
                      <th style="width: 40%px">kg disponibles</th>
                      <th style="width: 10%">Precio</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>

                </table>

              </div> <!-- box-body -->

            </div> <!-- box-primary -->

          </div> <!-- col-md-9 -->

          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Guardar Venta</h3>
                <div class="box-footer" align="right">
                  <br><br>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </div>

            </div>
          </div> <!-- Caja de Guardar-->
      </div>  <!-- Row -->

      <div>
        <p><strong> NOTA: ingrese todos los valores numericos SIN signo de pesos y comas ($ , ) </strong></p>
      </div>

    </form>
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

<!-- pone la fecha de hoy en el datepick -->
<!-- <script>
  document.getElementById('fecha').valueAsDate = new Date();
</script> -->

<!-- Mi app JS -->
<script src="includes/app.js"></script>

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

<!-- Morris.js charts
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>-->

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
