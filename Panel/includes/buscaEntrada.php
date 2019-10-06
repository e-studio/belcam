<?php
$entrada = $_GET['entrada'];

require_once "../includes/controller.php";
require_once "../includes/crud.php";

$precio = new MvcController();
$precio->buscaEntradaAjax("entradas",$entrada);

?>