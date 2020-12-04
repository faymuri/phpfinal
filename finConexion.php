<?PHP
   session_start ();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconectar</title>
    <link rel="stylesheet" TYPE="text/css" HREF="estilos.css">
    <!--Bootstrap-->
<link  href= "https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    

<?PHP
   if (isset($_SESSION["usuario_valido"]))
   {
      session_destroy ();
      print ("<BR><BR><P ALIGN='CENTER'>Conexión finalizada</P>\n");
      print ("<P ALIGN='CENTER'><a class='btn btn-primary' href='ingreso.php' role='button'>Conectar</a></P>\n");
   }
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>No existe una conexión activa</P>\n");
      print ("<P ALIGN='CENTER'><a class='btn btn-primary' href='ingreso.php' role='button'>Conectar</a></P>\n");

   }
?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</BODY>
</HTML>