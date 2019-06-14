<?php
/*
CU004: Roles.
Gestor de Permisos a los Modulos.
*/

/* Conexion con la bd en php */	
	include('bd/conexion_log.php');	
	error_reporting(0);
/* Llegan datos en variables */	
	$id=$_SESSION["id_usuario"];
	
	$us='';
	$us=$_REQUEST['usu'];
		
?>
<!-- Funciones en javascript -->
<script>
/* Funcion verificar usuarios */
	function revisar()
	{
		// alert(document.f.us.value);
		
		if(document.f.us.value!='')
		{	
			location.href='roles.php?usu='+document.f.us.value;
		}
	}
/* Funcion agregar/quitar acceso aplicaciones usuarios que procesa en la clase roles_l.php */
	function accion(op,us,apl)
	{
		if(op=='E')
		{
			alert('opcion='+'Eliminar,'+'Usuario='+us+' ,aplicacion='+apl);
			location.href='roles_l.php?op=E&usuario='+us+'&apli='+apl;			
		}	
		if(op=='I')
		{
			alert('opcion='+'Insertar,'+'Usuario='+us+' ,aplicacion='+apl);
			location.href='roles_l.php?op=I&usuario='+us+'&apli='+apl;			
		}			
	}
</script>
<!-- Configurar fondo de pantalla -->
<style>
	html {

		/* background: url(img/fondo.jpg);
		background-size: 100%; */
	}
</style>
<!-- Encabezado HTML -->
<html>
	<head>
		<!-- Codificacion HTML UTF8 -->
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<title>Permisos de Usuario</title>
		<!-- Bootstrap -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css" />
		<!-- Logo animado -->
		<link rel="StyleSheet" href="css/estilos.css" type="text/css"> 
	</head>
	<body>
	<!-- Titulo animado -->
		<!-- <marquee><font size=7 color="black">Conceder Permisos por Usuario</font></marquee> -->		
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<div class="card">
						<h5 class="card-header">Conceder Permisos por Usuario</h5>
						<div class="card-body">
							<!-- Logo animado -->
							<!-- <div class="div-img">
								<img class="img" src="img/logo.gif" title="logo" alt="logo">
							</div> -->
							<!-- Formulario Agregar / Quitar aplicaciones usuarios -->			
							<form name="f">
								<div class="row">
									<div class="col-lg-4 col-md-8 col-sm-12">
										<font color="black">Usuario</font>&nbsp;<br><br>
										<select name="us" id="us" class="form-control">
											<option value=''>-Seleccione-</option>
											<?php
												$sql = "SELECT * FROM usuarios";
												$result = $conn->query($sql);
												$total=$result->num_rows;
												if($total>0)
													{
													for($i=1;$i<=$total;$i++)
														{
															$row = $result->fetch_assoc();
															$id_c=$row["id"];
															$nombre_c=$row["nombre"];
															$apelldos_c=$row["apellidos"];
															$nom=$nombre_c.' '.$apelldos_c;
															
														if($us==$id_c)
															{
																echo "
																<option value='$id_c' selected>$nom</option>
																";
															}	
														else
															{
																echo "
																<option value='$id_c' >$nom</option>
																";
															}		
													}
												}	
											?>
										</select>
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col-4 d-flex justify-content-end">
										<!-- Boton enviar formulario -->
										<button type="button" name="b" class="btn btn-outline-secondary" onclick="revisar();">Continuar</button>
									</div>
								</div>
								<div class="row">
									<div class="col-8"><?php
										if ($us != '') {?>
											<!-- Titulo tabla lista de aplicaciones -->
											<br><br>
											<h4>Lista de Aplicaciones</h4>
											<h6>Usuario = <?=$us?></h6>
											<table class='table table-hover'>
												<thead>
													<tr>
														<th scope="col" class="text-center">Aplicación</th>
														<th scope="col" class="text-center">Habilitar</th>
													</tr>
												</thead>
												<tbody><?php
													/* Consulta registros aplicaciones */
													$sql = "SELECT * FROM aplicaciones";
													$result = $conn->query($sql);
													$total=$result->num_rows;
													if ($total > 0) {
														for ($j=1;$j<=$total;$j++) {
															$row = $result->fetch_assoc();
															$id_c1=$row["id"];
															$nombre_c1=$row["nombre"];
															$url_c1=$row["url"];
															$nom=$nombre_c.' '.$apelldos_c;?>
															<tr>
																<td class="text-center"><?=$nombre_c1?></td><?php
																/* Consulta registros permisos de aplicaciones por usuario */
																$sql1 = "SELECT * FROM usu_apli where id_usuario='$us' and id_apli='$id_c1'";
																$result1 = $conn->query($sql1);
																$total1=$result1->num_rows;
																if ($total1>0) {?>
																	<td class="text-center"><input type='checkbox' name='<?=$id_c1?>' onclick='accion("E","<?=$us?>","<?=$id_c1?>");' checked></td><?php
																} else {?>
																	<td class="text-center"><input type='checkbox' name='<?=$id_c1?>'  onclick='accion("I","<?=$us?>","<?=$id_c1?>");'></td><?php
																}?>
															</tr><?php
														}
													}?>
												</tbody>
											<table><?php
										}?>
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