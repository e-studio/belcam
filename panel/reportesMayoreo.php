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
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Reporte de Vantas Mayoreo</h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-2">
											<select class="form-control" required id="producto" name="producto">
												<option>Seleccione</option>
												<?php
													$Productos = new MvcController();
													$Productos -> ctlBuscaProductosMayoreo('');
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
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-body no-padding">
				              <table class="table table-striped">
				                <tbody>
				                <tr>
				                  <th style="width: 10px">#</th>
				                  <th style="width: 50px">Uno</th>
				                  <th style="width: 50px">Dos</th>
				                  <th style="width: 50px">Tres</th>
				                  <th style="width: 50px">Cuatro</th>
				                  <th style="width: 50px">Cinco</th>
				                  <th style="width: 50px">Seis</th>
				                  <th style="width: 50px">Siete</th>
				                </tr>
				                <tr>
				                  <td>1.</td>
				                  <td>Update software</td>
				                  <td>
				                    <div class="progress progress-xs">
				                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
				                    </div>
				                  </td>
				                  <td><span class="badge bg-red">55%</span></td>
				                </tr>
				                <tr></tr>
				                <tr></tr>
				                <tr></tr>
				                <tr></tr>
				                <tr></tr>
				                <tr></tr>
				                <tr></tr>
				              </tbody></table>
				            </div>

						</div>
					</div>

				</div>


				<div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Reporte</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		              <table class="table table-striped">
		                <tbody><tr>
		                  <th style="width: 10px">#</th>
		                  <th style="width: 50px">Task</th>
		                  <th style="width: 50px">Progress</th>
		                  <th style="width: 40px">Label</th>
		                </tr>
		                <tr>
		                  <td>1.</td>
		                  <td>Update software</td>
		                  <td>
		                    <div class="progress progress-xs">
		                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
		                    </div>
		                  </td>
		                  <td><span class="badge bg-red">55%</span></td>
		                </tr>
		                <tr></tr>
		                <tr></tr>
		                <tr></tr>
		              </tbody></table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <div class="row">
		          	<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Totales</h3>
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






				<div class="row">
					<div class="col-md-8">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Listado</h3>
							</div>
							<div class="box-body">
								<table class="table table-ordered" id="example1">
									<thead>
										<tr>
											<th>No. de Operacion</th>
											<th>Fecha</th>
											<th>Proveedor</th>
											<th>Productor</th>
											<th>Precio</th>
											<th>KG</th>
											<th>Costo</th>
											<th>Total</th>
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
					<div class="col-md-4">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Totales</h3>
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