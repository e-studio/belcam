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
  $siguiente -> ctlBuscaNumOpEntradas($fecha);

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
<form role="form" action="regEntradas.php" method="post">
    <section class="content-header">
      <h1>
        Compras de Mayoreo
      </h1>
      <br>

          <div class="row">
            <div class="col-md-12">
               <div class="box box-success">
                 <div class="box-header with-border">
                   <h3 class="box-title">Datos de Generales</h3>
                   <div class="box-body">

                     <div class="row">
                        <div class="col-xs-2">
                        <label>#Operacion</label>
                        <input type="text" readonly="true" id="operacion" name="operacion" value="<?php opNum(); ?>" class="form-control" onchange="buscaEntrada(this.value)">
                        </div>
                        <div class="col-xs-2">
                           <label>Lote</label>
                           <input type="text" required id="lote" name="lote" class="form-control">
                        </div>
                        <div class="col-xs-4">
                           <label>Proveedor</label>
                           <select class="form-control" name="proveedor" >
                              <option></option>
                              <?php $proveedores = new MvcController(); $proveedores -> ctlBuscaProveedores();?>
                           </select>
                        </div>

                         <div class="col-xs-4">
                           <label>Productor</label>
                           <input type="text" name="productor" class="form-control">
                         </div>
                     </div> <!-- Row-->

                     <div class="row">
                        <div class="col-xs-2">
                          <label>Unidad</label>
                          <input type="text" required name="unidad" class="form-control">
                        </div>
                        <div class="col-xs-2">
                          <label>Remolque</label>
                          <input type="text" required name="unidad1" class="form-control">
                        </div>
                        <div class="col-xs-2">
                          <label>Operador</label>
                          <select class="form-control" name="op" >
                              <option></option>
                              <?php $Operadores = new MvcController(); $Operadores -> ctlBuscaOperadores();?>
                           </select>
                        </div>

                        <div class="col-xs-3">
                          <label>Origen</label>
                          <input type="text" required name="origen" class="form-control">
                        </div>
                        <div class="col-xs-3">
                          <label>Destino</label>
                          <input type="text" required name="destino" class="form-control">
                        </div>
                    </div> <!--Row-->

                 </div>

               </div>
             </div>
           </div>


             <div class="col-md-3">
               <div class="box box-success">
                 <div class="box-header with-border">
                   <h3 class="box-title">Datos del Producto</h3>
                   <div class="box-body">

                     <label>Producto</label>
                     <select class="form-control" required name="codProd">
                       <option value="">Selecione</option>
                       <?php
                         $productos = new MvcController();
                         $productos -> ctlBuscaProductosMayoreo('Z');
                       ?>
                     </select>


                      <label>Kg.</label>
                      <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="kg" name="kg" class="form-control" onchange="calculaCompra()">


                      <label>U.M.</label>
                      <input type="text" required name="um" class="form-control">

                      <label>Precio</label>
                      <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="precio" name="precio" class="form-control" onchange="calculaCompra()">

                      <label>Calidad</label>
                      <input type="number" id="calidad" value="0" name="calidad" class="form-control">


                   </div>
                 </div>

               </div>
             </div>  <!-- Datos del Producto -->

             <div class="col-md-3">
               <div class="box box-danger">
                 <div class="box-header with-border">
                   <h3 class="box-title">Descuentos</h3>
                   <div class="box-body">


                         <label>Comision</label>
                         <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" id="comision" name="comision" class="form-control" onchange="calculaCompra()">


                         <label>Flete</label>
                         <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="flete" name="flete" class="form-control" onchange="calculaCompra()">


                         <label>Maniobra</label>
                         <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" required id="maniobra" name="maniobra" class="form-control" onchange="calculaCompra()">


                         <label>Anticipo</label>
                         <input type="number" pattern="^\d*(\.\d{0,2})?$" step="0.01" value="0" id="anticipo" name="anticipo" class="form-control" onchange="calculaCompra()">

                         <label>Forma Pago</label>
                         <input type="text" id="formaPago" name="formaPago" class="form-control">

                   </div>
                 </div>

               </div>
             </div> <!-- Caja de Descuentos-->


             <div class="col-md-3">
               <div class="box box-primary">
                 <div class="box-header with-border">

                   <div class="box-body">
                     <div class="col-xs-12">
                        <strong>Costo</strong><h4><p align="right"id="costoLbl"><span>$</span> 0.00</p></h4>
                        <input type="hidden" value="0" required id="costo" name="costoTotal" class="form-control">
                        <!-- type="hidden" -->
                      </div>

                      <div class="col-xs-12">
                       <h3>Total Costo</h3>
                       <label><h4><strong></strong></h4></label><h2><p align="right"id="totalCompraLbl"><span>$</span> 0.00</p></h2>
                       <input type="hidden" value="0" required id="totalCompra" name="totalCompra" class="form-control">
                     </div>
                   </div>
                 </div>

               </div>
             </div> <!-- Caja de Total-->

             <div class="col-md-3">
               <div class="box box-primary">
                 <div class="box-header with-border">
                   <h3 class="box-title">Guardar Datos</h3>
                   <div class="box-body" align="right">
                     <br><br>

                    <div class="col-sm-6">
                      <button class="btn btn-default"><a href="listaComprasNuez.php" >Cancelar</a></button>
                    </div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                   </div>
                 </div>

               </div>
             </div> <!-- Caja de Guardar-->



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
