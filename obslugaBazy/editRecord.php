<?php
  session_start();
  if(!isset($_SESSION['zalogowany'])){
    header('Location: logIn.php');
    exit();
  }
  $id_curio = $_SESSION['id_curio'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  require_once "connect.php";
  try{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno != 0)
      throw new Exception(mysqli_connect_errno());
    else{
        $polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
        $polaczenie->query("SET CHARSET utf8");
        $result = $polaczenie->query("UPDATE ciekawostka SET nazwa = '$name',
            opis = '$description', id_kategori = $category WHERE id = $id_curio");
        if(!$result)
          throw new Exception($polaczenie->error);
        else
        $_SESSION['result'] = "Edytowano ciekawostkę";
    }
    $polaczenie->close();
  }catch(Exception $e){
    echo "Błąd serwera";
    echo $e;
  }
    header('Location: /BazaCiekawostek/usrCurio.php');
  ?>
