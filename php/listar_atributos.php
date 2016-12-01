<?php
  function listar_tablas(){
    include "conexion_servidor.php";
	$basedatos = $_POST["basedatos"];
	$tabla = $_POST["tabla"];
    $tables = "<option value=''> Selecciona atributo</option>";
	$sql = "USE $basedatos";
	$conn->query($sql);
    $sql = "DESC $tabla";
    foreach ($conn->query($sql) as $row){
		$tables .= "<option value='$row[0]'>".$row[0]."</option>";
    }
    echo $tables;
    $conn = null;
  }
  listar_tablas();
?>
