<?PHP
   session_start ();
   // Incluir bibliotecas de funciones
   include ("conexion.php");

   //Evita el error de las variables vacias
   error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <TITLE> Compras a proveedores</TITLE>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
   <LINK REL="stylesheet" TYPE="text/css" HREF="estilos.css">
<<<<<<< HEAD
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
$idproductos = $_REQUEST['idproductos'];
$idproveedores = $_REQUEST['idproveedores'];
$precio_compra = $_REQUEST['precio_compra'];
$cantidad_compra = $_REQUEST['cantidad_compra'];
//--------------

$error = false;
if (isset($insertar))
{
    // Comprobar que se han introducido todos los datos obligatorios
   // nombre
   if (trim($idproductos) == "")
   {
      $errores["idproductos"] = "¡Debe introducir el nombre del producto";
      $error = true;
   }
   else
      $errores["idproductos"] = "";

// apellido
   if (trim($idproveedores) == "")
   {
      $errores["idproveedores"] = "¡Debe introducir el tipo de producto!";
      $error = true;
   }
   else
      $errores["idproveedores"] = "";

  // aspiraciones
   if (trim($precio_compra) == "")
   {
      $errores["precio_compra"] = "¡Debe introducir la descrpsion del producto!";
      $error = true;
   }
   else
      $errores["precio_compra"] = "";

      if (trim($cantidad_compra) == "")
      {
         $errores["cantidad_compra"] = "¡Debe introducir la descrpsion del producto!";
         $error = true;
      }
      else
         $errores["cantidad_compra"] = "";
   
         // Subir fichero
         $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se a�ade una marca de tiempo
     
    
   // Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

     
      $instruccion = "INSERT INTO compras (idproductos,idproveedores,precio_compra,cantidad_compra) values ( '$idproductos', '$idproveedores', '$precio_compra','$cantidad_compra')";
      $consulta = mysqli_query ($conexion, $instruccion)
         or die ("Fallo en la consulta");
      mysqli_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
          // Mostrar datos introducidos
      print ("<H1>Gestión de compras</H1>\n");
      print ("<H2>Resultado de la compra</H2>\n");

      print ("<P>la compra se ha resibido correctamente:</P>\n");
      print ("<UL>\n");
      print ("   <LI>id productos: " . $idproductos. "\n");
      print ("   <LI>id proveedores: " . $idproveedores . "\n");
      print ("   <LI>precio de la compra: " . $precio_compra . "\n"); 
      print ("   <LI>cantidad de la compra: " . $$cantidad_compra . "\n");
      

      print ("<P><a class='btn btn-success' href='compras.php' role='button'>Insertar otra compra</a> | ");
      print ("<a class='btn btn-primary' href='ingreso.php' role='button'>Menú principal</a></P>\n");

   }
   else
   {

?>

    
    
    <H1 class="titulo4">Insertar nueva compra</H1>

    <div id="formularioinsertar" class=container>
    <FORM CLASS="borde" ACTION="compras.php" NAME="insertar" METHOD="POST"
       ENCTYPE="multipart/form-data">
</P>
    <!-- nombre -->
       <div class="bloque1"> 
    <P><LABEL>id producto: *</LABEL>
    <INPUT TYPE="TEXT" NAME="idproductos" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($insertar))
          print ("VALUE='$idproductos'>\n");
       else
          print (">\n");
       if ($errores["idproductos"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["idproductos"] . "</SPAN>");
    ?>
 <P>
       
</P>
    <!-- apellido -->
    <P><LABEL>id proveedores : *</LABEL>
    <INPUT TYPE="TEXT" NAME="idproveedores" SIZE="30" MAXLENGTH="50">
    
    <?PHP
       if (isset($idproveedores))
          print ("VALUE='$idproveedores'>\n");
       else
          print (">\n");
       if ($errores["idproveedores"] != "")
          print ("<BR><SPAN CLASS='error'>" . $errores["idproveedores"] . "</SPAN>");
    ?>
    </div>
 <P>

<div class="bloque2">
 <!-- aspiraciones-->
 <div class="eleccion1">
 <LABEL>precio compra: *</LABEL>
<TEXTAREA COLS="35" ROWS="3" NAME="precio_compra">
<?PHP
   if (isset($insertar))
      print ("$precio_compra");
   print ("</TEXTAREA>");
   if ($errores["precio_compra"] != "")
      print ("<BR><SPAN CLASS='error'>" . $errores["precio_compra"] . "</SPAN>");
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

   
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      print ("<P ALIGN='CENTER'>[ <A HREF='ingreso.php' TARGET='_top'>Conectar</A> ]</P>\n");
   }

?>

