<?php
  include_once "includes/controller.php";
  include_once "includes/crud.php";
  session_start();
      if(!$_SESSION["valido"]){
        header("location:index.php");
        exit();
      }
  $usuario = $_REQUEST['idEditar'];
  $respuesta = Datos::mdlBuscaProducto("productos",$usuario);
?>

<!DOCTYPE html>
<html>
<?php
    include "includes/menus/head.php";
  ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php
    include "includes/menus/header.php";
    include "includes/menus/menuAdmin.php";
  ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
     <form role="form" method="post">
      <div class="row">
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizaci&oacute;n de Datos - Producto</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" name="nombre" value="<?php echo $respuesta['nombre'];?>">
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" name="codProducto" value="<?php echo $respuesta['codProducto'];?>">
                </div>
              </div>
              <br>
              <div class="row">

                <br>
                <div class="col-xs-7" align="right">
                </div>
                <div class="col-xs-1" align="right">
                  <button class="btn btn-default"><a href="listaProductos.php" >Cancelar</a></button>
                </div>
                <div class="col-xs-1" align="right">
                </div>
                <div class="col-xs-1" align="right">
                  <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          </div>
        </div> <!-- row -->
        <input type="hidden" name="id" value="<?php echo $usuario; ?>">
     </form>
     <?php
        $registro = new MvcController();
        $registro -> actualizaProducto();
    ?>


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
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
