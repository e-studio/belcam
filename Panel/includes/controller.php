
<?php
require_once 'crud.php';
class MvcController{

	#-------------------------------------
	#Busca los clientes registrados en la tabla clientes
	#------------------------------------
	public function ctlBuscaClientes(){

		$respuesta = Datos::mdlClientes("clientes");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}

	#-------------------------------------
	#Busca los proveedores registrados
	#------------------------------------
	public function ctlBuscaProveedores(){

		$respuesta = Datos::mdlProveedores();

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}


	public function ctlBuscaOperadores($chofer){

		$respuesta = Datos::mdlOperadores();

		 foreach ($respuesta as $row => $item){

			if ($item["idChofer"] == $chofer ){
				echo  '<option value="'.$item["idChofer"].'" selected>'.$item["nombre"].'</option>';
			}
			else{
				echo  '<option value="'.$item["idChofer"].'">'.$item["nombre"].'</option>';
			}
		}
	}

	public function ctlOperadores () {
		$Respuesta = Datos::mdlOperadores();

		foreach ($Respuesta as $Row => $Item) {
			echo "<option value='" . $Item['idChofer'] . "'>" . $Item['nombre'] . "</option>";
		}
	}


	#-----------------------------------------------------------
	#Busca el siguiente numero de operacion en la tabla entradas
	#-----------------------------------------------------------
	public function ctlBuscaNumOpEntradas($fecha){
		$busca = $fecha.'%';

		$respuesta = Datos::mdlNumOperaciones('entradas', $busca);

		$next = $respuesta['cuenta']+1;
		echo $fecha,"-",$next;
		//echo '$fecha-$next';
	}

	#----------------------------------------------------------
	#Busca el siguiente numero de operacion en la tabla salidas
	#----------------------------------------------------------
	public function ctlBuscaNumOpSalidas($fecha){
		$busca = $fecha.'%';

		$respuesta = Datos::mdlNumOperaciones('salidas', $busca);

		$next = $respuesta['cuenta']+1;
		echo $fecha,"-",$next;
		//echo '$fecha-$next';
	}



	#-------------------------------------
	#Busca los productos de la tabla productos
	#------------------------------------
	public function ctlBuscaProductos(){

		$respuesta = Datos::mdlProductos("productos");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["codProducto"].'">'.$item["nombre"].'</option>';
		}
	}

	public function ctlBuscaProductosAct($cod){

		$respuesta = Datos::mdlProductos("productos");

		foreach ($respuesta as $row => $item){
			if($item["codProducto"] == $cod){
				echo  '<option value="'.$item["codProducto"].' " selected>'.$item["nombre"].'</option>';
			}else{
				echo  '<option value="'.$item["codProducto"].'">'.$item["nombre"].'</option>';
			}
		}
	}

	#-------------------------------------
	#Busca los productos de Nuez y Chile
	#------------------------------------
	public function ctlBuscaProductosNuez($prod){

		$respuesta = Datos::mdlProductosNuez("productos");

		foreach ($respuesta as $row => $item){
			if ($item["codProducto"] == $prod ){
				echo  '<option value="'.$item["codProducto"].'" selected>'.$item["nombre"].'</option>';
			}
			else{
				echo  '<option value="'.$item["codProducto"].'">'.$item["nombre"].'</option>';
			}
		}
	}

	public function ctlBuscaProductosMayoreo($prod){

		$respuesta = Datos::mdlProductosMayoreo("productos");

		foreach ($respuesta as $row => $item){
			if ($item["codProducto"] == $prod ){
				echo  '<option value="'.$item["codProducto"].'" selected>'.$item["nombre"].'</option>';
			}
			else{
				echo  '<option value="'.$item["codProducto"].'">'.$item["nombre"].'</option>';
			}
		}
	}

	#-------------------------------------
	#Busca operaciones de compra, precio y proveedor de la tabla entradas
	#------------------------------------
	public function ctlBuscaCompras(){

		$respuesta = Datos::mdlCompras("entradas");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["codProducto"].'">'.$item["noOperacion"].' - '.$item["proveedor"].' - '.$item["kg"].' - '.$item["precio"].'</option>';
		}
	}

	#-------------------------------------
	#Busca mis bodegas disponibles de la tabla entradas
	#------------------------------------
	public function ctlBuscaMisBodegas(){

		$respuesta = Datos::mdlBodegas("entradas");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["destino"].'">'.$item["destino"].'</option>';
		}
	}

	public function ctlBuscaUnidades () {


		$Respuesta = Datos::mdlListaUnidades("unidades");

		foreach ($Respuesta as $Row => $Item) {
			echo "<option value='".$Item['idUnidad']."'>" . $Item['noEconomico']."-".$Item['marca']. "</option>";
		}
	}

	public function ctlBuscaRemolques () {
		$Respuesta = Datos::mdlListaRemolques("remolques");

		foreach($Respuesta as $Row => $Item) {
			echo "<option value='" . $Item['id'] . "'>" . $Item["noEconomico"]." - ". $Item["marca"]. "</option>";
		}
	}

