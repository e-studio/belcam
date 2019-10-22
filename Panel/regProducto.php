<?php include_once "includes/controller.php";
      include_once "includes/crud.php";
      //include_once "includes/ingreso.php";
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
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de Productos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-5">
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required="true" >
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-12">
                  <input type="text" class="form-control" name="codProducto" placeholder="Codigo" required="true" >
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="col-xs-6">
                  <select class="form-control" required name="TipoPro">
                    <option  selected>Tipo</option>
                    <option  value="MAYOREO">Mayoreo</option>
                    <option  value="CHILE">Chile</option>
                    <option  value="NUEZ">Nuez</option>
                  </select>
                  </div>
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
                  <button type="submit" class="btn btn-primary">Guardar</button>
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
        $registro -> registroProducto();
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
