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


if (isset($_SESSION['delete_success'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'File has been successfully deleted!'
              });
          });
        </script>";
  unset($_SESSION['delete_success']);
}

if (isset($_SESSION['upload'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'File has been successfully Uploaded!'
              });
          });
        </script>";
  unset($_SESSION['upload']);
}else if (isset($_SESSION['upload_failed'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'File not Uploaded!'
              });
          });
        </script>";
  unset($_SESSION['upload_failed']);
}

if (isset($_SESSION['edit'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'Permissions Changed for File!'
              });
          });
        </script>";
  unset($_SESSION['edit']);
}elseif (isset($_SESSION['edit_failed'])) {
  # code...
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Failed to Change Fie Permissions!'
              });
          });
        </script>";
  unset($_SESSION['edit_failed']);
}

if (isset($_SESSION['file_failed'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Use Accepted File Type'
              });
          });
        </script>";
  unset($_SESSION['file_failed']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- <link rel="stylesheet" type="text/css" href="sweet-alert/sweetalert.css">
  <script src="sweet-alert/sweetalert.min.js"></script> -->
  <!-- <script src="sweet-alert/sweetalert.min.js"></script> -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Standards</title>
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

  <style>
    #btn2{
      padding: 3px;
      margin: 3px;
    }
  </style>
</head>

<body>
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

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span> -->
          <!-- </a>End Messages Icon -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/male-avator.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $firstname.' '.$lastname;?></h6></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6>
              <?php echo $firstname.' '.$lastname;?></h6>
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
        <a class="nav-link collapsed" href="usermanagement.php">
          <i class="bi bi-people-fill"></i>
          <span>User Management</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="">
          <i class="bi bi-menu-button-wide"></i><span>Departments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content" data-bs-parent="#sidebar-nav">
          <li>
            <a href="director.php">
              <i class="bi bi-circle"></i><span>Director General Office</span>
            </a>
          </li>
          <li>
            <a href="finance.php">
              <i class="bi bi-circle"></i><span>Finance and Administration</span>
            </a>
          </li>
          <li>
            <a href="standards.php">
              <i class="bi bi-circle"></i><span>Standards Development</span>
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
      <a class="nav-link collapsed" href="javascript:void(0);" onclick="confirmLogout();">
   <i class="bi bi-box-arrow-in-right"></i>
   <span>Logout</span>
