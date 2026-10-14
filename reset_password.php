<?php
session_start();
include("db.php");
if(!isset($_SESSION['reset_email'])){ header("Location: forgot_password.php"); exit; }
$msg="";
if(isset($_POST['reset'])){
  $new = $_POST['new_password'];
  $confirm = $_POST['confirm_password'];
  if($new != $confirm){ $msg="Passwords do not match!"; }
  else {
    $email = $_SESSION['reset_email'];
    $hash = password_hash($new, PASSWORD_DEFAULT);
    mysqli_query($con, "UPDATE users SET password='$hash' WHERE email='$email'");
    unset($_SESSION['reset_email']);
    header("Location: customer_login.php?reset=1");
    exit;
  }
}
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>Reset Password</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:380px;padding:28px;border-radius:16px;box-shadow:0 8px 25px rgba(0,0,0,.12);text-align:center}input{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{width:100%;padding:12px;background:#6b2c1a;color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer}.error{color:red;font-size:13px}</style>
</head><body>
<div class="box">
<h3>🔒 Reset Password</h3>
<p>For: <b><?php echo $_SESSION['reset_email']; ?></b></p>
<?php if($msg) echo "<div class='error'>$msg</div>"; ?>
<form method="POST">
<input type="password" name="new_password" placeholder="New Password" required>
<input type="password" name="confirm_password" placeholder="Confirm Password" required>
<button name="reset" class="btn">Update Password</button>
</form>
</div></body></html>