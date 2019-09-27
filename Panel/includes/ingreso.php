<?php
class Ingreso{

	public function ingresoController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array("usuario"=>$_POST["usuario"],
				                     "password"=>$_POST["password"]);

			$respuesta = Datos::ingresoModel($datosController, "usuarios");

			if($respuesta["email"] == $_POST["usuario"] && $respuesta["password"] == $_POST["password"]){
				$_SESSION["valido"] = true;
				$_SESSION["nombre"] = $respuesta["nombre"];
				$_SESSION["rol"] = $respuesta["rol"];
				$_SESSION["email"] = $respuesta["email"];
				echo '<script language="Javascript"> location.href="inicio.php";</script>';
			}
			else
			{
				echo '<br> <br> <div class="alert alert-danger" align="center">Verifique Usuario/Password</div>';
			}
		}
	}
}
?>