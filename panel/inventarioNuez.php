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

<?php
	include "includes/menus/head.php";
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
			include "includes/menus/header.php";
			include "includes/menus/menuAdmin.php";

		?>

		<div class="content-wrapper">
			<section class="content-header">
		      <h1>Inventario de Nuez</h1>
		    </section>
			<section class="content">
				<form role="form" method="POST">
					<div class="row">
						<div class="col-md-4">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Filtro</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-8">
						                     <select class="form-control" required name="codProd">
						                       <option value="">Selecione</option>
						                       <?php
						                         $productos = new MvcController();
						                         $productos -> ctlBuscaProductosNuez('Z');
						                       ?>
						                     </select>
										</div>
										<!-- <div class="col-md-4">
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
										</div> -->
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
					// $Buscar = new MvcController();
					// $Buscar -> ctlInventarioNuez();
				?>
				<div class="row">
					<div class="col-md-8">
						<div class="box box-primary">
							<div class="box-body">
								<table class="table table-ordered" id="example2">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Calidad</th>
											<th>kgs</th>
											<th>Precio</th>
										</tr>
									</thead>
									<tbody>

									<?php
										$Lista = new MvcController();
										$Lista -> ctlInventarioNuez();
									?>
									</tbody>

								</table>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Reporte</h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<h4>Precio promedio</h4>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-2">
										<h4>
										<?php
											$Promedio = new MvcController();
											$Promedio -> ctlPromedios("precio");
										?>
										</h4>
									</div>
									<div class="col-md-2"></div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<h4>KG totales</h4>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-2">
										<h4>
										<?php
											$Promedio = new MvcController();
											$Promedio -> ctlPromedios("kg");
										?>
										</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<h4>Costo Total</h4>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-2">
										<h4>
										<?php
											$Promedio = new MvcController();
											$Promedio -> ctlPromedios("costo");
										?>
										</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<h4>Total</h4>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-2">
										<h4>
										<?php
											$Promedio = new MvcController();
											$Promedio -> ctlPromedios("total");
										?>
										</h4>
									</div>
									<div class="col-md-2"></div>
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
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>