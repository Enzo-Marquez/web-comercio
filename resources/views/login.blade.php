

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/login.css">
	

</head>

  
  <body class="body">
  

  <form method="post">

    <div class="login-box">
      <img src="assets/img/Escuela.png" class="avatar" alt="Avatar Image">
      <h1>Login</h1>
      <form>
        <!-- USERNAME INPUT -->
        <label for="username">Dni</label>
        <input id="typeEmailX" name="username" type="text" placeholder="Ingrese su Dni" required/>
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseña</label>
        <input id="typePasswordX" name="pass" type="password" placeholder="Ingrese su contraseña" required/>
        <input type="submit" value="Ingresar">
		    <input type="button" onclick="location='index.php'"value="volver">
        <p>¿No tienes una cuenta? <a href="register">Regístrate aquí</a></p>
      </form>
    </div>

</body>
</html>