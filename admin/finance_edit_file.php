<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start(); 

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
    exit();
}

include('../connection/connection.php');

$department= $_SESSION['department'];
  $email=$_SESSION['username'];
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

  <title>Edit File</title>
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

     body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #f6d365, #fda085);
            margin: 0;
            color: #333;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form#myForm {
            width: 50%;
            box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            background-color: #ffffff;
            margin: auto;
            margin-top: 20px;
        }

        .form-control, .select2-selection {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        button[type="submit"] {
            background-color: #fda085;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #f6d365;
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

<?php
// if(isset($_GET['file_id'])){
//     echo $_GET['file_id'];
// }
?>

<!-- Form starts here -->
<form id="myForm" action="#" enctype="multipart/form-data" method="POST" onsubmit="return validateForm();">
    <!-- <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">Document Title</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Doc. Title" name="title" required>
        </div>
    </div> -->

    <h3 style="text-align:center;">Change File permission</h3>
    <hr>
    <br>

    <?php
        $id=$_GET['file_id'];
        $sql2 = "SELECT * FROM finance WHERE id= '$id'";
        $file_result = mysqli_query($conn, $sql2); 

        while($file = mysqli_fetch_assoc($file_result)) {
            $title=$file['title'];
        }
    ?>

    <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Document Description</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Short Description" name="title" required value=<?php echo $title;?>>
                </div>
            </div>
                    
    <div class="row mb-3">
        <label for="userSelect" class="col-sm-2 col-form-label">Select Users</label>
        <div class="col-sm-6">
        <?php
            $sql = "SELECT * FROM users WHERE department = 'finance' AND role = 'user'";
            $user_result = mysqli_query($conn, $sql); 

            
        ?>
            
            <select class="form-control select2-multi" id="userSelect" name="users[]" multiple="multiple">
                <option value="None">None</option>
                <?php 
                if (mysqli_num_rows($user_result) > 0) {
                    while($user = mysqli_fetch_assoc($user_result)) {
                        if ($user['email'] != $email) {
                            echo "<option value='".$user['email']."'>".$user['fName'].' '.$user['lName']."</option>";  
                        }
                    }
                } else {
                    echo "<option value='No Any'>No Any</option>";
                }
                ?>

            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name="submit">Edit Permission</button>
        </div>
    </div>
</form>
<!-- Form ends here -->

<!-- Validate the form -->
<script>
    function validateForm() {
        let selectElement = document.getElementById('userSelect');
        let selectedOptions = selectElement.selectedOptions;

        if (selectedOptions.length === 0) {
            alert('Please select at least one user from the dropdown.');
            return false; // Prevents the form from submitting
        }
        return true;
    }

    $(document).ready(function() {
        $('.select2-multi').select2();
    });
</script>

</body>
</html>


<?php

if(isset($_POST['users'])) {
    $title=$_POST['title'];
    $selected_users = $_POST['users'];
    $selected_users_str = implode(",", $selected_users); // Concatenate the array values with comma

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE finance SET `title` = ?, `selected_users` = ? WHERE `id` = ?");
$stmt->bind_param('ssi', $title, $selected_users_str, $_GET['file_id']);


    if ($stmt->execute()) {
        $_SESSION['edit'] = true;
        header('Location: finance.php');
        exit;
    } else {
        $_SESSION['edit_failed'] = true;
        header('Location: finance.php');
        exit;
    }
}

?>