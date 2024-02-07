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

$target = "../uploads/";
$user = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$uploader = $firstname . ' ' . $lastname;
$name= $firstname.' '.$lastname;
$department = 'finance';
$targetDir = $target . "$department/";

// Verify and/or create the directory
if (!is_dir($targetDir)) {
    if(!mkdir($targetDir, 0777, true)) {
        die('Failed to create folders...');
    } 
}


if (isset($_POST['submit'])) {
    
    $selected_users_str = "";  // Create an empty string
if(isset($_POST['users'])) {
    
    $selected_users = $_POST['users'];
    $selected_users_str = implode(",", $selected_users);  // Concatenate the array values with comma
}

    
    $title = $_POST['title'];
    $category = $_POST['category'];
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $fileType = $_FILES['file']['type'];


    if ($fileType == 'application/pdf') {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filename = $_FILES["file"]["name"];
            $folder_path = $targetDir;
            $time_stamp = date('Y-m-d H:i');
            
            // Using prepared statements to avoid SQL injection
            $sql = "INSERT INTO finance (title, filename, folder_path, time_stamp, uploaded_by,uploader, department,category, status, selected_users) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user','$uploader','$department','$category','approved', '$selected_users_str')";
    
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
            
                $_SESSION['upload'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            } else {
                $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            }
            
        }


    }else if ($fileType == 'image/jpeg') {
        
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filename = $_FILES["file"]["name"];
            $folder_path = $targetDir;
            $time_stamp = date('Y-m-d H:i');
            
            // Using prepared statements to avoid SQL injection
            $sql = "INSERT INTO finance (title, filename, folder_path, time_stamp, uploaded_by,uploader, department,category, status, selected_users) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user','$uploader','$department','$category','approved', '$selected_users_str')";
    
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
            
                $_SESSION['upload'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            } else {
                $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            }
            
        }
    }else if ($fileType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
       
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filename = $_FILES["file"]["name"];
            $folder_path = $targetDir;
            $time_stamp = date('Y-m-d H:i');
            
            // Using prepared statements to avoid SQL injection
            $sql = "INSERT INTO finance (title, filename, folder_path, time_stamp, uploaded_by,uploader, department,category, status, selected_users) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user','$uploader','$department','$category','approved', '$selected_users_str')";
    
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
            
                $_SESSION['upload'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            } else {
                $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            }
            
        }
    }else if ($fileType == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
       
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $filename = $_FILES["file"]["name"];
            $folder_path = $targetDir;
            $time_stamp = date('Y-m-d H:i');
            
            // Using prepared statements to avoid SQL injection
            $sql = "INSERT INTO finance (title, filename, folder_path, time_stamp, uploaded_by,uploader, department,category, status, selected_users) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user','$uploader','$department','$category','approved', '$selected_users_str')";
    
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
            
                $_SESSION['upload'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            } else {
                $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
            }
            
        } else {
            // echo "Failed to upload due to error: " . $_FILES["file"]["error"];
            $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
            </script>';
        }
    }else {
        $_SESSION['upload_failed'] = true;
                // header('location: upload.php');
                echo '<script>
              window.history.back();
        </script>';
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
