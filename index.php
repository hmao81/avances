<style>
/* Configurar fondo de pantalla */
	html {
		background: url(img/fondo.jpg);
		background-size: 100%;
	}
</style>
<!-- Encabezado HTML -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<TITLE>Sistema de Avances</TITLE>
		<link rel="StyleSheet" href="css/estilos.css" type="text/css"> 
	</head>
	<body>
	<center>
	<!-- Titulo animado -->
	<marquee><font size=7 color="black">Ingreso al Sistema</font></marquee>
		<BR><BR>
	<!-- Logo animado -->
		<div class="container">
			<div class="div-img">
				<img class="img" src="img/logo.gif" title="logo" alt="logo">
			</div>
		</div>		
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>				
			<!-- Formulario ingreso credenciales lo envía a valida.php -->	
			<form name=form id=form  action="valida.php" method="post">	
				<font color="black">Usuario</font>&nbsp;
				<input type=text name=us id=us required>
				<br><br>
				<font color="black">Clave</font>&nbsp; &nbsp; &nbsp; 
				<input type=password name=cl id=cl required>
				<br><br>
				<input type=submit value='Continuar'>
			</form>
		</center>
	</body>
</html>