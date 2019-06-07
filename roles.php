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
		alert(document.f.us.value);
		
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
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<TITLE>Permisos de Usuario</TITLE>
		<link rel="StyleSheet" href="css/estilos.css" type="text/css"> 
	</head>
	<body>
	<!-- Titulo animado -->
	<marquee><font size=7 color="black">Conceder Permisos por Usuario</font></marquee>
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
		<center>
<!-- Formulario Agregar / Quitar aplicaciones usuarios -->			
		<form name=f>
			<font color="black">Usuario</font>&nbsp;<br><br>
			<select name=us id=us>
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
			<br><br>
	<!-- Boton enviar formulario -->			
		<input type=button name=b value='Continuar' onclick='revisar();'><br><br>
		<?php
			if($us!='')
			{
				echo "
			<!-- Titulo tabla de registros usuarios -->
				<br><br>
				<font size=6 color=black>Lista de Aplicaciones
				</font><br><br>";
				echo "
				<font color=black>Usuario = ".$us."</font><br><br>";
				echo "
				<table border=1>
					<tr>
						<td align=center bgcolor=white>Aplicación</td>
						<td align=center bgcolor=white>Habilitar</td>";
				/* Consulta registros aplicaciones */
					$sql = "SELECT * FROM aplicaciones";
					$result = $conn->query($sql);
					$total=$result->num_rows;
					if($total>0)
					{
						for($j=1;$j<=$total;$j++)
						{
							$row = $result->fetch_assoc();
							$id_c1=$row["id"];
							$nombre_c1=$row["nombre"];
							$url_c1=$row["url"];
							$nom=$nombre_c.' '.$apelldos_c;
							
					echo "
					</tr>
					<tr>
						<td align=center bgcolor=white>$nombre_c1</td>";
						/* Consulta registros permisos de aplicaciones por usuario */
							$sql1 = "SELECT * FROM usu_apli where id_usuario='$us' and id_apli='$id_c1'";
							$result1 = $conn->query($sql1);
							$total1=$result1->num_rows;
							if($total1>0)
							{
								echo "<td><input type='checkbox' name='$id_c1' onclick='accion(\"E\",\"$us\",\"$id_c1\");' checked></td>";							
							}	
							else
							{
								echo "<td><input type='checkbox' name='$id_c1'  onclick='accion(\"I\",\"$us\",\"$id_c1\");'></td>";							
							}
					echo "
					</tr>";
						}
					}	
					echo "
				</table>";
			}	
		?>
		</form>
	</body>
</html>	