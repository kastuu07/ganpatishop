<?php session_start(); include("db.php");
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

if(isset($_GET['remove'])){
 $i=$_GET['remove'];
 unset($_SESSION['cart'][$i]);
 $_SESSION['cart']=array_values($_SESSION['cart']);
 header("Location: cart.php"); exit;
}
$total=0; foreach($_SESSION['cart'] as $c){ $total+=$c['price']; }
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#fff;padding:12px 20px;display:flex;justify-content:space-between}.header a{margin:0 7px;text-decoration:none;color:#333;font-weight:bold;font-size:13px}.box{max-width:800px;margin:20px auto;background:#fff;padding:20px;border-radius:14px}.item{display:flex;gap:15px;border-bottom:1px solid #eee;padding:15px 0;align-items:center}.item img{width:80px;height:80px;object-fit:cover;border-radius:10px}.info{flex:1}.btn{padding:8px 14px;border-radius:20px;text-decoration:none;font-weight:bold;font-size:12px;display:inline-block}.btn-remove{background:#000;color:#fff}.btn-book{background:#6b2c1a;color:#fff;padding:12px 30px;font-size:14px;border:none;cursor:pointer}.btn-shop{background:#e0e0e0;color:#333}</style></head><body>
<div class="header"><div><b>Ganpati Shop</b></div><div><a href="products.php">MURTI</a><a href="accessories.php">ACCESSORIES</a><a href="cart.php" style="color:#6b2c1a">🛒 CART (<?php echo count($_SESSION['cart']); ?>)</a><a href="my_orders.php">MY ORDERS</a><a href="logout.php">LOGOUT</a></div></div>

<div class="box">
<h2 style="color:#6b2c1a">Your Cart 🛒</h2>
<?php if(empty($_SESSION['cart'])){ echo "<p>Cart is Empty! <a href='products.php'>Shop Now</a></p>"; } else { ?>
<?php foreach($_SESSION['cart'] as $i=>$c){ ?>
<div class="item">
<img src="uploads/<?php echo $c['image']; ?>">
<div class="info">
<b><?php echo $c['name']; ?></b><br>
<small>₹<?php echo $c['price']; ?> | 📏 <?php echo $c['size']; ?></small><br>
<small style="color:#666"><?php echo $c['type']=='murti'?'Ganesh Murti':'Accessory'; ?></small>
</div>
<a href="cart.php?remove=<?php echo $i; ?>" class="btn btn-remove">Remove</a>
</div>
<?php } ?>
<hr>
<h3>Total: ₹<?php echo $total; ?></h3>
<a href="products.php" class="btn btn-shop">Continue Shopping</a>
<a href="checkout.php" class="btn btn-book">📦 Book Now</a>
<?php } ?>
</div>
</body></html>