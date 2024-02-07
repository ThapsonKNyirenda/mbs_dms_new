<?php
  session_start();
  
  if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
  }
?>
<?php
    include('../connection/connection.php');
    
    $id=$_SESSION['id'];
    $sql="SELECT * FROM users WHERE id=$id";
    $result=mysqli_query($conn,$sql);

    while ($row=mysqli_fetch_assoc($result)) {
      # code...
      $firstname= $row['fName'];
      $lastname= $row['lName'];
      $role= $row['role'];
    }

    $department=$_SESSION['department'];
?>
<?php


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

    if (isset($_SESSION['delete'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'success',
                      text: 'User Deleted!'
                  });
              });
            </script>";
      unset($_SESSION['delete']);
    }else if (isset($_SESSION['failed'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'error',
                      text: 'Failed to delete!'
                  });
              });
            </script>";
      unset($_SESSION['failed']);
    }

    if (isset($_SESSION['edit'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'success',
                      text: 'User Successfully Edited!'
                  });
              });
            </script>";
      unset($_SESSION['edit']);
    }else if (isset($_SESSION['edit_failed'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'error',
                      text: 'Failed to Edit!'
                  });
              });
            </script>";
      unset($_SESSION['edit_failed']);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Department Members</title>
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
        <span class="d-none d-lg-block">Malawi Bureau of Standards</span>
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
              <span><?php echo $role;?></span>
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
            <a class="nav-link collapsed" href="javascript:void(0);" onclick="confirmLogout();">
   <i class="bi bi-box-arrow-in-right"></i>
   <span>Logout</span>
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
    <a class="nav-link collapsed" href="approve.php">
    <i class="bi bi-hourglass-split"></i>
      <span>Pending Files</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="department_files.php">
    <i class="bi bi-file-earmark-text-fill"></i>
      <span>Department Files</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="upload.php">
    <i class="bi bi-upload"></i>
      <span>Upload Files</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link" href="members.php">
    <i class="bi bi-people"></i>
      <span>Department Members</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="profile.php">
    <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
  <a class="nav-link collapsed" href="javascript:void(0);" onclick="confirmLogout();">
   <i class="bi bi-box-arrow-in-right"></i>
   <span>Logout</span>
</a>

  </li><!-- End Login Page Nav -->

</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main" style="margin-bottom: 50px;">

    <div class="pagetitle">
      <h1>DEPARTMENT MEMBERS</h1>
      <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="approve.php">Home</a></li>
          <li class="breadcrumb-item"><a href="approve.php">Pending Files</a></li>
          <li class="breadcrumb-item"><a href="departmen_files.php">Department Files</a></li>
          <li class="breadcrumb-item"><a href="uload.php">Upload Files</a></li>
          <li class="breadcrumb-item active">Department Members</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard" style="width: 100%;">
      <div class="row" >

        <!-- Left side columns -->
        <div class="col-lg-8" style="width: 100%;">

          <div class="row">

            
        </div>
                  </div>

                  <div class="d-block align-items-center" style="overflow-x: auto;">
                    
                  <table class="table table-striped" id="mytable" >
                        <thead>
                          <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                  
                            $sql = "SELECT * FROM users WHERE department='$department'";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if($row["role"]=='user'){
                                        $row["role"]='Officer';
                                    } else if($row["role"]=='admin'){
                                        $row["role"]='Admin';
                                    }else if($row["role"]=='manager'){
                                        $row["role"]='Manager';
                                    }else{
                                        $row["role"]='N/A';
                                    }

                                    echo'
                                        <tr>
                                        <td>'.$row["fName"].'</td>
                                        <td>'.$row["lName"].'</td>
                                        <td>'.$row["email"].'</td>
                                        <td>'.$row["role"].'</td>
                                        </tr>
                                    ';
                              

                                }
                            } else {
                                echo "";
                            }
                          
                        ?>
                          
                        </tbody>
                      </table>
                  
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

<script>
  $(document).ready(function() {
    // Initialize DataTables
    $('#mytable').DataTable();

    // Handle delete button click event
    $('.delete-button').click(function(event) {
        event.preventDefault(); 
        var docId = $(this).data('docid'); 

        Swal.fire({
            // title: 'Are you sure?',
            text: 'Are you sure you want to Delete',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, Keep it',
            confirmButtonText: 'Yes, Delete it!',
            reverseButtons: true,
            confirmButtonColor: '#d33',  // This will set the confirm button to red
            cancelButtonColor: '#3085d6' // This will set the cancel button to default blue
        }).then((result) => {
            if (result.value) {
                window.location.href = "delete_user.php?doc_id=" + docId;
            }
        });
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if(isset($_SESSION['created']) || isset($_SESSION['creation_failed'])): ?>
        $("#myModal").modal("hide");
    <?php endif; ?>
});

function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Logout!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "logout.php";
        }
    });
}

</script>


</body>

</html>