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
  <meta charset="utf-8" />
</head>
<html>
    <head>
        <title>
            Ejemplo
        </title>
</head>
    <body>
    <div align="center">                        
    <p>Seleccione un Producto del siguiente menú:</p>
    <p>Productos:
      <select>
        <option value="0">Seleccione:</option>
        <?php
          $query = $conexion -> query ("SELECT * FROM productos");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_productos].'">'.$valores[nombre_producto].'</option>';
          }
        ?>
      </select>
      <button>Enviar</button>
    </p>
  </div>
    </body>
</html>