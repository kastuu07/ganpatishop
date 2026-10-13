<?php session_start(); include("db.php");
$filter = isset($_GET['type']) ? mysqli_real_escape_string($con,$_GET['type']) : '';
if($filter){ $products = mysqli_query($con,"SELECT * FROM products WHERE stock > 0 AND murti_type='$filter' ORDER BY id DESC"); }
else { $products = mysqli_query($con,"SELECT * FROM products WHERE stock > 0 ORDER BY id DESC"); }
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between;flex-wrap:wrap}.header a{color:#fff;text-decoration:none;margin:0 8px;font-weight:bold;font-size:13px}.filter{text-align:center;padding:15px}.filter a{padding:8px 18px;border-radius:20px;text-decoration:none;font-weight:bold;margin:5px;display:inline-block;border:2px solid #6b2c1a}.active{background:#6b2c1a;color:#fff}.inactive{background:#fff;color:#6b2c1a}.grid{display:flex;flex-wrap:wrap;gap:15px;padding:15px;justify-content:center}.card{background:#fff;width:200px;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1);text-align:center;padding-bottom:10px;position:relative}.badge{position:absolute;top:8px;left:8px;padding:4px 10px;border-radius:15px;font-size:10px;font-weight:bold;color:#fff}.eco{background:#2e7d32}.pop{background:#ef6c00}.card img{width:100%;height:180px;object-fit:cover}.btn{background:#6b2c1a;color:#fff;padding:7px 12px;border-radius:20px;text-decoration:none;font-size:12px;display:inline-block;margin:3px}</style></head><body>
<div class="header"><div><b>🙏 Ganpati Shop</b></div><div><a href="products.php">MURTI</a><a href="accessories.php">ACCESSORIES</a><a href="cart.php">CART (<?php echo isset($_SESSION['cart'])?count($_SESSION['cart']):0; ?>)</a><?php if(isset($_SESSION['user_id'])){ ?><a href="my_orders.php">MY ORDERS</a><a href="logout.php">LOGOUT</a><?php } else { ?><a href="login.php">LOGIN</a><?php } ?></div></div>

<div class="filter">
<a href="products.php" class="<?php echo $filter==''?'active':'inactive'; ?>">All Murti</a>
<a href="products.php?type=Eco-Friendly" class="<?php echo $filter=='Eco-Friendly'?'active':'inactive'; ?>">🌱 Eco-Friendly</a>
<a href="products.php?type=POP" class="<?php echo $filter=='POP'?'active':'inactive'; ?>">🎨 POP</a>
</div>

<div class="grid">
<?php while($r=mysqli_fetch_assoc($products)){ $isEco = ($r['murti_type']=='Eco-Friendly'); ?>
<div class="card">
<div class="badge <?php echo $isEco?'eco':'pop'; ?>"><?php echo $r['murti_type']; ?></div>
<img src="uploads/<?php echo $r['image']; ?>">
<h4 style="margin:8px 0"><?php echo $r['name']; ?></h4>
<p>₹<?php echo $r['price']; ?> | Stock: <?php echo $r['stock']; ?></p>
<a href="add_to_cart.php?type=murti&id=<?php echo $r['id']; ?>" class="btn">Add to Cart</a>
</div>
<?php } ?>
</div>
</body></html>