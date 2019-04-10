<?php
/* Conexión con la bd en php */
include('bd/conexion_log.php');

$id=$_SESSION["id_usuario"];
?>
<!-- Funciones en javascript -->
<script>
	function finalizar()
	{
		location.href="cerrar.php";
	}

	function cargar(b)
	{
		ifr.location.href=b;
	}
</script>
<style>
	html {
		background: url(img/fondo.jpg);
		background-size: 100%;
	}
</style>
<html>
	<head><title>Control Usuarios - Avances</title></head>
	<body>
		<table width=100% height='100%' border=0>
			<tr height=10%>
				<td width=20% align=center><input type=button value='Salida segura' onclick='finalizar();'></td>
				<td>Bienvenido: <?php echo $_SESSION["nom"];?></td>
			</tr>
			<tr height=90%>
				<td valign=top align=center>
					<?php
					$sql = "SELECT a.nombre,a.url url FROM usuarios u,aplicaciones a, usu_apli up where a.id=up.id_apli and up.id_usuario=u.id and u.id=$id";
					$result = $conn->query($sql);
					$total=$result->num_rows;
					if($total>0)
					{
						echo "
						<table border=0>
							<tr>";

							for($i=1;$i<=$total;$i++)
							{
								$row = $result->fetch_assoc();
								$nombre_c=$row["nombre"];
								$url_c=$row["url"];

								echo "
								
									<td align=center><input type=button value='$nombre_c' onclick=cargar('$url_c');></td>
							</tr>
								";
							}
							echo "
						</table>
						";
					}	
					?>
				</td>
				<td>
					<iframe name=ifr id=ifr width=100% height=100%></iframe>
				</td>
			</tr>
		</table>
	</body>
</html>