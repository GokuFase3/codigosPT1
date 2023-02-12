<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Buscar por aulas</title>
</head>
<body>
<script>
   function alerta(){
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {

      $fromemail = "saulmagana1998@outlook.com";
      $fromname = "Desconocido";
      $host = "smtp-mail.outlook.com";
      $port = "587";
      $SMTPAuth = true;
      $_SMTPSecure = "starttls";
      $Password = "Lo260772Lo";
      $emailTo = array();
      array_push($emailTo, "saulmagana1998@icloud.com");
      array_push($emailTo, "saimonluaskukie@icloud.com");
      $Subject = "Emails PT";
      $bodyEmail = "Test Correo";

      $mail->isSMTP();
      $mail->SMTPDebug = 0;
      $mail->Host = $host;
      $mail->Port = $port;
      $mail->SMTPAuth = $SMTPAuth;
      $mail->SMTPSecure = $_SMTPSecure;
      $mail->Username = $fromemail;
      $mail->Password = $Password;
      
      $mail->setFrom($fromemail,$fromname);
      if (is_array($emailTo)){
          foreach ($emailTo as $key => $value) {
               $mail->addAddress($value);
          }
      }else{
               $mail->addAddress($emailTo);
      }


      $mail->isHTML(true);
      $mail->Subject = $Subject;
      $mail->Body = $bodyEmail;

      $mail->send();

} catch (Exception $e) {
}

?>

      alert("Correos enviados");
   }

</script>


	<center><H1>¡Personas en riesgo!</H1></center>
<?php

if ($_GET){
	$inicio = $_GET['inicio'];
	$final = $_GET['final'];
   $NoAula = $_GET['aula'];      
   }else{
      echo "Sin datos";
   }

$usuario = "root";
$contrasena = "";
$servidor = "localhost";
$basededatos = "aulas";
$puerto = "80";
$tabla = "sala1";

$conexion = mysqli_connect($servidor, $usuario, "");
   echo "<div align=\"right\">conectado al servidor <font color='green'>✓</font></div>";
$db = mysqli_select_db($conexion, $basededatos);
   echo "<div align=\"right\">conectado a la base de datos <font color='green'>✓</font></div>";

echo "Buscando personas que coinciden con el horario entre ";
echo "".$_GET['inicio']." y ".$_GET['final'];
echo " en el aula: " .$_GET['aula'];

?>
<table>
	<tr>
		<td>UID</td>
		<td>Fecha</td>
      <td>Aula</td>
	</tr>
	<?php
	$listado = array();
	$consulta = "SELECT id, fecha, sala FROM salas WHERE sala = '$NoAula' AND fecha BETWEEN '$inicio' AND '$final'";

   $resultado = mysqli_query($conexion, $consulta);
   while($explorar = mysqli_fetch_array($resultado)){
   	printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $explorar["id"], $explorar["fecha"], $explorar["sala"]);
   	array_push($listado, $explorar["id"]);
   }

    $j = 0;
    $repetidos = array();
    $aux = $listado[$j];
    $repetidos[] = $aux;
    $j++;
    for($j; $j < count($listado); $j++){
       $aux = $listado[$j];
       if(!in_array($aux, $repetidos)){
       $repetidos[] = $aux;
       }
    }
    $j = 0;

    echo "<br>Los correos si los quiere imprimir son: <br><br>";
    while($j < count($repetidos)){
       $query = "SELECT contacto FROM info WHERE id = '$repetidos[$j]'";
       $correos = mysqli_query($conexion, $query);
         while($explorar_correos = mysqli_fetch_array($correos)){
                printf("%s, ", $explorar_correos["contacto"]);
         }
      $j++;
   }
     echo "<br><br>";
	?>
<fieldset>
      <legend>Correos</legend>
      <input type="button" onclick="alerta()" id="boton" value="Mandar correos">

</fieldset>

</body>
</html>
