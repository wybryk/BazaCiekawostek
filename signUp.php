<?php

  session_start();

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
      <div id="info">
      <?php
        if(isset($_SESSION['registration'])){
          echo $_SESSION['registration'];
          unset($_SESSION['registration']);
        }
       ?>
     </div>
      <div id="hero">
	      <h1>Załóż konto</h1>
      </div>
      <div id="form-logIn">
          <form action="rejestracja.php" method="post"/>
              <div class="form-item">
    		        <label>Login </label>
    		        <input type="text" name="userlogin" value="<?php
                  if(isset($_SESSION['zk_login'])){
                    echo $_SESSION['zk_login'];
                    unset($_SESSION['zk_login']);
                  }
                ?>"autofocus="true" />
  	           </div>
               <div class="error">
                 <?php
                   if(isset($_SESSION['login_err'])){
                     echo $_SESSION['login_err'];
                     unset($_SESSION['login_err']);
                   }
                  ?>
              </div>
    	        <div class="form-item">
    		        <label>Hasło </label>
    		        <input type="password" name="userpassword1" value="<?php
                  if(isset($_SESSION['zk_password1'])){
                    echo $_SESSION['zk_password1'];
                    unset($_SESSION['zk_password1']);
                  }
                ?>"/>
    	        </div>
              <div class="form-item">
                <label>Powtórz hasło </span></label>
                <input type="password" name="userpassword2" value="<?php
                  if(isset($_SESSION['zk_password2'])){
                    echo $_SESSION['zk_password2'];
                    unset($_SESSION['zk_password2']);
                  }
                ?>"/>
              </div>
              <div class="error">
                <?php
                  if(isset($_SESSION['password_err'])){
                    echo $_SESSION['password_err'];
                    unset($_SESSION['password_err']);
                  }
                 ?>
              </div>
  	          <p><button class="submit">Załóż konto</button></p>
          </form>
      </div>
    </div>
  </body>
</html>
