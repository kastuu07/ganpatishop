<?php
session_start();
include("db.php");
@include("config.php");
if(!isset($SHOP_NAME)) $SHOP_NAME="Vaishanvi Arts";
$msg="";
if(isset($_POST['register'])){
  $name=mysqli_real_escape_string($con,$_POST['name']); $email=mysqli_real_escape_string($con,$_POST['email']); $phone=mysqli_real_escape_string($con,$_POST['phone']); $pass=$_POST['password'];
  $check=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
  if(mysqli_num_rows($check)>0) $msg="❌ Email already registered!";
  else { $hashed=password_hash($pass, PASSWORD_DEFAULT); $q=mysqli_query($con,"INSERT INTO users(name,email,phone,password) VALUES('$name','$email','$phone','$hashed')"); if($q) $msg="✅ Registered! Now Login."; else $msg="❌ Error: Make password column VARCHAR(255)"; }
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Register - <?php echo $SHOP_NAME; ?></title><style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:390px;padding:30px;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,0.12)}h2{text-align:center;color:#6b2c1a}input{width:100%;padding:13px;margin:8px 0;border:1px solid #ddd;border-radius:10px;box-sizing:border-box}.btn{width:100%;padding:13px;background:#6b2c1a;color:#fff;border:none;border-radius:10px;font-weight:bold;cursor:pointer}.msg{padding:10px;border-radius:8px;text-align:center;margin-bottom:12px;font-size:13px}</style></head><body><div class="box"><h2>🙏 Join <?php echo $SHOP_NAME; ?></h2><?php if($msg) echo "<div class='msg' style='background:".(strpos($msg,'✅')!==false?'#d4edda':'#f8d7da')."'>$msg</div>"; ?><form method="POST"><input type="text" name="name" placeholder="Full Name" required><input type="email" name="email" placeholder="Email" required><input type="text" name="phone" placeholder="Phone" required><input type="password" name="password" placeholder="Password" required><button name="register" class="btn">Register →</button></form><p style="text-align:center;font-size:13px">Already have account? <a href="login.php">Login</a> | <a href="index.php">Home</a></p></div></body></html>