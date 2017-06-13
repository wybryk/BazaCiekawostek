<?php
  session_start();
  if($_SESSION['password_edit'] == false)
    $_SESSION['password_edit'] = true;
  else
    $_SESSION['password_edit'] = false;

    if(isset($_POST['userpassword1'])){
      $ok = true;
      $id = $_SESSION['id'];
      $password = $_POST['userpassword'];
      $password1 = $_POST['userpassword1'];
      $password2 = $_POST['userpassword2'];
      if($password1!=$password2){
        $ok = false;
        $_SESSION['password_err'] = "Hasla nie są takie same";
      }
      if(strlen($password1) < 8){
        $ok = false;
        $_SESSION['password_err'] = "Haslo musi miec wiecej niz 5 znakow";
      }
      if(ctype_alnum($password1) == false){
        $ok = false;
        $_SESSION['password_err'] = "Hasło musi składać się tylko z cyfr i liter(bez polskich znaków)";
      }
      $hash_password = password_hash($password1, PASSWORD_DEFAULT);

      //echo $hash_password;

      require_once "connect.php";
      mysqli_report(MYSQLI_REPORT_STRICT);

      try{
        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno != 0)
          throw new Exception(mysqli_connect_errno());
        else{
          $result = $polaczenie->query("SELECT haslo FROM konto WHERE id = $id");
          if(!$result)
            throw new Exception($polaczenie->error);
          $ilu_usr = $result->num_rows;
          if($ilu_usr > 0){
            $wiersz = $result->fetch_assoc();
          if(password_verify($password, $wiersz['haslo']) == false){
              $ok = false;
              $result->free_result();
              $_SESSION['password_err'] = "Nieprawidłowe hasło";
          }
          if($ok == true){
            if($polaczenie->query("UPDATE konto SET haslo = '$hash_password' WHERE id = $id")){
              $_SESSION['registration'] = "Zmieniono hasło.";
              $_SESSION['password'] = $hash_password;
              //Usuwanie zmiennych
              if(isset($_SESSION['password_err'])) unset($_SESSION['password_err']);
            }
            else
              throw new Exception($polaczenie->error);
          }
        }
        else
          $_SESSION['password_err'] = "Nie znaleziono takiego konta";

        $_SESSION['password_edit'] = true;
        $polaczenie->close();
      }
      }catch(Exception $e){
        echo "Błąd serwera";
        echo $e;
      }
    }

  header('Location: usrView.php');

?>
