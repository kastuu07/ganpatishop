<?php
session_start();
include("db.php");
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

function getImage($img){
  if(empty($img)) return "images/default.jpg";
  if(file_exists($img)) return $img;
  if(file_exists("uploads/".$img)) return "uploads/".$img;
  if(file_exists("images/".$img)) return "images/".$img;
  $name = basename($img);
  if(file_exists("uploads/".$name)) return "uploads/".$name;
  if(file_exists("images/".$name)) return "images/".$name;
  return $img;
}

if(isset($_GET['remove'])){
  $id=intval($_GET['remove']);
  unset($_SESSION['cart'][$id]);
  header("Location: cart.php"); exit;
}
if(isset($_GET['clear'])){ $_SESSION['cart']=[]; header("Location: cart.php"); exit; }
$total=0;
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>Cart</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb} .box{max-width:750px;margin:20px auto;background:#fff;padding:20px;border-radius:12px} table{width:100%;border-collapse:collapse} th,td{padding:10px;border-bottom:1px solid #ddd;text-align:center} .btn{padding:10px 18px;border-radius:8px;text-decoration:none;display:inline-block;font-weight:bold} .buy{background:#5a2a22;color:#fff} .clear{background:#e0e0e0;color:#000} .nav{background:#5a2a22;color:#fff;padding:12px 20px;display:flex;justify-content:space-between} .nav a{color:#fff;text-decoration:none;margin-left:12px}</style>
</head><body>
<div class="nav"><div>Cart</div><div><a href="products.php">Products</a></div></div>
<div class="box">
<h3>🛒 Your Cart</h3>
<?php if(empty($_SESSION['cart'])){ echo "<p>Cart is empty! <a href='products.php'>Buy</a></p>"; } else { ?>
<table>
<tr><th>Image</th><th>Name</th><th>Price</th><th>Qty</th><th>Total</th><th>Action</th></tr>
<?php
foreach($_SESSION['cart'] as $id=>$qty){
  $q=mysqli_query($con,"SELECT * FROM products WHERE id=$id");
  $p=mysqli_fetch_assoc($q);
  if(!$p) continue;
  $sub=$p['price']*$qty; $total+=$sub;
  $imgPath = getImage($p['image']);
  echo "<tr><td><img src='$imgPath' width='65' height='65' style='object-fit:cover;border-radius:8px' onerror=\"this.src='images/no-image.png'\"></td><td>{$p['name']}</td><td>₹{$p['price']}</td><td>$qty</td><td>₹$sub</td><td><a href='cart.php?remove=$id' style='color:red'>Remove</a></td></tr>";
}
?>
</table>
<h3 style="text-align:right">Total: ₹<?php echo $total; ?></h3>
<p style="text-align:right"><a class="btn clear" href="cart.php?clear=1">Clear Cart</a> <a class="btn buy" href="checkout.php">Buy Now</a></p>
<?php } ?>
</div></body></html>