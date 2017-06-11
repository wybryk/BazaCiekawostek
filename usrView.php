<?php
  session_start();
  if(!isset($_SESSION['zalogowany'])){
    header('Location: logIn.php');
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
        <nav id="top-nav-main">
          <ul>
      			<li><a href="#">Dodaj</a></li>
      			<li><a href="#">Usuń</a></li>
          </ul>
        </nav>
        <nav id="top-nav-extra">
          <ul>
      			<li><a href="usrView.php">Moje konto</a></li>
            <li><a href="usrCurio.php">Moje ciekawostki</a></li>
            <li><a href="logOut.php">Wyloguj</a></li>
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
      <h1>Edytuj dane konta</h1>
    </div>
    <div id="form-logIn">
        <form action="editLogin.php" method="post"/>
          <div class="form-item">
            <label>Login:
              <?php
              echo $_SESSION['login'];
              ?>
            </label>
            <button class="submit">
              <?php
              if(isset($_SESSION['login_edit']) && $_SESSION['login_edit'] == true)
                echo "Zamknij";
              else if(!isset($_SESSION['login_edit']) || (isset($_SESSION['login_edit']) && $_SESSION['login_edit'] == false))
                echo "Edytuj login";
                ?>
              </button>
          </div>
        </form>

        <form action="editLogin.php" method="post"/>
            <div class="form-login-edit">
            <?php
            if( isset($_SESSION['login_edit']) && $_SESSION['login_edit'] == true ){
                echo "<label>Nowy login </label>";
                echo "<input type='text' name='userlogin' autofocus='true'/>";
            ?>
            </div>
            <div class="error">
              <?php
                   if(isset($_SESSION['login_err'])){
                     echo $_SESSION['login_err'];
                     unset($_SESSION['login_err']);
                   }
              ?>
            </div>
            <p><button class="submit">Zapisz zmiany</button></p>
            <?php
            }
            ?>
        </form>
        <form action="editPassword.php" method="post"/>
        <label>Hasło:
          <?php
          echo $_SESSION['password'];
          ?>
        </label>
          <div class="form-item">
            <button class="submit">
              <?php
              if(isset($_SESSION['password_edit']) && $_SESSION['password_edit'] == true)
                echo "Zamknij";
              else if(!isset($_SESSION['password_edit']) || (isset($_SESSION['password_edit']) && $_SESSION['password_edit'] == false))
                echo "Edytuj hasło";
                ?>
              </button>
          </div>
        </form>
        <form action="editPassword.php" method="post"/>
          <div class="form-password-edit">
            <?php
            if( isset($_SESSION['password_edit']) && $_SESSION['password_edit'] == true ){
                echo "<label>Bieżące</label>";
                echo "<input type='password' name='userpassword' />";
                echo "<label>Nowe hasło</label>";
                echo "<input type='password' name='userpassword1' />";
                echo "<label>Powtórz nowe hasło</span></label>";
                echo "<input type='password' name='userpassword2' />";
            ?>
          </div>
          <div class="error">
              <?php
                if(isset($_SESSION['password_err'])){
                  echo $_SESSION['password_err'];
                  unset($_SESSION['password_err']);
                }
               ?>
          </div>
          <p><button class="submit">Zapisz zmiany</button></p>
          <?php
          }
          ?>
        </form>
    </div>
  </div>
</body>
</html>
