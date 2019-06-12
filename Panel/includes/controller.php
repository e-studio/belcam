<?php

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
	#Busca los productos de la tabla productos
	#------------------------------------
	public function ctlBuscaProductos(){

		$respuesta = Datos::mdlProductos("productos");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["codProducto"].'">'.$item["nombre"].'</option>';
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


}//Clase principal

?>