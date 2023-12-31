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
      $department= $_SESSION['department'];
    }
?>
<?php


  if (isset($_SESSION['update'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    text: 'Successfully Approved!'
                });
            });
          </script>";
    unset($_SESSION['update']);
  } else if (isset($_SESSION['failedupdate'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to approve!'
                });
            });
          </script>";
    unset($_SESSION['failedupdate']);
  }

  if (isset($_SESSION['deny'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    text: 'Document Denied!'
                });
            });
          </script>";
    unset($_SESSION['deny']);
  } else if (isset($_SESSION['faileddeny'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to deny!'
                });
            });
          </script>";
    unset($_SESSION['faileddeny']);
  }


 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
    #btn2{
      padding: 3px;
      margin: 3px;
      font-size: small;
    }
    #btn-download{
      padding: 3px;
      margin: 3px;
      font-size: small;
    }

  </style>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pending</title>
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
  <link rel="stylesheet" href="assets/css/style2.css">

  <!-- links for the table style  -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css"> 


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<div id="loading"></div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #fb7d3e;">

    <div class="d-flex align-items-center justify-content-between">
      <div href="#" class="logo d-flex align-items-center">
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

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span> -->
          <!-- </a>End Messages Icon -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/male-avator.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $firstname.' '.$lastname;?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $firstname.' '.$lastname;?></h6>
              <span><?php echo $role;?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
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
    <a class="nav-link" href="approve.php">
    <i class="bi bi-hourglass-split"></i>
      <span>PENDING FILES</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="department_files.php">
    <i class="bi bi-file-earmark-text-fill"></i>
      <span>DEPARTMENT FILES</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="upload.php">
    <i class="bi bi-upload"></i>
      <span>UPLOAD FILE</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="message.php">
      <i class="bi bi-messenger"></i>
      <span>MESSAGE</span>
    </a>
  </li>End Contact Page Nav -->

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="recycle.php">
      <i class="bi bi-recycle"></i>
      <span>RECYCLE BIN</span>
    </a>
  </li>End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="profile.php">
    <i class="bi bi-person"></i>
      <span>MY ACCOUNT</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="logout.php">
      <i class="bi bi-power"></i>
      <i class="bi bi-person-fill-gear"></i>
      <span>LOG OUT</span>
    </a>
  </li><!-- End Login Page Nav -->

</ul>

</aside><!-- End Sidebar-->


  <main id="main" class="main" style="margin-bottom: 50px;">

    <div class="pagetitle">
      <h1 class="mb-3">
      <?php 
        if($department=='director'){
          echo"Director General's Office Department";
        }elseif ($department=='finance') {
          echo'Finance and Administration Department';
        }elseif ($department=='standards') {
          echo'Standards Development Department';
        }elseif ($department=='quality') {
          echo'Quality Assurance Service Department';
        }elseif ($department=='testing') {
          echo'Testing Services Department';
        }elseif ($department=='metrology') {
          echo'Metrology Services Department';
        }
      ?>
      </h1>

      <nav>
        
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row" >

        <!-- Left side columns -->
        <!-- <div class="col-lg-8" style="width: 100%;">
          <div class="row">

            
            <div class="approve-header">
                <p>All Uploaded Documents
                    <input class="search-input" type="text">
                <button class="btn-search">Search</button>
                </p>
                
              </div> -->

            <!-- Customers Card -->
            <form action="approve.php" method="post" enctype="multipart/form-data">

    <div class="col-xxl-4 col-md-12" style="width: 100%;">
        <div class="card info-card sales-card" style="width: 100%; ">

            <div class="card-body" style="width: 100%;">
                <h5 class="card-title p-3">Pending Uploaded Documents</h5>
                <hr style="margin-bottom: 30px;">

                <div class="table-responsive">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th scope="col">Sn</th>
                                <th scope="col">Document title</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Date Uploaded</th>
                                <th scope="col">Uploaded By</th>
                                <th scope="col">size</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
$sql = "SELECT * FROM $department WHERE status='pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 1;
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $filePath = '../uploads/' . $department . '/' . $row['filename'];
        $fileSize = filesize($filePath); // Get the file size in bytes

        // Format the file size for display
        if ($fileSize >= 1024 * 1024) {
            $formattedSize = number_format($fileSize / (1024 * 1024), 2) . ' MB';
        } elseif ($fileSize >= 1024) {
            $formattedSize = number_format($fileSize / 1024, 2) . ' KB';
        } else {
            $formattedSize = $fileSize . ' bytes';
        }

        echo '
            <tr>
                <td>' . $count++ . '</td>
                <td>' . $row["title"] . '</td>
                <td>' . $row["filename"] . '</td>
                <td>' . date('Y-m-d H:i:s', strtotime($row["time_stamp"])) . '</td>
                <td>' . $row["uploaded_by"] . '</td>
                <td>' . $formattedSize . '</td> <!-- Display the formatted file size -->
                <td style="color: red;">' . $row["status"] . '</td>
                <td>
                    <div class="d-flex">
                        <div class="col">
                            <a href="' . $filePath . '" target="_blank" class="btn btn-success" id="btn-download"
                                data-toggle="tooltip" data-placement="top" title="Download Document">
                                <i class="bi bi-cloud-arrow-down"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a href="approval.php?doc_id=' . $row['id'] . '" class="btn btn-danger" id="btn2"
                                data-toggle="tooltip" data-placement="top" title="Approve Document">
                                <i class="bi bi-check2-square"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="delete-button" data-docid="' . $row['id'] . '"
                                data-toggle="tooltip" data-placement="top" title="Reject Document">
                                <button class="btn btn-danger" id="btn2">
                                    <i class="bi bi-x"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        ';
    }
} else {
    echo "";
}
?>


                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div><!-- End Sales Card -->
</form>


  
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
  $(document).ready(function() {
    // Initialize DataTables
    $('#mytable').DataTable();

    // Handle delete button click event
    $('.delete-button').click(function(event) {
        event.preventDefault(); 
        var docId = $(this).data('docid'); 

        Swal.fire({
            // title: 'Are you sure?',
            text: 'Are you sure you want to Decline',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, keep it',
            confirmButtonText: 'Yes, decline it!',
            reverseButtons: true,
            confirmButtonColor: '#d33',  // This will set the confirm button to red
            cancelButtonColor: '#3085d6' // This will set the cancel button to default blue
        }).then((result) => {
            if (result.value) {
                window.location.href = "deny.php?doc_id=" + docId;
            }
        });
    });
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