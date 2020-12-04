<?PHP
   session_start ();
   // Incluir bibliotecas de funciones
   include ("conexion.php");

   //Evita el error de las variables vacias
   error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<HTML LANG="es">
<HEAD>
   <TITLE> Inserción de estudiantes</TITLE>
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

<?PHP
// Obtener valores introducidos en el formulario
$insertar = $_REQUEST['insertar'];
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$aspiraciones = $_REQUEST['aspiraciones'];
$eleccion_escuela = $_REQUEST['eleccion_escuela'];

$error = false;
if (isset($insertar))
{
    // Comprobar que se han introducido todos los datos obligatorios
   // nombre
   if (trim($nombre) == "")
   {
      $errores["nombre"] = "¡Debe introducir el nombre de el/la  niñ@!";
      $error = true;
   }
   else
      $errores["nombre"] = "";

// apellido
   if (trim($apellido) == "")
   {
      $errores["apellido"] = "¡Debe introducir el apellido de el/la niñ@!";
      $error = true;
   }
   else
      $errores["apellido"] = "";

  // aspiraciones
   if (trim($aspiraciones) == "")
   {
      $errores["aspiraciones"] = "¡Debe introducir la aspirtacion de el/la  niñ@!";
      $error = true;
   }
   else
      $errores["aspiraciones"] = "";

    // eleccion de la escuela
   if (trim($eleccion_escuela) == "")
   {
      $errores["eleccion_escuela"] = "¡Debe introducir la aspirtacion el motivo de la eleccion de la escuela de el/la niñ@";
   }
   else
      $errores["eleccion_escuela"] = "";

      // Subir fichero
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se a�ade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
      }
      // El fichero introducido supera el límite de tamaño permitido
      else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores["imagen"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
         $error = true;
      }
   // No se ha introducido ningún fichero
      else if ($_FILES['imagen']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
      {
         $errores["imagen"] = "¡No se ha podido subir el fichero!";
         $error = true;
      }
   }
   // Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

     
      $instruccion = "INSERT INTO datos (nombre,apellido,aspiraciones,eleccion_escuela,foto) values ('$nombre', '$apellido', '$aspiraciones', '$eleccion_escuela', '$nombreFichero')";
      $consulta = mysqli_query ($conexion, $instruccion)
         or die ("Fallo en la consulta");
      mysqli_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombreDirectorio . $nombreFichero);

          // Mostrar datos introducidos
      print ("<H1>Gestión de datos</H1>\n");
      print ("<H2>Resultado de la inserción de nuevos datos</H2>\n");

      print ("<P>los datos han sido recibidos correctamente:</P>\n");
      print ("<UL>\n");
      print ("   <LI>nombre: " . $nombre. "\n");
      print ("   <LI>apellido: " . $apellido . "\n");
      print ("   <LI>aspiraciones: " . $aspiraciones . "\n");
      print ("   <LI>eleccion_escuela: " . $eleccion_escuela . "\n");
      if ($nombreFichero != "")
         print ("   <LI>Imagen: <A TARGET='_blank' HREF='" . $nombreDirectorio . $nombreFichero . "'>" . $nombreFichero . "</A>\n");
      else
         print ("   <LI>Imagen: (no hay)\n");
      print ("</UL>\n");

      print ("<P><a class='btn btn-success' href='insertar_datos.php' role='button'>Insertar otros datos</a> | ");
      print ("<a class='btn btn-primary' href='ingreso.php' role='button'>Menú principal</a></P>\n");

   }
   else
   {

?>

    
    
    <H1 class="titulo4">Insertar nuevos estudiantes</H1>

    <div id="formularioinsertar" class=container>
    <FORM CLASS="borde" ACTION="insertar_datos.php" NAME="insertar" METHOD="POST"
       ENCTYPE="multipart/form-data">
</P>
    <!-- nombre -->
       <div class="bloque1"> 
    <P><LABEL>Nombre: *</LABEL>
    <INPUT TYPE="TEXT" NAME="nombre" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($insertar))
          print ("VALUE='$nombre'>\n");
       else
          print (">\n");
       if ($errores["nombre"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["nombre"] . "</SPAN>");
    ?>
 <P>
       
</P>
    <!-- apellido -->
    <P><LABEL>Apellido: *</LABEL>
    <INPUT TYPE="TEXT" NAME="apellido" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($insertar))
          print ("VALUE='$apellido'>\n");
       else
          print (">\n");
       if ($errores["apellido"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["apellido"] . "</SPAN>");
    ?>
    </div>
 <P>

<div class="bloque2">
 <!-- aspiraciones-->
 <div class="eleccion1">
 <LABEL>Aspiraciones: *</LABEL>
<TEXTAREA COLS="35" ROWS="3" NAME="aspiraciones">
<?PHP
   if (isset($insertar))
      print ("$aspiraciones");
   print ("</TEXTAREA>");
   if ($errores["aspiraciones"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["aspiraciones"] . "</SPAN>");
?>
</P>
</div>

 <!-- eleccion de escuela-->
 <LABEL class="eleccion">Eleccion de  la escuela: *</LABEL>
<TEXTAREA COLS="35" ROWS="3" NAME="eleccion_escuela">
<?PHP
   if (isset($insertar))
      print ("$eleccion_escuela");
   print ("</TEXTAREA>");
   if ($errores["eleccion_escuela"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["eleccion_escuela"] . "</SPAN>");
?>
</P>
</div>
<div class="bloque3">
<!-- Imagen asociada a la noticia -->
<P><LABEL>Imagen:</LABEL>
<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="2000000">
<INPUT TYPE="FILE" SIZE="44" NAME="imagen">

<?PHP
   if ($errores["imagen"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["imagen"] . "</SPAN>");
?>
</P>
<!-- Botón de envío -->
<P><button type='submit' class='btn btn-outline-success' NAME="insertar">Insertar datos</button></P>

</FORM>

<P>NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</P>

<P><a class='btn btn-outline-primary' href='ingreso.php' role='button'>Menú principal</a></P>
</div>
</div>

<?PHP
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</BODY>
</HTML>


