<!-- CU002: Avances.
Gestor de Avances.

Conexion con la bd en php-->
<?php
include('bd/conexion_log.php');

/* Paso de variables para la funcion busqueda*/
$codigoParam = null;
if (isset($_GET['codigoParam']))
	$codigoParam = $_GET['codigoParam'];

$requerimientoParam = null;
if (isset($_GET['requerimientoParam']))
	$requerimientoParam = $_GET['requerimientoParam'];

$fechaParam = null;
if (isset($_GET['fechaParam']))
	$fechaParam = $_GET['fechaParam'];

$usuarioParam = null;
if (isset($_GET['usuarioParam']))
	$usuarioParam = $_GET['usuarioParam'];
?>
<!-- Funciones en javascript-->
<!-- Librerias que cargan el grafico-->
<script src="js/chart/js/chart.js/Chart.min.js"></script>
<script>
	/* Funcion Agregar Avances lo procesa en la clase avance2.php */
	function insertar()
	{
		if(form.checkValidity()){
			debugger;
			
			alert('Agregando el avance al sistema...');

			document.form.op.value='I';
			document.form.action='avance2.php';
			document.form.submit();
		}
	}
	/* Funcion Modificar Avances */
	function editar(id, codigo, avance, requerimiento, porcentaje_avance)
	{
		alert('Modificando el avance del sistema con el código: ' + codigo);
		/* Se codifican y decodifican los datos del campo para reconocer tildes */
		avance = atob(avance);
		avance = avance.replace(/<br\s*\/?>/gi, '');
		requerimiento = atob(requerimiento);
		requerimiento = requerimiento.replace(/<br\s*\/?>/gi, '');

		document.form.op.value='M';
		document.form.id.value = id;
		document.form.codigo.value = codigo;
		document.form.avance.value = avance;
		document.form.requerimiento.value = requerimiento;
		document.form.porcenta.value = porcentaje_avance;

		document.form.bti.style.display='none';
		document.form.btm.style.display='block';
	}

	/* Funcion Eliminar Avances que envia a la clase avance2.php */	
	function eliminar(id)
	{
		alert('Eliminando el avance...');

		document.form.op.value='E';
		document.form.id.value = id;
		document.form.action='avance2.php';
		document.form.submit();	
	}

	/* Funcion Enviar Formulario que envia a la clase avance2.php para realizar las operaciones enviar, buscar */	
	function enviar()
	{
		document.form.action='avance2.php';
		document.form.submit();	
	}
	/* Creacion de los contructores para buscar por codigo, requerimiento, fecha */
	function buscarAvance()
	{
		const buscarXCodigo = document.getElementById('buscarXCodigo').value;
		const buscarXRequerimiento = document.getElementById('buscarXRequerimiento').value;
		const buscarXfecha = document.getElementById('buscarXfecha').value;
		const buscarXUsuario = document.getElementById('buscarXUsuario').value;

		window.location.href = 'avance1.php?codigoParam=' + buscarXCodigo + '&requerimientoParam=' 
		+ buscarXRequerimiento + '&fechaParam=' + buscarXfecha + '&usuarioParam=' + buscarXUsuario;
	}
</script>

<!-- Configurar fondo de pantalla-->
<style type="text/css">
	html {
		/* background: url(img/fondo.jpg);
		background-size: 100%; */
	}

	/* formato a las tablas */
	table{
		border-spacing: 0;
		display: flex;	    	/* Se ajusta dinamicamente al tamaño del dispositivo */
		max-height: 40vh;		/* El alto que necesitemos */
		overflow-y: auto; 		/* scroll vertical         */
		overflow-x: auto; 		/* scroll horizontal       */
		table-layout: fixed;	/* Forzamos a que las filas tenga el mismo ancho */
		width: 94vw; 			/* ancho fijo */
		border:1px solid gray;	/* lineas tabla */
	}

	th{
		border-bottom: 1px solid #c4c0c9;
		border-right: 1px solid #c4c0c9;
	}

	th,td{
		font-weight: normal;
		margin: 0;
		max-width: 14.4vw;			/*Ancho por celda*/
		min-width: 14.4vw;			/*Ancho por celda*/
		word-wrap: break-word;		/*Si el contenido supera el tamano, adiciona a una nueva linea*/
		font-size: 12px;
		height: 3.5vh !important;	/*El mismo alto para todas las celdas*/
		padding: 4px;
		border-right: 1px solid #c4c0c9;
	}

	td.tdAction {
		max-width: 9vw;			/*Ancho por celda*/
		min-width: 9vw;			/*Ancho por celda*/
	}

	tr:nth-child(2n) {
		background: none repeat scroll 0 0 #edebeb;
	}

	/* Administra el tamaño en % y el color de fondo del grafico de barras */
	.chart {
		width: 90% !important;
		height: 90% !important;
		background-color: #FFF;
	}
