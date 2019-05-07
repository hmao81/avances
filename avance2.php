<?php
/* Conexion con la bd en php */
include('bd/conexion_log.php');
/* Buscar los campos en la base */
$opcion=$_REQUEST['op'];
$id = $_REQUEST['id'];
$codigo = $_REQUEST['codigo'];
$avance = utf8_decode($_REQUEST['avance']);
$requerimiento = utf8_decode($_REQUEST['requerimiento']);
$porcenta = $_REQUEST['porcenta'];
$fecha = (isset($_REQUEST['fecha'])) ? $_REQUEST['fecha'] : '';

echo "opcion:".$opcion;
echo "<br>código:".$codigo;
echo "<br>id:".$id;
echo "<br>avance:".utf8_encode($avance);
echo "<br>requerimiento:".utf8_encode($requerimiento);
echo "<br>fecha:".$fecha;
/* Inserta avances */
if($opcion=='I')
{
	$sql = "INSERT INTO tbavances (codigo, avance, requerimiento, porcentaje_avance, fecha, id_usuario)
	VALUES ('" . $codigo . "', '" . $avance . "', '" . $requerimiento . "', '" . $porcenta . "', NOW(), '" . $_SESSION['id_usuario'] . "')";

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

/* Modifica avances */
if ($opcion=='M') {
	$sql = "UPDATE tbavances
		SET avance = '" . $avance . "',
			requerimiento = '" . $requerimiento . "',
			codigo = '" . $codigo . "',
			fecha = NOW()
		WHERE id = '" . $id . "'";

	if ($conn->query($sql))
		echo "Actualizado";
	else
		echo "Error: " . $sql . "<br>" . $conn->error;?>

	<script>
		alert('Actualizando...');
	</script><?php
}
/* Elimina avances */
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
/* Envia lo procesado a la clase avance1.php */
echo "
<script>
	location.href='avance1.php';
</script>
";
?>
