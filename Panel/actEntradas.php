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
$lote= $_POST["lote"];
$proveedor = $_POST["proveedor"];
$productor = $_POST["productor"];
$codProd = $_POST["codProd"];
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
$costoTotal = $_POST["costoTotal"];
$totalCompra = $_POST["totalCompra"];
$fecha =  '23/10/2019';
$referencia =  'esta';
$monto =  'este';
$saldo =  'aquel';


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE entradas SET noOperacion=['$operacion'],lote=['$lote'],proveedor=[$proveedor],productor=[$productor],codProducto=[$codProd],unidad=[$unidad],unidad1=[$unidad1],operador=[$op],kg=[$kg],inventario=[],`um`=[value-12],`precio`=[value-13],`calidad`=[value-14],`origen`=[value-15],`destino`=[value-16],`comision`=[value-17],`flete`=[value-18],`maniobra`=[value-19],`costoTotal`=[value-20],`total`=[value-21],`fecha`=[value-22],`referencia`=[value-23],`monto`=[value-24],`saldo`=[value-25] WHERE 1";

    $conn->exec($sql);
    echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="entradas.php";
    </script>';
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

$conn = null;
?>