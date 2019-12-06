<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>INICIO</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/miestilo.css">
	
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
<img src="imagenes/dorado.jpg" width="150" height="100">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">INICIO<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rutas.php">RUTAS</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          HISTORIA
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="vision.php">MISIÓN Y VISIÓN</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contacto.php">CONTACTO</a>
      </li>
    </ul>
    <li class="nav">
        <a class="nav-link" href="index.php">INICIAR SESIÓN</a>
      </li>
  </div>
</nav>

	<div class="container" id="fondito">
		<div class="row">
			<div class="col-md-4">
				<form action="index.php" method="post">
					<div class="form-group">	
						<label for="usu">Usuario:</label>
						<input class="form-control" id="usu" type="text" name="txtlogin" required="true">
					</div>

					<div class="form-group">
						<label for="pass">Password:</label>
						<input class="form-control" id="pass" type="password" name="txtpass" required="true">
					</div>
					
					<input type="submit" class="btn btn-primary" value="Ingresar">	
				</form>
				<br>
				<div class="msg" id="msg">
					
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</div>
</body>
</html>

<?php
	if(isset($_POST['txtpass'])) 
	{
		session_start();
		//variable de conexion: recibe dirección del host , usuario, contraseña y el nombre base de datos
		$mysqli = new mysqli("localhost", "root", "luigui01234", "bdpersona") or die ("Error de conexion porque: ".$mysqli->connect_errno);
		// comprobar la conexión 
		if (mysqli_connect_errno()) 
		{
	    	printf("Falló la conexión: %s\n", mysqli_connect_error());
	   		exit();
		}

		$login = $mysqli->real_escape_string($_POST['txtlogin']);	
		$pass = $mysqli->real_escape_string($_POST['txtpass']);
		
		$resultado = $mysqli->query("SELECT * FROM tbusuario where login='$login' and pass='$pass' and activo!=0");
		$valida=$resultado->num_rows;
		if($valida != 0)
		{
			$datosUsu = $resultado->fetch_row();
			$_SESSION['nombreusu'] = $datosUsu[3];
			$_SESSION['perfil'] = $datosUsu[4];				
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=listar.php'>";
		}
		else
		{
			echo 
			"<script> 
				var textnode = document.createTextNode('Usuario ó Password Incorrecto');
				document.getElementById('msg').appendChild(textnode);
			</script>";
			
		}	
	}
	
	
?>

		