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
	$fechaParam = $_GET['fechaParam'];?>

<!-- Funciones en javascript-->
<script>
	/* Funcion Agregar Avances lo envia a la clase avance2.php */
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
		document.form.porcentaje_avance.value = porcentaje_avance;

		document.form.bti.style.display='none';
		document.form.btm.style.display='block';
	}

	/* Funcion Eliminar Avances lo envia a la clase avance2.php */	
	function eliminar(id)
	{
		alert('Eliminando el avance...');

		document.form.op.value='E';
		document.form.id.value = id;
		document.form.action='avance2.php';
		document.form.submit();	
	}

	/* Funcion Enviar Formulario lo envia a la clase avance2.php para realizar las operaciones enviar, buscar */	
	function enviar()
	{
		document.form.action='avance2.php';
		document.form.submit();	
	}

	function buscarAvance()
	{
		const buscarXCodigo = document.getElementById('buscarXCodigo').value;
		const buscarXRequerimiento = document.getElementById('buscarXRequerimiento').value;
		const buscarXfecha = document.getElementById('buscarXfecha').value;

		window.location.href = 'avance1.php?codigoParam=' + buscarXCodigo + '&requerimientoParam=' 
		+ buscarXRequerimiento + '&fechaParam=' + buscarXfecha;
	}
</script>

<!-- Configurar fondo de pantalla-->
<style type="text/css">
	html {
		background: url(img/fondo.jpg);
		background-size: 100%;
	}

	/* formato a las tablas */
	table{
		border-spacing: 0;
		display: flex;	    	/* Se ajuste dinamicamente al tamano del dispositivo */
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
		<marquee><font size="7" color="black">Agregar / Actualizar / Eliminar / Buscar Avances</font></marquee>
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
				<input type="text" name="codigo" id="codigo" required>
				<br /><br />

				<font color="black">Requerimiento</font>&nbsp;<br />
				<textarea name="requerimiento" id="requerimiento" rows="4"  cols="50"></textarea>
				<br /><br />

				<font color="black">Avance</font>&nbsp; &nbsp;<br />
				<textarea name="avance" id="avance" rows="4"  cols="50"></textarea>
				<br /><br />
			
				<font color="black">Porcentaje de Avance</font>&nbsp; &nbsp;<br />
				<input type="text" name="porcentaje_avance" id="porcentaje_avance" size="3" required> %
				<br /><br />
			
				<!-- Boton enviar formulario -->
				<table>
					<tr>
						<input type="submit" name="bti" value="Insertar" onclick="insertar();" >
						<input type="submit" name="btm" value="Guardar cambios" onclick="enviar();" style="display:none;">
					</tr>
				</table>
				<br /><br />

				<!-- Titulo tabla de registros avances -->
				<font size=6 color="black">Histórico Avances</font>
				<br /><br />

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
				
				<button id="buscar" value="Buscar" onclick="buscarAvance();">Buscar</button><br /><br />
				
				<!-- Consulta avances -->		
				<?php
				/* Paso de variables para la consulta por codigo, requerimiento y fecha declaradas parte superior*/
				$sqlCodigo = '';
				if ($codigoParam != null)
					$sqlCodigo = ' AND av.codigo = "' . $codigoParam . '"';

				$sqlRequerimiento = '';
				if ($requerimientoParam != null)
					$sqlRequerimiento = ' AND av.requerimiento LIKE "%' . $requerimientoParam . '%"';

				$sqlFecha = '';
				if ($fechaParam != null)
					$sqlFecha = ' AND DATE(av.fecha) = "' . $fechaParam . '"';
					
				/* Query que consulta en la base */
				$sql = "SELECT av.*, us.usuarios
					FROM tbavances av
						JOIN usuarios us ON av.id_usuario = us.id
					WHERE 1 = 1"
						. $sqlCodigo
						. $sqlRequerimiento 
						. $sqlFecha . "
					ORDER BY av.id";
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
						/*-- 
						Llenado de la tabla con datos de la base 
						*/
						for ($i = 1; $i <= $total;$i++) {
							$row = $result->fetch_assoc();
							$id_c = $row["id"];
							$codigo_c = $row["codigo"];
							$requerimiento_c = $row["requerimiento"];
							$avance_c = $row["avance"];
							$fecha_c = $row["fecha"];
							$porcentaje_avance_c = $row["porcentaje_avance"];
							$idUsuario = $row["usuarios"];
							?>
							<tr>								
								<td bgcolor="white"><?php echo $codigo_c?></td>
								<td bgcolor="white"><?php echo utf8_encode($requerimiento_c)?></td>
								<td bgcolor="white"><?php echo utf8_encode($avance_c)?></td>
								<td bgcolor="white"><?php echo $fecha_c?></td>
								<td bgcolor="white"><?php echo $porcentaje_avance_c?></td>
								<td class="tdAction" bgcolor="white"><?php echo $idUsuario?></td>
								<!-- boton editar (editar codifica/decodifica la lectura de tildes) avances -->
								<td class="tdAction"><input type=button value='Editar' onclick="editar('<?php echo $id_c?>', 
								'<?php echo $codigo_c?>', '<?php echo base64_encode($avance_c)?>', 
								'<?php echo base64_encode($requerimiento_c)?>', '<?php base64_encode($fecha_c)?>',
								'<?php echo $porcentaje_avance_c?>');"></td>
								<!-- boton eliminar avances -->
								<td class="tdAction"><input type=button value='Eliminar' onclick="eliminar('<?php 
								echo $id_c?>');">
								</td>
							</tr><?php
						}?>
					</table><?php
				}?>
			</form>
		</center>
	</body>
</html>