<?php
 $servername = "127.0.0.1";
 $username = "root";
 $password = "";
 $dbname = "belcam";
//$servername = "mysql1007.mochahost.com";
//$username = "rickurbi_belcam";
//$password = "8gqMy;BQz@Om";
//$dbname = "rickurbi_belcam";

$operacion = $_POST["operacion"];
$proveedor = $_POST["proveedor"];
$productor = $_POST["productor"];
$codProd = $_POST["codProd"];
$lote = $_POST["lote"];
$unidad = $_POST["unidad"];
$unidad1 = $_POST["unidad1"];
$op = $_POST["op"];
$kg =  $_POST["kg"];
$um = $_POST["um"];
$precio = $_POST["precio"];
$calidad = $_POST["calidad"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$comision = $_POST["comision"];
$flete = $_POST["flete"];
$maniobra = $_POST["maniobra"];
$anticipo = $_POST["anticipo"];
$costoTotal = $_POST["costoTotal"];
$totalCompra = $_POST["totalCompra"];
$formaPago = $_POST["formaPago"];
$fecha =  $_POST["fecha"];
// $referencia =  'esta';
// $monto =  'este';
// $saldo =  'aquel';


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO entradas (noOperacion, proveedor, productor, codProducto, lote, unidad, unidad1, operador, kg, inventario, um, precio, calidad, origen, destino, comision, flete, maniobra, anticipo, costoTotal, total, formaPago, `fecha`) VALUES ('$operacion', '$proveedor', '$productor', '$codProd', $lote, '$unidad','$unidad1', '$op', $kg, $kg, $um, $precio, $calidad, '$origen', '$destino', $comision, $flete, $maniobra, $anticipo,$costoTotal, $totalCompra, '$formaPago', '$fecha')";

    $conn->exec($sql);
    echo'<script type="text/javascript">
    alert("Se ha guardado operacion #'.$operacion.'");
    window.location.href="entradas.php";
    </script>';
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    echo '<br> '.$sql;
    }

$conn = null;
?>