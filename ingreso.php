<?php
//se inclue el archivo conexion.php que es en donde se encuentra 
//las instrucciones para establecer la conexion entre php y la base de datos
include('conexion.php');

//Evita el error de las variables vacias
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();

//Si se ha enviado el formulario
// se inicializan variables con los parametros de la tabla usuarios
$usuario= $_REQUEST['usuario'];
$clave = $_REQUEST['clave'];

if (isset($usuario) && isset($clave))

     {
        // extrae  las  3 primeras letras de la informacion ingresada en el campo usuario      
         $salt = substr ($usuario, 0, 3);
         // se crea la encriptacion de la clave ingresada para hacer una contraseña segura
         $clave_crypt = crypt ($clave, $salt);
         $instruccion = "SELECT usuario, clave FROM usuarios WHERE usuario = '$usuario'" .
            " and clave = '$clave_crypt'";
         $consulta = mysqli_query ($conexion, $instruccion)
            or die ("Fallo en la consulta");
         $nfilas = mysqli_num_rows ($consulta);
         mysqli_close ($conexion);


      // Los datos introducidos son correctos
         if ($nfilas > 0)
         {
            $usuario_valido = $usuario;
            $_SESSION["usuario_valido"] = $usuario_valido;
           // print ("<P>Valor de la variable de sesión: $usuario_valido</P>\n");
            echo" <script>
                    window.alert('Bienvenido $usuario');
                  </script>";
         }
      }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ingreso de usuarios</title>
    <link rel="stylesheet" href="estilos.css">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/86b890441b.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="contenedor">
    <div id="login">
    <?PHP
// Sesión iniciada
   if (isset($_SESSION["usuario_valido"]))
   {
    ?>
    
    <H1></H1>
    <HR>
    
    <UL>
       <LI><A HREF="ingresoProducto.php" class="text-dark">ingresar productos</A> 
       <LI><A HREF="consultarProductos.php" class="text-dark">ver listado de productos o servicios</A>
       <LI><A HREF="compras.php" class="text-dark">Compras a proveedores</A>
       <LI><A HREF="eliminarProductos.php" class="text-dark">Eliminar productos o servicios</A>
   
    </UL>
    
    <HR>
    
    <P><a class='btn btn-outline-danger' href='finConexion.php' role='button'>Cerrar Sesión</a></P>
    
    <?PHP
       }
       // Intento de entrada fallido
   else if (isset ($usuario))
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      
      print ("<P ALIGN='CENTER'><a class='btn btn-primary' href='ingreso.php' role='button'>Conectar</a></P>\n");

   }

   else
   {
        print ("<div  class='container'>\n") ;
         
            print("<div id='login-row' class='row justify-content-center align-items-center'>\n"); 
                    print("<div id='login-column' class='col-md-6'>\n");
                    print("<div id='login-box' class='col-md-12'>\n");
                    print   ("<form id='login-form' name='ingreso' class='form' action='ingreso.php' method='POST'>\n");
                    print   ( "<h3 class='text-center text-dark'>Ingreso</h3>\n");
                    print     ("<div class='form-group'>\n");
                    print    ("<label for='username' class='text-dark'>Usuario:</label><br>\n");
                    print     ("<input type='text' name='usuario' id='username' class='form-control'>\n");
                    print      ("</div>\n");
                    print       ("<div class='form-group'>\n");
                    print        ("<label for='password' class='text-dark'>Contraseña:</label><br>\n");
                    print          ("<input type='password' name='clave' id='password' class='form-control'>\n");
                    print          ("<br>\n");
                    print          ("</div>\n");
                    print ("<div class='form-group'>\n");
                                    
                    print  ("<input type='submit' name='submit'id='boton' class='btn btn-info btn-md' value='Enviar'>\n");
                    print   ("</div>\n");
                    print     ("<div id='register-link' class='text-right'>\n");
                    print         ("<a href='registrarUsuario.php' class='text-dark'>registrese aquí</a>\n");
                    print     ("</div>\n");
                    print  ("</form>\n");

                     print  ("</div>\n");
                     print ("</div>\n");
                     print  ("</div>\n");
                     print  ("</div>\n");
                     print ("</div>\n");    
                     print ("</div>\n");



    print ("<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>");
    print ("<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>");
    
 
   }
  ?>
</body>
</html>