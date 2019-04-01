<?php
/*
Conexion con la bd en php
*/
include('bd/conexion_log.php');
/*
Buscar los campos en la base
*/
$opcion=$_REQUEST['op'];
$id = $_REQUEST['id'];
$avance = $_REQUEST['avance'];
$requerimiento = $_REQUEST['requerimiento'];
$fecha = $_REQUEST['fecha'];

echo "opcion:".$opcion;
echo "<br>id:".$id;
echo "<br>avance:".$avance;
echo "<br>requerimiento:".$requerimiento;
echo "<br>fecha:".$fecha;
/*
Inserta avances
*/
if($opcion=='I')
{

	$sql = "INSERT INTO tbavances (id, avance, requerimiento, fecha)
	VALUES ('" . $id . "', '" . $avance . "', '" . $requerimiento . "', NOW())";

	if ($conn->query($sql) === TRUE) {
		echo "Agregando Avance";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	echo "
	<script>
	alert('Insertando...');
	</script>
	";
}
/*
Modifica avances
*/
if($opcion=='M')
{	
	$sql = "update tbavances set avance='$avance',requerimiento='$requerimiento',fecha=now() where id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "Actualizado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	echo "
	<script>
	alert('Actualizando...');
	</script>
	";
}
/*
Elimina avances
*/
if($opcion=='E')
{
	$sql = "delete from tbavances where id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "Eliminado";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	echo "
	<script>
	alert('Eliminando...');
	</script>
	";
}
/*
Envia lo procesado a la clase avance1.php
*/
echo "
<script>
location.href='avance1.php';
</script>

";

?>