<?php

  session_start();
  if(!isset($_SESSION['zalogowany'])){
    header('Location: /BazaCiekawostek/logIn.php');
    exit();
  }
  if(isset($_POST['name'])){
    $ok = true;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $id_klienta = $_SESSION['id'];
    if(strlen($name) < 3 || strlen($name) > 20){
      $ok = false;
      $_SESSION['name_err'] = "Nazwa musi posiadać od 5 do 20 znakow";
    }
    if(strlen($description) < 10){
      $ok = false;
      $_SESSION['description_err'] = "Opis musi miec wiecej niz 10 znakow";
    }

    $_SESSION['dc_name'] = $name;
    $_SESSION['dc_description'] = $description;
    $_SESSION['dc_category'] = $category;

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno != 0)
        throw new Exception(mysqli_connect_errno());
      else{
        if($ok == true){
          $polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
          $polaczenie->query("SET CHARSET utf8");
          if($polaczenie->query("INSERT INTO ciekawostka VALUES (NULL, '$name', '$description', $category, $id_klienta)")){
            $_SESSION['insert'] = "Dodano ciekawostkę.";

            //Usuwanie zmiennych
            if(isset($_SESSION['dc_name'])) unset($_SESSION['dc_name']);
            if(isset($_SESSION['dc_description'])) unset($_SESSION['dc_description']);
            if(isset($_SESSION['dc_category'])) unset($_SESSION['dc_category']);
            if(isset($_SESSION['name_err'])) unset($_SESSION['name_err']);
            if(isset($_SESSION['description_err'])) unset($_SESSION['description_err']);

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

  header('Location: /BazaCiekawostek/addCurio.php');
?>