</style>
<!-- Encabezado HTML -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<title>Avances</title>
		<link rel="StyleSheet" href="css/estilos.css" type="text/css">
	</head>
	<body>
		<!-- Titulo Animado-->
		<marquee><font size="7" color="black">Administración de Avances</font></marquee>
		<br /><br />
		<!-- Logo animado -->
		<div class="container">
			<div class="div-img">
				<img class="img" src="img/logo.gif" title="ava" alt="ava">
			</div>
		</div>
		<br /><br /><br /><br />
		<br /><br /><br /><br />
		<br /><br /><br /><br />
		<center>
			<!-- Formulario ingreso edicion avances-->			
			<form name="form" id="form"  action="" method="post" onsubmit="return false;">
				<input type="hidden" name="op" id="op" />
				<input type="hidden" name="id" id="id" />

				<font color="black">Código</font>&nbsp;<br />
				<input type="text" name="codigo" id="codigo" maxlength="10" required>
				<br /><br />

				<font color="black">Requerimiento</font>&nbsp;<br />
				<textarea name="requerimiento" id="requerimiento" rows="4"  cols="50"></textarea>
				<br /><br />

				<font color="black">Avance</font>&nbsp; &nbsp;<br />
				<textarea name="avance" id="avance" rows="4"  cols="50"></textarea>
				<br /><br />
			
				<font color="black">Porcentaje de Avance</font>&nbsp; &nbsp;<br />
				<input type="text" name="porcenta" id="porcenta" size="3" maxlength="3" required> %
				<br /><br />
			
			<!--
				<select name="porcenta">
					<option value="10">10 %</option> 
					<option value="20">20 %</option> 
					<option value="30">30 %</option>
					<option value="40">40 %</option> 
					<option value="50">50 %</option> 
					<option value="60">60 %</option> 
					<option value="70">70 %</option> 
					<option value="80">80 %</option> 
					<option value="90">90 %</option> 
					<option value="100">100 %</option> 
				</select>	
				<br /><br />
				-->
				<!-- Boton enviar formulario -->
				<table>
					<tr>
						<input type="submit" name="bti" value="Insertar" onclick="insertar();" >
						<input type="submit" name="btm" value="Guardar cambios" onclick="enviar();" style="display:none;">
					</tr>
				</table>
				<br /><br />

				<!-- Titulo tabla de registros avances -->
				<font size=6 color="black">Buscar Avances</font>
				<br /><br />
				<!-- Se crean los campos en el formulario de busqueda -->
				<font>Código</font>
				&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				<input type="text" id="buscarXCodigo" name="buscarXCodigo" value="<?php echo $codigoParam?>" />
				<br /><br />
				
				<font>Requerimiento</font>&nbsp;
				<input type="text" id="buscarXRequerimiento" name="buscarXRequerimiento" value="<?php 
				echo $requerimientoParam?>" /><br /><br />
				
				<font>Fecha</font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			
				<!-- Boton buscar por la fecha -->
				<input type="date" id="buscarXfecha" name="buscarXfecha" value="<?php echo $fechaParam?>" /><br /><br />
				
				<font>Usuario</font>
				&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				<input type="text" id="buscarXUsuario" name="buscarXUsuario" value="<?php 
				echo $usuarioParam?>" /><br /><br />
				
				<button id="buscar" value="Buscar" onclick="buscarAvance();">Buscar</button><br /><br />
				
				<!-- Consulta avances -->		
				<?php
				/* Paso de variables para consultar por codigo, requerimiento y fecha creadas en la funcion buscar*/
				$sqlCodigo = '';
				if ($codigoParam != null)
					$sqlCodigo = ' AND av.codigo = "' . $codigoParam . '"';

				$sqlRequerimiento = '';
				if ($requerimientoParam != null)
					$sqlRequerimiento = ' AND av.requerimiento LIKE "%' . utf8_decode($requerimientoParam) . '%"';

				$sqlFecha = '';
				if ($fechaParam != null)
					$sqlFecha = ' AND DATE(av.fecha) = "' . $fechaParam . '"';

				$sqlUsuario = '';
				if ($usuarioParam != null)
					$sqlUsuario = ' AND us.usuarios LIKE "%' . $usuarioParam . '%"';
						
				/* Query que consulta y trae los datos de la base para llenar la tabla */
				$sql = "SELECT av.*, us.usuarios, us.nombre, us.apellidos
					FROM tbavances av
						JOIN usuarios us ON av.id_usuario = us.id
					WHERE 1 = 1"
						. $sqlCodigo
						. $sqlRequerimiento
						. $sqlFecha
						. $sqlUsuario ."
					ORDER BY av.id_usuario";
				$result = $conn->query($sql);
				$total = $result->num_rows;
				
				if ($total > 0) {?>
					<!-- Tabla registros avances, cabecera fija -->
					<table border="1">
						<tr>
							<td align="center" bgcolor="white">Código</td>
							<td align="center" bgcolor="white">Requerimiento</td>
							<td align="center" bgcolor="white">Avance</td>
							<td align="center" bgcolor="white">Fecha</td>
							<td align="center" bgcolor="white">Porcentaje Avance</td>
							<td class="tdAction" align="center" bgcolor="white">Usuario</td>
							<td class="tdAction" align="center" bgcolor="white">Editar</td>
							<td class="tdAction" align="center" bgcolor="white">Eliminar</td>
						</tr>
					</table>
					<table border="1"><?php
						/*-- Llenado de la tabla con datos de la base */
						for ($i = 1; $i <= $total;$i++) {
							$row = $result->fetch_assoc();
							$id_c = $row["id"];
							$codigo_c = $row["codigo"];
							$requerimiento_c = $row["requerimiento"];
							$avance_c = $row["avance"];
							$fecha_c = $row["fecha"];
							$porcentaje_avance_c = $row["porcentaje_avance"];
							$idUsuario = $row["usuarios"];
							$nombre = $row["nombre"];
							$apellidos = $row["apellidos"];?>
							<tr>								
								<td bgcolor="white"><?php echo $codigo_c?></td>
								<td bgcolor="white"><?php echo utf8_encode($requerimiento_c)?></td>
								<td bgcolor="white"><?php echo utf8_encode($avance_c)?></td>
								<td bgcolor="white"><?php echo $fecha_c?></td>
								<td bgcolor="white"><?php echo $porcentaje_avance_c?></td>
								<td class="tdAction" bgcolor="white"><?php echo $nombre . ' ' . $apellidos . ' (' . $idUsuario . ')'?></td>
								<!-- boton editar (editar codifica/decodifica la lectura de tildes) avances -->
								<td class="tdAction"><input type=button value='Editar' onclick="editar('<?php echo $id_c?>', 
								'<?php echo $codigo_c?>', '<?php echo base64_encode($avance_c)?>', 
								'<?php echo base64_encode($requerimiento_c)?>','<?php echo $porcentaje_avance_c?>');"></td>
								<!-- boton eliminar avances -->
								<td class="tdAction"><input type=button value='Eliminar' onclick="eliminar('<?php 
								echo $id_c?>');">
								</td>
							</tr><?php
						}?>
					</table>
					<br /><br />
				<!-- Titulo grafico -->
				<font size=6 color="black">Avances por Usuario ( % )</font><?php
				}?>			
				<!-- Dar formato al texto -->
				<pre>
				<?php
				/* Query que trae los datos a usar en el grafico */
				$sql = "SELECT SUM(av.porcentaje_avance) AS porcentaje_avance, us.usuarios, us.nombre, us.apellidos
					FROM tbavances av
						JOIN usuarios us ON av.id_usuario = us.id
					WHERE 1 = 1"
						. $sqlCodigo
						. $sqlRequerimiento
						. $sqlFecha
						. $sqlUsuario ."
					GROUP BY us.usuarios";
				$result1 = $conn->query($sql);
				$consolidadoAvances = $result->num_rows;
				$labels = '';
				$data = '';
				/* El ciclo consulta y trae los datos a usar en el grafico */		
				for ($i = 1; $i <= $consolidadoAvances; $i++) {
					$fila = $result1->fetch_assoc();
					//Creacion de variables
					$nombres = '"' . $fila['nombre'] . ' ' . $fila['apellidos'] . '"';
					$porcentaje = $fila['porcentaje_avance'];
					//Se concatenan las variables y se separan con ,
					$labels .= $nombres . ','; // Es igual que escribir $labels = $labels . $nombres . ',';
					$data .= $porcentaje . ',';
				}
				// Quita la coma al final de cada cadena
				$labels = substr($labels, 0, strlen($labels) - 1);
				$data = substr($data, 0, strlen($data) - 1);?>
				<!-- Lienzo para pintar la imagen -->
				<canvas class="chart" id="chart1"></canvas>
				<script>
					var chart1 = document.getElementById('chart1');
					var myChart1 = new Chart(chart1, {
						// Define el tipo de grafico que se usa pie, bar, bubble, line, polar area, radar.
						type: 'bar',
							data: {
								labels: [<?php echo $labels?>],
									datasets: [{
										label: 'Porcentaje Usuarios',
										data: [<?php echo $data?>],
									backgroundColor: [
										'rgba(255, 99, 132, 0.2)',
										'rgba(54, 162, 235, 0.2)',
										'rgba(255, 206, 86, 0.2)',
										'rgba(75, 192, 192, 0.2)',
											'rgba(153, 102, 255, 0.2)',
										'rgba(255, 159, 64, 0.2)'
										],
									borderColor: [
										'rgba(255, 99, 132, 1)',
										'rgba(54, 162, 235, 1)',
										'rgba(255, 206, 86, 1)',
										'rgba(75, 192, 192, 1)',
										'rgba(153, 102, 255, 1)',
										'rgba(255, 159, 64, 1)'
										],
									borderWidth: 1
									}]
							},
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true
										}
									}]
								}
							}
						});
				</script>
			</form>
		</center>
	</body>
</html>