</a>

      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main" style="margin-bottom: 50px;">

    <div class="pagetitle">
      <h1 class="mb-3">STANDARDS DEVELOPMENT DEPARTMENT</h1>
      <hr>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Department/</li>
          <li class="breadcrumb-item active">Standards Development Department</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row" >

        <!-- Left side columns -->
        <div class="col-lg-8" style="width: 100%;">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card p-3">
                <form action="standards_upload.php" enctype="multipart/form-data" method="POST">
                <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Document Description</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Short Description" name="title" required>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                      <div class="col-sm-6">
                        <input class="form-control" type="file" id="formFile" name="file" required>
                        <div>
                          <b>Allowed Files (.pdf, .docx, .xlsx, .jpg)</b>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="userSelect" class="col-sm-2 col-form-label">Select Users</label>
                      <div class="col-sm-6">
                      <?php
                        $sql = "SELECT * FROM users WHERE department = 'standards' AND role = 'user'";
                        $user_result = mysqli_query($conn, $sql);                          
                        ?>
                        <select class="form-control select2-multi" id="userSelect" name="users[]" multiple="multiple">
                            <!-- <option value="None">None</option> -->
                            <?php 
                            if (mysqli_num_rows($user_result) > 0) {
                                while($user = mysqli_fetch_assoc($user_result)) {
                                    if ($user['email'] != $email) {
                                        echo "<option value='".$user['email']."'>".$user['fName'].' '.$user['lName']."</option>";  // Assuming 'email' is the user's email and 'fName' and 'lName' are the user's first name and last name respectively
                                      }
                                }
                            } else {
                              echo "<option value='No Any'>No Any</option>";
                            }
                            ?>
                            
                        </select>
                        <div>
                          <!-- <i>Ctrl+a to select all</i>,&nbsp;<i>Ctrl+click to select or unselect</i> -->
                        </div>

                        <button type="button" id="selectAll" class="btn btn-primary">Select All</button>
                        <button type="button" id="deselectAll" class="btn btn-secondary">Deselect All</button>


                        <script>
                        $(document).ready(function() {
                            $('.select2-multi').select2();

                            $('#selectAll').click(function() {
                                $('#userSelect option').prop('selected', true);
                                $('#userSelect').trigger('change');
                            });

                            $('#deselectAll').click(function() {
                                $('#userSelect option').prop('selected', false);
                                $('#userSelect').trigger('change');
                            });
                        });
                        </script>
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="userSelect" class="col-sm-2 col-form-label">Select Category</label>
                    <div class="col-sm-6">
                    <select class="form-control" id="userSelect" name="category" required>
                            
                            <?php 
                            
                          // Display options for standards
                          echo "<option value='Technical Reports'>Technical Reports</option>";
                          echo "<option value='Meeting Records'>Meeting Records</option>";
                          echo "<option value='Standards OPerations'>Standard Operations</option>";
                            ?>

                        </select>
                    </div>
                </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="reset" class="btn btn-secondary" name="reset">Clear</button>
                        <button type="submit" class="btn btn-primary" name="submit">Upload File</button>
                      </div>
                    </div>
    
                  </form><!-- End General Form Elements -->    
              </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-12" style="width: 100%;">
                <div class="card info-card sales-card" style="width: 100%; ">
  
                  <div class="card-body" style="width: 100%;">
                    <h5 class="card-title p-3">Documents Available</h5>
                    <hr style="margin-bottom: 30px;">
  
                    <div class="table-responsive align-items-center p-2" style="width:100%; overflow-x: auto;" >
                    <table class="table table-striped" id="mytable" >
                        <thead>
                          <tr>
                            <th scope="col">Sr. no</th>
                            <th scope="col">Filename</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Time Uploaded</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                  
                            $sql = "SELECT * FROM standards Where status='approved'";
                            $result = $conn->query($sql);

                            
                            
                            if ($result->num_rows > 0) {
                                $count= 1;
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                  $filePath = '../uploads/standards/' . $row['filename'];
                                  // $fileSize = filesize($filePath); // Get the file size in bytes
  
                                  // // Format the file size for display
                                  // if ($fileSize >= 1024 * 1024) {
                                  //     $formattedSize = number_format($fileSize / (1024 * 1024), 2) . ' MB';
                                  // } elseif ($fileSize >= 1024) {
                                  //     $formattedSize = number_format($fileSize / 1024, 2) . ' KB';
                                  // } else {
                                  //     $formattedSize = $fileSize . ' bytes';
                                  // }
                                  echo'
                                      <tr>
                                      <td>'.$count++.'</td>
                                      <td>'.$row["filename"].'</td>
                                      <td>'.$row["title"].'</td>
                                      <td>'.$row["category"].'</td>
                                      <td>'. date('Y-M-d H:i:s', strtotime($row["time_stamp"])) . '</td>
                                      <td>'.$row["uploader"].'</td>
                                      <td>
                                          <span><a href="../uploads/standards/'.$row['filename'].'"><button class="btn btn-danger" id="btn2"><i <i class="bi bi-eye"></i></i> View</button></a></span>
                                          <span><a href="standards_edit_file.php?file_id='.$row['id'].'"><button class="btn btn-danger" id="btn2"><i class="bi bi-pencil-square"></i> Edit</button></a></span>
                                          <span><a href="#" class="delete-button" data-docid="'.$row['id'].'"><button class="btn btn-danger" id="btn2"><i class="bi bi-trash"></i> Delete</button></a></span>
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
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script> -->
  <script>

    $(document).ready(function() {
        $('#mytable').DataTable();

        $('.delete-button').click(function(event) {
          event.preventDefault(); 
          var docId = $(this).data('docid'); 

          Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this file!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, keep it',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
            confirmButtonColor: '#d33',  // This will set the confirm button to red
            cancelButtonColor: '#3085d6' // This will set the cancel button to default blue
        }).then((result) => {
            if (result.value) {
                window.location.href = "delete_standards.php?doc_id=" + docId;
            }
        });

      });

    });


    // $('#example').DataTable();
    $(document).ready(function() {
        $('#mytable').DataTable();
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

      // swal({
      //   title: "Are you sure?",
      //   text: "Once deleted, you will not be able to recover this imaginary file!",
      //   icon: "warning",
      //   buttons: true,
      //   dangerMode: true,
      // })
      // .then((willDelete) => {
      //   if (willDelete) {
      //     document.getElementById("link1").href="delete_finance.php?doc_id='. $row['id'].'";
      //     swal("Poof! Your imaginary file has been deleted!", {
      //       icon: "success",
      //     });
      //   } else {
      //     swal("Your imaginary file is safe!");
      //   }
      // });
  </script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <!-- Include SweetAlert2 library via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


  <script>
    window.addEventListener("load", function () {
        var load_screen = document.getElementById("loading");
        document.body.removeChild(load_screen);
    });
</script>

</body>

</html>