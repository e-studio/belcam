<?php
  include_once "includes/controller.php";
  include_once "includes/crud.php";
  session_start();
      if(!$_SESSION["valido"]){
        header("location:index.php");
        exit();
      }
  $usuario = $_REQUEST['idEditar'];
  $respuesta = Datos::mdlBuscaCliente("clientes",$usuario);
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
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de Clientes</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-6">
                  <label>Nombre</label>
                  <input type="text" name="id" value="<?php echo $usuario; ?>" hidden>
                  <input type="text" class="form-control" name="nombre" value="<?php echo $respuesta['nombre'];?>" >
                </div>
                <div class="col-xs-2">
                  <label>Razon Social</label>
                  <input type="text" class="form-control" name="razonSocial" value="<?php echo $respuesta['razonSocial'];?>">
                </div>
                <div class="col-xs-2">
                  <label>RFC</label>
                  <input type="text" class="form-control" name="rfc" value="<?php echo $respuesta['rfc'];?>">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-5">
                  <label>Direccin</label>
                  <input type="text" class="form-control" name="direccion" value="<?php echo $respuesta['direccion'];?>" >
                </div>
                <div class="col-xs-2">
                  <label>Ubicacion</label>
                  <input type="text" class="form-control" name="ubicacion" value="<?php echo $respuesta['ubicacion'];?>" >
                </div>
                <div class="col-xs-2">
                  <label>Ubicacion 2</label>
                  <input type="text" class="form-control" name="ubicacion2" value="<?php echo $respuesta['ubicacion2'];?>">
                </div>
                <div class="col-xs-2">
                  <label>Ubicacion 3</label>
                  <input type="text" class="form-control" name="ubicacion3" value="<?php echo $respuesta['ubicacion3'];?>">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <label>Telefono</label>
                  <input type="text" class="form-control" name="telefono" value="<?php echo $respuesta['telefono'];?>" >
                </div>
                <div class="col-xs-3">
                  <label>Celular</label>
                  <input type="text" class="form-control" name="celular" value="<?php echo $respuesta['celular'];?>">
                </div>
                <div class="col-xs-3">
                  <label>Celular 2</label>
                  <input type="text" class="form-control" name="celular2" value="<?php echo $respuesta['celular2'];?>">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <label>Contacto</label>
                  <input type="text" class="form-control" name="contacto" value="<?php echo $respuesta['contacto'];?>">
                </div>
                <div class="col-xs-3">
                  <label>Contacto 2</label>
                  <input type="text" class="form-control" name="contacto2" value="<?php echo $respuesta['contacto2'];?>">
                </div>
                <div class="col-xs-3">
                  <label>Contacto 3</label>
                  <input type="text" class="form-control" name="contacto3" value="<?php echo $respuesta['contacto3'];?>">
                </div>
                <div class="col-xs-3">
                  <label>Linea de Credito</label>
                  <input type="text" class="form-control" name="lineaCredito" value="<?php echo $respuesta['lineaCredito'];?>" >
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-xs-11" align="right">
                  <br>
                  <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          </div>
        </div> <!-- row -->


     </form>
     <?php
        $registro = new MvcController();
        $registro -> actualizaCliente();
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
