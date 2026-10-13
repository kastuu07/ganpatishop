<?php session_start(); include("db.php");
$wish = mysqli_query($con,"SELECT * FROM wishlist ORDER BY id DESC");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#fff;padding:12px 20px;display:flex;justify-content:space-between}.header a{margin:0 8px;text-decoration:none;color:#333;font-weight:bold;font-size:13px}.grid{display:flex;flex-wrap:wrap;gap:18px;padding:20px;max-width:1100px;margin:auto}.card{background:#fff;width:240px;border-radius:12px;overflow:hidden;box-shadow:0 3px 10px rgba(0,0,0,.1);text-align:center;padding-bottom:12px}.card img{width:100%;height:200px;object-fit:cover}.btn{padding:6px 12px;border-radius:20px;text-decoration:none;display:inline-block;margin:4px;font-size:12px;font-weight:bold}.remove{background:#000;color:#fff}</style></head><body>
<div class="header"><div><b>Vaishnavi Arts</b></div><div><a href="home.php">HOME</a><a href="products.php">MURTI</a><a href="accessories.php">ACCESSORIES</a><a href="wishlist.php" style="color:#e91e63">❤️ WISHLIST</a></div></div>

<h2 style="max-width:1100px;margin:20px auto 0 auto;padding:0 20px;color:#6b2c1a">My Wishlist ❤️</h2>

<div class="grid">
<?php while($w=mysqli_fetch_assoc($wish)){
  if($w['item_type']=='accessory'){
    $item = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM accessories WHERE id=".$w['item_id']));
    if(!$item) continue;
?>
<div class="card">
<img src="uploads/<?php echo $item['image']; ?>">
<h4><?php echo $item['name']; ?></h4>
<p><b>₹<?php echo $item['price']; ?></b></p>
<p style="font-size:11px;background:#fff3cd;padding:3px 8px;border-radius:10px;display:inline-block">Size: Depends on Murti</p>
<p style="font-size:12px;padding:5px"><?php echo $item['description']; ?></p>
<a href="wishlist_remove.php?id=<?php echo $w['id']; ?>" class="btn remove">Remove</a>
</div>
<?php } else {
    $item = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM products WHERE id=".$w['item_id']));
    if(!$item) continue;
?>
<div class="card">
<img src="uploads/<?php echo $item['image']; ?>">
<h4><?php echo $item['name']; ?></h4>
<p><b>₹<?php echo $item['price']; ?> | <?php echo $item['size']; ?></b></p>
<a href="wishlist_remove.php?id=<?php echo $w['id']; ?>" class="btn remove">Remove</a>
</div>
<?php } } ?>
</div>
</body></html>