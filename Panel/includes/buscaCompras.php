<?php
$codigo = $_GET['codigo'];

require_once "../includes/controller.php";
require_once "../includes/crud.php";

$precio = new MvcController();
$precio->buscaComprasAjax("entradas",$codigo);

?>