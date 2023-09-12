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

        $query = "SELECT * FROM pending_uploads WHERE id = $id";
        $result = mysqli_query($conn,$query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $filename = $row['filename'];
                $filename = $row['uploaded_by'];
                $newdepartment = $department;


                // Insert the selected row into destination_table
                
            }
        } else {
            echo "0 results";
        }
        $query = 'DELETE FROM pending_uploads
        WHERE
        id = '. $_GET['doc_id'];

        $result= mysqli_query($conn,$query);
    }

?>
<script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "usermanagement.php";
</script>