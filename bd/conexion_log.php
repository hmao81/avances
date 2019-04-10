<?php
session_start();

include('def_globales.inc');

//sesion
if ($_SESSION["autentificado"] != "SI") 
{  	echo "
	<script>alert('Su sesion ha expirado, por favor autenticarse');</script>";
	echo "
	<script>location.href='../login.php';</script>";
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
//fin sesion
$conn = new mysqli($servidor,$usuario,$clave,$base);
?>