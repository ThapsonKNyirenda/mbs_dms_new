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

        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        // $department=$_POST['department'];
        // $role=$_POST['role'];
        // $email=$_POST['email'];
        // $password=$_POST['password'];

		
        $query = "UPDATE `users` SET `fName` = '$fName',`lName` = '$lName'
        WHERE `id` = ".$_SESSION['id'];

        $result = mysqli_query($conn, $query);
  
        if ($result) {
            // Set a session variable to indicate success

            $_SESSION['updated'] = true;
        }
        header('location: profile.php');
		
?>	
	<!-- <script type="text/javascript">
            alert("Editing Completed Successfully!");
            window.location = "users-profile.php";
                                
	</script> -->