<?php
  session_start();
  if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']== true){
    header('Location: usrView.php');
    exit();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Baza ciekawostek</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Kube CSS -->
    <link rel="stylesheet" href="dist/css/kube.css">
    <link rel="stylesheet" href="dist/css/style.css">

  </head>
  <body>
    <div id="top" class="hide-sm">
    	<div id="top-brand">
        <a href="index.php">Ciekawostki</a>
    	</div>
        <nav id="top-nav-extra">
          <ul>
      			<li><a href="signUp.php">Załóż konto</a></li>
      			<li><a href="logIn.php">Zaloguj się</a></li>
          </ul>
        </nav>
	  </div>
    <div id="main">
        <div id="hero">
	        <h1>Zaloguj się</h1>
        </div>
        <div id="form-logIn">
          <form action="zaloguj.php" data-component="validate" method="post" class="form form-centered"><input type="hidden" name="authorize-token" value="753e9d4322451c61e53907e6900039d545b152009c708e53e9cf65b50060e09a9008fb64fc49899cca72d08dc668ac1c553ca47677efa8a967fa2023aa78a8b1" />
              <div class="form-item">
		            <label>Login <span id="user-login-validation-error"></span></label>
		              <input type="text" name="login" autofocus="true" />
	            </div>
	            <div class="form-item">
		             <label>Haslo <span id="user-password-validation-error"></span></label>
		             <input type="password" name="password" />
	            </div>
	            <p><button class="submit">Zaloguj się</button></p>
          </form>
          <?php
          if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
          ?>
      </div>
    </div>
  </body>
</html>
