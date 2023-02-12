<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="estiloR.css">
   <title>RegistroUID</title>
</head>
<body>
<h1 id="Navh1"> </h1>
<?php

if ($_GET){

      $UID = $_GET['tarjeta'];
      $user = $_GET['name'];
      $form_contacto = $_GET['inf_cont'];
}else{
        echo "Sin datos";
   }

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";

$conexion = mysqli_connect($servidor, $usuario, "") or die ("No se ha podido conectar al servidor de la Base de datos");

$db = mysqli_select_db($conexion, $basededatos) or die ("No se ha podido seleccionar la Base de datos");

$consulta = "SELECT EXISTS (SELECT id FROM info WHERE id = '$UID');";

$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_row($resultado);
if($row[0] == FALSE){
     printf("\r");
      echo "<div align=\"center\"><H1>Datos subidos con exito</H1></div>";
      echo "<br><br><div align=\"center\">Su nombre es: $user </div>";
      echo "<br><br><div align=\"center\">Su contacto es: $form_contacto </div>";
      echo "<br><br><div align=\"center\">El UID de su tarjeta es: $UID </div> ";

      $subir = "INSERT INTO info (id, nombre, contacto) VALUES ('$UID','$user','$form_contacto')";
      $new_R = mysqli_query($conexion, $subir);
}else{
      echo "<div align=\"center\"><H1>Error fatal!!!</H1></div> ";
      echo "<div align=\"center\"><br><br>No se han podido subir los datos</div> ";
      echo "<div align=\"center\"><br><br>Favor de ponerse en contacto con el administrador</div> ";
}
?>
</body>
</html>