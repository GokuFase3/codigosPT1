<?php

if ($_GET){

$UID = $_GET['tarjeta'];
$user = $_GET['name'];
$mensaje = $_GET['inf_cont'];

        echo "Su nombre es: " .$_GET["name"];

        echo "<br><br>Su contacto es: " .$_GET["inf_cont"];

        echo "<br><br>El UID de su tarjeta es: " .$_GET["tarjeta"];
   }else{
        echo "Sin datos";
   }

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";

$conexion = mysqli_connect($servidor, $usuario, "") or die ("No se ha podido conectar al servidor de la Base de datos");

$db = mysqli_select_db($conexion, $basededatos) or die ("No se ha podido seleccionar la Base de datos");

$consulta = "INSERT INTO info (id, nombre, contacto) VALUES ('$UID','$user','$mensaje')";
$resultado = mysqli_query($conexion, $consulta) or die ("No se subir los datos");

?>