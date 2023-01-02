<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Formulario de Correo</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

   <H1>BIENVENIDO!</H1>
   <H3>Aqui puede mandar correo a los contactos</H3>
   <form action="UpCorreo.php" methot="get">
         <input type="text" placeholder ="correo" name="correo">
         <input type="text" placeholder ="asunto" name="asunto">
         <textarea placeholder = "mensaje" name = "msg"></textarea>
         <br><br><br>
         <button>enviar</button>
   </form>
</body>
</html>
