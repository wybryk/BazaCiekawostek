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
      			<li><a href="addCurio.php">Dodaj</a></li>
          </ul>
        </nav>
        <nav id="top-nav-extra">
          <ul>
      			<li><a href="usrView.php">Moje konto</a></li>
            <li><a href="usrCurio.php">Moje ciekawostki</a></li>
            <li><a href="obslugaBazy/logOut.php">Wyloguj</a></li>
          </ul>
        </nav>
	</div>
  <div id="main">
    <div id="info">
    <?php
      if(isset($_SESSION['result'])){
        echo $_SESSION['result'];
        unset($_SESSION['result']);
      }
     ?>
   </div>
    <div id="search-box">
      <form action="obslugaBazy/selectUserCurio.php" method="post" id="name-form" style="width: 80%;">
        <input type="text" id="search-docs" name="name" />
        <button type="submit" class="buton" >Szukaj</button>
      </form>
      <form action="obslugaBazy/selectAllUserCurio.php" method="post" id="random-form">
        <button type="submit" class="buton" >Pokaż wszystkie</button>
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
            echo "<tr><th>{$tab_dane[$i][1]}</th>
              <td ><a href='editCurio.php?id={$tab_dane[$i][0]}&nazwa={$tab_dane[$i][1]}&opis={$tab_dane[$i][2]}'>Edytuj</a></td></tr>
              <tr><td>{$tab_dane[$i][2]}</td><td><a href='obslugaBazy/deleteRecord.php?id={$tab_dane[$i][0]}'>Usuń</a></td></tr>";
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
