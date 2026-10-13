<?php
session_start();
include("db.php");
$msg=""; $step=1; $user=null;

if(isset($_POST['check_user'])){
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $q=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
  if(mysqli_num_rows($q)>0){
    $user=mysqli_fetch_assoc($q);
    $step=2;
    $_SESSION['forgot_email']=$email;
    $_SESSION['forgot_user']=$user;
  } else {
    $msg="❌ Email not found! Please check or Register.";
  }
}

if(isset($_POST['verify_phone'])){
  $phone=mysqli_real_escape_string($con,$_POST['phone']);
  $user=$_SESSION['forgot_user'];
  if($user['phone']==$phone){
    $step=3;
  } else {
    $msg="❌ Phone number does not match!";
    $step=2;
    $user=$_SESSION['forgot_user'];
  }
}

if(isset($_POST['reset_pass'])){
  $pass=mysqli_real_escape_string($con,$_POST['password']);
  $email=$_SESSION['forgot_email'];
  $hashed=password_hash($pass, PASSWORD_DEFAULT);
  // If you use plain password (not hash), use this line instead:
  // mysqli_query($con,"UPDATE users SET password='$pass' WHERE email='$email'");
  mysqli_query($con,"UPDATE users SET password='$hashed' WHERE email='$email'");
  $msg="✅ Password Reset Successfully! Now Login.";
  $step=4;
  unset($_SESSION['forgot_email']);
  unset($_SESSION['forgot_user']);
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:Arial;background:#f5f0eb;display:flex;justify-content:center;align-items:center;min-height:100vh}
.box{background:#fff;width:380px;padding:25px;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.1)}
.header{background:#6b2c1a;color:#fff;padding:12px;text-align:center;border-radius:12px 12px 0 0;margin:-25px -25px 20px -25px}
input{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}
.btn{width:100%;padding:12px;background:#6b2c1a;color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer;margin-top:10px}
.btn2{background:#000}
a{color:#6b2c1a;text-decoration:none;font-weight:bold}
.msg{padding:10px;border-radius:8px;text-align:center;margin-bottom:10px}
.error{background:#f8d7da;color:#721c24}.success{background:#d4edda;color:#155724}
</style></head><body>
<div class="box">
<div class="header"><h3 style="margin:0">🔑 Forgot Password?</h3></div>

<?php if($msg) echo "<div class='msg ".(strpos($msg,'✅')!==false?'success':'error')."'>$msg</div>"; ?>

<?php if($step==1){ ?>
<p>Enter your registered Email to reset password</p>
<form method="POST">
<input type="email" name="email" placeholder="Enter Your Email (e.g. vedika@gmail.com)" required>
<button name="check_user" class="btn">Next →</button>
</form>
<p style="text-align:center"><a href="login.php">← Back to Login</a> | <a href="register.php">Register</a></p>

<?php } elseif($step==2){ ?>
<p>Hi <b><?php echo $user['name']; ?></b>! Verify your phone number</p>
<p style="font-size:13px;color:#666">Email: <?php echo $user['email']; ?></p>
<form method="POST">
<input type="text" name="phone" placeholder="Enter Your Phone: <?php echo substr($user['phone'],0,2).'XXXXXX'.substr($user['phone'],-2); ?>" required>
<button name="verify_phone" class="btn">Verify Phone →</button>
</form>

<?php } elseif($step==3){ ?>
<p>✅ Phone Verified! Now create new password</p>
<form method="POST">
<input type="password" name="password" placeholder="New Password" required minlength="4">
<input type="password" name="cpassword" placeholder="Confirm New Password" required oninput="if(this.value!=this.form.password.value){this.setCustomValidity('Password not matching')}else{this.setCustomValidity('')}">
<button name="reset_pass" class="btn" style="background:#28a745">✅ Reset Password</button>
</form>

<?php } elseif($step==4){ ?>
<div style="text-align:center;padding:20px">
<h2 style="color:#28a745">Done!</h2>
<a href="login.php" class="btn" style="display:inline-block;text-align:center;text-decoration:none;padding:12px 30px">Go to Login →</a>
</div>
<?php } ?>

</div>
</body></html>