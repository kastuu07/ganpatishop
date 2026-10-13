<?php
session_start();
include("db.php");
@include("config.php");
if(!isset($SHOP_NAME)) $SHOP_NAME="Vaishanvi Arts";
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$q = mysqli_query($con,"SELECT * FROM accessories ORDER BY id DESC");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Accessories - <?php echo $SHOP_NAME; ?></title>
<style>body{margin:0;font-family:Arial;background:#fdf6f0}.topbar{background:#6b2c1a;color:#fff;padding:14px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}.logo{font-weight:bold;font-size:18px}.menu{display:flex;gap:18px;flex-wrap:wrap}.menu a{color:#fff;text-decoration:none;font-size:13px;font-weight:bold}.container{max-width:1100px;margin:0 auto;padding:20px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}.card{background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);text-align:center}.card img{width:100%;height:240px;object-fit:cover}.card-body{padding:12px}.price{font-weight:bold;color:#6b2c1a;margin:6px 0}.add{padding:7px 18px;background:#6b2c1a;color:#fff;border:none;border-radius:20px;font-size:12px;font-weight:bold;text-decoration:none;display:inline-block}</style>
</head><body>
<div class="topbar">
<div class="logo">🙏 <?php echo $SHOP_NAME; ?></div>
<div class="menu"><a href="index.php">HOME</a><a href="murti.php">MURTI</a><a href="accessories.php">ACCESSORIES</a><a href="cart.php">CART (<?php echo $cartCount; ?>)</a><?php if(isset($_SESSION['user_id'])){ ?><a href="my_orders.php">MY ORDERS</a><a href="logout.php">LOGOUT</a><?php } else { ?><a href="login.php">LOGIN</a><?php } ?><a href="admin.php">ADMIN</a></div>
</div>
<div class="container"><h2 style="text-align:center;color:#6b2c1a">Pooja Accessories - <?php echo $SHOP_NAME; ?></h2><div class="grid">
<?php while($r=mysqli_fetch_assoc($q)){ ?>
<div class="card"><img src="uploads/<?php echo $r['image']; ?>"><div class="card-body"><b><?php echo $r['name']; ?></b><div class="price">₹<?php echo $r['price']; ?></div><a href="add_to_cart.php?id=<?php echo $r['id']; ?>&type=accessory" class="add">Add to Cart</a></div></div>
<?php } ?></div></div>
</body></html>