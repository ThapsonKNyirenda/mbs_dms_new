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


        $password=$_POST['password'];

        $sql = "SELECT * FROM users WHERE `id` = ".$_SESSION['id'];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if($row['password']==$password){
            $newpassword=$_POST['newpassword'];
            $query1 = "UPDATE `users` SET `password` = '$newpassword' WHERE `id` = ".$_SESSION['id'];

            $result1 = mysqli_query($conn, $query1);
            if ($result1) {
                $_SESSION['changed']=true;
               echo '<script>
     window.history.back();
  </script>';
            }else{
                $_SESSION['change_failed']=true;
                echo '<script>
     window.history.back();
  </script>';
            }
        }else{
            $_SESSION['change_failed']=true;
            echo '<script>
     window.history.back();
  </script>';
        }

		
?>	
	<!-- <script type="text/javascript">
            alert("Password Changed Successfully!");
            window.location = "users-profile.php";
                                
	</script> -->