<?php
/* Conexión con la bd en php */
include('bd/conexion_log.php');
$id=$_SESSION["id_usuario"];?>

<!-- Funciones en javascript -->
<script>
	function finalizar() {
		location.href="cerrar.php";
	}

	function cargar(b) {
		ifr.location.href=b;
	}
</script>
<style>
	html {
		/* background: url(img/fondo.jpg); */
		/* background-size: 100%; */
	}
	iframe {
		border: 0;
		height: 82%;
	}
</style>
<html>
	<head>
		<title>Control Usuarios - Avances</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css" />
	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Gestor de avances</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav"><?php
					$sql = "SELECT a.nombre, a.url
						FROM usuarios u, aplicaciones a, usu_apli up
						WHERE a.id = up.id_apli
							AND up.id_usuario = u.id
							AND u.id = $id";
					$result = $conn->query($sql);
					$total = $result->num_rows;
					if ($total > 0) {
						for ($i = 1; $i <= $total; $i++) {
							$row = $result->fetch_assoc();
							$nombre_c = $row["nombre"];
							$url_c = $row["url"];?>
							<li class="nav-item">
								<a class="nav-link" href="#" onclick="cargar('<?=$url_c?>');"><?=$nombre_c?> <span class="sr-only">(current)</span></a>
							</li><?php
						}
					}?>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="finalizar();">Salida segura</a>
					</li>
				</ul>
			</div>
		</nav>

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item" aria-current="page">Bienvenido: <?php echo $_SESSION["nom"];?></li>
			</ol>
		</nav>

		<div class="container-fluid">
			<iframe name=ifr id=ifr width=100% height=100%></iframe>
		</div>

		<script src="js/jquery/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap/js/popper.min.js"></script>
		<script src="js/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>