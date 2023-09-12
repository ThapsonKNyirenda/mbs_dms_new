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
                $uploader = $row['uploaded_by'];
                $newdepartment = $department;
                $folder_path= "uploads/$department";

                $time_stamp = date('Y-m-d H:i');
            }

            $insertQuery = "INSERT INTO $department (title, filename, folder_path, time_stamp, uploaded_by) VALUES ('$title','$filename', '$folder_path','$time_stamp','$uploader')";

            $deleteQuery = 'DELETE FROM pending_uploads WHERE id = ' . $_GET['doc_id'];
            
            $deleteresult = mysqli_query($conn, $deleteQuery);
            $insertResult=mysqli_query($conn,$insertQuery);

            if($insertResult && $deleteQuery){ 
                echo "delete or insert successful";
                die;
            }else {
                echo "delete or insert not successful";
                die;
            }

        } else {
            echo "0 results";
        }
 
    }

?>
<script type="text/javascript">
        alert("Successfully deleted.");
        window.location = "approve.php";
</script>