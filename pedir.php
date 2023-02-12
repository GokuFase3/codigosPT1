<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="estiloR.css">
   <title>RegistroUID</title>
</head>
<body>
<nav id="Nav">
   <H1>BIENVENIDO!</H1>
</nav>
   <form action="subir.php" methot="get">
         <h1 id="Navh1"> Ingrese su datos por favor </h1>
       	Nombre: <input type="text" name="name">
         <br><br>
         Contacto: <input type="text" name="inf_cont">
         <h1 id="Navh1">Ingrese el UID de la tarjeta que le proporcionaron</h1>
         UID: <input type="text" name="tarjeta">
         
         <br><br><br>
         <input type="submit" value="Enviar">
   </form>
</body>
</html>
