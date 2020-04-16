
function calculaCompra(){
var kgs = parseFloat(document.querySelector("#kg").value);
var precio = parseFloat(document.querySelector("#precio").value);
var comision = parseFloat(document.querySelector("#comision").value);
var flete = parseFloat(document.querySelector("#flete").value);
var maniobra = parseFloat(document.querySelector("#maniobra").value);
var anticipo = parseFloat(document.querySelector("#anticipo").value);

var costo=0, costoTotal;

if (isNaN(kgs) || kgs=="") kgs = 0;
if (isNaN(precio) || precio=="") precio = 0;
if (isNaN(flete) || flete=="") flete = 0;
if (isNaN(maniobra) || maniobra=="") maniobra = 0;
if (isNaN(anticipo)|| anticipo=="") anticipo = 0;
if (isNaN(comision) || comision =="") comision = 0;

costo = (kgs * precio) + comision;
costoTotal = (kgs * precio) + (comision + flete + maniobra) - anticipo;

  document.querySelector("#costo").value = costo;
  document.querySelector("#totalCompra").value = costoTotal;

  document.querySelector("#costoLbl").innerHTML = '$ ' + numeral(costo).format('0,0.00');
  document.querySelector("#totalCompraLbl").innerHTML = '$ ' + numeral(costoTotal).format('0,0.00');

}