// BUSCA EL NUMERO DE ORDEN EN LA TABLA ORDERS PARA EVITAR DUPLICIDAD
    public function buscaProducto($tabla, $codigo){

        $res = Datos::buscaProducto($tabla, $codigo);

        foreach ($res as $row => $val) {

            echo $val['destino'];
            echo " || ";
            echo $val['kg'];
            echo " || ";
            echo $val['precio'];
            echo " || ";

        }

    }

    // BUSCA TODAS LAS COMPRAS QUE SE HAYAN HECHO DE UN PRODUCTO EN ESPECIFICO
    static function buscaComprasAjax($tabla, $codigo){

        $res = Datos::mdlComprasAjax($tabla, $codigo);

        foreach ($res as $row => $val) {

            echo $val['noOperacion'];
            echo " || ";
            echo $val['proveedor'];
            echo " || ";
            echo $val['inventario'];
            echo " || ";
            echo $val['precio'];
            echo " || ";

        }

    }

    // BUSCA SI UNA OPERACION YA EXISTE EN LA TABLA DE ENTRADAS
    public function buscaEntradaAjax($tabla, $codigo){

        $res = Datos::mdlEntradasAjax($tabla, $codigo);
        //echo $res["noOperacion"];
        if ($res==""){
        	//echo $res["noOperacion"];
            echo 0;
        }
        else {
        	// echo $res["noOperacion"];
            echo 1;
        }

    }

    // BUSCA SI UNA OPERACION YA EXISTE EN LA TABLA DE SALIDAS
    public function buscaSalidaAjax($codigo){

        $res = Datos::mdlSalidasAjax($codigo);
        //echo $res["noOperacion"];
        if ($res==""){
        	//echo $res["noOperacion"];
            echo 0;
        }
        else {
        	 //echo $res["noOperacion"];
            echo 1;
        }

    }

	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuario(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "nombre"=>$_POST["nombre"],
								      "password"=>$_POST["password"],
								      "email"=>$_POST["email"],
								      "rol"=>$_POST["rol"],
								      "activo"=>"S");

			$respuesta = Datos::registroUsuario($datosController, "usuarios");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Guardado");
				    window.location.href="regUsuario.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error! Registro NO Guardado");
				    window.location.href="regUsuario.php";
				    </script>';


			}

		}

	}


	#REGISTRO DE PRODUCOS
	#------------------------------------
	public function registroProducto(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "nombre"=>$_POST["nombre"],
								      "codProducto"=>$_POST["codProducto"],
								  	  "tipoProducto"=>$_POST["TipoPro"]);

			$respuesta = Datos::registroProducto($datosController, "productos");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Guardado");
				    window.location.href="regProducto.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error! Registro NO Guardado");
				    window.location.href="regProducto.php";
				    </script>';


			}

		}

	}


	#REGISTRO DE CHOFERES
	#------------------------------------
	public function ctlRegistroChofer(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "nombre" =>$_POST["nombre"],
									  "alias" => $_POST["alias"],
									  "rfc" => $_POST["rfc"],
								      "direccion" => $_POST["direccion"],
								      "ine" => $_POST["ine"],
								      "licencia" => $_POST["licencia"],
								      "telefono" => $_POST["telefono"],
								   	  "telefono2" => $_POST["telefono2"],
								   	  "telefono3" => $_POST["telefono3"],
								   	  "fechaIngreso" => $_POST["fechaIngreso"]);


			//echo'<script type="text/javascript">alert("'.$_POST["fechaIngreso"].'");</script>';

			$respuesta = Datos::mdlRegistroChofer($datosController, "choferes");

			echo $respuesta;



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Guardado");
				    window.location.href="regChofer.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error! Registro NO Guardado");
				    window.location.href="regChofer.php";
				    </script>';


			}

		}

	}


	#REGISTRO DE CLIENTE
	#------------------------------------
	public function ctlRegistroCliente(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "nombre"=>$_POST["nombre"],
									  "razonSocial"=>$_POST["razonSocial"],
									  "rfc"=>$_POST["rfc"],
								      "direccion"=>$_POST["direccion"],
								      "ubicacion"=>$_POST["ubicacion"],
								      "ubicacion2"=>$_POST["ubicacion2"],
								      "ubicacion3"=>$_POST["ubicacion3"],
								      "telefono"=>$_POST["telefono"],
								      "celular"=>$_POST["celular"],
								      "celular2"=>$_POST["celular2"],
								   	  "contacto"=>$_POST["contacto"],
								   	  "contacto2"=>$_POST["contacto2"],
								   	  "contacto3"=>$_POST["contacto3"],
								   	  "lineaCredito"=>$_POST["lineaCredito"]);


			//echo'<script type="text/javascript">alert("'.$_POST["fechaIngreso"].'");</script>';

			$respuesta = Datos::mdlRegistroCliente($datosController, "clientes");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Guardado");
				    window.location.href="regCliente.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error! Registro NO Guardado");
				    window.location.href="regChofer.php";
				    </script>';


			}

		}

	}



	#REGISTRO DE CLIENTE
	#------------------------------------
	public function ctlRegistroProveedor(){

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "codProveedor"=>$_POST["codProveedor"],
									  "nombre"=>$_POST["nombre"],
									  "razonSocial"=>$_POST["razonSocial"],
									  "rfc"=>$_POST["rfc"],
								      "direccion"=>$_POST["direccion"],
								      "ubicacion"=>$_POST["ubicacion"],
								      "ubicacion2"=>$_POST["ubicacion2"],
								      "ubicacion3"=>$_POST["ubicacion3"],
								      "telefono"=>$_POST["telefono"],
								      "celular"=>$_POST["celular"],
								      "celular2"=>$_POST["celular2"],
								   	  "contacto"=>$_POST["contacto"],
								   	  "contacto2"=>$_POST["contacto2"],
								   	  "contacto3"=>$_POST["contacto3"],
								   	  "lineaCredito"=>$_POST["lineaCredito"]);


			//echo'<script type="text/javascript">alert("'.$_POST["fechaIngreso"].'");</script>';

			$respuesta = Datos::mdlRegistroProveedor($datosController, "proveedores");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Guardado");
				    window.location.href="regCliente.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error! Registro NO Guardado");
				    window.location.href="regChofer.php";
				    </script>';


			}

		}

	}

	#Registrar nueva unidad

	public function ctlRegistroUnidad () {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosUnidad = array("noEconomico" => $_POST["noEconomico"],
								 "kilometraje" => $_POST["kilometraje"],
								 "modelo" => $_POST["modelo"],
								 "marca" => $_POST["marca"],
								 "placas" => $_POST["placas"],
								 "descripcion" => $_POST["descripcion"]);

			$Respuesta = Datos::mdlRegistroUnidad($datosUnidad, "unidades");
				if ($Respuesta == "success") {
					echo'<script type="text/javascript">
					    alert("Registro Guardado");
					    window.location.href="listaUnidades.php";
					    </script>';
				} else {
					echo'<script type="text/javascript">
					    alert("Error al guardar la unidad");
					    window.location.href="regUnidad.php";
					    </script>';
				}
		}
	}

	public function ctlRegistroRemolque () {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$DatosRemolque = array("noEconomico" => $_POST["noEconomico"],
								   "marca" => $_POST["marca"],
								   "anio" => $_POST["anio"],
								   "placas" => $_POST["placas"]
			);

			$Respuesta = Datos::mdlRegistroRemolque($DatosRemolque, "remolques");

			if ($Respuesta == "success") {
				echo'<script type="text/javascript">
					    alert("Registro Guardado");
					    window.location.href="listaRemolques.php";
					    </script>';
			} else {
				echo'<script type="text/javascript">
			   	alert("Registro Guardado");
				window.location.href="regUnidad.php";
				</script>';
			}
		}
	}

	#Registrar nueva entrada

	public function ctlRegEntradas ($datosController) {
		$Respuesta = Datos::mdlRegEntradas($datosController, "entradas");

		if ($Respuesta == "success") {
			echo'<script type="text/javascript">
				alert("Registro Guardado");
				window.location.href="listaComprasNuez.php";
				</script>';
		} else {
			echo'<script type="text/javascript">
				alert("Registro Guardado");
				window.location.href="entradas.php";
				</script>';
		}

	}



	#ACTUALIZA DE USUARIO
	#------------------------------------
	public function actualizaUsuario(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$_POST["id"],
									  "nombre"=>$_POST["nombre"],
								      "password"=>$_POST["password"],
								      "email"=>$_POST["email"],
								      "rol"=>$_POST["rol"],
								      "activo"=>"S");

			$respuesta = Datos::mdlActualizaUsuario($datosController, "usuarios");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaUsuarios.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaUsuarios.php";
				    </script>';


			}

		}

	}


	#ACTUALIZA DE PRODUCTO
	#------------------------------------
	public function actualizaProducto(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$_POST["id"],
									  "nombre"=>$_POST["nombre"],
								      "codProducto"=>$_POST["codProducto"],
								  	  "tipoProducto"=>$_POST["TipoPro"]);

			$respuesta = Datos::mdlActualizaProducto($datosController, "productos");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaProductos.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaProductos.php";
				    </script>';


			}

		}

	}


	#ACTUALIZA DE COMPRAS DE ALFALFA, ZACATE, RASTROJO, ETC

	public function ctlUpdtEntradas ($datosController) {
		$Respuesta = Datos::mdlUpdtEntradas($datosController, "entradas");

			if ($Respuesta == "success") {
				echo"<script type='text/javascript'>
				    alert('Registro Actualizado');
				    window.location.href='listaComprasNuez.php';
				    </script>";
			} else {
				echo"<script type='text/javascript'>
				    alert('Error, no se pudo actualizar el registro');
				    window.location.href='listaComprasNuez.php';
				    </script>";
			}
	}


	#ACTUALIZA DE COMPRAS DE MAYOREO
	#------------------------------------
	public function actualizaCompra(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array("id" => $_POST["id"],
				"operacion" => $_POST["operacion"],
				"proveedor" => $_POST["proveedor"],
				"productor" =>$_POST["productor"],
				"codProd" => $_POST["codProd"],
				"lote" => $_POST["lote"],
				"unidad" => $_POST["unidad"],
				"unidad1" => $_POST["unidad1"],
				"op" => $_POST["op"],
				"kg" =>  $_POST["kg"],
				"um" => $_POST["um"],
				"precio" => $_POST["precio"],
				"calidad" => $_POST["calidad"],
				"origen" => $_POST["origen"],
				"destino" => $_POST["destino"],
				"comision" => $_POST["comision"],
				"flete" => $_POST["flete"],
				"maniobra" => $_POST["maniobra"],
				"anticipo" => $_POST["anticipo"],
				"costoTotal" => $_POST["costoTotal"],
				"totalCompra" => $_POST["totalCompra"],
				"formaPago" => $_POST["formaPago"],
				"fecha" => $_POST["fecha"]);

			$respuesta = Datos::mdlActualizaCompras($datosController, "entradas");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaCompras.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaCompras.php";
				    </script>';


			}

		}

	}




	#ACTUALIZA DE COMPRA DE NUEZ Y CHILE
	#------------------------------------
	public function actualizaCompraNuez(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array("id" => $_POST["id"],
				"operacion" => $_POST["operacion"],
				"proveedor" => $_POST["proveedor"],
				"productor" =>$_POST["productor"],
				"codProd" => $_POST["codProd"],
				"lote" => $_POST["lote"],
				"unidad" => $_POST["unidad"],
				"remolque" => $_POST["remolque"],
				"op" => $_POST["op"],
				"kg" =>  $_POST["kg"],
				"um" => $_POST["um"],
				"precio" => $_POST["precio"],
				"calidad" => $_POST["calidad"],
				"origen" => $_POST["origen"],
				"destino" => $_POST["destino"],
				"comision" => $_POST["comision"],
				"flete" => $_POST["flete"],
				"maniobra" => $_POST["maniobra"],
				"anticipo" => $_POST["anticipo"],
				"costoTotal" => $_POST["costoTotal"],
				"totalCompra" => $_POST["totalCompra"],
				"formaPago" => $_POST["formaPago"]);

			$respuesta = Datos::mdlActualizaComprasNuez($datosController, "entradas");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaComprasNuez.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaComprasNuez.php";
				    </script>';


			}

		}

	}




