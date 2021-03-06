<?php
	session_start();

	if (!($_SESSION["valido"])) {
		header("location:index.php");
		exit();
	}
	include_once "includes/controller.php";
	include_once "includes/crud.php";
?>

<!DOCTYPE html>
<html>
<head>
<?php
	include "includes/menus/head.php";
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
			include "includes/menus/header.php";
			include "includes/menus/menuAdmin.php";

		?>

		<div class="content-wrapper">
			<section class="content">
				<form role="form" method="POST">
					<div class="row">
						<div class="col-md-8">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Reporte de Compras</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-2">
											<label>Proveedor</label>
											<select class="form-control" required id="proveedor" name="proveedor">
												<option>Seleccione</option>
												<?php
													$Productos = new MvcController();
													$Productos -> ctlBuscaProveedores('');
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Producto</label>
											<select class="form-control" required id="producto" name="producto">
												<option>Seleccione</option>
												<?php
													$Productos = new MvcController();
													$Productos -> ctlBuscaProductosMayoreo('');
												?>
											</select>
										</div>
										<div class="col-md-3">
											<div class="row">
											<div class="col-md-12">
												<label>De</label>
												<input type="date" required class="form-control" name="de" id="de">
											</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row">
												<div class="col-md-12">
													<label>Hasta</label>
													<input type="date" required="" class="form-control" name="hasta" id="hasta">
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="row">
												<div class="col-md-12">
													<input type="submit" class="btn btn-primary" name="buscar" id="buscar" value="Buscar">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>

				<?php
					$Buscar = new MvcController();
					$Buscar -> ctlRporteCompras();
				?>

			</section>
		</div>

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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>