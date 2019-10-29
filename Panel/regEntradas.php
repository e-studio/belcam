<?php
require "includes/controller.php";

$datosController = array(
                "operacion" => $_POST["operacion"],
                "lote" => $_POST["lote"],
                "proveedor" => $_POST["proveedor"],
                "productor" => $_POST["productor"],
                "codProd" => $_POST["codProd"],
                "unidad" => $_POST["unidad"],
                "unidad1" => $_POST["unidad1"],
                "op" => $_POST["op"],
                "kg" => $_POST["kg"],
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
                "referencia" => "esta",
                "monto" => "este",
                "saldo" => "1",
                "status" => "A"
            );

$Respuesta = new MvcController();
$Respuesta -> ctlRegEntradas($datosController);

$conn = null;
?>