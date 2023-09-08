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

        // $fName=$_POST['fName'];
        // $lName=$_POST['lName'];
        // $department=$_POST['department'];
        // $role=$_POST['role'];
        // $email=$_POST['email'];
        $password=$_POST['password'];

        $sql = "SELECT * FROM users WHERE `id` = ".$_SESSION['id'];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if($row['password']==$password){
            $newpassword=$_POST['newpassword'];
            $query1 = "UPDATE `users` SET `password` = '$newpassword' WHERE `id` = ".$_SESSION['id'];

            $result1 = mysqli_query($conn, $query1);
            if ($result1) {
                echo '
                <script type="text/javascript">
                alert("Password Successfully Changed!");
                window.location = "users-profile.php";
                                
	            </script>
            ';
            }else{
                echo '
                <script type="text/javascript">
                alert("Wrong Password used!");
                window.location = "users-profile.php";
                                
	            </script>
            ';
            }
        }else{
            echo '
                <script type="text/javascript">
                alert("Wrong Password used!");
                window.location = "users-profile.php";
                                
	            </script>
            ';
        }

		
?>	
	<!-- <script type="text/javascript">
            alert("Password Changed Successfully!");
            window.location = "users-profile.php";
                                
	</script> -->