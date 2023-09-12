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

    $department=$_SESSION['department'];

    if (isset($_GET['doc_id'])) {

        $id=$_GET['doc_id'];

        $query = "UPDATE $department SET `status` = 'approved' WHERE `quality`.`id` = $id";
        $result = mysqli_query($conn,$query);

        if($result){
            $_SESSION['update'] = true;
            header('location: approve.php');

        }else{

        }
 
    }

?>
<script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "approve.php";
</script>