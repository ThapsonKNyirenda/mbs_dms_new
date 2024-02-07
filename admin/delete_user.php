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
          echo '<script>
     window.history.back();
  </script>';
      }else{
        $_SESSION['failed']=true;
        echo '<script>
     window.history.back();
  </script>';
      }
    }

?>
<!-- <script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "usermanagement.php";
</script> -->