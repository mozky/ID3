document.getElementById("calcularInfo").addEventListener("click", calcular_e_g);

function calcular_e_g(){
	var aux = 0;
	var nombreDB = document.getElementById("cth-basedatos").value;
	var nombreT = document.getElementById("cth-tabla").value;
	var nombreA = document.getElementById("cth-atributo").value;
	var alerta = document.getElementById("cth-msj-error");
	if(nombreDB == ""){
		aux++;
	}
	if(nombreT == ""){
		aux++;
	}
	if(nombreA == ""){
		aux++;
	}
	if(aux > 0){
		
	}else{
		var http_request = null;
		if(window.XMLHttpRequest){
			http_request = new XMLHttpRequest();
		}else{
			if(window.ActiveXObject){
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		http_request.onreadystatechange = function (){
			if((http_request.readyState == 4) && (http_request.status == 200)){
				document.getElementById("infoEG").innerHTML = http_request.responseText;
				/*if(http_request.responseText.toString().length != 0){
					var text_alerta = "	<br/>";
					text_alerta += "		<div class='alert alert-warning alert-dismissable' id='mesaje-error'>";
					text_alerta += "		<button type='button' class='close' data-dismiss='alert'>&times;</button>";
					text_alerta += "		<strong>¡Error!</strong> <br> El nombre de tabla de hechos fue creado anteriormente.";
					text_alerta += "	</div>";
					alerta.innerHTML = text_alerta;
				}else{
					
				}*/
			}
		}
		http_request.open("POST", "php/calcular_E_G.php", true);
		http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http_request.send("nombreDB="+nombreDB+"&nombreT="+nombreT+"&nombreA="+nombreA);
	}
	if(aux > 0){
		var text_alerta = "	<br/>";
		text_alerta += "		<div class='alert alert-warning alert-dismissable' id='mesaje-error'>";
		text_alerta += "		<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		text_alerta += "		<strong>¡Error!</strong> <br>Seleccione un valor en todos los campos.";
		text_alerta += "	</div>";
		alerta.innerHTML = text_alerta;
	}else{
		var text_alerta = "	<br/>";
		text_alerta += "		<div class='alert alert-success alert-dismissable' id='mesaje-confir'>";
		text_alerta += "		<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		text_alerta += "		<strong>¡Operacion terminada con exito!</strong> <br> Los resultados se encuentran a su derecha";
		text_alerta += "	</div>";
		alerta.innerHTML = text_alerta;
	}
}