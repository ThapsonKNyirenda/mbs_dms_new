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
    
    $query = 'SELECT * FROM users
    WHERE
    id ='.$_GET['doc_id'];
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {   
    $fName=$row['fName'];
    $lName=$row['lName'];
    $department=$row['department'];
    $role=$row['role'];
    $email=$row['email'];
    $password=$row['password'];

}
?>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora&family=Raleway&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="styles.css">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit User</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/mbs logo3.png" rel="icon">
  <link href="assets/img/mbs logo.png" rel="mbs-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    @media (max-width: 600px) {
    .card {
        width: 90%;
    }
}

  </style>

</head>
<body>
    <div class="card" style="width:50%; margin:auto; margin-top: 30px;" id="card">
            <div class="card-body">
              <h5 class="card-title">Edit User Details</h5>
              <hr style="margin-bottom:20px;">

              <form action="update_user.php?doc_id=<?php echo $_GET['doc_id'];?>" method="POST" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fName" required value="<?php echo $fName; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Last Name</label>
                                <input type="text" class="form-control" name="lName" value="<?php echo $lName; ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                              <label class="form-label required">Department</label>
                              <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="department" required>
                                <option value="director">Director General's Office</option>
                                  <option value="finance">Finance and Administration</option>
                                  <option value="metrology">Metrology Services</option>
                                  <option value="standards">Standards Development</option>
                                  <option value="quality">Quality Assurance Service</option>
                                  <option value="testing">Testing Services</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label class="form-label required">Role</label>
                              <div class="col-sm-12">
                                <select class="form-select" aria-label="Default select example" name="role" required>
                                  <option value="user">User</option>
                                  <option value="manager">Manager</option>
                                  <option value="admin">Admin</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
                            </div>

            </div>
        </div>
</body>
</html>