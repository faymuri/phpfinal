<?PHP
   session_start ();
   // Incluir bibliotecas de funciones
   include ("conexion.php");

   //Evita el error de las variables vacias
   error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<HTML LANG="es">
<HEAD>
   <TITLE> Inserción de productos</TITLE>
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
$nombre_producto = $_REQUEST['nombre_producto'];
$tipo_producto = $_REQUEST['tipo_producto'];
$descripcion_producto = $_REQUEST['descripcion_producto'];
//--------------

$error = false;
if (isset($insertar))
{
    // Comprobar que se han introducido todos los datos obligatorios
   // nombre
   if (trim($nombre_producto) == "")
   {
      $errores["nombre_producto"] = "¡Debe introducir el nombre del producto";
      $error = true;
   }
   else
      $errores["nombre_producto"] = "";

// apellido
   if (trim($tipo_producto) == "")
   {
      $errores["tipo_producto"] = "¡Debe introducir el tipo de producto!";
      $error = true;
   }
   else
      $errores["tipo_producto "] = "";

  // aspiraciones
   if (trim($descripcion_producto) == "")
   {
      $errores["descripcion_producto"] = "¡Debe introducir la descrpsion del producto!";
      $error = true;
   }
   else
      $errores["descripcion_producto"] = "";

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

     
      $instruccion = "INSERT INTO productos (nombre_producto,tipo_producto,descripcion_producto,foto) values ('$nombre_producto', '$tipo_producto', '$descripcion_producto', '$nombreFichero')";
      $consulta = mysqli_query ($conexion, $instruccion)
         or die ("Fallo en la consulta");
      mysqli_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombreDirectorio . $nombreFichero);

          // Mostrar datos introducidos
      print ("<H1>Gestión de productos</H1>\n");
      print ("<H2>Resultado de la insercion de productos</H2>\n");

      print ("<P>los producctos han sido recibidos correctamente:</P>\n");
      print ("<UL>\n");
      print ("   <LI>nombre: " . $nombre_producto. "\n");
      print ("   <LI>apellido: " . $tipo_producto . "\n");
      print ("   <LI>aspiraciones: " . $descripcion_producto . "\n");
      if ($nombreFichero != "")
         print ("   <LI>Imagen: <A TARGET='_blank' HREF='" . $nombreDirectorio . $nombreFichero . "'>" . $nombreFichero . "</A>\n");
      else
         print ("   <LI>Imagen: (no hay)\n");
      print ("</UL>\n");

      print ("<P><a class='btn btn-success' href='ingresoProducto' role='button'>Insertar otros productos</a> | ");
      print ("<a class='btn btn-primary' href='ingreso.php' role='button'>Menú principal</a></P>\n");

   }
   else
   {

?>

    
    
    <H1 class="titulo4">Insertar nuevos productos</H1>

    <div id="formularioinsertar" class=container>
    <FORM CLASS="borde" ACTION="ingresoproducto.php" NAME="insertar" METHOD="POST"
       ENCTYPE="multipart/form-data">
</P>
    <!-- nombre -->
       <div class="bloque1"> 
    <P><LABEL>Nombre: *</LABEL>
    <INPUT TYPE="TEXT" NAME="nombre_producto" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($insertar))
          print ("VALUE='$nombre_producto'>\n");
       else
          print (">\n");
       if ($errores["nombre_producto"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["nombre_producto"] . "</SPAN>");
    ?>
 <P>
       
</P>
    <!-- apellido -->
    <P><LABEL>Tipo : *</LABEL>
    <INPUT TYPE="TEXT" NAME="tipo_producto" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($insertar))
          print ("VALUE='$tipo_producto'>\n");
       else
          print (">\n");
       if ($errores["tipo_producto"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["tipo_producto"] . "</SPAN>");
    ?>
    </div>
 <P>

<div class="bloque2">
 <!-- aspiraciones-->
 <div class="eleccion1">
 <LABEL>descripcion: *</LABEL>
<TEXTAREA COLS="35" ROWS="3" NAME="descripcion_producto">
<?PHP
   if (isset($insertar))
      print ("$descripcion_producto");
   print ("</TEXTAREA>");
   if ($errores["descripcion_producto"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["descripcion_producto"] . "</SPAN>");
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
 <!-- eleccion de escuela-->

<?PHP
   if ($errores["imagen"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["imagen"] . "</SPAN>");
?>
</P>
<!-- Botón de envío -->
<P><button type='submit' class='btn btn-outline-success' NAME="insertar">Insertar productos</button></P>

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


