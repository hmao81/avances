<?php
/* Conexion con la bd en php */
include('bd/conexion_log.php');
/* Buscar los campos en la base */
$opcion=$_REQUEST['op'];
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$usuarios = $_REQUEST['usuarios'];
$clave = $_REQUEST['clave'];

echo "opcion:".$opcion;
echo "<br>nombre:".$nombre;
echo "<br>apellidos:".$apellidos;
echo "<br>usuarios:".$usuarios;
echo "<br>clave:".$clave;

if($opcion=='I')
{
	$sql = "INSERT INTO usuarios (nombre, apellidos, usuarios, clave)
	VALUES ('" . $nombre . "', '" . $apellidos . "', '" . $usuarios . "', '" . $clave . "')";

	if ($conn->query($sql) === TRUE) {
		echo "Usuario Agregado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo "
	<script>
		alert('Usuario Insertado');
	</script>
	";
}
if($opcion=='M')
{	
	$sql = "update usuarios set nombre='$nombre', apellidos='$apellidos', usuarios='$usuarios', clave='$clave' where id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "Usuario Actualizado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	echo "
	<script>
		alert('Actualizado');
	</script>
	";

}
if($opcion=='E')
{
	$sql = "delete from usuarios where id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "Usuario Eliminado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	echo "
	<script>
		alert('Eliminado');
	</script>
	";

}

echo "
<script>
	location.href='usuarios1.php';
</script>
";
?>