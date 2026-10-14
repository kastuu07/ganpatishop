<?php
session_start();
include("db.php");
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

function getImage($img){
  if(empty($img)) return "images/no-image.png";
  if(file_exists($img)) return $img;
  if(file_exists("uploads/".$img)) return "uploads/".$img;
  if(file_exists("images/".$img)) return "images/".$img;
  $name = basename($img);
  if(file_exists("uploads/".$name)) return "uploads/".$name;
  if(file_exists("images/".$name)) return "images/".$name;
  if(file_exists("admin/uploads/".$name)) return "admin/uploads/".$name;
  return $img;
}

if(isset($_GET['add'])){
  $id=intval($_GET['add']);
  if(isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]++;
  else $_SESSION['cart'][$id]=1;
  header("Location: index.php?added=1#collection"); exit;
}
$products = mysqli_query($con, "SELECT * FROM products ORDER BY id DESC");
$cart_count = array_sum($_SESSION['cart']);
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>Vaishanvi Arts - Home</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb} .top{background:#5a1e14;color:#fff;padding:10px 20px;display:flex;justify-content:space-between;align-items:center} .top a{color:#fff;text-decoration:none;margin-left:14px;font-size:13px;font-weight:bold} .banner{background:#5a1e14;color:#fff;text-align:center;padding:40px 20px} .btn{background:#fff;color:#5a1e14;padding:10px 20px;border-radius:20px;text-decoration:none;font-weight:bold;display:inline-block;margin:5px;border:1px solid #fff} .btn2{background:transparent;color:#fff;border:1px solid #fff} .grid{display:flex;flex-wrap:wrap;justify-content:center;gap:20px;padding:20px} .card{background:#fff;width:250px;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.1);text-align:center;padding-bottom:12px} .card img{width:100%;height:220px;object-fit:cover;background:#fff} .tag{position:absolute;color:#fff;font-size:11px;padding:3px 8px;border-radius:10px;margin:6px;font-weight:bold} .imgbox{position:relative;background:#fff} .addbtn{background:#5a1e14;color:#fff;border:none;padding:8px 16px;border-radius:20px;cursor:pointer;text-decoration:none;display:inline-block;margin-top:8px;font-size:13px}</style>
</head><body>

<div class="top">
<div>🙏 Vaishanvi Arts</div>
<div>
<a href="index.php">HOME</a>
<a href="products.php?type=all">MURTI</a>
<a href="products.php?type=accessories">ACCESSORIES</a>
<a href="cart.php">CART (<?php echo $cart_count; ?>)</a>
<a href="my_orders.php">MY ORDERS</a>
<?php if(isset($_SESSION['user_id'])) echo '<a href="logout.php">LOGOUT ('.$_SESSION['user_name'].')</a>'; else echo '<a href="customer_login.php">LOGIN</a>'; ?>
<a href="admin/">ADMIN</a>
</div>
</div>

<div class="banner">
<h1>🙏 Vaishanvi Arts 🙏</h1>
<p>Best POP & Eco-Friendly Murti in Kolhapur - Home Delivery Available</p>
<div>
<a class="btn" href="products.php">🛒 Shop Murti</a>
<a class="btn btn2" href="products.php?type=Eco-Friendly">🌱 Eco-Friendly</a>
</div>
</div>

<h3 id="collection" style="text-align:center;margin-top:20px">Latest Murti Collection - Vaishanvi Arts</h3>
<?php if(isset($_GET['added'])) echo "<p style='text-align:center;color:green;font-weight:bold'>✅ Added to Cart!</p>"; ?>

<div class="grid">
<?php while($row=mysqli_fetch_assoc($products)){
  $imgPath = getImage($row['image']);
?>
<div class="card">
<div class="imgbox">
<span class="tag" style="background:<?php echo $row['murti_type']=='POP'?'#e67e22':'#1e8449'; ?>"><?php echo $row['murti_type']; ?></span>
<img src="<?php echo $imgPath; ?>" alt="<?php echo $row['name']; ?>" onerror="this.src='images/no-image.png'">
</div>
<h4 style="margin:8px 0 2px"><?php echo $row['name']; ?></h4>
<p style="margin:2px;font-weight:bold">₹<?php echo $row['price']; ?></p>
<a class="addbtn" href="index.php?add=<?php echo $row['id']; ?>">Add to Cart</a>
</div>
<?php } ?>
</div>

</body></html>