<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title">
  <title>AD</title>
</head>
<body>
<div class="container" >
    <div class="row">
        <div class="tab-content" >
			<div class="row">
				<div>
					<div class="tab-content">
						<br/>
						<div class="tab-pane fade in active">
							<div class="row">
								<div class="col-sm-4">
									<div class="row">
										<div class="col-sm-12">
											<label for="relacion" class="col-lg-12 control-label">Base de datos</label>
										</div>
										<div class="col-sm-12">
											<select class="form-control" id="cth-basedatos" name="tablas">
												<option> Selecciona base de datos</option>
											</select>
										</div>
										<div class="col-sm-12">
											<br/>
											<label for="relacion" class="col-lg-12 control-label">Tabla</label>
										</div>
										<div class="col-sm-12">
											<select class="form-control" id="cth-tabla" name="tablas">
												<option> Selecciona base de datos</option>
											</select>
										</div>
										<div class="col-sm-12">
											<br/>
											<label for="relacion" class="col-lg-12 control-label">Atributo</label>
										</div>
										<div class="col-sm-12">
											<select class="form-control" id="cth-atributo" name="tablas">
												<option> Selecciona base de datos</option>
											</select>
										</div>
										<div class="col-sm-12">
											</br>
											<button type="button" class="btn btn-primary btn-block" id="calcularInfo">Calcular</button>
										</div>
                    <div class="col-sm-12">
                      </br>
                      <button type="button" class="btn btn-primary btn-block" id="crearArbol">Crear Arbol</button>
                    </div>
                    <div class="col-sm-12">
                      </br>
                      <button type="button" class="btn btn-primary btn-block" id="crearReglas">Crear Reglas</button>
                    </div>
									</div>
									<div class="col-sm-12" id="cth-msj-error">
									</div>
								</div>
								<div class="col-sm-8" id="infoEG">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Atributo</th>
												<th>Entropia</th>
												<th>Ganancia</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Clase</td>
												<td>0.940</td>
												<td></td>
											</tr>
											<tr>
												<td>General</td>
												<td>0.694</td>
												<td>0.246</td>
											</tr>
											<tr>
												<td>Temperatura</td>
												<td>0.911</td>
												<td>0.029</td>
											</tr>
											<tr>
												<td>Humedad</td>
												<td>0.788</td>
												<td>0.151</td>
											</tr>
											<tr>
												<td>Viento</td>
												<td>0.892</td>
												<td>0.048</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Bootstrap--->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap-datepicker.de.js" charset="UTF-8"></script>
<!--JS para el apartado de "Crear tabla de hechos"-->
<script type="text/javascript" src="js/obtener_bases_datos_cth.js"></script>
<script type="text/javascript" src="js/obtener_tablas_cth.js"></script>
<script type="text/javascript" src="js/obtener_atributos_cth.js"></script>
<script type="text/javascript" src="js/calcular_E_G.js"></script>
<script type="text/javascript" src="js/crear_arbol.js"></script>
<script type="text/javascript" src="js/crear_reglas.js"></script>

<script>
$(window).load(function(){
	busca_bases_datos_cth();
});
</script>

</body>
</html>
