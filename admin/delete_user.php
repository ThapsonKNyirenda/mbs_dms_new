<?php
  session_start();
?>
<?php

    if (!isset($_SESSION['id'])) {
      header('location: ../index.php');
    }

    include('../connection/connection.php');
?>

<?php


    if (isset($_GET['doc_id'])) {
        $query = 'DELETE FROM users
        WHERE
        id = '. $_GET['doc_id'];

        $result= mysqli_query($conn,$query);

        if($result){
          $_SESSION['delete']=true;
          header('location:usermanagement.php');
      }else{
        $_SESSION['failed']=true;
        header('location:usermanagement.php');
      }
    }

?>
<!-- <script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "usermanagement.php";
</script> -->