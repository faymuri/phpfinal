<?PHP
   session_start ();
   // Incluir bibliotecas de funciones
  
   include("conexion.php");
?>
<HTML>

<HEAD>
   <TITLE>Gestión de datos - Consulta de datos</TITLE>
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


<H1>Consultar datos de estudiantes</H1>

<?PHP

   // Enviar consulta
   $instruccion = "SELECT * FROM datos";
   $consulta = mysqli_query ($conexion, $instruccion)
      or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<div class='table-responsive-sm'>");
         print ("<TABLE class='table table-striped table-hover'>\n");
         print ("<TR class='table-danger'>\n");
         print ("<TH>nombre</TH>\n");
         print ("<TH>apellido</TH>\n");
         print ("<TH>aspiraciones</TH>\n");
         print ("<TH>eleccion de escuela</TH>\n");
         print ("<TH>Imagen</TH>\n");
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_assoc ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['nombre'] . "</TD>\n");
            print ("<TD>" . $resultado['apellido'] . "</TD>\n");
            print ("<TD>" . $resultado['aspiraciones'] . "</TD>\n");
            print ("<TD>" . $resultado['eleccion_escuela'] . "</TD>\n");

            if ($resultado['foto'] != "")
               print ("<TD><A TARGET='_blank' HREF='img/" . $resultado['foto'] .
                      "'><IMG BORDER='0' SRC='img/ico-fichero.gif' ALT='Imagen asociada'></A></TD>\n");
            else
               print ("<TD>&nbsp;</TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");
         print ("</div>\n");
      }
      else
         print ("No hay datos de estudiantes  disponibles");

// Cerrar conexión
   mysqli_close ($conexion);

?>
<br><br>
<P><a class='btn btn-outline-primary' href='ingreso.php' role='button'>Menú principal</a></P>


<?PHP

   }
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      print ("<P ALIGN='CENTER'><a class='btn btn-primary' target='_top' href='ingreso.php' role='button'>Conectar</a></P>\n");
      //print ("<P ALIGN='CENTER'>[ <A HREF='login.php' TARGET='_top'>Conectar</A> ]</P>\n");
   }
   
?>
</div>
</div>
</BODY>
</HTML>