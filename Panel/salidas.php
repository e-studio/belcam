<?php
require_once "includes/controller.php";
require_once "includes/crud.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Belcam | Tablero Inicio</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Formateo de moneda para numeros en las ordenes  -->
    <script src="formato/numeral.js"></script>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Beltr&aacute;n</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <!-- <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Bienvenido Usuario</span>
            </a>
            <ul class="dropdown-menu">
              User image
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Usuario - Administrador
                  <small>Departamento de Compras</small>
                </p>
              </li>
               Menu Footer
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="http://belcam.com.mx" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">PANEL DE CONTROL</li>
        <li><a href="index.html"><i class="fa fa-book"></i> <span>Entradas</span></a></li>
        <li><a href="salidas.php"><i class="fa fa-book"></i> <span>salidas</span></a></li>
        <li><a href="listaEntradas.php"><i class="fa fa-list-ol"></i> <span>Lista de Entradas</span></a></li>
        <li><a href="listaSalidas.php"><i class="fa fa-list-ol"></i> <span>Lista de Salidas</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ventas
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <form role="form" action="regSalidas.php" method="post">
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Datos de venta</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-3">
                        <label># Operacion</label>
                        <input type="text" required name="operacion" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Cliente</label>
                        <!-- <input type="text" required name="cliente" class="form-control"> -->
                        <select class="form-control" required name="cliente" >
                          <option>Selecione</option>
                          <?php $clientes = new MvcController(); $clientes -> ctlBuscaClientes();?>
                        </select>
                      </div>
                      <div class="col-xs-3">
                        <label>Producto</label>
                        <!-- <input type="text" required name="codProd" class="form-control"> -->
                        <select class="form-control" required name="producto" onblur="buscaProducto(this.value)">
                          <option>Selecione</option>
                          <?php $productos = new MvcController(); $productos -> ctlBuscaProductos();?>
                        </select>
                      </div>
                      <div class="col-xs-3">
                        <label>Unidad</label>
                        <input type="text" required name="unidad" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-3">
                        <label>Remolque</label>
                        <input type="text" required name="remolque" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Op</label>
                        <input type="text" required name="op" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Kg.</label>
                        <input type="text" required id="kg" name="kg" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>U.M.</label>
                        <input type="text" required name="um" class="form-control">
                      </div>
                    </div>

                    <br><br>

                    <div class="row">
                      <div class="col-xs-3">
                        <label>Precio de Venta</label>
                        <input type="text" required id="precio" name="precio" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Calidad</label>
                        <input type="text" required name="calidad" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Origen</label>
                        <select class="form-control" required name="origen">
                          <option>Selecione</option>
                          <?php $clientes = new MvcController();
                                $clientes -> ctlBuscaMisBodegas();?>
                        </select>
                      </div>
                      <div class="col-xs-3">
                        <label>Destino</label>
                        <input type="text" required name="destino" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-3">
                      <label>Flete</label>
                      <input type="text" required id="flete" name="flete" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Maniobra</label>
                        <input type="text" required id="maniobra" name="maniobra" class="form-control">
                      </div>

                      <div class="col-xs-3">
                        <label>Costo Unitario</label>
                        <input type="text" required id="costoUnitario" name="costoUnitario" class="form-control">
                      </div>

                      <div class="col-xs-3">
                        <label>Costo</label>
                        <input type="text" required id="costo" name="costo" class="form-control">
                      </div>
                      <div class="col-xs-3">
                        <label>Total Venta</label>
                        <input type="text" required id="total" name="total" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                        <br><br>
                        <div class="col-xs-3">
                          <label>Utilidad Viaje</label>
                          <input type="text" required id="utViaje" name="utViaje" class="form-control">
                        </div>

                        <div class="col-xs-3">
                          <label>Merma</label>
                          <input type="text" required id="merma" name="merma" class="form-control">
                        </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
          </div>
      </div>  <!-- row -->





      <div class="row">

          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Disponibilidad en almacen</h3>
              </div>

              <div class="box-body">
                 <form role="form">
                 <div class="row">
                      <div class="col-xs-6">

                        <div class="form-group">
                          <select class="form-control" id="bodega">
                            <option>BODEGA</option>
                            <option>CAMARGO</option>
                            <option>TORREON</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <input type="text" required name="kg" id="kg" placeholder="Kilogramos" class="form-control">
                      </div>

                    <div class="col-xs-3">
                        <button type="button" id='btnAgregar' class="btn btn-primary">Agregar</button>
                    </div>
                  </div>
                </form>

                <table class="table table-condensed" id="lista-productos">
                  <thead>
                    <tr>
                      <th style="width: 50%">Origen</th>
                      <th style="width: 40%px">kg disponibles</th>
                      <th style="width: 10%">Precio</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>

                </table>

              </div> <!-- box-body -->

            </div> <!-- box-primary -->

          </div> <!-- col-md-9 -->

          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Guardar Venta</h3>
                <div class="box-footer" align="right">
                  <br><br>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </div>

            </div>
          </div><!-- Caja de Guardar -->
      </div>  <!-- Row -->

      <!-- <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
          <div class="box box-primary">
          <div class="mailbox-attachment-info">
                  <span class="mailbox-attachment-size">
                    <h4 align="center">Total:</h4>
                    <input type="text" class="form-control" id="totalKg" placeholder="Kgs" disabled="">

                  </span>
                </div>
        </div>
      </div>
      <div class="col-md-1">

        </div>
      </div> -->


      <div>
        <p><strong> NOTA: ingrese todos los valores numericos SIN signo de pesos y comas ($ , ) </strong></p>
      </div>

    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://belcam.com.mx">Productos del Campo Beltr&aacute;n </a>.</strong> Todos los derechos reservados.
  </footer>

</div>
<!-- ./wrapper -->

<!-- Mi app JS -->
<script src="includes/app.js"></script>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>

<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- jvectormap-->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>


<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
