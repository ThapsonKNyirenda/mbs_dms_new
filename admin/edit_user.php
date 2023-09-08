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

</head>
<body>
    <div class="card" style="width:50%; margin:auto; margin-top: 30px;">
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
                            <!-- <div class="mb-3">
                                <label class="form-label required">Type ypur message here</label>
                                <textarea class="form-control"></textarea>
                            </div> -->
                            <div class="modal-footer">
                                
                                <button type="reset" class="btn btn-danger">Reset</button><span>&nbsp;</span>
                                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            </div>
                        </form>

              <!-- Multi Columns Form -->
              <!-- <form class="row g-3">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="inputName5">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword5">
                </div>
                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Address</label>
                  <input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                  <label for="inputState" class="form-label">State</label>
                  <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="inputZip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form> -->
              <!-- End Multi Columns Form -->

            </div>
        </div>
</body>
</html>