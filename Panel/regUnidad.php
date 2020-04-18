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

  	<div class="content-wrapper">
  		<!-- Main content-->
  		<section class="content">
  			<form role="form" method="post">
  				<div class="row">
  					<div class="col-md-10">
  						<div class="box box-primary">
  							<div class="box-header with-border">
  									<h3 class="box-title">Registro de unidades</h3>
  							</div>
  							<div class="box-body">
  								<div class="row">
  									<div class="col-sm-1">
  									</div>
  									<div class="col-sm-2">
  										<input required type="text" class="form-control" name="noEconomico" placeholder="No. Económico">
  									</div>
  									<div class="col-sm-2">
  										<input required type="text" class="form-control" name="marca" placeholder="Marca">	
  									</div>
  									<div class="col-sm-2">
  										<input required type="text" class="form-control" name="anio" placeholder="Año">
  									</div>
  									<div class="col-sm-2">
  										<input required type="text" class="form-control" name="placas" placeholder="Placas">
  									</div>
  									<div class="col-sm-2">
  										<input required type="text" class="form-control" name="kilometraje" placeholder="Kilometraje">
  									</div>
  								</div>
  								<br>
  								<div class="row">
  									<div class="col-md-12">
  										<textarea name="descripcion" class="form-control"></textarea>
  									</div>
  								</div>
  								<br>
  								<div class="row">
  									<div class="col-md-8"></div>
  									<div class="col-sm-2">
  										<a class="btn btn-default" href="inicio.php">Cancelar</a>
  									</div>
  									<div class="col-sm-2">
  										<button type="submit" class="btn btn-primary">Guardar</button>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  			</form>
  			<?php 

  				$Registro = new MvcController();
  				$Registro -> ctlRegistroUnidad();

  			?>
  		</section>
  	</div>
  	<?php
  		include "includes/menus/footer.php";
  	?>
</div> 


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