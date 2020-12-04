<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar un nuevo usuario</title>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>



  
<h3 class="titulo">Por favor ingrese todos los datos</h3>

<div id="login-row" class="row justify-content-center align-items-center"> 
<form action="crear_clave.php" id="form3" method="POST" class="entrada">
  <div class="form-group">
    <label  class="col-sm-2 control-label" >Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="user" id="label"  size="10" required>
    </div>
  </div>
  <div class="form-group">
    <label  class="col-sm-2 control-label">Clave</label>
    <div class="col-sm-10">
      <input type="password" class="form-control"  name="clave" id="label" size="10" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-outline-primary" id="boton1">Registrar</button>
    </div>
  </div>
</form>
</div>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    
</body>
</html>





 