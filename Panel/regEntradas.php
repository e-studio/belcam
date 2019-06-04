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
$proveedor = $_POST["proveedor"];
$codProd = $_POST["codProd"];
$unidad = $_POST["unidad"];
$op = $_POST["op"];
$kg =  $_POST["kg"];
$um = $_POST["um"];
$precio = $_POST["precio"];
$calidad = $_POST["calidad"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$flete = $_POST["flete"];
$maniobra = $_POST["maniobra"];
$costoTotal = $_POST["costoTotal"];
$totalCosto = $_POST["totalCosto"];
$fecha =  $_POST["fecha"];
$referencia =  $_POST["referencia"];
$monto =  $_POST["monto"];
$saldo =  $_POST["saldo"];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO entradas (noOperacion, proveedor, codProducto, unidad, operador, kg, um, precio, calidad, origen, destino, flete, maniobra, costoTotal, total) VALUES ($operacion, '$proveedor', '$codProd', '$unidad', $op, $kg, $um, $precio, $calidad, '$origen', '$destino', $flete, $maniobra, $costoTotal, $totalCosto)";

    $conn->exec($sql);
    echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="index.html";
    </script>';
    }
catch(PDOException $e)
    {
    echo $sql."<br>" . $e->getMessage();
    }

$conn = null;
?>