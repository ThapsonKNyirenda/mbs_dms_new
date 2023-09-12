<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        #container{
            margin-top: 100px;
            width: 400px;
            padding: 10px;
            /* margin: auto; */
        }
        #login{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container border" id="container">
        <form action="login.php" method="post">

            <h3 id="login">LOGIN</h3><hr><br>
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-user-large"></i>
                </span>
                <input type="text" class="form-control" placeholder="Username" required name="email">
            </div>
            <label for="username" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>
            <input type="password" class="form-control" placeholder="Password" required name="password">
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="login" name="submit"></input>
                <input type="reset" class="btn btn-danger" value="cancel"></input>
            </div>
        </form>
    </div>

</body>
</html>
