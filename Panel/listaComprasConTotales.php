<?php
session_start();
if(!$_SESSION["valido"]){
  header("location:index.php");
  exit();
}

require_once "includes/controller.php";
require_once "includes/crud.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Belcam | Lista de Compras</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Formateo de moneda para numeros en las ordenes  -->
    <script src="formato/numeral.js"></script>

</head>



<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php
    include "includes/menus/header.php";
    include "includes/menus/menuAdmin.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Compras
      </h1>
      <br>
    </section>

    <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>No. Operacion</th>
                    <th>Proveedor</th>
                    <th>Cod. Prod.</th>
                    <th>Kgs.</th>
                    <th>Precio</th>
                    <th>Costo</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th></th>
                  </tr>

                </thead>
                <tfoot>
                  <tr>
                    <td>Totals</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
                <tbody>
                 <?php
                    $registro = new MvcController();
                    $registro -> listaCompras();
                    $registro -> borrarCompra();
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

<!-- DataTables
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
  // DataTable initialisation
  $('#example').DataTable(
    {
      "paging": false,
      "autoWidth": true,
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api();
        nb_cols = api.columns().nodes().length;
        var j = 3;
        while(j < nb_cols){
          var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
          j++;
        }
      }
    }
  );
});
</script>

<script>
// $(document).ready(function() {
//   // DataTable initialisation
//   $('#example1').DataTable(
//     {
//       "paging": false,
//       "autoWidth": true,
//       "footerCallback": function ( row, data, start, end, display ) {
//         var api = this.api();
//         nb_cols = api.columns().nodes().length;
//         var j = 3;
//         while(j < nb_cols){
//           var pageTotal = api
//                 .column( j, { page: 'current'} )
//                 .data()
//                 .reduce( function (a, b) {
//                     return Number(a) + Number(b);
//                 }, 0 );
//           // Update footer
//           $( api.column( j ).footer() ).html(pageTotal);
//           j++;
//         }
//       }
//     }
//   );
// });
</script>
</body>
</html>
