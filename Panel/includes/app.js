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
function obtenerEvento(e) {
	e.preventDefault();
  cont+=1;

  var datosJson;

	var operacion = document.querySelector("#operacionCompra");
  var totalKgs = parseInt(document.querySelector("#kgVenta").value);
  var kilos = parseInt(document.querySelector('#kilos').value);
  var precioVenta = parseFloat(document.querySelector("#precioVenta").value);
  var flete = parseFloat(document.querySelector("#flete").value);
  var maniobra = parseFloat(document.querySelector("#maniobra").value);

  if (isNaN(flete)) flete =0;
  if (isNaN(maniobra)) maniobra =0;

  var ventaTotal = (precioVenta * (totalKgs + kilos)) - (flete+ maniobra) ;
  var costoTotal = 0;
	var operacionText = operacion.options[operacion.selectedIndex].text;
  var array = operacionText.split(' - '),
  operacion = array[0], proveedor = array[1], precio = array[3];

	if (precioVenta == 0 || isNaN(precioVenta)) precioVenta = 0;
  if (kilos=="" || kilos==0 ||  isNaN(kilos)) kilos = 0;

  suma += parseFloat(precio);
  promedio = suma/ cont;
  costoTotal = promedio * (totalKgs + kilos);


  // document.querySelector("#totalVenta").value = numeral(ventaTotal).format('0,0');
  // document.querySelector("#kgVenta").value= totalKgs + kilos;
  // document.querySelector("#costoUnitario").value= numeral(promedio).format('0,0.00');
  // document.querySelector("#costo").value = numeral(costoTotal).format('0,0');
  // document.querySelector("#utViaje").value = numeral(ventaTotal - costoTotal).format('0,0');

  document.querySelector("#totalVenta").value = ventaTotal;
  document.querySelector("#kgVenta").value = totalKgs + kilos;
  document.querySelector("#costoUnitario").value = promedio;
  document.querySelector("#costo").value = costoTotal;
  document.querySelector("#utViaje").value = ventaTotal - costoTotal;



  datos.push({
        "operacion": operacion,
        "kilos"    : kilos,
        "precio"   : precio
    });
  objeto = datos;
  listaCompras.value = JSON.stringify(objeto);
  //listaCompras.value = datos;



  // datosJson += JSON.stringify({ operacion: operacion, kilos: kilos, precio: parseFloat(precio) });
  // console.log(datosJson);

  insertarRowTabla(operacionText, kilos, precio);

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


    function calculaTotal(){
    	const kg = document.querySelector('#kg');
    	const precio = document.querySelector('#precio');
    	const costoTotal = document.querySelector('#costoTotal');
    	const totalCosto = document.querySelector('#totalCosto');


    }



