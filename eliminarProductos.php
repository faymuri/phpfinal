<?PHP
   session_start ();
   // Incluir bibliotecas de funciones
   include ("conexion.php");
   //Evita el error de las variables vacias
   error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<HTML LANG="es">

<HEAD>
   <TITLE>Gestión de productoss - Eliminación de productos</TITLE>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilos.css">
   <style>
		.content {
			margin-top: 80px;
		}
	</style>


</HEAD>

<BODY>

<div class="container">
<div class="content">

<?PHP
   if (isset($_SESSION["usuario_valido"]))
   {
?>

<H1>Eliminar productos</H1>

<?PHP

   $eliminar = $_REQUEST['eliminar'];
   if (isset($eliminar))
   {


   // Obtener número de noticias a borrar
      $borrar = $_REQUEST['borrar'];
      $nfilas = count ($borrar);

   // Mostrar noticias a borrar
      for ($i=0; $i<$nfilas; $i++)
      {

      // Obtener datos de la noticia i-ésima
         $instruccion = "SELECT * FROM productos WHERE idproductos = $borrar[$i]";
         $consulta = mysqli_query ($conexion, $instruccion)
            or die ("Fallo en la consulta");
         $resultado = mysqli_fetch_assoc ($consulta);

      // Mostrar datos de la noticia i-ésima
         print ("datos eliminados:\n");
         print ("<UL>\n");
         print ("   <LI>Nombre de producto: " . $resultado['nombre_producto']);
         print ("   <LI>Tipo de producto: " . $resultado['tipo_producto']);
         print ("   <LI>Descripcion de porducto: " . $resultado['descripcion_producto']);
      
         if ($resultado['imagen'] != "")
            print ("   <LI>Imagen: " . $resultado['imagen']);
         else
            print ("   <LI>Imagen: (no hay)");
         print ("</UL>\n");

      // Eliminar productos
         $instruccion = "DELETE FROM productos WHERE idproductos = $borrar[$i]";
         $consulta = mysqli_query ($conexion, $instruccion)
            or die ("Fallo en la eliminación");

      // Borrar imagen asociada si existe
         if ($resultado['imagen'] != "")
         {
            $nombreFichero = "img/" . $resultado['imagen'];
            unlink ($nombreFichero);
         }

      }
      print ("<P>Número total de productos eliminados: " . $nfilas . "</P>\n");

   // Cerrar conexión
      mysqli_close ($conexion);

      print ("<P><a class='btn btn-danger' href='eliminarProductos.php' role='button'>Eliminar más datos?</a> | ");
      print ("<a class='btn btn-primary' href='ingreso.php' role='button'>Menú principal</a></P>\n");


   }
   else
   {


   // Enviar consulta
      $instruccion = "SELECT * from productos order by tipo_producto desc";
      $consulta = mysqli_query ($conexion, $instruccion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<FORM ACTION='eliminarProductos.php' METHOD='post'>\n");
         print ("<div class='table-responsive-sm'>");
         print ("<TABLE class='table table-striped table-hover'>\n");
         print ("<TR class='table-danger'>\n");
         print ("<TH>nombre de productos</TH>\n");
         print ("<TH>tipo de producto</TH>\n");
         print ("<TH>descripciones de producto</TH>\n");
         print ("<TH>Imagen</TH>\n");
         print ("<TH>Borrar</TH>\n");
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_assoc ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['nombre_producto'] . "</TD>\n");
            print ("<TD>" . $resultado['tipo_producto'] . "</TD>\n");
            print ("<TD>" . $resultado['descripcion_producto'] . "</TD>\n");

            if ($resultado['imagen'] != "")
               print ("<TD><A TARGET='_blank' HREF='img/" . $resultado['imagen'] .
                      "'><IMG BORDER='0' SRC='img/ico-fichero.gif' ALT='Imagen asociada'></A></TD>\n");
            else
               print ("<TD>&nbsp;</TD>\n");

            print ("<TD><INPUT TYPE='CHECKBOX' NAME='borrar[]' VALUE='" .
               $resultado['idproductos'] . "'></TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");
         print ("</div>\n");

         print ("<BR>\n");
         print ("<button type='submit' class='btn btn-outline-danger' NAME='eliminar'>Eliminar productos marcados</button>\n");
         print ("</FORM>\n");
      }
      else
         print ("No hay productos disponibles");

   // Cerrar conexión
      mysqli_close ($conexion);

      print ("<P><a class='btn btn-outline-primary' href='ingreso.php' role='button'>Menú principal</a></P>\n");

   }

?>

<?PHP

   }
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      print ("<P ALIGN='CENTER'>[ <A HREF='ingreso.php' TARGET='_top'>Conectar</A> ]</P>\n");
   }

?>
</div>
</div>
</BODY>
</HTML>