<?php
include_once "includes/controller.php";
include_once "includes/crud.php";
	session_start();

		if (!$_SESSION["valido"]) {
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
			include "includes/menus/header.php";
			include "includes/menus/menuAdmin.php";
		?>
		<!-- =============================================== -->

		<div class="content-wrapper">
			<!-- Main content -->

			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Lista de unidades</h3>
							</div>
							<div class="box-body">
								<table class="table table-ordered">

									<tr>
										<th style="width: 10px;">#</th>
										<th>no. Economico</th>
										<th>Marca</th>
										<th>Modelo</th>
										<th>Placas</th>
										<th>Kilometraje</th>
										<th style="width: 40px">Editar</th>
                  						<th style="width: 40px">Borrar</th>
									</tr>

									<?php
										$Lista = new MvcController();
										$Lista -> listaUnidades();
										$Lista -> borrarUnidad();
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>

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