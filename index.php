<?php

$ID = $_GET['id'];
#$DATE = "2022-11-16 17:05:13";

echo "El UID registrado es: " .$ID;
#echo "<br>La fecha es:" .$DATE;

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";

$conexion = mysqli_connect($servidor, $usuario, "") or die ("No se ha podido conectar al servidor de la Base de datos");

$db = mysqli_select_db($conexion, $basededatos) or die ("No se ha podido seleccionar la Base de datos");

#$fecha = time();
#".$ID."
$consulta = "INSERT INTO sala1 (id) VALUES ('$ID')";

$resultado = mysqli_query($conexion, $consulta) or die ("No se pudo subir los datos");

?>
