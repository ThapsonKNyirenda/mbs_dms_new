<?php
    session_start();

    include('../connection/connection.php');
?>
<?php
    $id=$_GET['doc_id'];
    $department=$_SESSION['department'];
    
    $sql="DELETE FROM $department WHERE id=$id";
    $result=mysqli_query($conn,$sql);

    if($result){
        $_SESSION['deny']=true;
        header('location:approve.php');
    }else{
        echo "not done";
        die;
    }
?>