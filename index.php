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
            <?php
              if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true){
                echo '<li><a href="#">Moje konto</a></li>';
                echo '<li><a href="#">Moje ciekawostki</a></li>';
                echo '<li><a href="logOut.php">Wyloguj</a></li>';
              }
              else{
                echo '<li><a href="signUp.php">Załóż konto</a></li>';
                echo '<li><a href="logIn.php">Zaloguj się</a></li>';
              }
            ?>
          </ul>
      </nav>
	</div>
  <div id="main">
    <div id="search-box">
      <form action="selectCiekawostka.php" method="post" id="name-form">
        <input type="text" id="search-docs" name="name" />
        <button type="submit" class="buton" >Szukaj</button>
      </form>
      <form action="randomRecord.php" method="post" id="random-form">
        <button type="submit" class="buton" >Losowe</button>
      </form>
      <form style="clear: both"></form>
    </div>
    <div id="results">
      <table>
        <tbody>
        <?php
        if(isset($_SESSION['exist']) && $_SESSION['exist'] == true){
          $tab_dane = $_SESSION['dane'];
          for($i=0; $i<$_SESSION['size']; $i++)
            echo "<tr><td><b>{$tab_dane[$i][0]}</b></td></tr><tr><td>{$tab_dane[$i][1]}</td></tr>\n";
          unset($_SESSION['dane']);
          $_SESSION['exist'] = false;
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
