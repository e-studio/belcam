<?php

require_once "conexion.php";

class Datos extends Conexion{



	#LISTA USUARIOS
	#-------------------------------------

	public function mdlListaUsuarios($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, password, email, titulo, foto, telefono FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		$stmt->close();

	}


	# LISTA DE CLIENTES
	#-------------------------------------

	public function mdlClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idCliente, nombre FROM $tabla ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE PRODUCTOS
	#-------------------------------------

	public function mdlProductos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT codProducto, nombre FROM $tabla ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE compras de un producto en especifico
	#-------------------------------------

	public function mdlComprasAjax($tabla, $codigo){

		$stmt = Conexion::conectar()->prepare("SELECT noOperacion, proveedor, inventario, precio FROM $tabla WHERE codProducto=:codigo ORDER BY proveedor");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}


	# LISTA DE MIS DEPOSITOS O BODEGAS DISPONIBLES
	#-------------------------------------

	public function mdlBodegas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT destino FROM $tabla ORDER BY destino");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE MIS DEPOSITOS O BODEGAS DISPONIBLES
	#-------------------------------------

	public function mdlBodegasClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla ORDER BY destino");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}


	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroUsuarioModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, usuario, password, email, sistema, rol, activo) VALUES (:nombre,:usuario,:password,:email,:sistema,:rol,:activo)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":sistema", $datosModel["sistema"], PDO::PARAM_STR);
		$stmt->bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
		$stmt->bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	//busca si existe registrada una orden en la tabla ordenes para evitar duplicar los numeros

    public function buscaProducto($tabla, $codigo){

        $stmt = Conexion::conectar()->prepare("SELECT `destino`, SUM(`kg`) as kg, AVG(`precio`) as precio FROM $tabla WHERE `codProducto`=:codigo GROUP by `destino`");

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();

    }






} // conexion