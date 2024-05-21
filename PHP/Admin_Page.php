<?php
require_once 'config.php';
session_start();
if(!isset($_SESSION['admin_name'])){
header('location:../HTML/home.html');
}
?>
<?php


// Logout script
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:../HTML/home.html');
    exit(); // Add this line to prevent further execution of the code
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="../" href="../pictures/pc.webp" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
</head>
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  
  <a href="#Managesite" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>Manage Site</p>
  </a>
  <a href="#AddUsers" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-plus fa-4x"></i>    
    <p>add Users</p>
  </a>
  <a href="#ManageUsers" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-cog w3-xxlarge"></i>
  <p>Manage Users</p>
  </a>
  <a href="../PHP/admin_java.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-cog w3-xxlarge"></i>
  <p>Manage JAVA Page</p>
  </a>
  <a href="../PHP/admin_html.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-cog w3-xxlarge"></i>
  <p>Manage HTML Page</p>
  </a>
  <a href="../PHP/admin_css.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-cog w3-xxlarge"></i>
  <p>Manage CSS Page</p>
  </a>
  <a href="../PHP/admin_js.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
  <i class="fa fa-cog w3-xxlarge"></i>
  <p>Manage JAVASCRIPT Page</p>
  </a>
  <a href="?logout" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                <i class="fa fa-sign-out w3-xxlarge"></i>
                <p>Logout</p>
            </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#Managesite" class="w3-bar-item w3-button" style="width:25% !important">Manage Site</a>
    <a href="#AddUsers" class="w3-bar-item w3-button" style="width:25% !important">Add Users</a>
    <a href="#ManageUsers" class="w3-bar-item w3-button" style="width:25% !important">Manage Users</a>
    <a href="../PHP/admin_java.php" class="w3-bar-item w3-button" style="width:25% !important">Manage JAVA Page</a>
    <a href="../PHP/admin_html.php" class="w3-bar-item w3-button" style="width:25% !important">Manage HTML Page</a>
    <a href="../PHP/admin_css.php" class="w3-bar-item w3-button" style="width:25% !important">Manage CSS Page</a>
    <a href="../PHP/admin_js.php" class="w3-bar-item w3-button" style="width:25% !important">Manage JAVASCRIPT Page</a>
    <a href="../PHP/admin_js.php" class="w3-bar-item w3-button" style="width:25% !important">Manage JAVASCRIPT Page</a>
    <a href="?logout" class="w3-bar-item w3-button" style="width:25% !important">Logout</a>

  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">welcome</span> <?php echo $_SESSION['admin_name']?></h1>
    <p>this is an admin page</p>
  </header>

  <!-- Manage site Section -->
  <?php

  if (isset($_POST['Postsubmit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $note = $_POST['notes'];
    $lang = $_POST['language'];

    if ($lang == 'java')
      $insertPost = "INSERT INTO blocks (category_id, title, content, notes) VALUES (1,'$title','$content','$note')";
    else if ($lang == 'html')
      $insertPost = "INSERT INTO blocks (category_id, title, content, notes) VALUES (2,'$title','$content','$note')";
    else if ($lang == 'css')
      $insertPost = "INSERT INTO blocks (category_id, title, content, notes) VALUES (3,'$title','$content','$note')";
    else if ($lang == 'javascript')
      $insertPost = "INSERT INTO blocks (category_id, title, content, notes) VALUES (4,'$title','$content','$note')";

    if (mysqli_query($conn, $insertPost)) {
      $message = "New post added successfully.";
      } else {
      $error[] = 'Error: ' . mysqli_error($conn);
    }
  }
  ?>
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="Managesite">
    <h2 class="w3-text-light-grey">New Post</h2>
    <hr style="width:200px" class="w3-opacity">

    <?php if(isset($message)) { ?>
      <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>

    <?php if(isset($error)) { ?>
      <div class="alert alert-danger"><?php echo implode("<br>", $error); ?></div>
    <?php } ?>

    <form action="" method="post">
      <p><input class="w3-input w3-padding-16" placeholder="Title" id="title" required name="title"></p>
      <p><textarea class="w3-input w3-padding-16" rows="6" placeholder="Code" required name="content"></textarea></p>
      <p><textarea class="w3-input w3-padding-16" rows="6" placeholder="Notes" required name="notes"></textarea></p>
      <h4 class="w3-text-light-grey">Category</h4>
      <p>
        <select class="w3-input w3-padding-16" id="category" name="language">
          <option value="java">Java</option>
          <option value="html">HTML</option>
          <option value="css">CSS</option>
          <option value="javascript">JavaScript</option>
        </select>
      </p>
      <p>
        <input class="w3-button w3-light-grey w3-padding-large" type="submit" name="Postsubmit" value="Post">
        </input>
      </p>
    </form>
  </div>
  <!-- manage site end Section -->

  <!-- add user Section -->
  <?php
  if(isset($_POST['Addsubmit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $select = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        $error[] = 'user already exists!';
    }else{
      if($pass != $cpass)
          $error[] = 'passwords do not match';
      else {
          $insertadd = "INSERT INTO admin(name,email,password) VALUES('$name','$email','$pass')";
          if(mysqli_query($conn,$insertadd)){
            $Adminmessage = "Admin account created successfully.";
            // ...
          } else {
            $error[] = 'Error: '.mysqli_error($conn);
          }
       }
    }
}
?>
  <div class="w3-padding-64 w3-content" id="AddUsers">
    <h2 class="w3-text-light-grey">Add new Admin</h2>
    <hr style="width:200px" class="w3-opacity">

    <?php if(isset($Adminmessage)) { ?>
      <div class="alert alert-success"><?php echo $Adminmessage; ?></div>
    <?php } ?>

    <?php if(isset($error)) { ?>
      <div class="alert alert-danger"><?php echo implode("<br>", $error); ?></div>
    <?php } ?>

    <form action="" method="post">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Enter Name" required name="name"></p>
      <p><input class="w3-input w3-padding-16" type="email" placeholder="Enter Email" required name="email"></p>
      <p><input class="w3-input w3-padding-16" type="password" placeholder="Enter Password" required name="password"></p>
      <p><input class="w3-input w3-padding-16" type="password" placeholder="Reenter Password" required name="cpassword"></p>
      <p>
        <input class="w3-button w3-light-grey w3-padding-large" type="submit" name="Addsubmit" value="ADD">
        </input>
      </p>
    </form>
  <!-- End add user Section -->
  </div>

 <!-- Manage Users Section -->
 <div class="w3-padding-64 w3-content" id="ManageUsers">
  <h2 class="w3-text-light-grey">Manage Users</h2>
  <hr style="width:200px" class="w3-opacity">

  <?php
  require_once 'config.php';

  $successMessage = '';

  if (isset($_POST['delete'])) {
      $id = $_POST['id'];
      $delete_query = "DELETE FROM admin WHERE id=$id";
      mysqli_query($conn, $delete_query);
  }

  if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = $_POST['password']; // Retrieve the password from the form

      // Update the password only if a new password is provided
      if (!empty($pass)) {
          $pass = md5($pass); // Hash the password
          $update_query = "UPDATE admin SET name='$name', password='$pass', email='$email' WHERE id=$id";
          mysqli_query($conn, $update_query);
      } else {
          // If no new password is provided, update the name and email only
          $update_query = "UPDATE admin SET name='$name', email='$email' WHERE id=$id";
          mysqli_query($conn, $update_query);
      }

      // Check if the update was successful
      if (mysqli_affected_rows($conn) > 0) {
          $successMessage = "User updated successfully.";
      }
  }

  // Execute a SELECT query
  $result = mysqli_query($conn, "SELECT * FROM admin");

  echo "<div class='container mt-3'>
          <table class='table table-dark table-striped'>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Action</th>
            </tr>";

  while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['name'];
      $email = $row['email'];

      echo "<tr>
              <td>
                <form method='POST'>
                  <input type='hidden' name='id' value='$id'>
                  <input type='text' name='name' value='$name'>
              </td>
              <td>
                  <input type='email' name='email' value='$email'>
              </td>
              <td>
                  <input type='password' name='password' value=''>
              </td>
              <td>
                  <input type='submit' name='update' value='Update' class='w3-button w3-light-grey w3-padding-small'>
                  <input type='submit' name='delete' value='Delete' class='w3-button w3-light-grey w3-padding-small'>
                </form>
              </td>
            </tr>";
  }

  echo "</table>";

  if (!empty($successMessage)) {
      echo "<p class='w3-text-green'>$successMessage</p>";
  }

  echo "</div>";

  mysqli_close($conn);
  ?>
<!-- End Manage Users Section -->




  
   

</body>
</html>