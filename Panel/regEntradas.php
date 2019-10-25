<?php
require "includes/crud.php";
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "belcam";
//$servername = "mysql1007.mochahost.com";
//$username = "rickurbi_belcam";
//$password = "8gqMy;BQz@Om";
//$dbname = "rickurbi_belcam";

$Datos = array("noOperacion" => $_POST["operacion"],
               "lote" => $_POST["lote"],
               "proveedor" => $_POST["proveedor"],
               "productor" => $_POST["productor"],
               "codProd" => $_POST["codProd"],
               "unidad" => $_POST["unidad"],
               "unidad1" => $_POST["unidad1"],
               "op" => $_POST["op"],
               "kg" => $_POST["kg"],
               "inventario" => $_POST["kg"],
               "um" => $_POST["um"],
               "precio" => $_POST["precio"],
               "calidad" => $_POST["calidad"],
               "origen" => $_POST["origen"],
               "destino" => $_POST["destino"],
               "comision" => $_POST["comision"],
               "flete" => $_POST["flete"],
               "maniobra" => $_POST["maniobra"],
               "costoTotal" => $_POST["costoTotal"],
               "totalCompra" => $_POST["totalCompra"],
               "fecha" => date("Y-m-d"),
               "referencia" => "esta",
               "monto" => 4,
               "saldo" => 4);

$Respuesta = Datos::mdlRegistroEntrada($Datos, "entradas");


    if ($Respuesta == "success") {
        echo'<script type="text/javascript">
        alert("Registro Guardado");
        window.location.href="entradas.php";
        </script>';
    } else {
        echo'<script type="text/javascript">
        alert("El registro no pudo ser guardado");
        window.location.href="entradas.php";
        </script>';
    }
?>