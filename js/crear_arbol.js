document.getElementById("crearArbol").addEventListener("click", crear_arbol);

function crear_arbol(){
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
				 var datos = JSON.parse(http_request.responseText);
				 console.log('Datos',datos);
				 formar_arbol(datos);
			}
		}
		http_request.open("POST", "php/crear_arbol.php", true);
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

function formar_arbol(datos){
	var tree = {
		"root": "",
		"childs": [],
		"top": true
	}

	// SI ALGO LA CAGA ES ESTO:
	agregarMaxGanancia(tree, datos);
	while (datos.length > 2 ) {
		agregarMaxGanancia(tree.childs[obtenerSiguienteMaximo(tree)], datos);
	}

	// console.log("Datos", datos);

	console.log("Arbol", tree);

	window.arbol = tree;
}

function agregarMaxGanancia(tree, datos){
	var indexMaxGanancia = 1;
	for (var i = 0; i < datos.length; i += 1) {
		if (datos[i].GananciaAttr && datos[i].GananciaAttr >= datos[indexMaxGanancia].GananciaAttr) {
			indexMaxGanancia = i;
		}
	}
	tree["root"] = datos[indexMaxGanancia].NombreAttr;
	datos[indexMaxGanancia].Atributos.forEach(function(item){
		item.childs = [];
		tree.childs.push(item);
	})
	datos.splice(indexMaxGanancia, 1);
}

function obtenerSiguienteMaximo(tree){
	var indexMax = 0;
	tree.childs.forEach(function(item, index){
		if(item.childs.length == 0){
			if(item.entropia > indexMax) {
				indexMax = index;
			}
		}
	})
	return indexMax;
}
