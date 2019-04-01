<?php
session_start();
//conexion
include('bd/conexion.php');
//llegada variables
$usuario=$_REQUEST['us'];
$clave=$_REQUEST['cl'];
//validacion consulta
$sql = "SELECT * FROM usuarios where usuarios='$usuario' and clave='$clave'";
//Asignacion variables
$result = $conn->query($sql);
$total=$result->num_rows;
if($total>0)
{
	$row = $result->fetch_assoc();
	
	$id_c=null;
	$id_c=$row["id"];
	$nombre_c=$row["nombre"];
	$usuarios_c=$row["usuarios"];
	
	$_SESSION["id_usuario"]=$id_c;
	$_SESSION["nom"]=$nombre_c;
//variable autenticacion para control de sesion, se establece el tiempo de sesion
	$_SESSION["autentificado"]= "SI";
	$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
	
	echo "<script>location.href='header.php';</script>";
}	
else
{
	echo "<script>alert('Usuario y/o Clave Incorrectos !!!');
	location.href='../login.php';
	</script>";
}

?>