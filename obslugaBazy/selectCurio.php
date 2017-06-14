<?php
  session_start();
  $_SESSION['exist'] = false;
  if(isset($_POST['name'])){
    $name = $_POST['name'];
    require_once "connect.php";
    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if($polaczenie->connect_errno != 0)
        throw new Exception(mysqli_connect_errno());
      else{
          $polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
          $polaczenie->query("SET CHARSET utf8");
          $result = $polaczenie->query("SELECT nazwa, opis FROM ciekawostka WHERE nazwa = '$name'");
          if(!$result)
            throw new Exception($polaczenie->error);
          $row = $result->num_rows;
          if($row > 0){
            for ($i=0; $i<$row; $i++){
              foreach ($result->fetch_assoc() as $value) {
                $tab[$i][] = $value;
              }
            }
            $_SESSION['dane'] = $tab;
            $_SESSION['size'] = $row;
            $_SESSION['exist'] = true;
          }
        $polaczenie->close();
      }
    }catch(Exception $e){
      echo $e;
    }
  }
  header('Location: ../index.php');

?>
