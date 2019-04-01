<!--
CU002: Avances.
Gestor de Avances.
-->

<!-- 
Conexion con la bd en php
-->
<?php
	include('bd/conexion_log.php');
?>
<!-- 
Funciones en javascript
-->
<script>
/*
Funcion Agregar Avances lo envia a la clase avance2.php
*/
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
/*
Funcion Modificar Avances
*/
	function editar(id,avance,requerimiento)
	{
		alert('Modificando el avance del sistema con el ID: '+id);
		/* 
		Se codifican y decodifican los datos del campo para reconocer tildes
		*/
		avance = atob(avance);
		avance = avance.replace(/<br\s*\/?>/gi, '');
		requerimiento = atob(requerimiento);
		requerimiento = requerimiento.replace(/<br\s*\/?>/gi, '');

		document.form.op.value='M';
		document.form.id.value = id;
		document.form.avance.value = avance;
		document.form.requerimiento.value = requerimiento;
				
		document.form.bti.style.display='none';
		document.form.btm.style.display='block';
	}
	
/*
Funcion Eliminar Avances lo envia a la clase avance2.php
*/	
function eliminar(id)
	{
		alert('Eliminando el avance...');
		
		document.form.op.value='E';
		document.form.id.value = id;
		document.form.action='avance2.php';
		document.form.submit();	
	}
/*
Funcion Enviar Formulario lo envia a la clase avance2.php para realizar las operaciones
*/	
	function enviar()
	{
		document.form.action='avance2.php';
		document.form.submit();	
	}
</script>
<!-- 
Configurar fondo de pantalla
-->
<style type="text/css">
	html {

		background: url(img/fondo.jpg);
		background-size: 100%;
	}

/*
Buscar fijar cabeceras columnas
http://yonax73.blogspot.com/2014/09/tabla-con-cabecera-estatica-cuerpo-con.html
*/

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

thead{
    background-color: #f1eee9;	/**/
    position: fixed !important;	/*el thead va ser siempre estatico*/
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

tr:nth-child(2n) {
    background: none repeat scroll 0 0 #edebeb;
}   

</style>
<!-- 
Encabezado HTML
-->
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<TITLE>Avances</TITLE>
		<link rel="StyleSheet" href="css/estilos.css" type="text/css">
	</HEAD>
	<BODY>
<!-- 
Logo animado
-->
		<div class="container">
			<div class="div-img">
				<img class="img" src="img/logo.gif" title="ava" alt="ava">
			</div>
		</div>
		
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>
		<BR><BR><BR><BR>
<!-- 
Titulo Animado
-->
		<marquee><font size=7 color="white">Agregar / Actualizar / Eliminar Avances</font></marquee>
		<BR>
		<BR>
<center>
<!-- 
Formulario ingreso edicion avances
-->			
		<form name=form id=form  action="" method="post" onsubmit="return false;">
		<input type=hidden name=op id=op>	
				
				<font color="white">ID</font>&nbsp;<br>
			<input type=text name=id id=id required>
				<br><br>
				
				<font color="white">Requerimiento</font>&nbsp;<br>
				<textarea name="requerimiento" id="requerimiento" rows="4"  cols="50"></textarea>
				<br><br>
				
				<font color="white">Avance</font>&nbsp; &nbsp;<br>
				<textarea name="avance" id="avance" rows="4"  cols="50"></textarea>
				<br><br>
<!-- 
Boton enviar formulario
-->
				<table>
					<tr>
						<input type=submit name=bti value='Insertar' onclick='insertar();' >
						<input type=submit name=btm value='Guardar cambios' onclick='enviar();' style='display:none;'>
					</tr>
				</table>
				
				<br><br>

<!-- 
Titulo tabla de registros avances
-->
			<font size=6 color="white">Histórico Avances</font>
				<br><br>

<!-- 
Consulta registros avances
-->		
			<?php	
				$sql = "SELECT * FROM tbavances order by id";
				$result = $conn->query($sql);
				$total = $result->num_rows;
				if ($total > 0) {
					echo "			
			<!-- 
			Tabla registros avances
			-->	
					<table border=1>
					<tr>
						<td align=center bgcolor=white>ID</td>
						<td align=center bgcolor=white>Requerimiento</td>
						<td align=center bgcolor=white>Avance</td>
						<td align=center bgcolor=white>Fecha</td>
						<td align=center bgcolor=white>Editar</td>						
						<td align=center bgcolor=white>Eliminar</td>						
					</tr>
					";
			/*-- 
			Llenado de la tabla con datos de la base 
			*/
					for ($i = 1; $i <= $total;$i++) {
							$row = $result->fetch_assoc();
							$id_c = $row["id"];
							$requerimiento_c = $row["requerimiento"];
							$avance_c = $row["avance"];
							$fecha_c = $row["fecha"];
			
					echo "
					<tr>								
						<td bgcolor=white><?php echo $id_c?></td>
						<td bgcolor=white><?php echo $requerimiento_c?></td>
						<td bgcolor=white><?php echo $avance_c?></td>
						<td bgcolor=white><?php echo $fecha_c?></td>
				<!-- 
				boton editar (editar codifica/decodifica la lectura de tildes) avances
				-->
						<td><input type=button value='Editar' onclick=\"editar('$id_c','base64_encode($requerimiento_c)',
						'base64_encode($avance_c)','$fecha_c');\></td>
				<!-- 
				boton eliminar avances
				-->
						<td><input type=button value='Eliminar' onclick=\"eliminar('$id_c');\"></td>
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