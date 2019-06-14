<!--
CU003: Usuarios.
Gestor de Usuarios.
-->

<?php
/* Conexion con la bd en php */
include('bd/conexion_log.php');
?>
<!-- Funciones en javascript -->
<script>
/* Funcion agregar usuarios */
	function insertar()
	{
		if(form.checkValidity()){
			
			debugger;
			
			alert('Agregando el usuario...');
			
			document.form.op.value='I';
			document.form.action='usuarios2.php';
			document.form.submit();			
		}		
	}
	/* Funcion modificar usuarios */	
	function modificar(id, nombre, apellidos, usuarios, clave)
	{
		alert('Modificando el usuario: ' + usuarios);
		document.form.op.value='M';
		document.form.id.value = id;
		document.form.nombre.value = nombre;
		document.form.apellidos.value = apellidos;
		document.form.usuarios.value = usuarios;
		document.form.clave.value = clave;
		
		document.form.bti.style.display='none';
		document.form.btm.style.display='block';
	}
	/* Funcion eliminar usuarios lo envia a la clase usuarios1.php */	
	function eliminar(id)
	{
		alert('Eliminando el usuario...');
		
		document.form.op.value='E';
		document.form.id.value = id;
		document.form.action='usuarios2.php';
		document.form.submit();	
	}
	/* Funcion Enviar Formulario lo envia a la clase usuarios2.php para realizar las operaciones */	
	function enviar()
	{
		document.form.action='usuarios2.php';
		document.form.submit();		
	}

</script>
<!-- Configurar fondo de pantalla -->
<style>
	html {
		/* background: url(img/fondo.jpg);
		background-size: 100%; */
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
		<!-- Codificacion HTML UTF8 -->
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<title>Usuarios</title>
		<!-- Bootstrap -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css" />
		<!-- Logo animado -->
		<link rel="StyleSheet" href="css/estilos.css" type="text/css"> 
	</head>
	<!-- Encabezado HTML -->
	<body>
	<!-- Titulo Animado -->
	<!-- <marquee><font size=7 color="black">Administración de Usuarios</font></marquee> -->
		<!-- <BR>
		<BR>
		<center> -->
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<div class="card">
						<h5 class="card-header">Administración de Usuarios</h5>
						<div class="card-body">
							<!-- Logo animado -->
							<!-- <div class="container">
								<div class="div-img">
									<img class="img" src="img/logo.gif" title="logo" alt="logo">
								</div>
							</div> -->
							<!-- <BR><BR><BR><BR>
							<BR><BR><BR><BR>
							<BR><BR><BR><BR> -->
							<!-- Formulario ingreso / edicion usuarios -->
							<form name=form id=form  action="" method="post" onsubmit="return false;">
								<div class="row">
									<div class="col-lg-4 col-md-8 col-sm-12">
										<input type=hidden name=op id=op>
										<input type=hidden name="id" id="id" value="">
										<table class='table table-hover'>
											<thead>		
												<tr>
													<font color="black">Nombres</font>&nbsp;&nbsp;
													<input type=text name="nombre" id="nombre" required>
													<br><br>
												</tr>
												<tr>	
													<font color="black">Apellidos</font>&nbsp;
													<input type=text name="apellidos" id="apellidos" required>
													<br><br>
												</tr>
												<tr>
													<font color="black">Usuario</font>&nbsp;&nbsp;&nbsp;
													<input type=text name="usuarios" id="usuarios" required>
													<br><br>
												</tr>
												<tr>
													<font color="black">Clave</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type=password name="clave" id="clave" required>
													<br><br>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col-4 d-flex justify-content-end">
										<!-- Boton enviar formulario -->
										<table class='table table-hover'>
											<thead>
												<tr>
													<input type=submit name=bti value='Insertar' onclick='insertar();' >
													<input type=submit name=btm value='Guardar cambios' onclick='enviar();' style='display:none;'>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-8">
										<div class="card">
											<h5 class="card-header">Usuarios del sistema</h5>
											<div class="card-body">
											<!-- Titulo tabla de registros usuarios -->
											<!-- <br><br>
												<font size=6 color="black">Usuarios del sistema</font>
											<br><br> -->								
												<?php
													// Consulta registros avances
													$sql = "SELECT * FROM usuarios";
													$result = $conn->query($sql);
													$total=$result->num_rows;
													if($total>0)
													{?>						
														<!-- echo " -->
														<!-- Tabla registros avances -->
														<table border=1>
															<tr>
																<td align=center bgcolor=white>Nombres</td>
																<td align=center bgcolor=white>Apellidos</td>
																<td align=center bgcolor=white>Usuario</td>
																<td align=center bgcolor=white>Editar</td>						
																<td align=center bgcolor=white>Eliminar</td>						
															</tr>
														<!-- "; -->
													<!-- /*-- Llenado de la tabla con datos de la base */		 -->
														<?php
															for($i=1;$i<=$total;$i++)
															{
																$row = $result->fetch_assoc();
																$id=$row["id"];
																$nombre=$row["nombre"];
																$apellidos=$row["apellidos"];
																$usuarios=$row["usuarios"];
																$clave = $row["clave"];?>		
															<!-- echo " -->
																<tr>
																	<td bgcolor=white>".$nombre."</td>
																	<td bgcolor=white>$apellidos</td>
																	<td bgcolor=white>$usuarios</td>
																	<!-- boton editar (editar codifica/decodifica la lectura de tildes) avances -->
																	<td><input type=button value='Editar' onclick=\"modificar('$id','$nombre','$apellidos','$usuarios',
																	'$clave');\"></td>
																	<!-- boton eliminar avances -->												
																	<td><input type=button value='Eliminar' onclick=\"eliminar('$id');\"></td>
																</tr>
																<!-- ";	 -->
													<?php	}?>
															<!-- echo " -->
															</table>
															<!-- ";	 -->
											</div>
										</div>
											<?php	}?>
											<!-- </center> -->
									</div>
								</div>
							</form>
						/div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap/js/popper.min.js"></script>
		<script src="js/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>					