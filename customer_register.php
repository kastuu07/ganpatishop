<?php
include("db.php");
$msg="";
if(isset($_POST['register'])){
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $check = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
  if(mysqli_num_rows($check)>0){
    $msg="Email already exists!";
  } else {
    mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
    header("Location: customer_login.php?registered=1");
    exit;
  }
}
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register - Vaishanvi Arts</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;padding:25px;border-radius:12px;width:360px;box-shadow:0 4px 15px rgba(0,0,0,0.1)}input{width:100%;padding:11px;margin:7px 0;border:1px solid #ccc;border-radius:7px;box-sizing:border-box}button{width:100%;padding:12px;background:#6b2c1a;color:#fff;border:none;border-radius:7px;font-weight:bold;cursor:pointer}</style>
</head><body><div class="box"><h3>Register - Vaishanvi Arts</h3><?php if($msg) echo "<p style='color:red'>$msg</p>"; ?><form method="POST"><input type="text" name="name" placeholder="Full Name" required><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="New Password" required><button name="register">Register</button></form><p style="text-align:center"><a href="customer_login.php">Already have account? Login</a></p></div></body></html>