// variables   -------------------------------------------------------------------------------
const btnAgregar = document.querySelector('#btnAgregar');
const tabla = document.querySelector('#lista-productos tbody');
var total = 0, suma=0, cont=0, promedio=0.0;
var datos  = [];
var objeto = {};

const btnBorrar = document.querySelector('#borraElemento');
const row =document.createElement('tr');
var listaCompras = document.querySelector("#listaCompras");



//Listeners -----------------------------------------------------------------------------------
//Cuando se presione el boton de agregar
btnAgregar.addEventListener('click', obtenerEvento);
//Cuando se presione el boton de boorar producto
tabla.addEventListener('click', borraElemento);



//funciones   ---------------------------------------------------------------------------------
function validarIngreso(){
  console.log("Entro a la funcion validarIngreso");

  var expresion = /^[a-zA-Z0-9]*$/;

  if(!expresion.test($("#usuario").val())){

    return false;
  }

  if(!expresion.test($("#pass").val())){

    return false;
  }

  return true;

}


function obtenerEvento(e) {
	e.preventDefault();

  var datosJson, costoMerma = 0, utTotal=0, kgVenta=0;
  var costoTotal = parseFloat(document.querySelector("#costo").value);

	var operacion = document.querySelector("#operacionCompra");
  var totalKgs = parseInt(document.querySelector("#kgVenta").value);
  var kilos = parseFloat(document.querySelector('#kilos').value);
  var precioVenta = parseFloat(document.querySelector("#precioVenta").value);
  var flete = parseFloat(document.querySelector("#flete").value);
  var maniobra = parseFloat(document.querySelector("#maniobra").value);
  var merma = parseFloat(document.querySelector("#merma").value);

if (isNaN(precioVenta) || precioVenta == 0){
    alert("escriba el Precio de Venta");
    document.getElementById("precioVenta").focus();
  }
  else{
      if (isNaN(merma)) merma = 0;
      if (isNaN(flete)) flete = 0;
      if (isNaN(maniobra)) maniobra = 0;
      kgVenta = totalKgs + kilos;

      var ventaTotal = (precioVenta * (kgVenta)) - (flete+ maniobra) ;

    	var operacionText = operacion.options[operacion.selectedIndex].text;
      var array = operacionText.split(' - '),
      operacion = array[0], proveedor = array[1], precio = array[3];

    	if (precioVenta == 0 || isNaN(precioVenta)) precioVenta = 0;
      if (kilos=="" || kilos==0 ||  isNaN(kilos)) kilos = 0;


      if (precio > 0 ) cont+=1;
      suma += parseFloat(precio);
      promedio = suma/ cont;


//-----------------------------------------------------------------------------
// el costo total se va acumulando segun se agregan kg para contemplar operaciones
// de kg que tienen valor de compra $0
      costoTotal = costoTotal + (parseFloat(precio)* kilos )
//-----------------------------------------------------------------------------


      costoMerma = merma * precioVenta;
      utTotal = ventaTotal - costoTotal - costoMerma;

      document.querySelector("#totalVenta").value = ventaTotal;
      document.querySelector("#kgVenta").value = kgVenta;
      document.querySelector("#costoUnitario").value = promedio;
      document.querySelector("#costo").value = costoTotal;
      document.querySelector("#utViaje").value = utTotal;
      document.querySelector("#costoMerma").value = costoMerma;
      document.querySelector("#ventaTitulo").innerHTML = '$ ' + numeral(utTotal).format('0,0.00');

      datos.push({
            "operacion": operacion,
            "kilos"    : kilos,
            "precio"   : precio
        });
      objeto = datos;
      listaCompras.value = JSON.stringify(objeto);

      insertarRowTabla(operacionText, kilos, precio);
    }// validacion del precio de venta

}


function insertarRowTabla(operacion, kg, precio){
	const row =document.createElement('tr');
	row.innerHTML = `
                    <td>${operacion}</td>
                    <td>${kg}</td>
                    <td>${precio}</td>
	`;

	tabla.appendChild(row);

	// var kilos = parseInt(kg);
	// total+=kilos;
	// document.querySelector("#totalKg").value = total;

}

function borraElemento(e){
	e.preventDefault();
	if(e.target.classList.contains('borrar')){
		const ele = e.target;
		console.log(ele)
	}

}

function mensaje(){
  alert("Mensaje");
}



function buscaProducto(codigo) {
	//alert(codigo);
	//const row =document.createElement('tr');
	$ ("#lista-productos tbody tr").remove();

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            var xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

              var responseArray = xmlhttp.responseText.split("||");

              if (responseArray != ""){

	              for (var i = 0; i < responseArray.length - 1; i+=3) {

	              	var kilos = numeral(responseArray[i+1]).format('0,0');
                  var precio = numeral(responseArray[i+2]).format('0,0.00');
	              	//console.log(x);

	              	var fila='<tr class="selected" id="fila"><td>'+responseArray[i]+'</td><td>'+ kilos +'</td><td>'+ precio +'</td></tr>';
					$('#lista-productos').append(fila);

	              }
          	  }
          	  else{
          	  	var fila='<tr><td><code> No hay registros</code></td><td></td><td></td></tr>';
				$('#lista-productos').append(fila);

          	  }

            }
        }
        xmlhttp.open("GET","buscaProducto.php?codigo="+codigo,true);
        xmlhttp.send();

    }

    function buscaCompras(codigo) {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            var xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {


              var responseArray = xmlhttp.responseText.split("||");

              if (responseArray != ""){

                $('#operacionCompra').empty();
                console.log(responseArray);

                for (var i = 0; i < responseArray.length - 1; i+=4) {


                  var operacion = responseArray[i];
                  var proveedor = responseArray[i+1];


                  var kilos = numeral(responseArray[i+2]).format('0,0');
                  var precio = numeral(responseArray[i+3]).format('0,0.00');
                  //console.log(operacion+' - '+ proveedor +' - '+ kilos +' - '+ precio);

                  var opcion=`<option value="${operacion}">${operacion} - ${proveedor} - ${kilos} - ${precio}</option>`;
                  $('#operacionCompra').append(opcion);

                }

                btnAgregar.disabled = false;

              }
              else{
                var opcion=`<option>Selecione</option>`;
                $('#operacionCompra').empty();
                  $('#operacionCompra').append(opcion);

              }

            }
        }
        xmlhttp.open("GET","includes/buscaCompras.php?codigo="+codigo,true);
        xmlhttp.send();

    }


    function recalcula(){

      const precio = parseFloat(document.querySelector('#precioVenta').value);
      var totalKgs = parseFloat(document.querySelector("#kgVenta").value);
      const totalVenta = parseFloat(document.querySelector('#totalVenta').value);
      var costoUnitario = parseFloat(document.querySelector("#costoUnitario").value);
      const costo = parseFloat(document.querySelector('#costo').value);
      var merma = parseFloat(document.querySelector("#merma").value);
      var costoMerma = parseFloat(document.querySelector("#costoMerma").value);

      totalVenta = precio * totalKgs;
      costoMerma = merma * kgVenta;






      document.querySelector('#precioVenta').value = 0;
      document.querySelector("#kgVenta").value=0;
      document.querySelector('#totalVenta').value=0;
      document.querySelector("#costoUnitario").value=0;
      document.querySelector('#costo').value=0;
      document.querySelector("#merma").value=0;
      document.querySelector("#costoMerma").value=0;


      ventaTitulo
      utViaje

      console.log("totalVenta "+ventaTotal +" kgVenta "+kgVenta+ "costoUnitario" + promedio);


    }



