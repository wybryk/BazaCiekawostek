<?php

  session_start();

  if(isset($_POST['userlogin'])){
    $ok = true;
    $login = $_POST['userlogin'];
    $password1 = $_POST['userpassword1'];
    $password2 = $_POST['userpassword2'];
    if(strlen($login) < 5 || strlen($login) > 20){
      $ok = false;
      $_SESSION['login_err'] = "Login musi posiadać od 5 do 20 znakow";
    }
    if(ctype_alnum($login) == false){
      $ok = false;
      $_SESSION['login_err'] = "Login musi składać się tylko z cyfr i liter(bez polskich znaków)";
    }
    if($password1!=$password2){
      $ok = false;
      $_SESSION['password_err'] = "Hasla nie są takie same";
    }
    if(strlen($password1) < 5){
      $ok = false;
      $_SESSION['password_err'] = "Haslo musi miec wiecej niz 5 znakow";
    }
    if(ctype_alnum($password1) == false){
      $ok = false;
      $_SESSION['password_err'] = "Hasło musi składać się tylko z cyfr i liter(bez polskich znaków)";
    }
    $hash_password = password_hash($password1, PASSWORD_DEFAULT);

    //echo $hash_password;

    $_SESSION['zk_login'] = $login;
    $_SESSION['zk_password1'] = $password1;
    $_SESSION['zk_password2'] = $password2;

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno != 0)
        throw new Exception(mysqli_connect_errno());
      else{
        $result = $polaczenie->query("SELECT id FROM KONTO WHERE login = '$login'");
        if(!$result)
          throw new Exception($polaczenie->error);
        $ilu_usr = $result->num_rows;
        if($ilu_usr > 0){
          $ok = false;
          $_SESSION['login_err'] = "Istnieje już konto z takim loginem";
        }
        if($ok == true){
          if($polaczenie->query("INSERT INTO konto VALUES (NULL, '$login', '$hash_password')")){
            $_SESSION['registration'] = "Dziękujemy za rejestrację w serwisie. Możesz się zalogować.";

            //Usuwanie zmiennych
            if(isset($_SESSION['zk_login'])) unset($_SESSION['zk_login']);
            if(isset($_SESSION['zk_password1'])) unset($_SESSION['zk_password1']);
            if(isset($_SESSION['zk_password2'])) unset($_SESSION['zk_password2']);
            if(isset($_SESSION['login_err'])) unset($_SESSION['login_err']);
            if(isset($_SESSION['password_err'])) unset($_SESSION['password_err']);
          }
          else
            throw new Exception($polaczenie->error);
        }
      $polaczenie->close();
    }
    }catch(Exception $e){
      echo "Błąd serwera";
      echo $e;
    }
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
      <div id="registration">
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
          <form action="signUp.php" method="post"/>
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
