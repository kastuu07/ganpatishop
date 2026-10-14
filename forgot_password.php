<?php
session_start();
include("db.php");
$msg="";
if(isset($_POST['check'])){
  $email = mysqli_real_escape_string($con, trim($_POST['email']));
  $q = mysqli_query($con, "SELECT * FROM users WHERE email='$email' LIMIT 1");
  if(mysqli_num_rows($q)==1){
    $_SESSION['reset_email'] = $email;
    header("Location: reset_password.php");
    exit;
  } else {
    $msg = "Email not found!";
  }
}
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Forgot Password</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:380px;padding:28px;border-radius:16px;box-shadow:0 8px 25px rgba(0,0,0,.12);text-align:center}input{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{width:100%;padding:12px;background:#6b2c1a;color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer}.error{color:red;font-size:13px}</style>
</head><body>
<div class="box">
<h3>🔑 Forgot Password - Vaishanvi Arts</h3>
<?php if($msg) echo "<div class='error'>$msg</div>"; ?>
<form method="POST">
<input type="email" name="email" placeholder="Enter registered email" required>
<button name="check" class="btn">Verify Email</button>
</form>
<p><a href="customer_login.php" style="color:#6b2c1a;text-decoration:none">← Back to Login</a></p>
</div></body></html>