<?php
  session_start();
?>
<?php

    if (!isset($_SESSION['id'])) {
      header('location: index.php');
    }

    $firstname=$_SESSION['firstname'];
    $lastname=$_SESSION['lastname'];

    include('../connection/connection.php');

    if (isset($_SESSION['created'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'New User has been Created!'
                  });
              });
            </script>";
      unset($_SESSION['created']);
    }else if (isset($_SESSION['creation_failed'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Failed',
                      text: 'User creation failed!'
                  });
              });
            </script>";
      unset($_SESSION['creation_failed']);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>user management</title>
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

  <!-- custom css for data tables -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css"> 

  <style>
        .modal-header {
            background: #fb7d3e;
            color: #fff;
        }
        
        /* .required:after {
            content: "*";
            color: red;
        } */
        #danger{
          background-color: red;
          padding: 3px;
        }
        #edit{
          background-color: blue;
          padding: 3px;
        }
    </style>
    <style>
    /* Loading Screen */
    #loading {
        position: fixed;
        width: 100%;
        height: 100vh;
        background: white url('assets/img/loading.gif') no-repeat center center; /* You can replace this with your own loading GIF or spinner */
        z-index: 9999;
    }
</style>
</head>

<body style="width: 100%;">
<div id="loading"></div>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #fb7d3e;">

    <div class="d-flex align-items-center justify-content-between">
      <div href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/mbs logo.png" alt="logo">
        <span class="d-none d-lg-block">Malawi Bureu of Standards</span>
      </div>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <!-- <li class="nav-item dropdown"> -->

          <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>End Notification Icon -->
        <!-- 
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>End Messages Icon -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/male-avator.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $firstname.' '.$lastname;?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $firstname.' '.$lastname?></h6>
              <span><?php echo $_SESSION['user'];?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>My Profile</span>
              </a>
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" style="background-color: #fb7d3e;">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="usermanagement.php">
          <i class="bi bi-people-fill"></i>
          <span>User Management</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Departments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="director.php">
              <i class="bi bi-circle"></i><span>Director General Office</span>
            </a>
          </li>
          <li>
            <a href="finance.php">
              <i class="bi bi-circle"></i><span>FInance and Administration</span>
            </a>
          </li>
          <li>
            <a href="standards.php">
              <i class="bi bi-circle"></i><span>standards Development</span>
            </a>
          </li>
          <li>
            <a href="quality.php">
              <i class="bi bi-circle"></i><span>Quality Assurance</span>
            </a>
          </li>
          <li>
            <a href="testing.php">
              <i class="bi bi-circle"></i><span>Testing services</span>
            </a>
          </li>
          <li>
            <a href="metrology.php">
              <i class="bi bi-circle"></i><span>Metrology services</span>
            </a>
          </li>          
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person-lines-fill"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php?user_id=<?php echo $_SESSION['user'];?>">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main" style="margin-bottom: 50px;">

    <div class="pagetitle">
      <h1>USER MANAGEMENT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">user management</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard" style="width: 100%;">
      <div class="row" >

        <!-- Left side columns -->
        <div class="col-lg-8" style="width: 100%;">

          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12" style="width: 100%;">
              <div class="card info-card sales-card" style="width: 100%; ">

                <div class="card-body" style="width: 100%;">
                  <h5 class="card-title">User Details</h5>
                  <div class="m-3" style="display: flex; justify-content: end;">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><span class="bi bi-plus-circle"></span> Add User</button>
                    <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" style="background-color: red;" ></button>
                    </div>
                    <div class="modal-body">
                    <form action="add_user.php" method="POST" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Last Name</label>
                                <input type="text" class="form-control" name="lName" required>
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
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Password</label>
                                <input type="password" class="form-control" name="password" required>
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

                    </div>
                    
                </div>
            </div>
        </div>
                  </div>

                  <div class="d-block align-items-center" style="width:100%; overflow-x: auto;">
                    
                  <table class="table table-striped" id="mytable" >
                        <thead>
                          <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Role</th>
                            <th scope="col">email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                  
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo'
                                        <tr>
                                        <td>'.$row["fName"].'</td>
                                        <td>'.$row["lName"].'</td>
                                        <td>'.$row["department"].'</td>
                                        <td>'.$row["role"].'</td>
                                        <td>'.$row["email"].'</td>
                                        <td>'.$row["password"].'</td>
                                        <td><span><a href="edit_user.php?doc_id='. $row['id'].'"><button id="edit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> edit</button></a></span><span> </span><span><a href="delete_user.php?doc_id='. $row['id'].'"><button class="btn btn-danger" id="danger"><i class="bi bi-trash"></i> delete</button></a></span></td>                                          
                                        </tr>
                                    ';
                              

                                }
                            } else {
                                echo "";
                            }
                          
                          ?>
                          
                        </tbody>
                      </table>';
                  
                    <!-- <table class="table table-striped" id="mytable" >
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Age</th>
                            <th scope="col">Start Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Brandon Jacob</td>
                            <td>Designer</td>
                            <td>28</td>
                            <td>2016-05-25</td>
                          </tr>
                          
                        </tbody>
                      </table>
                      End Table with stripped rows -->
                    
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
          </div>
        </div><!-- End Left side columns -->          
          
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Copyright © 2021 Malawi Bureau of Standards Designed by Kreative Technologies -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      <span>copyright </span> &copy;&nbsp;  <strong><span>2023 Malawi Bureau of Standards</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- custom script for datatables -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script> -->
  
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

  <script>
    // $('#example').DataTable();
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
  </script>

<script>
    window.addEventListener("load", function () {
        var load_screen = document.getElementById("loading");
        document.body.removeChild(load_screen);
    });
</script>

</body>

</html>