<?php session_start(); include("db.php");
if(isset($_POST['login'])){
 $email=$_POST['email']; $pass=$_POST['password'];
 $res=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$pass'");
 if(mysqli_num_rows($res)==1){ $_SESSION['user']=$email; header("Location: home.php"); }
 else{ $error="Wrong Email or Password"; }
}
?>
<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Arial;background:#f0eeea;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
.box{background:#fff;padding:30px;border-radius:10px;box-shadow:0 5px 20px rgba(0,0,0,0.1);width:320px}
h2{color:#6b2c1a;text-align:center} input{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:5px;box-sizing:border-box}
.btn{width:100%;background:#6b2c1a;color:#fff;padding:10px;border:none;border-radius:5px;font-weight:bold;cursor:pointer}
</style></head><body>
<div class="box">
<h2>👤 Customer Login</h2>
<?php if(isset($error)) echo "<p style='color:red;text-align:center'>$error</p>"; ?>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button class="btn" name="login">Login</button>
</form>
<p style="text-align:center;font-size:13px">No account? <a href="register.php">Register</a></p>
<p style="text-align:center"><a href="home.php">← Back to Home</a></p>
</div>
</body></html>