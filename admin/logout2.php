<?php
  session_start();

//   echo $_SESSION['id'];

    if (isset($_SESSION['id'])) {
        session_destroy();
        header('location: ../index.php');
    }else{
        header('location: ../index.php');
    }
?>