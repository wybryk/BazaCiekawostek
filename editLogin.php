<?php
  session_start();
  if($_SESSION['login_edit'] == false)
    $_SESSION['login_edit'] = true;
  else
    $_SESSION['login_edit'] = false;

    if(isset($_POST['userlogin'])){
      $ok = true;
      $login = $_POST['userlogin'];
      $id = $_SESSION['id'];
      if(strlen($login) < 5 || strlen($login) > 20){
        $ok = false;
        $_SESSION['login_err'] = "Login musi posiadać od 5 do 20 znakow";
      }
      if(ctype_alnum($login) == false){
        $ok = false;
        $_SESSION['login_err'] = "Login musi składać się tylko z cyfr i liter(bez polskich znaków)";
      }

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

          if($ok == true){
            if($polaczenie->query("UPDATE konto SET login = '$login' WHERE id = '$id'")){
              $_SESSION['registration'] = "Zmieniono login.";

              //Usuwanie zmiennych
              if(isset($_SESSION['login_err'])) unset($_SESSION['login_err']);

            }
            else
              throw new Exception($polaczenie->error);
          }
        }
        $_SESSION['login_edit'] = true;
        $polaczenie->close();
      }
      }catch(Exception $e){
        echo "Błąd serwera";
        echo $e;
      }
    }


  header('Location: usrView.php');

?>
