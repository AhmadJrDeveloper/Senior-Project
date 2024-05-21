<?php
require_once 'config.php';
session_start();

$error = []; // Initialize the $error array

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $select = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $hashed_password = md5($password);
        if($hashed_password == $row['password']){
            if ($email == 'admin@gmail.com') {
                $_SESSION['admin_name'] = $row['name'];
                header('location: ../php/admin_page.php');
            } else {
                $name = $row['name']; // Retrieve the name from the database
                $_SESSION['user_name'] = $name; // Store the user's name in the session
                header('location: ../php/subadmin.php');
            }
        }else{
            $error[] = 'Incorrect email or password!';
        }
    }else{
        $error[] = 'Incorrect email or password!';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" type="../" href="../pictures/pc.webp" />

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>Admin<br> Login Page</h2>
            <p>Login from here to access.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <?php if(!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($error as $err): ?>
                        <p><?php echo $err; ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <input type="submit" class="btn btn-black" name="submit" value="Login">
                    <a href="../html/home.html" class="btn btn-black">Back</a>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
