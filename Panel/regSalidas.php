<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "belcam";
// $servername = "mysql1007.mochahost.com";
// $username = "rickurbi_belcam";
// $password = "8gqMy;BQz@Om";
// $dbname = "rickurbi_belcam";

$operacion = $_POST["operacion"];
$cliente = $_POST["cliente"];
$codProd = $_POST["producto"];
$unidad = $_POST["unidad"];
$remolque = $_POST["remolque"];
$op = $_POST["op"];
$kg =  $_POST["kgVenta"];
$um = $_POST["um"];
$precioVenta = $_POST["precio"];
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
// $referencia =  $_POST["referencia"];
// $monto =  $_POST["monto"];
// $saldo =  $_POST["saldo"];
$listaCompras = $_POST["listaCompras"];




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `salidas`(`noOperacion`, `cliente`, `codProducto`, `unidad`,`remolque`, `operador`, `kg`, `um`, `precioVenta`, `calidad`, `origen`, `destino`, `flete`, `maniobra`, `costoUnitario`, `costo`, `total`, `utViaje`, `merma`, `listaCompras`, `fecha`) VALUES ('$operacion', '$cliente', '$codProd', '$unidad','$remolque', $op, $kg, $um, $precioVenta, $calidad, '$origen', '$destino', $flete, $maniobra, $costoUnitario, $costo, $total, $utViaje, $merma, '$listaCompras', $fecha)";
    $conn->exec($sql);

    $array = json_decode($listaCompras);
    foreach($array as $obj){
            $operacion = $obj->operacion;
            $kilos = $obj->kilos;
            $precio = $obj->precio;

            $sql = "UPDATE `entradas` SET `inventario`= `inventario` - $kilos WHERE `noOperacion`='$operacion'";
            $conn->exec($sql);
    }


    echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="salidas.php";
    </script>';

    }
catch(PDOException $e)
    {
    //echo $listaCompras ."<br>";
    echo $sql. "<br>" . $e->getMessage();
    }

$conn = null;
?>