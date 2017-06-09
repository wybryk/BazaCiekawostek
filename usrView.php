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
      			<li><a href="#">Moje konto</a></li>
            <li><a href="#">Moje ciekawostki</a></li>
            <li><a href="logOut.php">Wyloguj</a></li>
          </ul>
        </nav>
	</div>
  <div id="main">
    <div id="search-box">
      <input type="text" id="search-docs" name="q" data-component="livesearch" data-append-forms="#search-form" data-min="1" data-target="#docs-search-results" data-url="/ajax/redactor/docs/search/" placeholder="Search" />
      <button type="submit" class="buton" onclick="getValue()">Szukaj</button>
    </div>
    <div id="results">
      <?php
        echo $_SESSION['login'];
        echo $_SESSION['zalogowany'];
        ?>
    </div>
  </div>
</body>
</html>
