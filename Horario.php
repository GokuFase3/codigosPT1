<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>ConsultasUID</title>
</head>
<body>
	<H1>Personas en riesgo!</H1>
<?php

if ($_GET){
	$inicio = $_GET['inicio'];
	$final = $_GET['final'];
      echo "Personas que coinciden con el horario entre ";
      echo "".$_GET['inicio']." y ".$_GET['final'];
      echo "<br><br>";
   }else{
      echo "Sin datos";
   }

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";
$puerto = "80";
$tabla = "sala1";

if(!($conexion = mysqli_connect($servidor, $usuario, ""))){
	echo "No se ha podido conectar al servidor de la Base de datos <br><br>";
}else{
	echo "Al conectarme con el servidor ";
}
if(!($db = mysqli_select_db($conexion, $basededatos))){
   echo "No se ha podido seleccionar la Base de datos <br><br>";
}else{
	echo "encontre en la base de datos de ".$basededatos."";
}
$consulta = "SELECT id, fecha FROM sala1 WHERE fecha BETWEEN '$inicio' AND '$final'";

if (!($resultado = mysqli_query($conexion, $consulta))){
	echo "No se ha podido hacer la consulta correctamente <br><br>";
}else{
   echo " que las personas en riesgo son: <br><br>";	
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
    	if 
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion)
	?>
</table>




</body>
</html>