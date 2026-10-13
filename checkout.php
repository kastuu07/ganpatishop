<?php session_start(); include("db.php");
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }
if(empty($_SESSION['cart'])){ header("Location: cart.php"); exit; }
$total=0; foreach($_SESSION['cart'] as $c){ $total+=$c['price']; }
if(isset($_POST['continue_payment'])){
 $uid=$_SESSION['user_id'];
 $address=mysqli_real_escape_string($con,$_POST['address']);
 $phone=mysqli_real_escape_string($con,$_POST['phone']);
 // Create order in pending payment status
 mysqli_query($con,"INSERT INTO orders(user_id,total,address,phone,status,payment_status) VALUES($uid,$total,'$address','$phone','Pending','Pending')");
 $order_id=mysqli_insert_id($con);
 foreach($_SESSION['cart'] as $c){
   $name=mysqli_real_escape_string($con,$c['name']);
   $size=mysqli_real_escape_string($con,$c['size']);
   mysqli_query($con,"INSERT INTO order_items(order_id,item_type,item_id,name,price,size) VALUES($order_id,'{$c['type']}',{$c['id']},'$name',{$c['price']},'$size')");
 }
 header("Location: payment.php?order_id=$order_id");
 exit;
}
$user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id=".$_SESSION['user_id']));
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.box{max-width:500px;margin:30px auto;background:#fff;padding:25px;border-radius:14px}input,textarea{width:100%;padding:11px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;cursor:pointer}</style></head><body>
<div class="box">
<h2 style="color:#6b2c1a;text-align:center">Book Your Order 📦</h2>
<p>Total: <b>₹<?php echo $total; ?></b> | Items: <?php echo count($_SESSION['cart']); ?></p>
<form method="POST">
<input type="text" value="<?php echo $user['name']; ?>" readonly>
<input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>" placeholder="Phone" required>
<textarea name="address" rows="4" placeholder="House No, Street, Kolhapur, Pincode" required></textarea>
<button name="continue_payment" class="btn">Continue to Payment - ₹<?php echo $total; ?></button>
</form>
</div></body></html>