<?php
  session_start();
?>
<?php

    if (!isset($_SESSION['id'])) {
      header('location: index.php');
    }

    include('connection/connection.php');
?>

<?php

        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $department=$_POST['department'];
        $role=$_POST['role'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $query = "UPDATE `users` SET `fName` = '$fName',`role` = '$role',`lName` = '$lName',`email` = '$email',`password` = '$password',`department` = '$department'
        WHERE `id` = ".$_GET['doc_id'];

        $result = mysqli_query($conn, $query);
		
?>	
	<script type="text/javascript">
            alert("Editing Completed Successfully!");
            window.location = "usermanagement.php";
                                
	</script>