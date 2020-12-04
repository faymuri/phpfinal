<?php
    
// ceramos la conexion ee php y la base de datos
  $servidor = "localhost";
  $usuario = "root";
  $contrasena = "";
  $nombrebd = "bdvivero";
 
  $conexion = mysqli_connect($servidor, $usuario, $contrasena, $nombrebd);
 
  if(mysqli_connect_errno()){
	  echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
  }
      // else{
       echo"conexion establecida";
   //}
   //------------------------------------------------
    
?>  