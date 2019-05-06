<?php
session_start();

include('def_globales.inc');

//en caso de que se haya finalizado la sesion redirige al login
if ($_SESSION["autentificado"] != "SI") 
{  	echo "
	<script>alert('Su sesion ha expirado, por favor autenticarse');</script>";
	echo "
	<script>location.href='index.php';</script>";
	exit;
} 
else 
{
	$fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
     if($tiempo_transcurrido >= $tiempo_sesion) {
		session_destroy(); 
		session_unset();
	}else {
    $_SESSION["ultimoAcceso"] = $ahora;
	}
}
//conexion con la BD para verificar informacion
$conn = new mysqli($servidor,$usuario,$clave,$base);
?>