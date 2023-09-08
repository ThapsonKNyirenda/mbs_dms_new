<?php
  session_start();
?>
<?php

    if (!isset($_SESSION['id'])) {
      header('location: index.php');
    }

    include('connection/connection.php');
?>

<?php


    if (isset($_GET['doc_id'])) {
        $query = 'DELETE FROM users
        WHERE
        id = '. $_GET['doc_id'];

        $result= mysqli_query($conn,$query);
    }

?>
<script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "usermanagement.php";
</script>