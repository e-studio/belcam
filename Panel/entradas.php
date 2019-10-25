<?php
session_start();
if(!$_SESSION["valido"]){
  header("location:index.php");
  exit();
}
require "includes/crud.php";
require "includes/controller.php";

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
        Registro de Compras
      </h1>
      <br>
<form role="form" action="regEntradas.php" method="post">
   <div class="row">
      <div class="col-md-12">

      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
               <div class="row">
                  <div class="col-xs-2">
                  <label># Operacion</label>
                  <input type="text" required id="operacion" name="operacion" class="form-control" onchange="buscaEntrada(this.value)">
                  </div>
                  <div class="col-xs-2">
                     <label>Lote</label>
                     <input type="text" required id="lote" name="lote" class="form-control">
                  </div>
                  <div class="col-xs-3">
                     <label>Proveedor</label>
                     <select class="form-control" name="proveedor" >
                        <option></option>
                        <?php $proveedores = new MvcController(); $proveedores -> ctlBuscaProveedores();?>
                     </select>
                  </div>

                   <div class="col-xs-3">
                     <label>Productor</label>
                     <input type="text" id="productor" name="productor" class="form-control">
                   </div>

                   <div class="col-xs-2">
                     <label>Producto</label>
                     <select class="form-control" required name="codProd">
                       <option value="">Seleccione</option>
                       <?php
                         $productos = new MvcController();
                         $productos -> ctlBuscaProductos();
                       ?>
                     </select>
                   </div>
               </div> <!-- Row-->
               <div class="row">
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
                  <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="kg" name="kg" class="form-control" onchange="calculaCompra()">
                </div>
                <div class="col-xs-1">
                  <label>U.M.</label>
                  <input type="text" required name="um" class="form-control">
                </div>
                <div class="col-xs-1">
                  <label>Precio</label>
                  <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="precio" name="precio" class="form-control" onchange="calculaCompra()">
                </div>
                <div class="col-xs-1">
                  <label>Calidad</label>
                  <input type="text" id="calidad" name="calidad" class="form-control">
                </div>
                <div class="col-xs-2">
                  <label>Origen</label>
                  <input type="text" required name="origen" class="form-control">
                </div>
                <div class="col-xs-2">
                  <label>Destino</label>
                  <input type="text" required name="destino" class="form-control">
                </div>
               </div> <!--Row-->
               <div class="row">
                  <div class="col-xs-2">
                     <label>Comision</label>
                     <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" id="comision" name="comision" class="form-control" onchange="calculaCompra()">
                   </div>
                   <div class="col-xs-1">
                     <label>Flete</label>
                     <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="flete" name="flete" class="form-control" onchange="calculaCompra()">
                   </div>
                   <div class="col-xs-1">
                     <label>Maniobra</label>
                     <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="maniobra" name="maniobra" class="form-control" onchange="calculaCompra()">
                   </div>
               </div><!--Row-->
               <div class="row">
                  <div class="col-xs-8">
                  </div>
                <div class="col-xs-2">
                  <strong>Costo</strong><h4><p align="right"id="costoLbl"><span>$</span> 0.00</p></h4>
                  <input type="hidden" value="0" required id="costo" name="costoTotal" class="form-control">
                  <!-- type="hidden" -->
                </div>
               </div>

              </div>

              <div class="box-footer" align="right">
                <p><strong> NOTA: Ingrese todos los valores numericos SIN signo de pesos ni comas ($ , ) </strong></p>
              </div>
              <div>

              </div>

          </div>

          <div class="row">
             <div class="col-md-6"></div> <!-- Caja de Total-->
             <div class="col-md-3">
               <div class="box box-primary">
                 <div class="box-header with-border">
                   <h3 class="box-title">Total Costo</h3>
                   <div class="box-body">
                       <label><h4><strong></strong></h4></label><h2><p align="right"id="totalCompraLbl"><span>$</span> 0.00</p></h2>
                       <input type="hidden" value="0" required id="totalCompra" name="totalCompra" class="form-control">
                   </div>
                 </div>

               </div>
             </div> <!-- Caja de Total-->
             <div class="col-md-3">
               <div class="box box-primary">
                 <div class="box-header with-border">
                   <h3 class="box-title">Guardar Venta</h3>
                   <div class="box-body" align="right">
                     <br><br>
                     <button type="submit" class="btn btn-primary">Guardar</button>
                   </div>
                 </div>

               </div>
             </div> <!-- Caja de Guardar-->
          </div>
      </div>

   </div>

    </section>
</form>
 
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

<script src="dist/js/opCompras.js"></script>
</body>
</html>
