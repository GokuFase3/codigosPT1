<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>ConsultasUID</title>
</head>
<body>
	<H1>BIENVENIDO!</H1>
<?php

$card = $_GET['card'];
$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";
$puerto = "80";
$tabla = "sala1";

if(!($conexion = mysqli_connect($servidor, $usuario, ""))){
	echo "No se ha podido conectar al servidor de la Base de datos <br><br>";
}else{
	echo "conectado al servidor <br><br>";
}
if(!($db = mysqli_select_db($conexion, $basededatos))){
   echo "No se ha podido seleccionar la Base de datos <br><br>";
}else{
	echo "base de datos seleccionada: ".$basededatos."<br><br>";
}
$consulta = "SELECT id, fecha FROM sala1 WHERE id = '$card'";

if (!($resultado = mysqli_query($conexion, $consulta))){
	echo "No se ha podido hacer la consulta correctamente <br><br>";
}else{
   echo "Su consulta es: <br><br>";	
}

?>
<table>
	<tr>
		<td>UID</td>
		<td>Fecha</td>
	</tr>
	<?php
    while($row = mysqli_fetch_array($resultado)){
    	printf("<<tr><<td>%s</td><<td>%s</td></tr>", $row["id"],$row["fecha"]);
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion)
	?>
</table>

</body>
</html>