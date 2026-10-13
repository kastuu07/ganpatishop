<?php session_start();
if(isset($_SESSION['admin'])){ header("Location: dashboard.php"); exit; }
if(isset($_POST['login'])){
 if($_POST['username']=='admin' && $_POST['password']=='admin123'){
   $_SESSION['admin']='admin'; 
   header("Location: dashboard.php"); exit;
 } else { $msg="❌ Wrong Username or Password!"; }
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea;display:flex;justify-content:center;align-items:center;min-height:100vh}.box{background:#fff;width:350px;padding:25px;border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,.1)}input{width:100%;padding:11px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold}</style></head><body>
<div class="box">
<h2 style="text-align:center">🔒 Admin Login</h2>
<?php if(isset($msg)) echo "<p style='background:#f8d7da;color:#721c24;padding:8px;text-align:center;border-radius:6px'>$msg</p>"; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required value="admin">
<input type="password" name="password" placeholder="Password" required>
<button name="login" class="btn">Login</button>
</form>
<p style="text-align:center;font-size:13px"><a href="products.php">← Back to Shop</a></p>
</div></body></html>