
<?php
require 'includes/crud.php';
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


	#-------------------------------------
	#Busca el siguiente numero de operacion
	#------------------------------------
	public function ctlBuscaNumOpEntradas($fecha){
		$busca = $fecha.'%';

		$respuesta = Datos::mdlNumOperaciones('entradas', $busca);

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
    public function buscaComprasAjax($tabla, $codigo){

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
            echo "no";
        }
        else {
        	// echo $res["noOperacion"];
            echo "si";
        }

    }

    // BUSCA SI UNA OPERACION YA EXISTE EN LA TABLA DE SALIDAS
    public function buscaSalidaAjax($codigo){

        $res = Datos::mdlSalidasAjax($codigo);
        //echo $res["noOperacion"];
        if ($res==""){
        	//echo $res["noOperacion"];
            echo "no";
        }
        else {
        	// echo $res["noOperacion"];
            echo "si";
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

			$datosUnidad = array("descripcion" => $_POST["descripcion"],
								 "kilometraje" => $_POST["kilometros"],
								 "anio" => $_POST["anio"],
								 "marca" => $_POST["marca"],
								 "modelo" => $_POST["modelo"],
								 "placas" => $_POST["placas"]);

			$Respuesta = Datos::mdlRegistroUnidad($datosUnidad, "unidades");
				if ($Respuesta == "success") {
					echo'<script type="text/javascript">
					    alert("Registro Guardado");
					    window.location.href="listaUnidades.php";
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
	public function actualizaChofer(){


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$datosController = array( "id"=>$_POST["id"],
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
								 "descripcion" => $_POST["descripcion"],
								 "kilometraje" => $_POST["kilometros"],
								 "anio" => $_POST["anio"],
								 "marca" => $_POST["marca"],
								 "modelo" => $_POST["modelo"],
								 "placas" => $_POST["placas"]);

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


	#BORRAR USUARIO
    #------------------------------------
    public function borrarUsuario(){
    	//echo'<script type="text/javascript">alert('.var_dump(isset($_GET["idBorrar"])).');</script>';

        if ($_GET['idBorrar']){
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
        if ($_GET['idBorrar']){
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

        if ($_GET['idBorrar']){
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

        if ($_GET['idBorrar']){
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
    #------------------------------------
    public function cerrarCompra(){

        if (isset($_GET['idCerrar'])){
        	//echo'<script type="text/javascript">alert("'.$_GET['idCerrar'].'");</script>';
            $datosController = $_GET['idCerrar'];
            $respuesta = Datos::mdlCerrarCompra($datosController,"entradas");
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


    #BORRAR VENTAS
    #------------------------------------
    public function borrarVentas(){

        if ($_GET['idBorrar']){
        	//echo'<script type="text/javascript">alert("'.$_GET['idBorrar'].'");</script>';
            $datosController = $_GET['idBorrar'];
            $respuesta = Datos::mdlborrarVenta($datosController,"salidas");
            if ($respuesta == "success"){
                echo "<script type='text/javascript'>
                		alert('Registro Eliminado');
                		window.location.href='listaVentas.php'
                	 </script>";
            }
            else{
            	echo'<script type="text/javascript">alert("Error!");</script>';
            }
        }
    }



    #BORRAR PROVEEDOR
    #------------------------------------
    public function borrarProveedor(){

        if ($_GET['idBorrar']){
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
                  <td>
                  <a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a>
                  </td>
                  <td><a href="listaCompras.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger">Borrar</button></a></td>

                </tr>';
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
                  <a href="updtCompra.php?idEditar='.$item["cons"].'" title="Editar Compra"><button class="btn btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                  <a href="comprasCerradas.php?idAbrir='.$item["cons"].'" title="Abrir Compra"><button class="btn btn-success"><i class="fa fa-fw fa-unlock"></i></button></a>';
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

                  <td><a href="listaVentas.php?idBorrar='.$item["cons"].'" ><button class="btn btn-danger">Borrar</button></a></td>
                </tr>';
                //<td><a href="updtCompra.php?idEditar='.$item["cons"].'"><button class="btn btn-warning">Editar</button></a></td>
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
    					<td>".$Item["placas"]."</td>
    					<td>".$Item["marca"]."</td>
    					<td>".$Item["modelo"]."</td>
						<td>".$Item["anio"]."</td>
						<td><a href='updtUnidad.php?idEditar=".$Item["idUnidad"]."'><button class='btn btn-warning'>Editar</button></a></td>
						<td><a href='listaUnidades.php?idBorrar=".$Item["idUnidad"]."'><button class='btn btn-danger'>Borrar</button></a></td>
    				</tr>";

    		}

    }


    public function ctlBuscarReportes () {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    			$Parametros = array("producto" => $_POST["producto"],
    								"de" => $_POST["de"],
    								"hasta" => $_POST["hasta"],
    								"tabla" => "entradas");

    			$Respuesta = Datos::mdlReportes($Parametros);

    			$_POST["ans"] = $Respuesta;
		    	
    	}
    }

    public function ctlListaReportes () {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    			$Datos = $_POST["ans"];
	    	foreach ($Datos as $Row => $item) {
	    		echo "<tr>
	    			<td>".$item["noOperacion"]."</td>
	    			<td>".$item["codProducto"]."</td>
	    			<td>".$item["precio"]."</td>
	    		</tr>";
	    	}
    	}
    }

    public function ctlPromedios () {
    	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    		$Datos = $_POST["ans"];
    		$Suma = 0.0;
    		$Contador = 0;
    			foreach($Datos as $Row => $item) {
    				$Suma += $item["precio"];
    				$Contador++;
    			}

    			echo $Suma / $Contador;
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

}//Clase principal

?>