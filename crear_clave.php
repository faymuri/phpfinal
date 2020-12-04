<?php

  include('conexion.php');

  
   $usuario = $_REQUEST['usuario'];
   $clave = $_REQUEST['clave'];

   $salt = substr ($usuario, 0, 3);
   $clave_crypt = crypt ($clave, $salt);
   $instruccion = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$clave_crypt')";
   $consulta = mysqli_query ($conexion, $instruccion)
      or die ("Fallo en la inserción");
   mysqli_close ($conexion);
   print ("Usuario $usuario insertado con Éxito\n"); 
   echo "<script>
   window.alert('Usuario $usuario agregado con Éxito\\n Ingrese nuevamente con sus datos');
   window.location.replace('ingreso.php'); 
   </script>"

?>