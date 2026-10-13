<?php
session_start();
include("db.php");

// If already logged in, go to dashboard
if(isset($_SESSION['admin'])){
 header("Location: dashboard.php");
 exit;
}

$msg = "";
if(isset($_POST['login'])){
 $user = $_POST['username'];
 $pass = $_POST['password'];
 // Default admin password
 if($user == 'admin' && $pass == 'admin123'){
   $_SESSION['admin'] = 'admin';
   header("Location: dashboard.php");
   exit;
 } else {
   $msg = "❌ Wrong Username or Password! Use admin / admin123";
 }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login - Ganpati Shop</title>
<style>
body{margin:0;font-family:Arial;background:#f0eeea;display:flex;justify-content:center;align-items:center;min-height:100vh}
.box{background:#fff;width:360px;padding:25px;border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,0.1);text-align:center}
input{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}
.btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;cursor:pointer;font-size:15px}
a{color:#6b2c1a;text-decoration:none;font-weight:bold;font-size:13px}
</style>
</head>
<body>
<div class="box">
<h2 style="color:#6b2c1a">🔒 Admin Login</h2>
<p style="font-size:13px;color:#555">Ganpati Shop Admin Panel</p>

<?php if($msg){ echo "<p style='background:#f8d7da;color:#721c24;padding:10px;border-radius:8px;font-size:13px'>$msg</p>"; } ?>

<form method="POST">
<input type="text" name="username" placeholder="Username" value="admin" required>
<input type="password" name="password" placeholder="Password - admin123" required>
<button name="login" class="btn">Login</button>
</form>

<br>
<p><a href="products.php">← Go to Shop</a></p>
<p style="font-size:12px;color:#888">Default: admin / admin123</p>
</div>
</body>
</html>