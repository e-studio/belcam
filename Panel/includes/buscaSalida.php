<?php
$salida = $_GET['salida'];

require_once "../includes/controller.php";
require_once "../includes/crud.php";

$precio = new MvcController();
$precio->buscaSalidaAjax($salida);

?>