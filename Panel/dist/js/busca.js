function buscaEntrada(entrada) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            var xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
              var responseArray = xmlhttp.responseText;
                if (responseArray == 1){
                    alert ('Numero de Operacion ya Existe! ');
                    document.getElementById("operacion").focus();
                    document.getElementById("operacion").value="";
                }

            }
        }
        xmlhttp.open("GET","includes/buscaEntrada.php?entrada="+entrada,true);
        xmlhttp.send();
    }


    function buscaSalida(salida) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            var xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var responseArray = xmlhttp.responseText;
                if (responseArray == 1){
                    alert ('Numero de Operacion ya Existe! ');
                    document.getElementById("operacion").focus();
                    document.getElementById("operacion").value="";
                }
            }
        }
        //xmlhttp.open("GET","includes/buscaEntrada.php?entrada="+entrada,true);
        xmlhttp.open("GET","includes/buscaSalida.php?salida="+salida,true);
        xmlhttp.send();
    }


