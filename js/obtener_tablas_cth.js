document.getElementById("cth-basedatos").addEventListener("change", busca_tablas_cth);

function busca_tablas_cth(){
	var basedatos = document.getElementById("cth-basedatos").value;
	var tablas = document.getElementById("cth-tabla");
	var atributos = document.getElementById("cth-atributo");
	if(basedatos == ""){
		tablas.innerHTML = "<option> Selecciona base de datos</option>";
		atributos.innerHTML = "<option> Selecciona base de datos</option>";
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
				tablas.innerHTML = http_request.responseText;
				atributos.innerHTML = "<option> Selecciona tabla</option>";
			}
		}
		http_request.open("POST", "php/listar_tablas.php", true);
		http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http_request.send("basedatos="+basedatos);
	}
}