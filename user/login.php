<?php

    // session_start();

    include('connection/connection.php');

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $post_email=$_POST['email'];
        $post_password=$_POST['password'];

        $sql= "SELECT * FROM users";
        $result=mysqli_query($conn,$sql);

        if ($result) {
            while ($details=mysqli_fetch_assoc($result)) {
                $email=$details['email'];
                $password=$details['password'];
                $role=$details['role'];

                if ($email==$post_email && $password==$post_password && $role=='admin') {
                    session_start();
                    $_SESSION['id']= $details['id'];
                    $_SESSION['user']=$details['role'];
                    $_SESSION['username']=$details['email'];
                    $_SESSION['department']=$details['department'];
                    header('location:index.php');

                }
                    echo 'not an admin';
                
            }
        }
    }

?>



