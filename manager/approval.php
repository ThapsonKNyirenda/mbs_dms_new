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

        $id=$_GET['doc_id'];

        $query = "SELECT * FROM source_table WHERE id = $id";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $email = $row['email'];

                // Insert the selected row into destination_table
                $insertQuery = "INSERT INTO destination_table (name, email) VALUES (?, ?)";
                $stmt = $mysqli->prepare($insertQuery);
                $stmt->bind_param('ss', $name, $email);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            echo "0 results";
        }
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