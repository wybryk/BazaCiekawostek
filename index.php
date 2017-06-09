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
      <input type="text" id="search-docs" name="q" data-component="livesearch" data-append-forms="#search-form" data-min="1" data-target="#docs-search-results" data-url="/ajax/redactor/docs/search/" placeholder="Search" />
      <button type="submit" class="buton" onclick="getValue()">Szukaj</button>
    </div>
    <div id="results">
    </div>
  </div>
</body>
</html>
