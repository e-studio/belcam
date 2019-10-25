<?php
  include_once "includes/controller.php";
  include_once "includes/crud.php";
  session_start();
      if(!$_SESSION["valido"]){
        header("location:index.php");
        exit();
      }
  $usuario = $_REQUEST['idEditar'];
  $respuesta = Datos::mdlBuscaChofer("choferes",$usuario);
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
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar datos de Choferes</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-6">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" value="<?php echo $respuesta['nombre'];?>" required="true" >
                </div>
                <div class="col-xs-3">
                  <label>Alias</label>
                  <input type="text" class="form-control" name="alias" value="<?php echo $respuesta['alias'];?>" >
                </div>
                <div class="col-xs-3">
                  <label>RFC</label>
                  <input type="text" class="form-control" name="rfc" value="<?php echo $respuesta['rfc'];?>" >
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-6">
                  <label>Direccion</label>
                  <input type="text" class="form-control" name="direccion" value="<?php echo $respuesta['direccion'];?>" required="true" >
                </div>
                <div class="col-xs-3">
                  <label>INE</label>
                  <input type="text" class="form-control" name="ine" value="<?php echo $respuesta['ine'];?>"  >
                </div>
                <div class="col-xs-3">
                  <label># Licencia</label>
                  <input type="text" class="form-control" name="licencia" value="<?php echo $respuesta['licencia'];?>"  >
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-3">
                  <label>Telefono</label>
                  <input type="text" class="form-control" name="telefono" value="<?php echo $respuesta['telefono'];?>"  required="true" >
                </div>
                <div class="col-xs-3">
                  <label>Telefono 2</label>
                  <input type="text" class="form-control" name="telefono2" value="<?php echo $respuesta['telefono2'];?>"  >
                </div>
                <div class="col-xs-3">
                  <label>Telefono 3</label>
                  <input type="text" class="form-control" name="telefono3" value="<?php echo $respuesta['telefono3'];?>" >
                </div>
                <div class="col-xs-3">
                  <label>Fecha Ingreso</label>
                  <input type="date" class="form-control" name="fechaIngreso" value="<?php echo $respuesta['fechaIngreso'];?>">
                </div>
              </div>
              <br>

              <div class="row">

                <br>
                <div class="col-xs-7" align="right">
                </div>
                <div class="col-xs-1" align="right">
                  <button class="btn btn-default"><a href="listaChoferes.php" >Cancelar</a></button>
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


     </form>
     <?php
        $registro = new MvcController();
        $registro -> actualizaChofer();
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
