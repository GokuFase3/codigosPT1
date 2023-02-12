<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>ConsultasUID</title>
</head>
<body>
	<center><H1>BIENVENIDO!</H1></center>
<?php

$card = $_GET['card'];
$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";
$puerto = "80";
$tabla = "salas";

$conexion = mysqli_connect($servidor, $usuario, "");
	echo "<div align=\"right\">conectado al servidor <font color='green'>✓</font></div>";
$db = mysqli_select_db($conexion, $basededatos);
	echo "<div align=\"right\">conectado a la base de datos <font color='green'>✓</font></div>";

$consulta = "SELECT EXISTS (SELECT id FROM salas WHERE id = '$card');";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_row($resultado);
if($row[0] == FALSE){
	echo "<div align=\"center\"><H1>No existe la sala seleccionada!!! </H1></div>";	
}else{
    $new_consulta = "SELECT id, fecha, sala FROM salas WHERE id = '$card'";
    $new_resultado = mysqli_query($conexion, $new_consulta);

	 echo "la tarjeta " .$card. " estuvo en los siguientes horarios<br><br>";
    while($row = mysqli_fetch_array($new_resultado)){
    	printf("<tr><td>%s en el aula: %s<br></td></tr>", $row["fecha"], $row["sala"]);
    }
}
    mysqli_free_result($new_resultado);
    mysqli_close($conexion);
    ?>
<center>
<form action="Salas.php" methot="get">        
<H3>Para buscar por horarios y aula ingrese las fechas y aula en los campos siguientes:</H3>
<H5>Ingrese el horario inicial (AAAA-MM-DD hh:mm:ss)</H5>
inicial: <input type="text" name="inicio">
<H5>Ingrese el horario final (AAAA-MM-DD hh:mm:ss)</H5>
final: <input type="text" name="final">
<br><br>
<H5>Agregar un aula para buscar las coincidencias</H5>
Aula: <input type="text" name="aula">
<br><br>
<input type="submit" value="Buscar coincidencias">
   </form>
</center>
</body>
</html>