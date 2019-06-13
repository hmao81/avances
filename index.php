<style>
/* Configurar fondo de pantalla */
	html {
		/* background: url(img/fondo.jpg);
		background-size: 100%; */
	}
	iframe {
		border: 0;
		height: 82%;
	}
</style>
<!-- Encabezado HTML -->
<html>
	<head>
		<!-- Codificacion HTML UTF8 -->
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<title>Sistema de Avances</title>
		<!-- Bootstrap -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css" />
		<!-- Logo animado -->
		<link rel="StyleSheet" href="css/estilos.css" type="text/css">
	</head>
	<body>
		<!-- Titulo animado -->
		<!-- <marquee><font size=7 color="black">Ingreso al Sistema</font></marquee>
		<BR><BR> -->

		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<div class="card">
						<h5 class="card-header">Ingreso al Sistema</h5>
						<div class="card-body"> 
							<!-- Logo animado -->							
							<!-- <div class="div-img">
									<img class="img" src="img/logo.gif" title="logo" alt="logo">
								</div> -->
			
								<!-- <BR><BR><BR><BR>
								<BR><BR><BR><BR>
								<BR><BR><BR><BR>				 -->
							<!-- Formulario ingreso credenciales lo envía a valida.php -->	
							<form class="form-inline" name=form id=form  action="valida.php" method="post">	
							<div class="form-group row">
									<!-- Adaptacion de pantalla distintos tamaños de la pestaña-->	
									<div class="col-lg-4 col-md-8 col-sm-12">		
										<!-- Adaptacion de pantalla distintos tamaños -->	
										<label for="lblusuario" class="col-lg-9 col-md-9 col-sm-9 col-form-label col-form-label-lg">Usuario</label>								
										<input type=text class="form-control form-control-lg" name=us id=us placeholder="" required>
										<br>
										<label for="lblclave" class="col-lg-9 col-md-9 col-sm-9 col-form-label col-form-label-lg">Clave</label>
										<input type=password class="form-control" name=cl id=cl placeholder="" required>
										<br><br>
										<button type=submit class="btn btn-primary mb-2">Enviar
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="js/jquery/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap/js/popper.min.js"></script>
		<script src="js/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>