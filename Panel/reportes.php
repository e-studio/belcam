<?php
	include_once "includes/controller.php";
	include_once "includes/crud.php";
	session_start();

		if (!($_SESSION["valido"])) {
			header("location:index.php");
			exit();
		}
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
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Generar reporte</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-2">
											<select class="form-control" required id="producto" name="producto">
												<option>Seleccione</option>
												<?php
													$Productos = new MvcController();
													$Productos -> ctlBuscaProductosNombre();
												?>
											</select>
										</div>
										<div class="col-md-4">
											<div class="row">
											<div class="col-md-4"><input type="text" readonly value="De:" class="form-control" name=""></div>
											<div class="col-md-8">
												<input type="date" required class="form-control" name="de" id="de">
											</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
											<div class="col-md-4"><input type="text" readonly value="Hasta:" class="form-control" name=""></div>
											<div class="col-md-8">
												<input type="date" required="" class="form-control" name="hasta" id="hasta">
											</div>
											</div>
										</div>
										<div class="col-md-2">
											<input type="submit" class="btn btn-primary" name="buscar" id="buscar" value="Buscar">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<?php  
					$Buscar = new MvcController();
					$Buscar -> ctlBuscarReportes();
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Listado</h3>
							</div>
							<div class="box-body">
								<table class="table table-ordered" id="example1">
									<thead>
										<tr>
											<th>No. de Operacion</th>
											<th>Producto</th>
											<th>Precio</th>
										</tr>
									</thead>
									<tbody>	

									<?php
										$Lista = new MvcController();
										$Lista -> ctlListaReportes();						
									?>							
									</tbody>




								</table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Reporte</h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<h4>Precio promedio</h4>
									</div>
									<div class="col-md-2">
										<h4>
										<?php
											$Promedio = new MvcController();
											$Promedio -> ctlPromedios();
										?>
										</h4>
									</div>
									<div class="col-md-4"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
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