#ACTUALIZA DE CHOFER
	#------------------------------------
	public function actualizaChofer($id){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$id,
									  "nombre"=>$_POST["nombre"],
									  "alias"=>$_POST["alias"],
									  "rfc"=>$_POST["rfc"],
								      "direccion"=>$_POST["direccion"],
								      "ine"=>$_POST["ine"],
								      "licencia"=>$_POST["licencia"],
								      "telefono1"=>$_POST["telefono"],
								   	  "telefono2"=>$_POST["telefono2"],
								   	  "telefono3"=>$_POST["telefono3"],
								   	  "fechaIngreso"=>$_POST["fechaIngreso"]);

			$respuesta = Datos::mdlActualizaChofer($datosController, "choferes");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaChoferes.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaChoferes.php";
				    </script>';


			}

		}

	}
	#ACTUALIZA DE CLIENTE
	#------------------------------------
	public function actualizaCliente(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$_POST["id"],
									  "nombre"=>$_POST["nombre"],
									  "razonSocial"=>$_POST["razonSocial"],
									  "rfc"=>$_POST["rfc"],
								      "direccion"=>$_POST["direccion"],
								      "ubicacion"=>$_POST["ubicacion"],
								      "ubicacion2"=>$_POST["ubicacion2"],
								      "ubicacion3"=>$_POST["ubicacion3"],
								      "telefono"=>$_POST["telefono"],
								      "celular"=>$_POST["celular"],
								      "celular2"=>$_POST["celular2"],
								   	  "contacto"=>$_POST["contacto"],
								   	  "contacto2"=>$_POST["contacto2"],
								   	  "contacto3"=>$_POST["contacto3"],
								   	  "lineaCredito"=>$_POST["lineaCredito"]);

			$respuesta = Datos::mdlActualizaCliente($datosController, "clientes");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaClientes.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaChoferes.php";
				    </script>';


			}

		}

	}

	#ACTUALIZA DE PROVEEDOR
	#------------------------------------
	public function actualizaProveedor(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$_POST["id"],
									  "codProveedor"=>$_POST["codProveedor"],
									  "nombre"=>$_POST["nombre"],
									  "razonSocial"=>$_POST["razonSocial"],
									  "rfc"=>$_POST["rfc"],
								      "direccion"=>$_POST["direccion"],
								      "ubicacion"=>$_POST["ubicacion"],
								      "ubicacion2"=>$_POST["ubicacion2"],
								      "ubicacion3"=>$_POST["ubicacion3"],
								      "telefono"=>$_POST["telefono"],
								      "celular"=>$_POST["celular"],
								      "celular2"=>$_POST["celular2"],
								   	  "contacto"=>$_POST["contacto"],
								   	  "contacto2"=>$_POST["contacto2"],
								   	  "contacto3"=>$_POST["contacto3"],
								   	  "lineaCredito"=>$_POST["lineaCredito"]);

			$respuesta = Datos::mdlActualizaProveedor($datosController, "proveedores");



			if($respuesta == "success"){
				echo'<script type="text/javascript">
				    alert("Registro Actualizado");
				    window.location.href="listaProveedores.php";
				    </script>';

			}

			else{
				echo'<script type="text/javascript">
				    alert("Error!");
				    window.location.href="listaProveedores.php";
				    </script>';


			}

		}

	}

	#Actualiza Unidad

	public function ctlActualizaUnidad ($id) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosUnidad = array("idUnidad" => $id,
								 "noEconomico" => $_POST["noEconomico"],
								 "marca" => $_POST["marca"],
								 "modelo" => $_POST["modelo"],
								 "placas" => $_POST["placas"],
								 "kilometraje" => $_POST["kilometraje"],
								 "descripcion" => $_POST["descripcion"]);

			$Respuesta = Datos::mdlActualizaUnidad($datosUnidad, "unidades");

			if ($Respuesta == "success") {
				echo "<script type='text/javascript'>
						alert('Regsitro Actualizado');
						window.location.href='listaUnidades.php';
					 </script>";
			}
			else {
				echo "<script>
						alert('Error');
						window.location.href='listaUnidades.php';
					</script>";
			}
		}
	}

	public function ctlUpdtRemolque ($id) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$DatosRemolque = array("id" => $id,
								   "noEconomico" => $_POST["noEconomico"],
								   "marca" => $_POST["marca"],
								   "anio" => $_POST["anio"],
								   "placas" => $_POST["placas"]
			);

			$Respuesta = Datos::mdlUpdtRemolque($DatosRemolque, "remolques");

			if ($Respuesta == "success") {
				echo'<script type="text/javascript">
					    alert("Registro Guardado");
					    window.location.href="listaRemolques.php";
					    </script>';
			} else {
				echo'<script type="text/javascript">
			   	alert("Fallo al actualizar el registro");
				window.location.href="regRemolque.php";
				</script>';
			}

		}
	}


	#BORRAR USUARIO
    #------------------------------------
    public function borrarUsuario(){
    	//echo'<script type="text/javascript">alert('.var_dump(isset($_GET["idBorrar"])).');</script>';

        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarUsuario($datosController,"usuarios");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>window.location.href='listaUsuarios.php';alert('Registro Eliminado!');</script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }


    #BORRAR PRODUCTO
    #------------------------------------
    public function borrarProducto(){
        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarProducto($datosController,"productos");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>window.location.href='listaProductos.php';alert('Registro Eliminado!');</script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }

    #BORRAR CHOFER
    #------------------------------------
    public function borrarChofer(){
    	//echo'<script type="text/javascript">alert('.var_dump(isset($_GET["idBorrar"])).');</script>';

        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarChofer($datosController,"choferes");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>window.location.href='listaChoferes.php'</script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }

    #BORRAR CLIENTE
    #------------------------------------
    public function borrarCliente(){

        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarCliente($datosController,"clientes");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Registro Eliminado');
                		window.location.href='listaClientes.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }


    #BORRAR COMPRA
    #------------------------------------
    public function borrarCompra(){

        if (isset($_GET['idBorrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarCompra($datosController,"entradas");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Registro Eliminado');
                		window.location.href='listaCompras.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }

    #ABRIR COMPRA
    #------------------------------------
    public function abrirCompra(){

        if (isset($_GET['idAbrir'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idAbrir'].'");</script>';
            $datosController = $_GET['idAbrir'];
            $respuesta = Datos::mdlAbrirCompra($datosController,"entradas");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Compra Cerrada!');
                		window.location.href='comprasCerradas.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }







    #CERRAR COMPRA
    #-------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function cerrarCompra(){

        if (isset($_GET['idCerrar'])){

            $datosController = $_GET['idCerrar'];
            $respuesta = Datos::mdlCerrarCompra($datosController);

            echo "<script type='text/javascript'>
                		alert('".$respuesta."');
                		window.location.href='listaComprasNuez.php'
                	 </script>";

            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Compra Cerrada!');
                		window.location.href='listaComprasNuez.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------------------------------








    #BORRAR VENTAS
    #-----------------------------+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-------
    public function borrarVentas(){
    	if (isset($_GET['idBorrar'])){
			// buscar la compra idBorrar y traer las operaciones registradas
			$compras = Datos::mdlBuscaVentaBorar($_GET['idBorrar']);

			$jsonItem = json_decode($compras[0], true);  //esto arroja un arreglo

			foreach ($jsonItem as $item){	//recorremos el arreglo
				$devuelve = Datos::mdlActualizaInventario($item["operacion"], $item['kilos']);
				//echo $item["operacion"].' - '. $item['kilos']."<br>";
			};

			if ($devuelve == "success"){
				    $respuesta = Datos::mdlborrarVenta($_GET['idBorrar'],"salidas");
		            if ($respuesta == "success"){
		                echo "<script type='text/javascript'>
		                		alert('Venta Eliminada, inventario devuelto');
		                		window.location.href='listaVentas.php'
		                	 </script>";
		            }
		            else{
		            	echo'<script type="text/javascript">alert("No se Elimino la venta!");</script>';
		            }

			}
			else{
		        	echo'<script type="text/javascript">alert("El inventario no coincide!");</script>';
		        }

		}



    }



    #BORRAR PROVEEDOR
    #------------------------------------
    public function borrarProveedor(){

        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarProveedor($datosController,"proveedores");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Registro Eliminado');
                		window.location.href='listaProveedores.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }

    #Borrar Unidad

    public function borrarUnidad () {

    	if (isset($_GET['idBorrar'])) {

    		$datosController = $_GET['idBorrar'];
    		$Respuesta = Datos::mdlBorrarUnidad($datosController, "unidades");

    		if ($Respuesta == "success") {
    			echo "<script type='text/javascript'>
    				alert('Registro Eliminado');
    				window.location.href='listaUnidades.php';
    			</script>";
    		}
    		else {
    			echo "<script tupe='text/javascript'>alert('Error');</script>";
    		}

    	}

    }

    public function borrarRemolque () {
    	if (isset($_GET['idBorrar'])) {

    		$DatosController = $_GET['idBorrar'];
    		$Respuesta = Datos::mdlBorrarRemolque($DatosController, "remolques");

    		if ($Respuesta == "success") {
    			echo "<script type='text/javascript'>
    				alert('Registro Eliminado');
    				window.location.href='listaRemolques.php';
    			</script>";
    		}
    		else {
    			echo "<script tupe='text/javascript'>alert('Error al eliminar el registro');</script>";
    		}

    	}
    }

	#LISTADO DE TODOS LOS USUARIOS
    #------------------------------------
    public function listaUsuarios(){

        $respuesta = Datos::mdlListaUsuarios("usuarios");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;
            if ($item["rol"] == 0) $tipoAcceso = "Administrator";
            if ($item["rol"] == 1 ) $tipoAcceso = "Usuario";
            if ($item["rol"] == 2 ) $tipoAcceso = "Engineer";
            if ($item["rol"] == 3 ) $tipoAcceso = "Accountant";


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$tipoAcceso.'</td>
                  <td><a href="updtUsuario.php?idEditar='.$item["id"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaUsuarios.php?idBorrar='.$item["id"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
        }

    }

    #LISTADO DE TODOS LOS PRODUCTOS
    #------------------------------------
    public function listaProductos(){

        $respuesta = Datos::mdlListaProductos("productos");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["codProducto"].'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["tipo"].'</td>
                  <td><a href="updtProducto.php?idEditar='.$item["idProducto"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaProductos.php?idBorrar='.$item["idProducto"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
        }

    }


	#LISTADO DE TODOS LOS CHOFERES
    #------------------------------------
    public function listaChoferes(){

        $respuesta = Datos::mdlListaChoferes("choferes");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;
            // if ($item["rol"] == 0) $tipoAcceso = "Administrator";
            // if ($item["rol"] == 1 ) $tipoAcceso = "Usuario";
            // if ($item["rol"] == 2 ) $tipoAcceso = "Engineer";
            // if ($item["rol"] == 3 ) $tipoAcceso = "Accountant";


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["rfc"].'</td>
                  <td>'.$item["ine"].'</td>
                  <td>'.$item["licencia"].'</td>
                  <td>'.$item["telefono"].'</td>
                  <td>'.$item["telefono2"].'</td>
                  <td style="text-align: center">'.$item["fechaIngreso"].'</td>
                  <td><a href="updtChofer.php?idEditar='.$item["idChofer"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaChoferes.php?idBorrar='.$item["idChofer"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
        }

    }


    #LISTADO DE TODOS LOS CLIENTES
    #------------------------------------
    public function listaClientes(){

        $respuesta = Datos::mdlListaClientes("clientes");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["razonSocial"].'</td>
                  <td>'.$item["rfc"].'</td>
                  <td>'.$item["direccion"].'</td>
                  <td>'.$item["ubicacion"].'</td>
                  <td>'.$item["telefono"].'</td>
                  <td>'.$item["celular"].'</td>
                  <td>'.$item["contacto"].'</td>
                  <td>'.$item["lineaCredito"].'</td>
                  <td><a href="updtCliente.php?idEditar='.$item["idCliente"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaClientes.php?idBorrar='.$item["idCliente"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
        }

    }



   #LISTADO DE TODOS LAS COMPRAS
    #------------------------------------
    public function listaCompras(){

        $respuesta = Datos::mdlListaCompras("entradas");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["noOperacion"].'</td>
                  <td>'.$item["proveedor"].'</td>
                  <td>'.$item["productor"].'</td>
                  <td>'.$item["codProducto"].'</td>
                  <td>'.$item["kg"].'</td>
                  <td>'.$item["precio"].'</td>
                  <td>'.$item["costoTotal"].'</td>
                  <td>'.$item["total"].'</td>
                  <td>'.$item["fecha"].'</td>
                  <td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaCompras.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger">Borrar</button></a></td>

                </tr>';
                //Boton editar
                //Boton Borrar 		<a href="listaCompras.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger">Borrar</button></a>
                //<td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
        }

    }


   #LISTADO DE LAS COMPRAS ACTIVAS
    #------------------------------------
    public function listaComprasActivas(){

        $respuesta = Datos::mdlListaComprasActivas("entradas");

        foreach ($respuesta as $row => $item){



        echo '<tr>
                  <td>'.$item["noOperacion"].'</td>
                  <td>'.$item["proveedor"].'</td>
                  <td>'.$item["productor"].'</td>
                  <td>'.$item["codProducto"].'</td>
                  <td>'.$item["kg"].'</td>
                  <td>'.$item["precio"].'</td>
                  <td>'.$item["costoTotal"].'</td>
                  <td>'.$item["total"].'</td>
                  <td>'.$item["fecha"].'</td>
                  <td>
                  <a href="updtCompraNuez.php?idEditar='.$item["cons"].'"><button class="btn btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                  <a href="listaComprasNuez.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button></a>
                  <a href="listaComprasNuez.php?idCerrar='.$item["cons"].'" ><button class="btn btn-primary"><i class="fa fa-fw fa-lock"></i></button></a>
                  </td>
                </tr>';
                //<td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
        }

    }

       #LISTADO DE LAS COMPRAS CERRADAS
    #------------------------------------
    public function comprasCerradas(){

        $respuesta = Datos::mdlListaComprasCerradas("entradas");

        foreach ($respuesta as $row => $item){



        echo '<tr>
                  <td>'.$item["noOperacion"].'</td>
                  <td>'.$item["proveedor"].'</td>
                  <td>'.$item["productor"].'</td>
                  <td>'.$item["codProducto"].'</td>
                  <td>'.$item["kg"].'</td>
                  <td>'.$item["precio"].'</td>
                  <td>'.$item["costoTotal"].'</td>
                  <td>'.$item["total"].'</td>
                  <td>'.$item["fecha"].'</td>
                  <td>
                  <a href="detalleCompraNuez.php?idEditar='.$item["cons"].'" title="Detalles"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>';

              //<a href="comprasCerradas.php?idAbrir='.$item["cons"].'" title="Abrir Compra"><button class="btn btn-success"><i class="fa fa-fw fa-unlock"></i></button></a>';
              //    <a href="comprasCerradas.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button></a>

                echo'  </td>
                </tr>';
                //<td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
        }

    }


   #LISTADO DE TODOS LAS VENTAS
    #------------------------------------
    public function listaVentas(){

        $respuesta = Datos::mdlListaVentas("salidas");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;
        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["noOperacion"].'</td>
                  <td>'.$item["cliente"].'</td>
                  <td>'.$item["codProducto"].'</td>
                  <td>'.$item["kg"].'</td>
                  <td>'.$item["origen"].'</td>
                  <td>'.$item["destino"].'</td>
                  <td>'.$item["precioVenta"].'</td>
                  <td>'.$item["costo"].'</td>
                  <td>'.$item["total"].'</td>
                  <td>'.$item["fecha"].'</td>
                  <td><a href="listaVentas.php?idBorrar='.$item["cons"].'"><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
                //Boton Borrar
                //Boton Editar <td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
        }

    }





    #LISTADO DE TODOS LOS PROVEDDORES
    #------------------------------------
    public function listaProveedores(){

        $respuesta = Datos::mdlListaProvedores("proveedores");
        $cont =0;

        foreach ($respuesta as $row => $item){
        	$cont ++;


        echo '<tr>
                  <td>'.$cont.'</td>
                  <td>'.$item["codProveedor"].'</td>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["razonSocial"].'</td>
                  <td>'.$item["rfc"].'</td>
                  <td>'.$item["direccion"].'</td>
                  <td>'.$item["ubicacion"].'</td>
                  <td>'.$item["telefono"].'</td>
                  <td>'.$item["celular"].'</td>
                  <td>'.$item["contacto"].'</td>
                  <td><a href="updtProveedor.php?idEditar='.$item["id"].'"><button class="btn btn-warning">Editar</button></a></td>
                  <td><a href="listaProveedores.php?idBorrar='.$item["id"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
        }

    }

    #Listado de todas las unidades

    public function listaUnidades () {
    	$Respuesta = Datos::mdlListaUnidades("unidades");
    	$Contador = 0;

    		foreach ($Respuesta as $Row => $Item) {
    			$Contador++;

    			echo "<tr>
    					<td>".$Contador."</td>
    					<td>".$Item["noEconomico"]."</td>
    					<td>".$Item["marca"]."</td>
    					<td>".$Item["modelo"]."</td>
						<td>".$Item["placas"]."</td>
						<td>".$Item["kilometraje"]."</td>
						<td><a href='updtUnidad.php?idEditar=".$Item["idUnidad"]."'><button class='btn btn-warning'>Editar</button></a></td>
						<td><a href='listaUnidades.php?idBorrar=".$Item["idUnidad"]."'><button class='btn btn-danger'>Borrar</button></a></td>
    				</tr>";

    		}

    }

    public function listaRemolques () {
    	$Respuesta = Datos::mdlListaRemolques("remolques");
    	$Contador = 0;
    	foreach ($Respuesta as $Row => $Item) {
    			$Contador++;

    			echo "<tr>
    					<td>".$Contador."</td>
    					<td>".$Item["noEconomico"]."</td>
    					<td>".$Item["marca"]."</td>
    					<td>".$Item["anio"]."</td>
						<td>".$Item["placas"]."</td>
						<td><a href='updtRemolque.php?idEditar=".$Item["id"]."'><button class='btn btn-warning'>Editar</button></a></td>
						<td><a href='listaRemolques.php?idBorrar=".$Item["id"]."'><button class='btn btn-danger'>Borrar</button></a></td>
    				</tr>";

    		}
    }


    public function ctlRporteCompras() {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		$cont = 0;
    		$kgs = 0;
    		$costo = 0;
    		$total = 0;
    		$region = 'en_US';
			$currency = 'USD';
			$formatter = new NumberFormatter($region, NumberFormatter::CURRENCY);


			$Parametros = array("producto" => $_POST["producto"],
								"proveedor" => $_POST["proveedor"],
								"de" => $_POST["de"],
								"hasta" => $_POST["hasta"]);

			$Respuesta = Datos::mdlReporteCompras($Parametros);

			$de = date_create($_POST["de"]);
			$hasta = date_create($_POST["hasta"]);

			echo '<div class="row">
					<div class="col-md-8">
						<div class="box box-primary">
							<div class="box-header with-border">
									<h3 class="box-title">'.$_POST["proveedor"].' &nbsp;&nbsp;&nbsp;&nbsp; '.date_format($de, 'd-M').'  &nbsp;&nbsp; al &nbsp;&nbsp; '.date_format($hasta, 'd-M').' </h3>
								</div>
							<div class="box-body no-padding">
				              <table class="table table-striped">
				                <tbody>
				                <tr>
				                  <th style="width: 50px">operacion</th>
				                  <th style="width: 50px">precio</th>
				                  <th style="width: 50px">lote</th>
				                  <th style="width: 50px">kgs.</th>
				                  <th style="width: 50px">total</th>
				                </tr>';
				                foreach ($Respuesta as $Row => $Item) {
									$cont++;
									$kgs += $Item["kg"];
									$costo += $Item["costoTotal"];
									$total += $Item["total"];

									echo '<tr>
											<td>'.$Item["noOperacion"].'</td>
											<td>'.$Item["precio"].'</td>
						                  	<td>'.$Item["lote"].'</td>
						                  	<td>'.$Item["kg"].'</td>
						                  	<td>'.$Item["total"].'</td>
						                  </tr>';
						    	}

				          echo '</tbody></table>
				            </div>

						</div>
					</div>
					<div class="col-md-4">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h2 >Totales</h2>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-md-4">
										<h4>Operaciones</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>'. $cont .'<h4>
									</div>
									<div class="col-md-2"></div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<h4>Kilos</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>'. $kgs .'</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h4>Total</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4><strong>';
										$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
										echo $formatter->formatCurrency($total, 'USD'), PHP_EOL;

										echo '</strong></h4>
									</div>
									<div class="col-md-2"></div>
								</div>
							</div>
						</div>
					</div>

				</div>';





    	}
    }




       public function ctlRporteVentas() {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		$cont = 0;
    		$kgs = 0;
    		$costo = 0;
    		$total = 0;
    		$utilidad = 0;
    		$region = 'en_US';
			$currency = 'USD';
			$formatter = new NumberFormatter($region, NumberFormatter::CURRENCY);


			$Parametros = array("producto" => $_POST["producto"],
								"cliente" => $_POST["cliente"],
								"de" => $_POST["de"],
								"hasta" => $_POST["hasta"]);

			$Respuesta = Datos::mdlReporteVentas($Parametros);

			$de = date_create($_POST["de"]);
			$hasta = date_create($_POST["hasta"]);

			echo '<div class="row">
					<div class="col-md-8">
						<div class="box box-success">
							<div class="box-header with-border">
									<h3 class="box-title">'.$_POST["cliente"].' &nbsp;&nbsp;&nbsp;&nbsp; '.date_format($de, 'd-M').'  &nbsp;&nbsp; al &nbsp;&nbsp; '.date_format($hasta, 'd-M').' </h3>
								</div>
							<div class="box-body no-padding">
				              <table class="table table-striped">
				                <tbody>
				                <tr>
				                  <th style="width: 50px">operacion</th>
				                  <th style="width: 30px">precio</th>
				                  <th style="width: 50px">kgs</th>
				                  <th style="width: 50px">Costo</th>
				                  <th style="width: 50px">Total</th>
				                  <th style="width: 50px">utilidad</th>
				                </tr>';
				                foreach ($Respuesta as $Row => $Item) {
									$cont++;
									$kgs += $Item["kg"];
									$costo += $Item["costo"];
									$total += $Item["total"];
									$utilidad += $Item["utViaje"];

									echo '<tr>
											<td>'.$Item["noOperacion"].'</td>
											<td>'.$Item["precioVenta"].'</td>
						                  	<td>'.$Item["kg"].'</td>
						                  	<td>'.$Item["costo"].'</td>
						                  	<td>'.$Item["total"].'</td>
						                  	<td>'.$Item["utViaje"].'</td>
						                  </tr>';
						    	}

				          echo '</tbody></table>
				            </div>

						</div>
					</div>
					<div class="col-md-4">
						<div class="box box-success">
							<div class="box-header with-border">
								<h2 >Totales</h2>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-md-4">
										<h4>Operaciones</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>'. $cont .'<h4>
									</div>
									<div class="col-md-2"></div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<h4>Kilos</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>'. $kgs .'</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h4>Costo</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>';
										$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
										echo $formatter->formatCurrency($costo, 'USD'), PHP_EOL;
									echo '</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h4>Total</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4>';
										echo $formatter->formatCurrency($total, 'USD'), PHP_EOL;

										echo '</h4>
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h4>Utilidad</h4>
									</div>
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<h4><strong>';
										//$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
										echo $formatter->formatCurrency($utilidad, 'USD'), PHP_EOL;
									echo '</strong></h4>
									</div>
									<div class="col-md-2"></div>
								</div>
							</div>
						</div>
					</div>

				</div>';





    	}
    }






	#-------------------------------------
	#Busca los productos de la tabla inventarioNuez y genera reporte por producto
	#------------------------------------

    public function ctlInventarioNuez () {
    	//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		//$Respuesta = Datos::mdlInventarioNuez ($_POST["producto"]);
    		$Respuesta = Datos::mdlInventarioNuez ();
    		foreach ($Respuesta as $Row => $item) {
	    		echo "<tr>
	    			<td>".$item["nombre"]."</td>
	    			<td>".$item["calidad"]."</td>
	    			<td>".$item["kgs"]."</td>
	    			<td>".$item["precioPromedio"]."</td>
	    		</tr>";
	    	}


    	//}
    }




    public function ctlListaReportes () {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    			$Datos = $_POST["ans"];
	    	foreach ($Datos as $Row => $item) {
	    		echo "<tr>
	    			<td>".$item["noOperacion"]."</td>
	    			<td>".$item["fecha"]."</td>
	    			<td>".$item["proveedor"]."</td>
	    			<td>".$item["productor"]."</td>
	    			<td>".$item["precio"]."</td>
	    			<td>".$item["kg"]."</td>
	    			<td>".$item["costoTotal"]."</td>
	    			<td>".$item["total"]."</td>
	    		</tr>";
	    	}

    	}
    }

//Busca el inventario de cierto producto para las graficas de la pantalla de inicio
public function ctlBuscarInventario ($codProducto) {
			$respuesta = Datos::mdlInventario($codProducto);

				foreach ($respuesta as $Row => $item) {
					$inv = (is_null($item['inventario'])) ? 0:$item['inventario'];
					$kgs = (is_null($item['kgs'])) ? 0:$item['kgs'];
					$porcentaje = (is_null($item['porcentaje'])) ? 0:$item['porcentaje'];

				echo '<span class="progress-number"><b>'.$inv.'</b>/'.$kgs.'</span>';
				echo '<div class="progress sm">
	                      <div class="progress-bar progress-bar-aqua" style="width: '.$porcentaje.'%"></div>
	                    </div>';
	            }
        	}






    public function ctlPromedios ($Cosa) {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {

    		$Datos = $_POST["ans"];
    		$SumaPrecio = 0.0;
    		$SumaKg = 0.0;
    		$SumaCosto = 0.0;
    		$SumaTotal = 0.0;
    		$Contador = 0;

    		foreach($Datos as $Row => $item) {
    				$SumaPrecio += $item["precio"];
    				$SumaKg += $item["kg"];
    				$SumaCosto += $item["costoTotal"];
    				$SumaTotal += $item["total"];
    				$Contador++;
    		}
    		if ($SumaPrecio != 0.0) {
    			$SumaPrecio /= $Contador;
    		}


    		echo "
    			<div class='col-md-4'>
						<div class='box box-primary'>
							<div class='box-header with-border'>
								<h3 class='box-title'>Reporte</h3>
							</div>
							<div class='box-body'>
								<div class='row'>
									<div class='col-md-6'>
										<h4>Precio promedio</h4>
									</div>
									<div class='col-md-2'></div>
									<div class='col-md-2'>
										<h4>".
											number_format($SumaPrecio, 3)
										."
										</h4>
									</div>
									<div class='col-md-2'></div>
								</div>

								<div class='row'>
									<div class='col-md-6'>
										<h4>KG totales</h4>
									</div>
									<div class='col-md-2'></div>
									<div class='col-md-2'>
										<h4>".
											number_format($SumaKg, 3)
										."
										</h4>
									</div>
									<div class='col-md-2'></div>
								</div>
								<div class='row'>
									<div class='col-md-6'>
										<h4>Costo Total</h4>
									</div>
									<div class='col-md-2'></div>
									<div class='col-md-2'>
										<h4>".
											number_format($SumaCosto, 3)
										."
										</h4>
									</div>
									<div class='col-md-2'></div>
								</div>
								<div class='row'>
									<div class='col-md-6'>
										<h4>Total</h4>
									</div>
									<div class='col-md-2'></div>
									<div class='col-md-2'>
										<h4>".
											number_format($SumaTotal, 3)
										."
										</h4>
									</div>
									<div class='col-md-2'></div>
								</div>
							</div>
						</div>
					</div>";
    	}
    }

    	#-------------------------------------
	#Busca los productos de la tabla productos Solo el nombre
	#------------------------------------
	public function ctlBuscaProductosNombre(){

		$respuesta = Datos::mdlProductosTodos("productos");

		foreach ($respuesta as $row => $item){
			echo "<option>".$item["codProducto"]."</option>";
		}
	}

	#-------------------------------------
	#Cuenta las compras hechas
	#------------------------------------
	public function ctlCuentaCompras($ops){

		$respuesta = Datos::mdlCuentaOps($ops);

		foreach ($respuesta as $row => $item){
			echo  $item["resultado"];
		}
	}


	#DATOS PARA GRAFICA 1
    #------------------------------------
    public function grafica1Controller(){
    	//  crea el array para las citas atendidas
        $respuesta = Datos::graficaMensualModel("salidas");
        $meses = array();
        $cantA = array();
        foreach ($respuesta as $row => $item){
            array_push($meses, $item["mes"]);
            array_push($cantA, $item["total"]);

        }


        // Crea array para citas agendadas
        $respuesta = Datos::graficaMensualModel("entradas");
        $mesesCompras = array();
        $cantCompras = array();
        foreach ($respuesta as $row => $item){
            array_push($mesesCompras, $item["mes"]);
            array_push($cantCompras, $item["total"]);

        }

        // // Crea array para citas referidas
        // $respuesta = Datos::grafica1cModel("presupuestos");
        // //$meses = array();
        // $cantC = array();
        // foreach ($respuesta as $row => $item){
        //     //array_push($meses, $item["mes"]);
        //     array_push($cantC, $item["cantidad"]);

        // }


     echo "<script>
  $(function () {

    var areaChartCanvas = $('#graficaVentas').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  :".json_encode($meses).",
      datasets: [
        {
          label               : 'Ventas',
          fillColor           : 'rgba(100, 200, 50, .5)',
          strokeColor         : 'rgba(100, 200, 50, 1)',
          pointColor          : 'rgba(100, 200, 50, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ". json_encode($cantA,JSON_NUMERIC_CHECK)."
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  })
</script>";

echo "<script>
  $(function () {

    var areaChartCanvas = $('#graficaCompras').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  :".json_encode($mesesCompras).",
      datasets: [
        {
          label               : 'Ventas',
          fillColor           : 'rgba(50, 214, 222, .5)',
          strokeColor         : 'rgba(50, 214, 222, 1)',
          pointColor          : 'rgba(50, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ". json_encode($cantCompras,JSON_NUMERIC_CHECK)."
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  })
</script>";
}







}//Clase principal

?>