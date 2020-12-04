<?php

  include('conexion.php');

  
   $user = $_REQUEST['user'];
   $clave = $_REQUEST['clave'];

   $salt = substr ($user, 0, 3);
   $clave_crypt = crypt ($clave, $salt);
   $instruccion = "INSERT INTO usuarios (user, clave) VALUES ('$user', '$clave_crypt')";
   $consulta = mysqli_query ($conexion, $instruccion)
      or die ("Fallo en la inserción");
   mysqli_close ($conexion);
   print ("Usuario $user insertado con Éxito\n"); 
   echo "<script>
   window.alert('Usuario $user agregado con Éxito\\n Ingrese nuevamente con sus datos');
   window.location.replace('ingreso.php'); 
   </script>"

?>