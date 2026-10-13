<?php
session_start();
include("db.php");
include("config.php");
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$murtis = mysqli_query($con,"SELECT * FROM products ORDER BY id DESC LIMIT 6");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $SHOP_NAME; ?> - Home</title>
<style>
body{margin:0;font-family:Arial;background:#fdf6f0}
.topbar{background:#6b2c1a;color:#fff;padding:14px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;position:sticky;top:0;z-index:100}
.logo{font-weight:bold;font-size:18px;display:flex;align-items:center;gap:6px}
.menu{display:flex;gap:18px;flex-wrap:wrap;align-items:center}
.menu a{color:#fff;text-decoration:none;font-size:13px;font-weight:bold}
.menu a:hover{color:#ffcc80}
.banner{background:#7a2e14;color:#fff;text-align:center;padding:55px 20px}
.banner h1{margin:0;font-size:36px}
.banner p{margin:10px 0;font-size:15px;opacity:0.9}
.btn{display:inline-block;padding:10px 22px;border-radius:25px;text-decoration:none;font-weight:bold;font-size:14px;margin:8px 6px}
.white{background:#fff;color:#6b2c1a}.outline{border:2px solid #fff;color:#fff;background:transparent}
.container{max-width:1100px;margin:0 auto;padding:20px}
.title{text-align:center;color:#6b2c1a;font-weight:bold;font-size:18px;margin:25px 0 15px 0}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}
.card{background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);text-align:center}
.card img{width:100%;height:240px;object-fit:cover}
.card-body{padding:12px}
.badge{font-size:10px;padding:4px 10px;border-radius:12px;color:#fff;font-weight:bold;position:absolute;margin:8px}
.eco{background:#2e7d32}.pop{background:#ef6c00}
.img-wrap{position:relative}
.price{font-weight:bold;color:#6b2c1a;margin:6px 0}
.add{padding:7px 18px;background:#6b2c1a;color:#fff;border:none;border-radius:20px;font-size:12px;font-weight:bold;cursor:pointer;text-decoration:none;display:inline-block}
.viewall{text-align:center;margin:25px 0}
.viewall a{background:#6b2c1a;color:#fff;padding:12px 28px;border-radius:25px;text-decoration:none;font-weight:bold;font-size:14px}
</style></head><body>

<div class="topbar">
<div class="logo">🙏 <?php echo $SHOP_NAME; ?></div>
<div class="menu">
<a href="index.php">HOME</a>
<a href="murti.php">MURTI</a>
<a href="accessories.php">ACCESSORIES</a>
<a href="cart.php">CART (<?php echo $cartCount; ?>)</a>
<?php if(isset($_SESSION['user_id'])){ ?>
<a href="my_orders.php">MY ORDERS</a>
<a href="logout.php">LOGOUT (<?php echo $_SESSION['user_name']; ?>)</a>
<?php } else { ?>
<a href="login.php">LOGIN</a>
<?php } ?>
<a href="admin.php">ADMIN</a>
</div>
</div>

<div class="banner">
<h1>🙏 <?php echo $SHOP_NAME; ?> 🙏</h1>
<p>Best POP & Eco-Friendly Murti in Kolhapur - Home Delivery Available</p>
<div style="margin-top:18px">
<a href="murti.php" class="btn white">🛒 Shop Murti</a>
<a href="murti.php?type=Eco-Friendly" class="btn outline">🌱 Eco-Friendly</a>
</div>
</div>

<div class="container">
<div class="title">Latest Murti Collection - <?php echo $SHOP_NAME; ?></div>
<div class="grid">
<?php while($r=mysqli_fetch_assoc($murtis)){ ?>
<div class="card">
<div class="img-wrap">
<span class="badge <?php echo $r['murti_type']=='Eco-Friendly'?'eco':'pop'; ?>"><?php echo $r['murti_type']; ?></span>
<img src="uploads/<?php echo $r['image']; ?>">
</div>
<div class="card-body">
<b style="font-size:14px"><?php echo $r['name']; ?></b><br>
<div class="price">₹<?php echo $r['price']; ?></div>
<a href="add_to_cart.php?id=<?php echo $r['id']; ?>&type=murti" class="add">Add to Cart</a>
</div>
</div>
<?php } ?>
</div>
<div class="viewall"><a href="murti.php">View All Murti →</a></div>
</div>

</body></html>