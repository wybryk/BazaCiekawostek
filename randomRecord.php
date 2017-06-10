<?php
  session_start();
  $_SESSION['exist'] = false;
  require_once "connect.php";
  try{
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno != 0)
      throw new Exception(mysqli_connect_errno());
    else{
        $result = $polaczenie->query("SELECT id FROM ciekawostka");
        if(!$result)
          throw new Exception($polaczenie->error);
        $row = $result->num_rows;
        if($row > 0){
          $random_value = rand(1, $row);
          $_SESSION['random_value'] = $random_value;
          $result = $polaczenie->query("SELECT nazwa, opis FROM ciekawostka WHERE id = $random_value");
          if(!$result)
            throw new Exception($polaczenie->error);
          foreach ($result->fetch_assoc() as $value) {
            $tab[0][] = $value;
          }
          $_SESSION['dane'] = $tab;
          $_SESSION['size'] = 1;
          $_SESSION['exist'] = true;
          header('Location: index.php');
        }
      $polaczenie->close();
    }
  }catch(Exception $e){
    echo "Błąd serwera";
    echo $e;
  }
?>
