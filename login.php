<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: login.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM user WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: login.php");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ready Login </title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'partials/header.php' ?>
	<?php if(!empty($message)): ?>
  	<p> <?= $message ?></p>
	<?php endif; ?>
  <div class="wrapper">
	<div class="container">
		<h1>Bienvenido a</h1>
		<div class="contenido_logo">
			<img src="img/readynew.png" alt="">
		</div>
        
		<h1>Iniciar Sesión</h1>
		<form action="login.php" method="POST">
			<input placeholder="Email" name='email'>
			<input type="password" placeholder="Contraseña" name='password'>
			<div>
            	<a href="signup.php">¿No tienes una cuenta? Registrate aquí</a>
            </div>
			<button type="submit">Login</button>
		</form>
        
	</div>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="index.js"></script>
</body>
</html>