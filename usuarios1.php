<!--
CU003: Usuarios.
Gestor de Usuarios.
-->

<?php
/*
Conexion con la bd en php
*/
include('bd/conexion_log.php');
?>
<!-- 
Funciones en javascript
-->
<script>
/*
Funcion agregar usuarios
*/
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
/*
Funcion modificar usuarios
*/	
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
/*
Funcion eliminar usuarios lo envia a la clase usuarios1.php
*/	
	function eliminar(id)
	{
		alert('Eliminando el usuario...');
		
		document.form.op.value='E';
		document.form.id.value = id;
		document.form.action='usuarios2.php';
		document.form.submit();	
	}
/*
Funcion Enviar Formulario lo envia a la clase usuarios2.php para realizar las operaciones
*/	
	function enviar()
	{
		document.form.action='usuarios2.php';
		document.form.submit();
		
	}

</script>
<!-- 
Configurar fondo de pantalla
-->
<style>
	html {

		background: url(img/fondo.jpg);
		background-size: 100%;
	}
</style>
<!-- 
Encabezado HTML
-->
<html>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<TITLE>Usuarios</TITLE>
		<link rel="StyleSheet" href="css/estilos.css" type="text/css"> 
	</HEAD>
<!-- 
Encabezado HTML
-->
	<BODY>
<!-- 
Logo animado
-->
		<div class="container">
			<div class="div-img">
				<img class="img" src="img/logo.gif" title="logo" alt="logo">
			</div>
		</div>
		
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>
<!-- 
Titulo Animado
-->
		<marquee><font size=7 color="white">Agregar Usuarios</font></marquee>
		<BR>
		<BR>
		<center>
<!-- 
Formulario ingreso / edicion usuarios
-->
			<form name=form id=form  action="" method="post" onsubmit="return false;">
				<input type=hidden name=op id=op>
				<input type=hidden name="id" id="id" value="">
		<table>				
			<tr>
				<font color="white">Nombres</font>&nbsp;&nbsp;
				<input type=text name="nombre" id="nombre" required>
				<br><br>
			</tr>
			<tr>	
				<font color="white">Apellidos</font>&nbsp;
				<input type=text name="apellidos" id="apellidos" required>
				<br><br>
			</tr>
			<tr>
				<font color="white">Usuario</font>&nbsp;&nbsp;&nbsp;
				<input type=text name="usuarios" id="usuarios" required>
				<br><br>
			</tr>
			<tr>
				<font color="white">Clave</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type=password name="clave" id="clave" required>
				<br><br>
			</tr>
			</table>		
<!-- 
Boton enviar formulario
-->	
			<table>
				<tr>
					<input type=submit name=bti value='Insertar' onclick='insertar();' >
					<input type=submit name=btm value='Guardar cambios' onclick='enviar();' style='display:none;'>
				</tr>
			</table>
<!-- 
Titulo tabla de registros usuarios
-->
				<br><br>
				<font size=6 color="white">Usuarios del sistema</font>
				<br><br>
<!-- 
Consulta registros avances
-->	
				<?php
					$sql = "SELECT * FROM usuarios";
					$result = $conn->query($sql);
					$total=$result->num_rows;
					if($total>0)
					{						
						echo "
				<!-- 
				Tabla registros avances
				-->
						<table border=1>
						<tr>
							<td align=center bgcolor=white>Nombres</td>
							<td align=center bgcolor=white>Apellidos</td>
							<td align=center bgcolor=white>Usuario</td>
							<td align=center bgcolor=white>Editar</td>						
							<td align=center bgcolor=white>Eliminar</td>						
						</tr>
						";
				/*-- 
				Llenado de la tabla con datos de la base 
				*/		
						for($i=1;$i<=$total;$i++)
						{
							$row = $result->fetch_assoc();
							$id=$row["id"];
							$nombre=$row["nombre"];
							$apellidos=$row["apellidos"];
							$usuarios=$row["usuarios"];
							$clave = $row["clave"];
							
						echo "
							<tr>
								<td bgcolor=white>".$nombre."</td>
								<td bgcolor=white>$apellidos</td>
								<td bgcolor=white>$usuarios</td>
				<!-- 
				boton editar (editar codifica/decodifica la lectura de tildes) avances
				-->
								<td><input type=button value='Editar' onclick=\"modificar('$id','$nombre','$apellidos','$usuarios',
								'$clave');\"></td>
				<!-- 
				boton eliminar avances
				-->												
								<td><input type=button value='Eliminar' onclick=\"eliminar('$id');\"></td>
							</tr>
							";	
						}
						
						echo "
						</table>
						";	
					}	
					
				?>
			</center>
		</form>
	</body>
</html>					