<?php
  session_start();
  if(!isset($_SESSION['zalogowany'])){
    header('Location: /BazaCiekawostek/logIn.php');
    exit();
  }

  $id = $_GET['id'];
  require_once "connect.php";
  try{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno != 0)
      throw new Exception(mysqli_connect_errno());
    else{
        $result = $polaczenie->query("DELETE FROM ciekawostka WHERE id = $id");
        if(!$result)
          throw new Exception($polaczenie->error);
        else
          $_SESSION['result'] = "Usunięto ciekawostkę";
    }
    $polaczenie->close();
  }catch(Exception $e){
    echo "Błąd serwera";
    echo $e;
  }
  header('Location: /BazaCiekawostek/usrCurio.php');
?>
