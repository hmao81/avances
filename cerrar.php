<!--
Cierre de sesión
-->
<?php
session_start();
session_destroy(); 
session_unset();

echo "<script>
alert('Cerrando Sesion');
/*
Redirige al index
*/
location.href='index.php';
</script>";
exit;
?>