<?php
  session_start();
  if(!isset($_SESSION['zalogowany'])){
    header('Location: logIn.php');
    exit();
  }
  require_once("obslugaBazy/selectKategorie.php");
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
        if(isset($_SESSION['insert'])){
          echo $_SESSION['insert'];
          unset($_SESSION['insert']);
        }
       ?>
     </div>
      <div id="hero">
	      <h1>Dodaj ciekawostkę</h1>
      </div>
      <div id="form-logIn">
          <form action="obslugaBazy/insertCurio.php" method="post"/>
              <div class="form-item">
    		        <label>Nazwa </label>
    		        <input type="text" name="name" value="<?php
                  if(isset($_SESSION['dc_name'])){
                    echo $_SESSION['dc_name'];
                    unset($_SESSION['dc_name']);
                  }
                ?>"autofocus="true" />
  	           </div>
               <div class="error">
                 <?php
                   if(isset($_SESSION['name_err'])){
                     echo $_SESSION['name_err'];
                     unset($_SESSION['name_err']);
                   }
                  ?>
              </div>
    	        <div class="form-item">
    		        <label>Opis </label>
    		        <textarea name="description" value="<?php
                  if(isset($_SESSION['dc_description'])){
                    echo $_SESSION['dc_description'];
                    unset($_SESSION['dc_description']);
                  }
                ?>" rows="4" cols="50"></textarea>
    	        </div>
              <div class="error">
                <?php
                  if(isset($_SESSION['description_err'])){
                    echo $_SESSION['description_err'];
                    unset($_SESSION['description_err']);
                  }
                 ?>
              </div>
              <div class="form-item">
                <label>Kategoria </label>
                <select name="category">
                  <?php
                    $tab_dane = $_SESSION['dane'];
                    for($i=0; $i<$_SESSION['size']; $i++)
                      echo "<option value={$tab_dane[$i][0]}>{$tab_dane[$i][1]}</option>";
                    unset($_SESSION['dane']);
                  ?>
                </select>
              </div>
  	          <p><button class="submit">Dodaj ciekawostkę</button></p>
          </form>
      </div>
    </div>
  </body>
</html>
