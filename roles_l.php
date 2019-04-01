<?php
/*
Conexion con la bd en php
*/	
include('bd/conexion_log.php');

error_reporting(0);
/*
Llegan datos en variables
*/
$op='';
$op=$_REQUEST['op'];

$id=$_SESSION["id_usuario"];

$us='';
$us=$_REQUEST['usuario'];

$apl='';
$apl=$_REQUEST['apli'];
/* 
Agrega acceso a la aplicacion para el usuario
*/
if($op=='I')
{
	$sql = "INSERT INTO usu_apli(id_usuario,id_apli) VALUES ('$us', '$apl')";

	if ($conn->query($sql) === TRUE) {
		echo "Creado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo "
	<script>
	alert('Agregado');
	</script>
	";
}
/* 
Quita acceso a la aplicacion para el usuario
*/	
if($op=='E')
{
	$sql = "delete from usu_apli where id_usuario='$us' and id_apli='$apl'";

	if ($conn->query($sql) === TRUE) {
		echo "Creado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	echo "
	<script>
	alert('Eliminado');
	</script>
	";
}
/*
Envia los datos a la clase roles.php
*/
echo "
<script>
location.href='roles.php';
</script>
";

?>