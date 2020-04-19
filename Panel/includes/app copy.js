// variables   -------------------------------------------------------------------------------
const btnAgregar = document.querySelector('#btnAgregar');
const btnGrabar = document.querySelector('#btnGrabar');
const tabla = document.querySelector('#lista-productos tbody');
var total = 0, suma=0, cont=0, promedio=0.0;
var datos  = [];
var objeto = {};

const btnBorrar = document.querySelector('#borraElemento');
const row =document.createElement('tr');
var listaCompras = document.querySelector("#listaCompras");
var recalcFlag = true;



//Listeners -----------------------------------------------------------------------------------
//Cuando se presione el boton de agregar
btnAgregar.addEventListener('click', obtenerEvento);
//Cuando se presione el boton de boorar producto
tabla.addEventListener('click', borraElemento);



function obtenerEvento(e) {
	e.preventDefault();

  var datosJson, costoMerma = 0, utTotal=0, kgVenta=0;
  var costoTotal = parseFloat(document.querySelector("#costo").value);
  var costoInicial = parseFloat(document.querySelector("#costoInicial").value);
	var operacion = document.querySelector("#operacionCompra");
  var totalKgs = parseInt(document.querySelector("#kgVenta").value);
  var kilos = parseFloat(document.querySelector('#kilos').value);
  var precioVenta = parseFloat(document.querySelector("#precioVenta").value);
  var flete = parseFloat(document.querySelector("#flete").value);
  var maniobra = parseFloat(document.querySelector("#maniobra").value);
  var merma = parseFloat(document.querySelector("#merma").value);
  var comision = parseFloat(document.querySelector("#costoComision").value);
  //var costoComision = parseFloat(document.querySelector("#").value);

if (isNaN(precioVenta) || precioVenta == 0 || kilos == 0){
    alert("Revise Precio de Venta y/o Kilos no sea 0");
    document.getElementById("precioVenta").focus();
  }
  else{
      if (isNaN(merma)) merma = 0;
      if (isNaN(flete)) flete = 0;
      if (isNaN(maniobra)) maniobra = 0;
      kgVenta = totalKgs + kilos;

      var ventaTotal = (precioVenta * (kgVenta));
    	var operacionText = operacion.options[operacion.selectedIndex].text;
      var array = operacionText.split(' - '),
                  operacion = array[0],
                  proveedor = array[1],
                  kgsDisponibles= array[2],
                  precio = array[3];

      if (kgsDisponibles < kilos) {
        alert("Solo dispone de " + kgsDisponibles + " kgs ");
        document.querySelector('#kilos').value = 0;
        document.querySelector('#kilos').focus();
        return
      }

    	if (precioVenta == 0 || isNaN(precioVenta)) precioVenta = 0;
      if (kilos=="" || kilos==0 ||  isNaN(kilos)) kilos = 0;


      if (precio > 0 ) {
        cont+=1;
        // costoComision += (kilos * comision);
      }
      else {
        // document.getElementById("precioVenta").setAttribute("disabled", true);
        // document.getElementById("costoComision").setAttribute("disabled", true);
        // document.getElementById("merma").setAttribute("disabled", true);
        // recalcFlag = false;  // se desactiva la funcion de recalcular porque tengo una merma a favor
      }
      suma += parseFloat(precio);
      promedio = suma/ cont;


      //-----------------------------------------------------------------------------
      // el costo total se va acumulando segun se agregan kg para contemplar operaciones
      // de kg que tienen valor de compra $0
      costoTotal = costoTotal + (parseFloat(precio)* kilos );
      costoInicial = costoInicial + (parseFloat(precio)* kilos );
      document.querySelector("#costoInicial").value = costoInicial;
      //-----------------------------------------------------------------------------


      costoMerma = merma * precioVenta;
      utTotal = ventaTotal - costoTotal - costoMerma;

      document.querySelector("#totalVenta").value = ventaTotal;
      document.querySelector("#kgVenta").value = kgVenta;
      document.querySelector("#costoUnitario").value = promedio;
      document.querySelector("#costoComision").value = comision;
      document.querySelector("#costo").value = costoTotal;

      document.querySelector("#utViaje").value = utTotal;
      document.querySelector("#costoMerma").value = costoMerma;
      document.querySelector("#ventaTitulo").innerHTML = '$ ' + numeral(utTotal).format('0,0.00');
      document.querySelector('#kilos').value = 0;


      datos.push({
            "operacion": operacion,
            "kilos"    : kilos,
            "precio"   : precio
        });
      objeto = datos;
      listaCompras.value = JSON.stringify(objeto);

      insertarRowTabla(operacionText, kilos, precio);
      recalcula();
    }// validacion del precio de venta

}


