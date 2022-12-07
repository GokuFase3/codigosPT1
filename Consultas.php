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
	echo "conectado al servidor";
}
if(!($db = mysqli_select_db($conexion, $basededatos))){
   echo "No se ha podido seleccionar la Base de datos <br><br>";
}else{
	echo " y listo para usar la base de datos: ".$basededatos."<br><br>";
}
$consulta = "SELECT id, fecha FROM sala1 WHERE id = '$card'";

if (!($resultado = mysqli_query($conexion, $consulta))){
	echo "No se ha podido hacer la consulta correctamente <br><br>";
}else{
   echo "Nueva consulta: ";	
}

?>
	<?php
	 echo "la tarjeta " .$card. " estuvo en los siguientes horarios<br><br>";
    while($row = mysqli_fetch_array($resultado)){
    	printf("<tr><td>%s<br></td></tr>", $row["fecha"], $row["id"]);
    }
    #mysqli_free_result($resultado);
    #mysqli_close($conexion)
   ?>
       <form action="Horario.php" methot="get">        
         <H3>Para buscar por horarios ingrese las fechas en los campos</H3>
          <H5>Ingrese el horario inicial (AAAA-MM-DD hh:mm:ss)</H5>
         inicial: <input type="text" name="inicio">
          <H5>Ingrese el horario final (AAAA-MM-DD hh:mm:ss)</H5>
         final: <input type="text" name="final">
         <br><br>
         <input type="submit" value="Buscar por horarios">
   </form>
</body>
</html>