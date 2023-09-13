<?php
    include('../connection/connection.php');
    session_start();

    if (!isset($_GET['user_id'])) {
      header('location: ../index.php');
    }

    
    if (isset($_POST['submit'])) {

        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $department=$_POST['department'];
        $role=$_POST['role'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        // Prepare the SQL statement
        $sql = "INSERT INTO users (fName,lName,email,password,department,role) VALUES ('$fName', '$lName','$email','$password','$department','$role')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            $_SESSION['created'] = true;
        } else {
            $_SESSION['creation_failed']=true;
        }
        header('location: usermanagement.php');
    }

?>