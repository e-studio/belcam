<?php

require_once "conexion.php";

class Datos extends Conexion {

	#VERIFICA SI EL USUARIO EXISTE PARA INGRESAR AL SISTEMA
	#--------------------------------------------------------
	public static function ingresoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :usuario AND password = :password");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}



	#LISTA USUARIOS
	#-------------------------------------

	public static function mdlListaUsuarios($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		$stmt->close();

	}


	#LISTA PRODUCTOS
	#-------------------------------------

	public static function mdlListaProductos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		$stmt->close();

	}

	public static function mdlBuscaEntrada($tabla, $entrada){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE cons = :id");

		$stmt->bindParam(":id", $entrada, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}

		public static function mdlBuscaVentaBorar($venta){

		$stmt = Conexion::conectar()->prepare("SELECT listaCompras FROM salidas WHERE cons = :id LIMIT 1");

		$stmt->bindParam(":id", $venta, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}

	#LISTA CHOFERES
	#-------------------------------------
	public static function mdlListaChoferes($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA CLIENTES
	#-------------------------------------
	public static function mdlListaClientes($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA COMPRAS
	#-------------------------------------
	public static function mdlListaCompras($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codProducto NOT LIKE 'N%' AND codProducto NOT LIKE 'C%'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA COMPRAS ACTIVAS
	#-------------------------------------
	public static function mdlListaComprasActivas($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status ='A'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA COMPRAS CERRADAS
	#-------------------------------------
	public static function mdlListaComprasCerradas($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status ='C'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA VENTAS
	#-------------------------------------
	public static function mdlListaVentas($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#LISTA PROVEEDORES
	#-------------------------------------
	public static function mdlListaProvedores($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#Lista de Unidades

	public static function mdlListaUnidades ($tabla) {
		$Statement = Conexion::conectar() -> prepare("SELECT * FROM $tabla ORDER BY idUnidad");
		$Statement -> execute();
		return $Statement -> fetchAll();

		$Statement -> close();
	}

	public static function mdlListaRemolques ($Tabla) {
		$Statement = Conexion::conectar() -> prepare("SELECT * FROM $Tabla ORDER BY id");
		$Statement -> execute();
		return $Statement -> fetchAll();

		$Statement -> close();
	}

	# LISTA DE CLIENTES
	#-------------------------------------

	public static function mdlClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idCliente, nombre FROM $tabla ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE PROVEEDORES
	#-------------------------------------

	public static function mdlProveedores(){

		$stmt = Conexion::conectar()->prepare("SELECT codProveedor, nombre FROM proveedores ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE OPERADORES
	#-------------------------------------

	public static function mdlOperadores(){

		$stmt = Conexion::conectar()->prepare("SELECT idChofer, nombre FROM choferes ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}


	# CUENTA LOSREGISTROS QUE EMPIEZAN CON
	# CIERTA FECHA EN LA TABLA QUE SE OBTIENEN COMO PARAMETROS
	# ----------------------------------------------------------

	public static function mdlNumOperaciones($tabla, $fecha){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as cuenta FROM $tabla WHERE `noOperacion` LIKE :fecha");
		$stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}

	# LISTA DE PRODUCTOS
	#-------------------------------------

	public static function mdlProductos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT codProducto, nombre FROM $tabla WHERE tipo NOT IN ('CHILE', 'NUEZ') ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	public static function mdlProductosTodos ($tabla) {
				$stmt = Conexion::conectar()->prepare("SELECT codProducto, nombre FROM $tabla ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	# LISTA DE PRODUCTOS NUEZ Y CHILE
	#-------------------------------------

	public static function mdlProductosNuez($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT codProducto, nombre FROM $tabla WHERE tipo = 'CHILE' OR tipo ='NUEZ' ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	public static function mdlProductosMayoreo($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT codProducto, nombre FROM $tabla WHERE tipo ='MAYOREO' ORDER BY nombre");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}


	# LISTA DE compras de un producto en especifico
	#-------------------------------------

	public static function mdlComprasAjax($tabla, $codigo){

		$stmt = Conexion::conectar()->prepare("SELECT noOperacion, proveedor, inventario, precio FROM $tabla WHERE codProducto=:codigo AND inventario > 0 ORDER BY proveedor");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}


	# BUSCA SI UNA OPERACION ESTA REGISTRADA EN LA TABLA DE ENTRADAS
	#-------------------------------------

	public static function mdlEntradasAjax($tabla, $codigo){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE noOperacion = :codigo");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}


	# BUSCA SI UNA OPERACION ESTA REGISTRADA EN LA TABLA DE SALIAS
	#-------------------------------------

	public static function mdlSalidasAjax($codigo){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM salidas WHERE noOperacion = :codigo");
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

	}


	# LISTA DE MIS DEPOSITOS O BODEGAS DISPONIBLES
	#-------------------------------------

	public static function mdlBodegas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT destino FROM $tabla ORDER BY destino");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}

	# LISTA DE MIS DEPOSITOS O BODEGAS DISPONIBLES
	#-------------------------------------

	public static function mdlBodegasClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla ORDER BY destino");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}



	#REGISTRO DE USUARIOS
	#-------------------------------------
	public static function registroUsuarioModel($datosModel, $tabla){

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

    public static function buscaProducto($tabla, $codigo){

        $stmt = Conexion::conectar()->prepare("SELECT `destino`, SUM(`kg`) as kg, AVG(`precio`) as precio FROM $tabla WHERE `codProducto`=:codigo GROUP by `destino`");

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();

    }

    public static function mdlBuscaUnidad ($tabla, $id) {

		$Statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idUnidad = :id");

		$Statement->bindParam(":id", $id, PDO::PARAM_INT);

		$Statement -> execute();
		return $Statement -> fetch();

		$Statement->close();
    }

    public static function mdlBuscaRemolque ($Tabla, $Id) {
    	$Statement = Conexion::conectar()->prepare("SELECT * FROM $Tabla WHERE id = :id");

    	$Statement -> bindParam(":id", $Id, PDO::PARAM_INT);

    	$Statement -> execute();
    	return $Statement -> fetch();
    	echo $Statement;
    	$Statement -> close();
    }

    public static function mdlRegistroEntrada ($datosModel, $tabla) {
    	$Statement = Conexion::conectar() -> prepare("INSERT INTO $tabla (lote, noOperacion, proveedor, productor, codProducto, unidad, unidad1, operador, kg, inventario, um, precio, calidad, origen, destino, comision, flete, maniobra, costoTotal, total, fecha, referencia, monto, saldo) VALUES (:lote, :noOperacion, :proveedor, :productor, :codProducto, :unidad, :unidad1, :operador, :kg, :inventario, :um, :precio, :calidad, :origen, :destino, :comision, :flete, :maniobra, :costoTotal, :total, :fecha, :referencia, :monto, :saldo)");

    	$Statement->bindParam(":lote", $datosModel["lote"], PDO::PARAM_STR);
    	$Statement->bindParam(":noOperacion", $datosModel["noOperacion"], PDO::PARAM_STR);
    	$Statement->bindParam(":proveedor", $datosModel["proveedor"], PDO::PARAM_STR);
    	$Statement->bindParam(":productor", $datosModel["productor"], PDO::PARAM_STR);
    	$Statement->bindParam(":codProducto", $datosModel["codProducto"], PDO::PARAM_STR);
    	$Statement->bindParam(":unidad", $datosModel["unidad"], PDO::PARAM_STR);
    	$Statement->bindParam(":unidad1", $datosModel["unidad1"], PDO::PARAM_STR);
    	$Statement->bindParam(":operador", $datosModel["operador"], PDO::PARAM_INT);
    	$Statement->bindParam(":kg", $datosModel["kg"], PDO::PARAM_STR);
    	$Statement->bindParam(":inventario", $datosModel["inventario"], PDO::PARAM_STR);
    	$Statement->bindParam(":um", $datosModel["um"], PDO::PARAM_STR);
    	$Statement->bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
    	$Statement->bindParam(":calidad", $datosModel["calidad"], PDO::PARAM_STR);
    	$Statement->bindParam(":origen", $datosModel["origen"], PDO::PARAM_STR);
    	$Statement->bindParam(":destino", $datosModel["destino"], PDO::PARAM_STR);
    	$Statement->bindParam(":comision", $datosModel["comision"], PDO::PARAM_STR);
    	$Statement->bindParam(":flete", $datosModel["flete"], PDO::PARAM_STR);
    	$Statement->bindParam(":maniobra", $datosModel["maniobra"], PDO::PARAM_STR);
    	$Statement->bindParam(":costoTotal", $datosModel["costoTotal"], PDO::PARAM_STR);
    	$Statement->bindParam(":total", $datosModel["total"], PDO::PARAM_STR);
    	$Statement->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    	$Statement->bindParam(":referencia", $datosModel["referencia"], PDO::PARAM_STR);
    	$Statement->bindParam(":monto", $datosModel["monto"], PDO::PARAM_STR);
    	$Statement->bindParam(":saldo", $datosModel["saldo"], PDO::PARAM_STR);

    		if ($Statement -> execute()) {
    			return "success";
    		} else {
    			return "error";
    		}

    }

    #REGISTRO DE USUARIO
	#-------------------------------------
	public static function registroUsuario($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, password, email, rol, activo) VALUES (:nombre,:password,:email,:rol,:activo)");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
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

	#REGISTRO DE PRODUCTO
	#-------------------------------------
	public static function registroProducto($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, codProducto, tipo) VALUES (:nombre,:codProducto, :tipoProducto)");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":codProducto", $datosModel["codProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoProducto", $datosModel["tipoProducto"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}


	#REGISTRO DE CHOFER
	#-------------------------------------
	public static function mdlRegistroChofer($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (`idChofer`, `codChofer`, `nombre`, `alias`, `rfc`, `direccion`, `ine`, `licencia`, `telefono`, `telefono2`, `telefono3`, `contacto`, `fechaIngreso`) VALUES (NULL, NULL, :nombre, :alias, :rfc, :direccion, :ine, :licencia, :telefono, :telefono2, :telefono3, '0', :fechaIngreso)");

		$stmt->bindParam(':nombre', $datosModel['nombre'], PDO::PARAM_STR,50);
		$stmt->bindParam(':alias', $datosModel["alias"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ine", $datosModel["ine"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia", $datosModel["licencia"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono2", $datosModel["telefono2"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono3", $datosModel["telefono3"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaIngreso", $datosModel["fechaIngreso"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}


	#REGISTRO DE CLIENTE
	#-------------------------------------
	public static function mdlRegistroCliente($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (`idCliente`, `codCliente`, `nombre`, `razonSocial`, `rfc`, `direccion`, `ubicacion`, `ubicacion2`, `ubicacion3`, `telefono`, `celular`, `celular2`, `contacto`, `contacto2`, `contacto3`, `lineaCredito`) VALUES (NULL, NULL, :nombre, :razonSocial,:rfc, :direccion, :ubicacion, :ubicacion2, :ubicacion3, :telefono, :celular, :celular2, :contacto, :contacto2, :contacto3, :lineaCredito)");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datosModel["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion2", $datosModel["ubicacion2"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion3", $datosModel["ubicacion3"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":celular2", $datosModel["celular2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datosModel["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto2", $datosModel["contacto2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto3", $datosModel["contacto3"], PDO::PARAM_STR);
		$stmt->bindParam(":lineaCredito", $datosModel["lineaCredito"], PDO::PARAM_STR);



		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#REGISTRO DE CLIENTE
	#-------------------------------------
	public static function mdlRegistroProveedor($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (`id`, `codProveedor`, `nombre`, `razonSocial`, `rfc`, `direccion`, `ubicacion`, `ubicacion2`, `ubicacion3`, `telefono`, `celular`, `celular2`, `contacto`, `contacto2`, `contacto3`, `lineaCredito`) VALUES (NULL, :codProveedor, :nombre, :razonSocial,:rfc, :direccion, :ubicacion, :ubicacion2, :ubicacion3, :telefono, :celular, :celular2, :contacto, :contacto2, :contacto3, :lineaCredito)");

		$stmt->bindParam(":codProveedor", $datosModel["codProveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datosModel["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion2", $datosModel["ubicacion2"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion3", $datosModel["ubicacion3"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":celular2", $datosModel["celular2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datosModel["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto2", $datosModel["contacto2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto3", $datosModel["contacto3"], PDO::PARAM_STR);
		$stmt->bindParam(":lineaCredito", $datosModel["lineaCredito"], PDO::PARAM_INT);



		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#Registro unidades

	public static function mdlRegistroUnidad ($datosModel, $Tabla) {

		$Statement = Conexion::conectar() -> prepare("INSERT INTO $Tabla (`idUnidad`, `noEconomico`, `marca`, `modelo`, `placas`, `kilometraje`, `descripcion`) VALUES (null, :noEconomico, :marca, :modelo, :placas, :kilometraje, :descripcion);");

		$Statement -> bindParam(":noEconomico", $datosModel["noEconomico"], PDO::PARAM_STR);
		$Statement -> bindParam(":marca", $datosModel["marca"], PDO::PARAM_STR);
		$Statement -> bindParam(":modelo", $datosModel["modelo"], PDO::PARAM_STR);
		$Statement -> bindParam(":placas", $datosModel["placas"], PDO::PARAM_STR);
		$Statement -> bindParam(":kilometraje", $datosModel["kilometraje"], PDO::PARAM_INT);
		$Statement -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			}
			else {
				return "error";
			}
		$Statement -> close();

	}

	public static function mdlRegistroRemolque ($Datos, $Tabla) {
		$Statement = Conexion::conectar()->prepare("INSERT INTO $Tabla (`id`, `noEconomico`, `marca`, `anio`, `placas`) VALUES (null, :noEconomico, :marca, :anio, :placas);");

		$Statement -> bindParam(":noEconomico", $Datos["noEconomico"], PDO::PARAM_INT);
		$Statement -> bindParam(":marca", $Datos["marca"], PDO::PARAM_STR);
		$Statement -> bindParam(":anio", $Datos["anio"], PDO::PARAM_STR);
		$Statement -> bindParam(":placas", $Datos["placas"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			} else {
				return "error";
			}

		$Statement -> close();
	}


	#Registro Entradas

	public static function mdlRegEntradas ($datosModel, $Tabla) {

		$Statement = Conexion::conectar() -> prepare("INSERT INTO $Tabla (cons, lote, noOperacion, proveedor, productor, codProducto, unidad, unidad1, kg, um, precio, calidad, origen, destino, comision, flete, maniobra, costoTotal, total, status) VALUES (null, :lote, :noOperacion, :proveedor, :productor, :codProd, :unidad, :unidad1, :kg, :um, :precio, :calidad, :origen, :destino, :comision, :flete, :maniobra, :costoTotal, :total, :status)");

		$Statement -> bindParam(":lote", $datosModel["lote"], PDO::PARAM_STR);
		$Statement -> bindParam(":noOperacion", $datosModel["operacion"], PDO::PARAM_STR);
		$Statement -> bindParam(":proveedor", $datosModel["proveedor"], PDO::PARAM_STR);
		$Statement -> bindParam(":productor", $datosModel["productor"], PDO::PARAM_STR);
		$Statement -> bindParam(":codProd", $datosModel["codProd"], PDO::PARAM_STR);
		$Statement -> bindParam(":unidad", $datosModel["unidad"], PDO::PARAM_STR);
		$Statement -> bindParam(":unidad1", $datosModel["unidad1"], PDO::PARAM_STR);
		$Statement -> bindParam(":kg", $datosModel["kg"], PDO::PARAM_STR);
		$Statement -> bindParam(":um", $datosModel["um"], PDO::PARAM_STR);
		$Statement -> bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
		$Statement -> bindParam(":calidad", $datosModel["calidad"], PDO::PARAM_STR);
		$Statement -> bindParam(":origen", $datosModel["origen"], PDO::PARAM_STR);
		$Statement -> bindParam(":destino", $datosModel["destino"], PDO::PARAM_STR);
		$Statement -> bindParam(":comision", $datosModel["comision"], PDO::PARAM_STR);
		$Statement -> bindParam(":flete", $datosModel["flete"], PDO::PARAM_STR);
		$Statement -> bindParam(":maniobra", $datosModel["maniobra"], PDO::PARAM_STR);
		$Statement -> bindParam(":costoTotal", $datosModel["costoTotal"], PDO::PARAM_STR);
		$Statement -> bindParam(":total", $datosModel["totalCompra"], PDO::PARAM_STR);
		$Statement -> bindParam(":status", $datosModel["status"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			} else {
				return "error";
			}


	}

	#ACTUALIZA USUARIO
	#-------------------------------------
	public static function mdlActualizaUsuario($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, email = :email, rol = :rol, activo = :activo WHERE id = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
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


	#ACTUALIZA INVENTARIO
	#-------------------------------------
	public static function mdlActualizaInventario($operacion, $kilos){


		$stmt = Conexion::conectar()->prepare("UPDATE entradas SET inventario = inventario + :kilos WHERE noOperacion = :operacion");

		$stmt->bindParam(":operacion", $operacion, PDO::PARAM_STR);
		$stmt->bindParam(":kilos", $kilos, PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}

	#ACTUALIZA USUARIO
	#-------------------------------------
	public static function mdlActualizaProducto($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, codProducto = :codProducto, tipo= :tipoproducto WHERE idProducto = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":codProducto", $datosModel["codProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoproducto", $datosModel["tipoProducto"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}

	#Actualiza Entradas de rastrojo, zacate, etc

	public static function mdlUpdtEntradas ($datosModel, $tabla) {
		$Statement = Conexion::conectar() -> prepare("UPDATE $tabla SET noOperacion = :operacion, proveedor = :proveedor, productor = :productor, codProducto = :codProd, lote = :lote, unidad = :unidad, unidad1 = :unidad1, operador = :op, kg = :kg, um = :um, precio = :precio, calidad = :calidad, origen = :origen, destino = :destino, comision = :comision, flete = :flete, maniobra = :maniobra, costoTotal = :costoTotal, total = :totalCompra WHERE cons = :id");
		$Statement -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$Statement -> bindParam(":operacion", $datosModel["operacion"], PDO::PARAM_STR);
		$Statement -> bindParam(":proveedor", $datosModel["proveedor"], PDO::PARAM_STR);
		$Statement -> bindParam(":productor", $datosModel["productor"], PDO::PARAM_STR);
		$Statement -> bindParam(":codProd", $datosModel["codProd"], PDO::PARAM_STR);
		$Statement -> bindParam(":lote", $datosModel["lote"], PDO::PARAM_STR);
		$Statement -> bindParam(":unidad", $datosModel["unidad"], PDO::PARAM_STR);
		$Statement -> bindParam(":unidad1", $datosModel["unidad1"], PDO::PARAM_STR);
		$Statement -> bindParam(":op", $datosModel["op"], PDO::PARAM_STR);
		$Statement -> bindParam(":kg", $datosModel["kg"], PDO::PARAM_STR);
		$Statement -> bindParam(":um", $datosModel["um"], PDO::PARAM_STR);
		$Statement -> bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
		$Statement -> bindParam(":calidad", $datosModel["calidad"], PDO::PARAM_STR);
		$Statement -> bindParam(":origen", $datosModel["origen"], PDO::PARAM_STR);
		$Statement -> bindParam(":destino", $datosModel["destino"], PDO::PARAM_STR);
		$Statement -> bindParam(":comision", $datosModel["comision"], PDO::PARAM_STR);
		$Statement -> bindParam(":flete", $datosModel["flete"], PDO::PARAM_STR);
		$Statement -> bindParam(":maniobra", $datosModel["maniobra"], PDO::PARAM_STR);
		$Statement -> bindParam(":costoTotal", $datosModel["costoTotal"], PDO::PARAM_STR);
		$Statement -> bindParam(":totalCompra", $datosModel["total"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			} else {
				return "error";
			}

	}

	#ACTUALIZA COMPRA DE MAYOREO
	#-------------------------------------
	public static function mdlActualizaCompras($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noOperacion = :operacion, proveedor = :proveedor, productor = :productor, codProducto = :codProd, lote = :lote, unidad = :unidad, unidad1 = :unidad1, operador = :op, kg = :kg, um = :um, precio = :precio, calidad = :calidad, origen = :origen, destino = :destino, comision = :comision, flete = :flete, maniobra = :maniobra, anticipo = :anticipo, costoTotal = :costoTotal, total = :totalCompra, formaPago = :formaPago, fecha = :fecha WHERE cons = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam("operacion" , $_POST["operacion"], PDO::PARAM_STR);
		$stmt->bindParam("proveedor" , $_POST["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam("productor" ,$_POST["productor"], PDO::PARAM_STR);
		$stmt->bindParam("codProd" , $_POST["codProd"], PDO::PARAM_STR);
		$stmt->bindParam("lote" , $_POST["lote"], PDO::PARAM_INT);
		$stmt->bindParam("unidad" , $_POST["unidad"], PDO::PARAM_STR);
		$stmt->bindParam("unidad1" , $_POST["unidad1"], PDO::PARAM_STR);
		$stmt->bindParam("op" , $_POST["op"], PDO::PARAM_INT);
		$stmt->bindParam("kg" ,  $_POST["kg"], PDO::PARAM_STR);
		$stmt->bindParam("um" , $_POST["um"], PDO::PARAM_INT);
		$stmt->bindParam("precio" , $_POST["precio"], PDO::PARAM_STR);
		$stmt->bindParam("calidad" , $_POST["calidad"], PDO::PARAM_INT);
		$stmt->bindParam("origen" , $_POST["origen"], PDO::PARAM_STR);
		$stmt->bindParam("destino" , $_POST["destino"], PDO::PARAM_STR);
		$stmt->bindParam("comision" , $_POST["comision"], PDO::PARAM_INT);
		$stmt->bindParam("flete" , $_POST["flete"], PDO::PARAM_INT);
		$stmt->bindParam("maniobra" , $_POST["maniobra"], PDO::PARAM_INT);
		$stmt->bindParam("anticipo" , $_POST["anticipo"], PDO::PARAM_INT);
		$stmt->bindParam("costoTotal" , $_POST["costoTotal"], PDO::PARAM_INT);
		$stmt->bindParam("totalCompra" , $_POST["totalCompra"], PDO::PARAM_INT);
		$stmt->bindParam("formaPago" , $_POST["formaPago"], PDO::PARAM_STR);
		$stmt->bindParam("fecha" , $_POST["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}






	#ACTUALIZA COMPRA DE NUEZ Y CHILE
	#-------------------------------------
	public static function mdlActualizaComprasNuez($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noOperacion = :operacion, proveedor = :proveedor, productor = :productor, codProducto = :codProd, lote = :lote, unidad = :unidad, unidad1 = :unidad1, operador = :op, kg = :kg, um = :um, precio = :precio, calidad = :calidad, origen = :origen, destino = :destino, comision = :comision, flete = :flete, maniobra = :maniobra, anticipo = :anticipo, costoTotal = :costoTotal, total = :totalCompra, formaPago = :formaPago WHERE cons = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam("operacion" , $_POST["operacion"], PDO::PARAM_STR);
		$stmt->bindParam("proveedor" , $_POST["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam("productor" ,$_POST["productor"], PDO::PARAM_STR);
		$stmt->bindParam("codProd" , $_POST["codProd"], PDO::PARAM_STR);
		$stmt->bindParam("lote" , $_POST["lote"], PDO::PARAM_INT);
		$stmt->bindParam("unidad" , $_POST["unidad"], PDO::PARAM_STR);
		$stmt->bindParam("unidad1" , $_POST["unidad1"], PDO::PARAM_STR);
		$stmt->bindParam("op" , $_POST["op"], PDO::PARAM_INT);
		$stmt->bindParam("kg" ,  $_POST["kg"], PDO::PARAM_INT);
		$stmt->bindParam("um" , $_POST["um"], PDO::PARAM_INT);
		$stmt->bindParam("precio" , $_POST["precio"], PDO::PARAM_INT);
		$stmt->bindParam("calidad" , $_POST["calidad"], PDO::PARAM_INT);
		$stmt->bindParam("origen" , $_POST["origen"], PDO::PARAM_STR);
		$stmt->bindParam("destino" , $_POST["destino"], PDO::PARAM_STR);
		$stmt->bindParam("comision" , $_POST["comision"], PDO::PARAM_INT);
		$stmt->bindParam("flete" , $_POST["flete"], PDO::PARAM_INT);
		$stmt->bindParam("maniobra" , $_POST["maniobra"], PDO::PARAM_INT);
		$stmt->bindParam("anticipo" , $_POST["anticipo"], PDO::PARAM_INT);
		$stmt->bindParam("costoTotal" , $_POST["costoTotal"], PDO::PARAM_INT);
		$stmt->bindParam("totalCompra" , $_POST["totalCompra"], PDO::PARAM_INT);
		$stmt->bindParam("formaPago" , $_POST["formaPago"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}



	#ACTUALIZA CLIENTE
	#-------------------------------------
	public static function mdlActualizaCliente($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, razonSocial = :razonSocial, rfc = :rfc, direccion = :direccion, ubicacion = :ubicacion, ubicacion2 = :ubicacion2, ubicacion3 = :ubicacion3, telefono = :telefono, celular = :celular, celular2 = :celular2, contacto = :contacto, contacto2 = :contacto2, contacto3 = :contacto3, lineaCredito = :lineaCredito WHERE idCliente = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datosModel["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion2", $datosModel["ubicacion2"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion3", $datosModel["ubicacion3"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":celular2", $datosModel["celular2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datosModel["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto2", $datosModel["contacto2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto3", $datosModel["contacto3"], PDO::PARAM_STR);
		$stmt->bindParam(":lineaCredito", $datosModel["lineaCredito"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}


	#ACTUALIZA PROVEEDOR
	#-------------------------------------
	public static function mdlActualizaProveedor($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codProveedor = :codProveedor, nombre = :nombre, razonSocial = :razonSocial, rfc = :rfc, direccion = :direccion, ubicacion = :ubicacion, ubicacion2 = :ubicacion2, ubicacion3 = :ubicacion3, telefono = :telefono, celular = :celular, celular2 = :celular2, contacto = :contacto, contacto2 = :contacto2, contacto3 = :contacto3, lineaCredito = :lineaCredito WHERE id = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codProveedor", $datosModel["codProveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datosModel["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion2", $datosModel["ubicacion2"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion3", $datosModel["ubicacion3"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":celular2", $datosModel["celular2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datosModel["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto2", $datosModel["contacto2"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto3", $datosModel["contacto3"], PDO::PARAM_STR);
		$stmt->bindParam(":lineaCredito", $datosModel["lineaCredito"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}




	#MODELO ACTUALIZA CHOFER
	#-----------------------------------------

	public static function mdlActualizaChofer($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,alias = :alias,rfc = :rfc,direccion = :direccion, ine = :ine,licencia = :licencia,telefono = :telefono,telefono2 = :telefono2,telefono3 = :telefono3 ,fechaIngreso = :fechaIngreso WHERE idChofer =:id");

		$stmt->bindParam(':id', $datosModel['id'],PDO::PARAM_STR);
		$stmt->bindParam(':nombre', $datosModel['nombre'], PDO::PARAM_STR,50);
		$stmt->bindParam(':alias', $datosModel["alias"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ine", $datosModel["ine"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia", $datosModel["licencia"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel["telefono1"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono2", $datosModel["telefono2"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono3", $datosModel["telefono3"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaIngreso", $datosModel["fechaIngreso"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}





	#Actualizar unidad

	public static function mdlActualizaUnidad ($datosModel, $Tabla) {

		$Statement = Conexion::conectar() -> prepare("UPDATE $Tabla SET noEconomico = :noEconomico, marca = :marca, modelo = :modelo, placas = :placas, kilometraje = :kilometraje, descripcion = :descripcion WHERE idUnidad = :idUnidad;");
		$Statement -> bindParam(":idUnidad", $datosModel["idUnidad"], PDO::PARAM_INT);
		$Statement -> bindParam(":noEconomico", $datosModel["noEconomico"], PDO::PARAM_STR);
		$Statement -> bindParam(":marca", $datosModel["marca"], PDO::PARAM_STR);
		$Statement -> bindParam(":modelo", $datosModel["modelo"], PDO::PARAM_STR);
		$Statement -> bindParam(":placas", $datosModel["placas"], PDO::PARAM_STR);
		$Statement -> bindParam(":kilometraje", $datosModel["kilometraje"], PDO::PARAM_STR);
		$Statement -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			}
			else {
				return "error";
			}
		$Statement -> close();
	}

	public static function mdlUpdtRemolque ($Datos, $Tabla) {
		$Statement = Conexion::conectar() -> prepare("UPDATE remolques SET noEconomico = :noEconomico, marca = :marca, anio = :anio, placas = :placas WHERE id = :id;");

		$Statement -> bindParam(":id", $Datos["id"], PDO::PARAM_INT);
		$Statement -> bindParam(":noEconomico", $Datos["noEconomico"], PDO::PARAM_INT);
		$Statement -> bindParam(":marca", $Datos["marca"], PDO::PARAM_STR);
		$Statement -> bindParam(":anio", $Datos["anio"], PDO::PARAM_STR);
		$Statement -> bindParam(":placas", $Datos["placas"], PDO::PARAM_STR);

			if ($Statement -> execute()) {
				return "success";
			} else {
				return "error";
			}

		$Statement -> close();
	}

	#BORRAR USUARIO
	#-------------------------------------
	public static function mdlborrarUsuario($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}


	#BORRAR PRODUCTO
	#-------------------------------------
	public static function mdlborrarProducto($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idProducto = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}


	#BORRAR CHOFER
	#-------------------------------------
	public static function mdlborrarChofer($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idChofer = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}

	#BORRAR CLIENTE
	#-------------------------------------
	public static function mdlborrarCliente($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCliente = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}


	#BORRAR COMPRA
	#-------------------------------------
	public static function mdlborrarCompra($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cons = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}


	#ABRIR COMPRA
	#-------------------------------------
	public static function mdlAbrirCompra($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = 'A' WHERE cons = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}








 #CERRAR COMPRA
 #-------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public static function mdlCerrarCompra($datosModel){

		$msg = "";

		// Consultar el id de entradas que vamos a cerrar y obtener codProducto, calidad, precio y kgs
		//$stmt = Conexion::conectar()->prepare("SELECT codProducto, calidad, precio, kg FROM entradas  WHERE cons = :id");
		$stmt = Conexion::conectar()->prepare("SELECT e.codProducto, e.calidad, e.precio, e.kg, p.nombre FROM entradas as e, productos as p WHERE e.cons = :id AND p.codProducto = e.codProducto");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			$res = $stmt->fetch();
			$msg .= $res['codProducto'].'-';
		}
		$nombre = $res["nombre"];
		$codProducto = $res['codProducto'];
		$calidad = $res['calidad'];
		$precio = $res['precio'];
		$kg = $res['kg'];

		$stmt2 = Conexion::conectar()->prepare("SELECT id, precioPromedio, kgs FROM inventarioNuez WHERE codigo = :codigo AND calidad = :calidad");
		// $stmt2 -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		$stmt2 -> bindPARAM(":codigo",$codProducto, PDO::PARAM_STR);
		$stmt2 -> bindPARAM(":calidad",$calidad, PDO::PARAM_INT);

		$stmt2->execute();
		$res2 = $stmt2->fetch();

		if ($res2 != ''){

			$msg .= 'If';

			$idInventario = $res2['id'];
			$precioAnt = $res2['precioPromedio'];
			$precioPromedio = ($precioAnt + $precio)/2;
			$nuevoKgs = $res2['kgs'] + $kg;

			// UPDATE
			$stmt3 = Conexion::conectar()->prepare("UPDATE inventarioNuez SET kgs = :nKgs, precioAnterior = :precioAnt, precioPromedio =:precioProm  WHERE id = :id");
			$stmt3 -> bindPARAM(":id",$idInventario, PDO::PARAM_INT);
			$stmt3 -> bindPARAM(":nKgs",$nuevoKgs, PDO::PARAM_INT);
			$stmt3 -> bindPARAM(":precioAnt",$precioAnt, PDO::PARAM_INT);
			$stmt3 -> bindPARAM(":precioProm",$precioPromedio, PDO::PARAM_INT);
			$stmt3->execute();
		} else {
			// INSERT
			$msg .= 'Else';
			$stmt4 = Conexion::conectar()->prepare("INSERT INTO inventarioNuez (nombre, codigo, calidad, kgs, precioAnterior, precioPromedio) VALUES (:nombre, :codigo, :calidad, :kgs, :precioAnterior, :precioPromedio)");
			$stmt4 -> bindPARAM(":nombre", $nombre, PDO::PARAM_STR);
			$stmt4 -> bindPARAM(":codigo", $codProducto, PDO::PARAM_STR);
			$stmt4 -> bindPARAM(":calidad", $calidad, PDO::PARAM_INT);
			$stmt4 -> bindPARAM(":kgs", $kg, PDO::PARAM_INT);
			$stmt4 -> bindPARAM(":precioAnterior", $precio, PDO::PARAM_INT);
			$stmt4 -> bindPARAM(":precioPromedio",$precio, PDO::PARAM_INT);
			$stmt4->execute();

		}


        	//  buscar el codProducto y calidad en la tabla inventarioNuez, si existe actualizar los kgs y el precio
        	//  de lo contrario registrar todos los datos (codProducto, calidad, precio y kgs) en la tabla inventarioNuez

        	// despues de esto se cierra la compra en entradas


		$stmt5 = Conexion::conectar()->prepare("UPDATE entradas SET status = 'C' WHERE cons = :id");
		$stmt5 -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);


		if ($stmt5->execute()){
			$msg .= "-".$calidad;
			//return "success";
			return $msg;
		} else {
			return "error";
		}
		$stmt5 -> close();


	}



 #-------------------------------------------------------------------------------------------------------------------------------------------------------------------








	#BORRAR VENTA
	#-------------------------------------
	public static function mdlborrarVenta($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cons = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}

	#BORRAR PROVEEDOR
	#-------------------------------------
	public static function mdlborrarProveedor($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindParam(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		$stmt -> close();
	}

	#Borrar Unidad

	public static function mdlBorrarUnidad ($datosModel, $Tabla) {
		$Statement = Conexion::conectar() -> prepare ("DELETE FROM $Tabla WHERE idUnidad = :id;");
		$Statement -> bindParam(":id", $datosModel, PDO::PARAM_INT);

		if ($Statement -> execute()) {
			return "success";
		}
		else {
			return "error";
		}
		$Statement -> close();
	}

	public static function mdlBorrarRemolque ($Datos, $Tabla) {
		$Statement = Conexion::conectar() -> prepare("DELETE FROM $Tabla WHERE id = :id;");
		$Statement -> bindParam(":id", $Datos, PDO::PARAM_INT);

		if ($Statement -> execute()) {
			return "success";
		}	else {
			return "error";
		}

		$Statement -> close();
	}

	#BUSCA UN USUARIO
	#-------------------------------------

	public static function mdlBuscaUsuario($tabla, $usuario){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}


	#BUSCA UN PRODUCTO
	#-------------------------------------

	public static function mdlBuscaProducto($tabla, $producto){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idProducto = :id");

		$stmt->bindParam(":id", $producto, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}



	#BUSCA UN USUARIO
	#-------------------------------------

	public static function mdlBuscaChofer($tabla, $usuario){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idChofer = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}

	#BUSCA UN USUARIO
	#-------------------------------------

	public static function mdlBuscaCompraUpdt($tabla, $compra){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE cons = :compra");

		$stmt->bindParam(":compra", $compra, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}

	#BUSCA UN USUARIO
	#-------------------------------------

	public static function mdlBuscaCliente($tabla, $usuario){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idCliente = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}


	#BUSCA UN PROVEEDOR
	#-------------------------------------

	public static function mdlBuscaProveedor($tabla, $usuario) {

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt->close();
	}


	#CONSULTA DE INVENTARIOS DE NUEZ

	public static function mdlInventarioNuez () {
		$Statement = Conexion::conectar()->prepare("SELECT * FROM inventarioNuez");

		//$Statement -> bindParam(":codProd", $Parametros['producto'], PDO::PARAM_STR);

		if ($Statement -> execute()) {
			$Resultado = $Statement -> fetchAll();
			return $Resultado;
		} else {
			echo "adios";
		}

	}








	#BUSCA DATOS ESPECIFICOS DE COMPRA PARA GENERAR UN REPORTE

	public static function mdlReporteCompras($Parametros) {
		$Statement = Conexion::conectar()->prepare("SELECT noOperacion, proveedor, productor, lote, precio, kg, costoTotal, total FROM entradas WHERE proveedor = :proveedor AND fecha BETWEEN :de AND :hasta AND codProducto = :codProd");

		$Statement -> bindParam(":de", $Parametros['de'], PDO::PARAM_STR);
		$Statement -> bindParam(":hasta", $Parametros['hasta'], PDO::PARAM_STR);
		$Statement -> bindParam(":codProd", $Parametros['producto'], PDO::PARAM_STR);
		$Statement -> bindParam(":proveedor", $Parametros['proveedor'], PDO::PARAM_STR);

		$Statement -> execute();
		return $Statement -> fetchAll();
		$Statement->close();
	}



		public static function mdlReporteVentas($Parametros) {
		$Statement = Conexion::conectar()->prepare("SELECT noOperacion, cliente, precioVenta, kg, costo, total, utViaje FROM salidas WHERE cliente = :cliente AND fecha BETWEEN :de AND :hasta AND codProducto = :codProd");

		$Statement -> bindParam(":de", $Parametros['de'], PDO::PARAM_STR);
		$Statement -> bindParam(":hasta", $Parametros['hasta'], PDO::PARAM_STR);
		$Statement -> bindParam(":codProd", $Parametros['producto'], PDO::PARAM_STR);
		$Statement -> bindParam(":cliente", $Parametros['cliente'], PDO::PARAM_STR);

		$Statement -> execute();
		return $Statement -> fetchAll();
		$Statement->close();
	}



	#DATOS PARA GRAFICA 2
	#-------------------------------------

	public static function graficaMensualModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) AS total , MONTHNAME(fecha) AS mes FROM $tabla WHERE YEAR(fecha)='2020' GROUP BY MONTH(fecha) ORDER BY fecha");
		$stmt -> execute();
		return $stmt -> fetchALL();

		$stmt->close();
	}


	#BUSCA EL INVENTARIO, KILOS ADQUIRIDOS PARA DAR UN PORCENTAJE DE EXISTENCIA EN INVENTARIO

	public static function mdlInventario ($codProducto) {
		$Statement = Conexion::conectar()->prepare("
			SELECT SUM(`inventario`) AS inventario, SUM(`kg`) AS kgs, (SUM(`inventario`) / SUM(`kg`))*100 AS porcentaje FROM entradas where codProducto=:codProd");

		$Statement -> bindParam(":codProd", $codProducto, PDO::PARAM_STR);

			if ($Statement -> execute()) {
				$Resultado = $Statement -> fetchAll();
				return $Resultado;
			} else {
				echo "adios";
			}
	}


	# CUENTA OPERACIONES COMPRAS O VENTAS
	#-------------------------------------

	public static function mdlCuentaOps($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(cons) AS resultado FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

	}













} // conexion