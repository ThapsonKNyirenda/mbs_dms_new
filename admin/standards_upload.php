<?php
    session_start();
    ob_start(); // Start output buffering

    if (!isset($_SESSION['id'])) {
        header('location: index.php');
        exit(); // Ensure the rest of the script doesn't execute
    }

    include('connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    
    <!-- Include SweetAlert2 library via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>
<body>

<?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $target = "uploads/";
        $user = $_SESSION['username'];
        $targetDir = $target . "standards/";
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
                $time_stamp = date('Y-m-d H:i:s');
                
                $sql = "INSERT INTO standards (title, filename, folder_path, time_stamp, uploaded_by) VALUES ('$title','$filename', '$folder_path','$time_stamp','$user')";

                $result = mysqli_query($conn, $sql);
  
                if ($result) {
                    // Set a session variable to indicate success
                    $_SESSION['upload'] = true;
                }

                header('location: standards.php');
                
            }
        }
    }
?>
<?php
    ob_end_flush(); // End output buffering and send contents to browser
?>
</body>
</html>
