<?php
	function crear_arbol(){
		include "conexion_servidor.php";
		$arbol = array ();
		$nombreDB = $_POST["nombreDB"];
		$nombreT = $_POST["nombreT"];
		$nombreA = $_POST["nombreA"];
		$sql = "USE $nombreDB";
		$conn->query($sql);
		$sql = "SELECT DISTINCT $nombreA FROM $nombreT;";
		$tables = "";
		$i = 0;
		foreach ($conn->query($sql) as $row){
			$clase[$i] = $row[0];
			$sql1 = "SELECT COUNT(*) FROM $nombreT WHERE $nombreA = '$clase[$i]';";
			foreach ($conn->query($sql1) as $row){
				$valclase[$i] = $row[0];
			}
			$i++;
		}
		$entropia_gen = calcular_entropia($valclase);

		array_push($arbol, array("NombreAtributo"=>$nombreA, "EntropiaGeneral"=>$entropia_gen));

		$sql = "DESC $nombreT;";
		$i = 0;
		foreach ($conn->query($sql) as $row){
			$atributos[$i] = $row[0];
			$i++;
		}
		$numatrib = count($atributos);
		$numclases = count($clase);
		for($i = 1; $i < $numatrib; $i++){
			$sql = "SELECT DISTINCT $atributos[$i] FROM $nombreT;";
			if($atributos[$i] != $nombreA){
				array_push($arbol[0], $atributos[$i]);
				$k = 0;
				$arrayAttr = array();
				$val_entropia_attr = [];
				$val_suma_attr = [];
				foreach ($conn->query($sql) as $row){
					$valoresattr[$k] = $row[0];
					for($j = 0; $j < $numclases; $j++){
						$sql = "SELECT COUNT(*) FROM $nombreT WHERE $nombreA = '$clase[$j]' AND $atributos[$i] = '$row[0]';";
						foreach ($conn->query($sql) as $row1){
							$valoresattrC[$j] = $row1[0];
						}
					}
					$val_entropia_attr[$k] = calcular_entropia($valoresattrC);
					$val_suma_attr[$k] = suma_valores($valoresattrC);
					array_push($arrayAttr, array("atributo"=>$row[0], "entropia"=>$val_entropia_attr[$k]));
					$k++;
				}
				$entropia_attr = calcular_entropia_attr($val_entropia_attr, $val_suma_attr, 14);
				$ganancia_attr = $entropia_gen - $entropia_attr;
				array_push($arbol, array(
					"NombreAttr"=>$atributos[$i],
					"EntropiaAttr"=>$entropia_attr,
					"GananciaAttr"=>$ganancia_attr,
					"Atributos"=> array()
				));

				for ($w = 0; $w < count($arrayAttr); $w++){
					array_push($arbol[$i]["Atributos"], $arrayAttr[$w]);
				}
				error_log(json_encode($arbol));
			}
		}
		echo json_encode($arbol);
		$conn = null;
	}

	function calcular_entropia($valclase){
		$numclases = count($valclase);
		$totalT = 0;
		$entropia = 0;
		for($i = 0; $i < $numclases; $i++){
			if($valclase[$i] == 0){
				return 0;
			}
			$totalT += $valclase[$i];
		}
		for($i = 0; $i < $numclases; $i++){
			$entropia = $entropia - ((($valclase[$i])/($totalT))*(log(($valclase[$i]/($totalT)),2)));
		}
		return $entropia;
	}

	function suma_valores($valoresattr){
		$numclases = count($valoresattr);
		$totalT = 0;
		for($i = 0; $i < $numclases; $i++){
			$totalT += $valoresattr[$i];
		}
		return $totalT;
	}

	function calcular_entropia_attr($valentropia, $valoresattr, $numtuplas){
		$numclases = count($valoresattr);
		$entropia = 0;
		$totalnum = 0;
		for($i = 0; $i < $numclases; $i++){
			$entropia = $entropia + (($valoresattr[$i])*($valentropia[$i]));
		}
		for($i = 0; $i < $numclases; $i++){
			$totalnum = $totalnum + $valoresattr[$i];
		}
		$entropia = $entropia / $numtuplas;
		return $entropia;
	}

	crear_arbol();
?>
