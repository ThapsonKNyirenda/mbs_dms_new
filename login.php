<?php

include('connection/connection.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_email = $_POST['email'];
    $post_password = $_POST['password'];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $loginSuccess = false;

    if ($result) {
        while ($details = mysqli_fetch_assoc($result)) {
            $email = $details['email'];
            $password = $details['password'];
            $role = $details['role'];

            if ($email == $post_email && $password == $post_password) {
                session_start();
                $_SESSION['id'] = $details['id'];
                $_SESSION['user'] = $details['role'];
                $_SESSION['username'] = $details['email'];
                $_SESSION['department'] = $details['department'];
                $_SESSION['firstname'] = $details['fName'];
                $_SESSION['lastname'] = $details['lName'];

                if ($role == 'admin') {
                    header('location: admin/dashboard.php');
                } elseif ($role == 'user') {
                    header('location: user/file.php');
                } elseif ($role == 'manager') {
                    header('location: manager/approve.php');
                }
                exit;
            }      
        }
    }
    
    if (!$loginSuccess) {
        $message = "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Wrong email or password!'
                        }).then(() => {
                            window.history.back();
                        });
                    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SweetAlert2 stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <!-- SweetAlert2 script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<?php 
    if ($message) {
        echo $message;
    }
?>

</body>
</html>