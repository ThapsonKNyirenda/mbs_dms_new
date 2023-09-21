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
  $query = 'DELETE FROM metrology WHERE id = ' . $_GET['doc_id'];
  $result = mysqli_query($conn, $query);
  
  if ($result) {
    // Set a session variable to indicate success
    $_SESSION['delete_success'] = true;
}else{
  $_SESSION['delete_failed'] = true;
}

  echo '<script>
     window.history.back();
  </script>';
}


?>
<!-- <script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "director.php";
</script> -->