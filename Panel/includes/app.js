// variables   -------------------------------------------------------------------------------
const btnAgregar = document.querySelector('#btnAgregar');
const tabla = document.querySelector('#lista-productos tbody');
var total = 0;
const btnBorrar = document.querySelector('#borraElemento');
const row =document.createElement('tr');


//Listeners -----------------------------------------------------------------------------------
//Cuando se presione el boton de agregar
//btnAgregar.addEventListener('click', obtenerEvento);
//Cuando se presione el boton de boorar producto
tabla.addEventListener('click', borraElemento);



//funciones   ---------------------------------------------------------------------------------
// function obtenerEvento(e) {
// 	e.preventDefault();

// 	var bodega = document.querySelector("#bodega");
// 	var bodegaText = bodega.options[bodega.selectedIndex].text;

// 	const kg = document.querySelector('#kg').value;

// 	insertarRowTabla(bodegaText, kg);

// 	document.querySelector("#bodega").value="";
// 	document.querySelector('#kg').value="";


// }


function insertarRowTabla(bodega, kg){
	const row =document.createElement('tr');
	row.innerHTML = `
                    <td>uno</td>
                    <td>dos</td>
                    <td><a href="http://www.google.com"><span id="borraElemento" class="badge bg-red borrar" data-id="uno">X</span></a></td>
	`;

	tabla.appendChild(row);

	var kilos = parseInt(kg);
	total+=kilos;
	document.querySelector("#totalKg").value=total;


}

function borraElemento(e){
	e.preventDefault();
	if(e.target.classList.contains('borrar')){
		const ele = e.target;
		console.log(ele)
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


    function calculaTotal(){
    	const kg = document.querySelector('#kg');
    	const precio = document.querySelector('#precio');
    	const costoTotal = document.querySelector('#costoTotal');
    	const totalCosto = document.querySelector('#totalCosto');


    }



