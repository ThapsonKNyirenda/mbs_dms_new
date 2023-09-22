<?php
session_start();

include('../connection/connection.php');
?>
<?php
$id = $_GET['doc_id'];
$department = $_SESSION['department'];

// Retrieve the filename associated with the document ID
$sql = "SELECT filename FROM $department WHERE id=$id";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $filename = $row['filename'];

    // Delete the record from the database
    $deleteSql = "DELETE FROM $department WHERE id=$id";
    $deleteResult = mysqli_query($conn, $deleteSql);

    // Check if the database record was deleted successfully
    if ($deleteResult) {
        // Define the path to the file on the server
        $filePath = '../uploads/' . $department . '/' . $filename;

        // Check if the file exists on the server
        if (file_exists($filePath)) {
            // Delete the file from the server
            if (unlink($filePath)) {
                $_SESSION['delete'] = true;
                echo '<script>window.history.back();</script>';
            } else {
                $_SESSION['faileddelete'] = true;
                echo '<script>window.history.back();</script>';
            }
        } else {
            $_SESSION['faileddelete'] = true;
                echo '<script>window.history.back();</script>';
        }
    } else {
        $_SESSION['faileddelete'] = true;
                echo '<script>window.history.back();</script>';
    }
} else {
    $_SESSION['faileddelete'] = true;
                echo '<script>window.history.back();</script>';
}
?>
