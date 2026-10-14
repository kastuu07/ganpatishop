<?php
session_start();
include("db.php");
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

// ADD TO CART
if(isset($_GET['add'])){
  $id = intval($_GET['add']);
  $q = mysqli_query($con, "SELECT * FROM products WHERE id=$id");
  if(mysqli_num_rows($q)>0){
    if(isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]++;
    else $_SESSION['cart'][$id]=1;
    header("Location: products.php?added=1");
    exit;
  }
}

// FILTER by murti_type
$filter = "";
if(isset($_GET['type']) && $_GET['type']!='all'){
  $type = mysqli_real_escape_string($con, $_GET['type']);
  $filter = "WHERE murti_type='$type'";
}
$products = mysqli_query($con, "SELECT * FROM products $filter ORDER BY id DESC");
$cart_count = array_sum($_SESSION['cart']);
if(!$products){ die("Query Error: ".mysqli_error($con)); }
?>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Ganpati Shop</title>
<style>body{margin:0;font-family:Arial;background:#f5f0eb} .nav{background:#5a2a22;color:#fff;padding:12px 20px;display:flex;justify-content:space-between} .nav a{color:#fff;text-decoration:none;margin-left:14px;font-weight:bold} .filters{text-align:center;padding:15px} .filters a{padding:8px 16px;border:1px solid #5a2a22;border-radius:20px;margin:5px;text-decoration:none;color:#5a2a22;display:inline-block} .filters a.active{background:#5a2a22;color:#fff} .grid{display:flex;flex-wrap:wrap;justify-content:center;gap:20px;padding:20px} .card{background:#fff;width:240px;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.1);text-align:center;padding-bottom:12px} .card img{width:100%;height:210px;object-fit:cover} .btn{background:#5a2a22;color:#fff;border:none;padding:8px 16px;border-radius:20px;cursor:pointer;text-decoration:none;display:inline-block;margin-top:8px} .tag{position:absolute;color:#fff;font-size:11px;padding:3px 8px;border-radius:10px;margin:6px;font-weight:bold} .imgbox{position:relative}</style>
</head><body>

<div class="nav">
<div>🙏 Ganpati Shop</div>
<div>
<a href="products.php?type=all">MURTI</a>
<a href="products.php">ACCESSORIES</a>
<a href="cart.php">CART (<?php echo $cart_count; ?>)</a>
<?php if(isset($_SESSION['user_id'])) echo '<a href="logout.php">Logout</a>'; else echo '<a href="customer_login.php">Login</a>'; ?>
</div>
</div>

<div class="filters">
<a href="products.php?type=all" class="<?php if(!isset($_GET['type']) || $_GET['type']=='all') echo 'active'; ?>">All Murti</a>
<a href="products.php?type=Eco-Friendly" class="<?php if(isset($_GET['type']) && $_GET['type']=='Eco-Friendly') echo 'active'; ?>">🌱 Eco-Friendly</a>
<a href="products.php?type=POP" class="<?php if(isset($_GET['type']) && $_GET['type']=='POP') echo 'active'; ?>">POP</a>
</div>

<?php if(isset($_GET['added'])) echo "<p style='text-align:center;color:green;font-weight:bold'>✅ Added to Cart!</p>"; ?>

<div class="grid">
<?php while($row=mysqli_fetch_assoc($products)){ 
  $img = $row['image'];
  // fix image path - your images are in uploads/ or root
  if(!file_exists($img) && file_exists("uploads/".$img)) $img = "uploads/".$img;
  if(!file_exists($img) && file_exists("images/".$img)) $img = "images/".$img;
?>
<div class="card">
<div class="imgbox">
<span class="tag" style="background:<?php echo $row['murti_type']=='POP'?'#ff8c00':'#2e8b57'; ?>"><?php echo $row['murti_type']; ?></span>
<img src="<?php echo $img; ?>" alt="<?php echo $row['name']; ?>">
</div>
<h4 style="margin:8px 0 4px"><?php echo $row['name']; ?></h4>
<p style="margin:4px;font-size:14px">₹<?php echo $row['price']; ?> | Stock: <?php echo $row['stock']; ?></p>
<p style="margin:0;font-size:12px;color:#777"><?php echo $row['size']; ?></p>
<a class="btn" href="products.php?add=<?php echo $row['id']; ?><?php if(isset($_GET['type'])) echo '&type='.$_GET['type']; ?>">Add to Cart</a>
</div>
<?php } ?>
</div>

</body></html>