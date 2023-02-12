<?php

$ID = $_GET['id'];
$aula = $_GET['aula'];

echo "El UID registrado es: " .$ID;
echo "  En el aula: " .$aula;

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";

$conexion = mysqli_connect($servidor, $usuario, "") or die ("No se ha podido conectar al servidor de la Base de datos");

$db = mysqli_select_db($conexion, $basededatos) or die ("No se ha podido seleccionar la Base de datos");
#".$ID."
$consulta = "INSERT INTO salas (id, sala) VALUES ('$ID', '$aula')";

$resultado = mysqli_query($conexion, $consulta) or die ("No se pudo subir los datos");

?>