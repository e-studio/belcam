<?php
// $servername = "127.0.0.1";
// $username = "root";
// $password = "";
// $dbname = "belcam";
$servername = "mysql1007.mochahost.com";
$username = "rickurbi_belcam";
$password = "8gqMy;BQz@Om";
$dbname = "rickurbi_belcam";

$operacion = $_POST["operacion"];
$cliente = $_POST["cliente"];
$codProd = $_POST["codProd"];
$unidad = $_POST["unidad"];
$unidad1 = $_POST["unidad1"];
$op = $_POST["op"];
$kg =  $_POST["kg"];
$um = $_POST["um"];
$precioVenta = $_POST["precioVenta"];
$calidad = $_POST["calidad"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$flete = $_POST["flete"];
$maniobra = $_POST["maniobra"];
$costoUnitario = $_POST["costoUnitario"];
$costo = $_POST["costo"];
$total = $_POST["total"];
$utViaje = $_POST["utViaje"];
$merma = $_POST["merma"];
$fecha =  $_POST["fecha"];
$referencia =  $_POST["referencia"];
$monto =  $_POST["monto"];
$saldo =  $_POST["saldo"];





try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `salidas`(`noOperacion`, `cliente`, `codProducto`, `unidad`,`unidad1`, `operador`, `kg`, `um`, `precioVenta`, `calidad`, `origen`, `destino`, `flete`, `maniobra`, `costoUnitario`, `costo`, `total`, `utViaje`, `merma`) VALUES ('$operacion', '$cliente', '$codProd', '$unidad','$unidad1', $op, $kg, $um, $precioVenta, $calidad, '$origen', '$destino', $flete, $maniobra, $costoUnitario, $costo, $total, $utViaje, $merma)";

    $conn->exec($sql);
    echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="salidas.html";
    </script>';
    }
catch(PDOException $e)
    {
    echo $sql. "<br>" . $e->getMessage();
    }

$conn = null;
?>