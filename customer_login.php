<?php
session_start();
include("db.php");
$msg="";
if(isset($_GET['reset'])) $msg = "<span style='color:green'>✅ Password Updated! Login now.</span>";
if(isset($_GET['registered'])) $msg = "<span style='color:green'>✅ Registered! Please login.</span>";

if(isset($_POST['login'])){
  $email = mysqli_real_escape_string($con, trim($_POST['email']));
  $pass = trim($_POST['password']);
  $q = mysqli_query($con, "SELECT * FROM users WHERE email='$email' LIMIT 1");
  if(mysqli_num_rows($q)==1){
    $user = mysqli_fetch_assoc($q);
    if(password_verify($pass, $user['password']) || $pass === $user['password']){
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      header("Location: index.php"); exit;
    } else { $msg = "Wrong Email or Password"; }
  } else { $msg = "Wrong Email or Password"; }
}
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login - Vaishanvi Arts</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:380px;padding:28px;border-radius:16px;box-shadow:0 8px 25px rgba(0,0,0,.12);text-align:center}input{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{width:100%;padding:12px;background:#6b2c1a;color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer;margin-top:8px}a{color:#6b2c1a;text-decoration:none;font-size:14px}.error{color:#d93025;font-size:13px;margin-bottom:10px}</style>
</head><body>
<div class="box">
<h3>👤 Customer Login</h3>
<?php if($msg) echo "<div class='error'>$msg</div>"; ?>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login" class="btn">Login</button>
</form>
<p><a href="forgot_password.php" style="color:#c0392b;font-weight:bold">Forgot Password?</a></p>
<p>No account? <a href="customer_register.php">Register</a><br><a href="index.php">← Back to Home</a></p>
</div></body></html>