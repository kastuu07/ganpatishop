<?php
session_start();
include("db.php");
@include("config.php");
if(!isset($SHOP_NAME)) $SHOP_NAME="Vaishanvi Arts";
$msg="";
if(isset($_POST['login'])){
  $email=mysqli_real_escape_string($con, trim($_POST['email']));
  $pass=trim($_POST['password']);
  $q=mysqli_query($con,"SELECT * FROM users WHERE email='$email' LIMIT 1");
  if(mysqli_num_rows($q)==1){
    $user=mysqli_fetch_assoc($q);
    if(password_verify($pass, $user['password']) || $pass === $user['password']){
      $_SESSION['user_id']=$user['id']; $_SESSION['user_name']=$user['name']; $_SESSION['user_email']=$user['email'];
      header("Location: index.php"); exit;
    } else $msg="❌ Wrong Password!";
  } else $msg="❌ Email not found!";
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login - <?php echo $SHOP_NAME; ?></title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:390px;padding:30px;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,0.12)}h2{text-align:center;color:#6b2c1a;margin:0 0 5px 0}.sub{text-align:center;color:#888;font-size:13px;margin-bottom:15px}input{width:100%;padding:13px;margin:8px 0;border:1px solid #ddd;border-radius:10px;box-sizing:border-box}.btn{width:100%;padding:13px;background:#6b2c1a;color:#fff;border:none;border-radius:10px;font-weight:bold;cursor:pointer;margin-top:10px}.msg{padding:10px;border-radius:8px;text-align:center;margin-bottom:12px;font-size:13px;background:#f8d7da;color:#721c24}</style></head><body>
<div class="box"><h2>🙏 <?php echo $SHOP_NAME; ?></h2><div class="sub">Login to <?php echo $SHOP_NAME; ?></div><?php if($msg) echo "<div class='msg'>$msg</div>"; ?><form method="POST"><input type="email" name="email" placeholder="📧 Email" required><input type="password" name="password" placeholder="🔒 Password" required><button name="login" class="btn">Login →</button></form><p style="text-align:center;margin-top:15px;font-size:13px">No account? <a href="register.php" style="color:#6b2c1a;font-weight:bold">Create New</a> | <a href="index.php">Home</a></p></div></body></html>