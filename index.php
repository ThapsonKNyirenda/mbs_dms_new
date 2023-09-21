<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        @media (max-width: 500px) {
            #container {
                margin: 2% 10%;
            }
        }
        body {
            background-color: #FF6E26;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #container {
            background-color: white;
            max-width: 450px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        h3 {
            text-align: center;
        }
        .input-group-text {
            background-color: #FF6E26;
            color: white;
            border: none;
        }
        .btn-success, .btn-clear {
            background-color: #FF6E26;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container shadow-lg rounded" id="container">
        <form action="login.php" method="post" id="loginForm">
            <div class="text-center mb-4">
                <img src="assets/img/mbs logo.png" alt="Your Logo/Image" class="img-fluid" style="max-width: 150px;">
            </div>
            <div style="text-align: center;"><h5><I>Malawi Bureau of Standards</I></h5></div>
            <hr><br>

            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i> <!-- Corrected the Font Awesome icon -->
                    </span>
                    <input type="text" class="form-control" placeholder="Email" required name="email">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group" id="show_hide_password">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i> <!-- Corrected the Font Awesome icon -->
                    </span>
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                    <a href="#" class="input-group-text" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye-slash"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-clear me-2" onclick="clearForm()" style="color: white; background-color: red;">Clear</button> &nbsp;
                <input type="submit" class="btn btn-success" value="Login" name="submit">
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.querySelector('input[name="password"]');
            const eyeIcon = document.querySelector('#show_hide_password a i');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        function clearForm() {
            document.getElementById("loginForm").reset();
        }
    </script>

</body>

</html>

