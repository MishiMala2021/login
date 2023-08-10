<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse Ready</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  <div class="wrapper">
	  <div class="container">
		  <h1>Registrarse</h1>
		  <form action="signup.php" method="POST">
        <input name="email" type="text" placeholder="Email">
        <input name="password" type="password" placeholder="Contraseña">
        <input name="confirm_password" type="password" placeholder="Confirmar Contraseña">
        <input type="submit" value="Registrarme">
        <a href="login.php">Ir a Inicio</a>
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