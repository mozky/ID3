<?php
	function calcular(){
		include "conexion_servidor.php";
		$nombreDB = $_POST["nombreDB"];
		$nombreT = $_POST["nombreT"];
		$nombreA = $_POST["nombreA"];
		$cabecera = "
			<table class='table table-hover'>
				<thead>
					<tr>
						<th>Atributo</th>
						<th>Entropia</th>
						<th>Ganancia</th>
					</tr>
				</thead>
				<tbody>";
		$pie = "</tbody>
			</table>";
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
		$tuplas = "	<tr>
						<td>$nombreA</td>
						<td>$entropia_gen</td>
						<td></td>
					</tr>";

		$sql = "DESC $nombreT;";
		$i = 0;
		foreach ($conn->query($sql) as $row){
			$atributos[$i] = $row[0];
			$i++;
		}
		$numatrib = count($atributos);
		//echo "Se tiene: $numatrib atributos <br>";
		$numclases = count($clase);
		//echo "Se tiene: $numclases clases <br>";
		for($i = 1; $i < $numatrib; $i++){
			$sql = "SELECT DISTINCT $atributos[$i] FROM $nombreT;";
			//echo "<b>".$atributos[$i]."</b><br>";
			if($atributos[$i] != $nombreA){
				$k = 0;
				$val_entropia_attr = [];
				$val_suma_attr = [];
				foreach ($conn->query($sql) as $row){
					$valoresattr[$k] = $row[0];
					//echo $valoresattr[$k]."<br>";
					for($j = 0; $j < $numclases; $j++){
						$sql = "SELECT COUNT(*) FROM $nombreT WHERE $nombreA = '$clase[$j]' AND $atributos[$i] = '$row[0]';";
						//echo $sql."<br>";
						foreach ($conn->query($sql) as $row1){
							$valoresattrC[$j] = $row1[0];
							//echo $valoresattrC[$j]."<br>";
						}

					}
					$val_entropia_attr[$k] = calcular_entropia($valoresattrC);
					$val_suma_attr[$k] = suma_valores($valoresattrC);
					//echo "Entropia = ".$val_entropia_attr[$k]."<br>";
					//echo "Numero = ".$val_suma_attr[$k]."<br>";
					$k++;
				}
				$entropia_attr = calcular_entropia_attr($val_entropia_attr, $val_suma_attr, 14);
				//echo "Entropia General = ".$entropia_attr."<br>";
				$ganancia_attr = $entropia_gen - $entropia_attr;
				//echo "Ganancia General = ".$ganancia_attr."<br>";
				$tuplas .= "
					<tr>
						<td>$atributos[$i]</td>
						<td>$entropia_attr</td>
						<td>$ganancia_attr</td>
					</tr>";
			}
		}
		echo $cabecera.$tuplas.$pie;
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

	calcular();
?>