//====================================================================================================


function insertarRowTabla(operacion, kg, precio){
	const row =document.createElement('tr');
	row.innerHTML = `
                    <td>${operacion}</td>
                    <td>${kg}</td>
                    <td>${precio}</td>
	`;

	tabla.appendChild(row);
}

//==================================================================================================

   function recalcula(){
     var costoInicial = parseFloat(document.querySelector("#costoInicial").value);
      if (costoInicial != 0 ){
          // Sub total de la venta
          const precio = parseFloat(document.querySelector('#precioVenta').value);
          var totalKgs = parseFloat(document.querySelector("#kgVenta").value);
          var venta = precio * totalKgs;

          var merma = parseFloat(document.querySelector("#merma").value);
          var costoMerma = precio * merma;

          var comision = parseFloat(document.querySelector("#costoComision").value);
          var flete = parseFloat(document.querySelector("#flete").value);
          var maniobra = parseFloat(document.querySelector("#maniobra").value);
          //var costo = parseFloat(document.querySelector("#costo").value);

          //console.log("CostoUnitario:"+costoUnitario+" totalKgs:"+totalKgs+" Comision:"+comision+" Costo Merma:"+ costoMerma +" Flete:"+ flete +" Manniobra:"+ maniobra)

          var costo = costoInicial + costoMerma + comision + flete + maniobra;
          var utilidad = venta - costo;

          //console.log("Venta:"+venta+" costo:"+costo+" costoMerma:"+costoMerma+" comision:"+totComision+" Utilidad:"+utilidad);


          document.querySelector('#totalVenta').value = venta;
          document.querySelector('#costo').value = costo;
          //document.querySelector('#costoComision').value = totComision;
          document.querySelector("#costoMerma").value = costoMerma;
          document.querySelector("#utViaje").value = utilidad;   //utViaje es utilidad de la venta que se graba en la bd
          document.querySelector("#ventaTitulo").innerHTML = '$ ' + numeral(utilidad).format('0,0.00');  // total con letras grandes solo de muestra

      }

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


                  // var kilos = numeral(responseArray[i+2]).format('0,0');
                  // var precio = numeral(responseArray[i+3]).format('0,0.00');

                  var kilos = responseArray[i+2];
                  var precio = responseArray[i+3];
                  //console.log(operacion+' - '+ proveedor +' - '+ kilos +' - '+ precio);

                  var opcion=`<option value="${operacion}">${operacion} - ${proveedor} - ${kilos} - ${precio}</option>`;
                  $('#operacionCompra').append(opcion);

                }

                //btnAgregar.disabled = false;

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


    function agregarOn(){  //se manda llamr desde el onblur de kilos del formulario
      btnAgregar.disabled = false;
      btnAgregar.focus();
    }

    function grabarOn(valor){  //se manda llamr desde el onblur de kilos del formulario
      btnGrabar.disabled = false;
      btnGrabar.focus();
    }

    function borraElemento(e){
      e.preventDefault();
      if(e.target.classList.contains('borrar')){
        const ele = e.target;
        console.log(ele)
      }

    }


