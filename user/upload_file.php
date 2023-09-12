<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start(); 

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
    exit();
}

include('../connection/connection.php');

$target = "uploads/";
$user = $_SESSION['username'];
$department = $_SESSION['department'];
$targetDir = $target . "$department/";


// Verify and/or create the directory
if (!is_dir($targetDir)) {
    if(!mkdir($targetDir, 0777, true)) {
        die('Failed to create folders...');
    } 
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $fileType = $_FILES['file']['type'];

    if ($fileType !== 'application/pdf') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Only PDFs are allowed.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
              </script>";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filename = $_FILES["file"]["name"];
            $folder_path = $targetDir;
            $time_stamp = date('Y-m-d H:i');
            
            // Using prepared statements to avoid SQL injection
            $sql = "INSERT INTO $department (title, filename, folder_path, time_stamp, uploaded_by,department,status) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user','$department','pending')";
    
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
            
                $_SESSION['upload'] = true;
                header('location: upload.php');
            } else {
                echo "Error inserting record: " . $stmt->error;
            }
            
            $stmt->close();
            
        } else {
            echo "Failed to upload due to error: " . $_FILES["file"]["error"];
        }
    }
}

ob_end_flush(); // End output buffering and send contents to browser
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Include SweetAlert2 library via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>
<body>
    <!-- Rest of the HTML body (if any) -->
</body>
</html>
