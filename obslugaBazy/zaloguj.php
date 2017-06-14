<?php

  session_start();

  if(!isset($_POST['login']) || !isset($_POST['password'])){
    header('Location: ../logIn.php');
    exit();
  }

  require_once "connect.php";

  try{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno != 0)
      throw new Exception(mysqli_connect_errno());
    else{
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $result = $polaczenie->query(sprintf("SELECT * FROM KONTO WHERE login='%s'",
          mysqli_real_escape_string($polaczenie, $login)));
        if(!$result)
          throw new Exception($polaczenie->error);
        $ilu_usr = $result->num_rows;
        if($ilu_usr > 0){
          $wiersz = $result->fetch_assoc();

          if(password_verify($password, $wiersz['haslo'])){
            $_SESSION['zalogowany'] = true;
            $_SESSION['id'] = $wiersz['id'];
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['password'] = $wiersz['haslo'];

            unset($_SESSION['blad']);
            $result->free_result();
            header('Location: ../index.php');
          }
          else{
            $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub haslo</span>';
            header('Location: ../logIn.php');
          }
        }
        else{
          $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub haslo</span>';
          header('Location: ../logIn.php');
        }
      }
        $polaczenie->close();
  }catch(Exception $e){
    echo "Błąd serwera";
    echo $e;
  }

?>
