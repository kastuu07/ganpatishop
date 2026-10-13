<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit; }
include("db.php");

if(isset($_GET['delete']) && isset($_GET['type'])){
  $id=(int)$_GET['delete'];
  if($_GET['type']=='murti'){ mysqli_query($con,"DELETE FROM products WHERE id=$id"); }
  else { mysqli_query($con,"DELETE FROM accessories WHERE id=$id"); }
  header("Location: admin_stock.php"); exit;
}
if(isset($_POST['update'])){
  $id=(int)$_POST['id']; $stock=(int)$_POST['stock']; $type=$_POST['type'];
  if($type=='murti') mysqli_query($con,"UPDATE products SET stock=$stock WHERE id=$id");
  else mysqli_query($con,"UPDATE accessories SET stock=$stock WHERE id=$id");
}
$products=mysqli_query($con,"SELECT * FROM products ORDER BY id DESC");
$acc=mysqli_query($con,"SELECT * FROM accessories ORDER BY id DESC");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:Arial;background:#f5f0eb}
.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0}
.header a{color:#fff;text-decoration:none;font-weight:bold;margin:0 8px;font-size:14px}
.container{max-width:900px;margin:20px auto;padding:10px}
.card-box{background:#fff;border-radius:16px;padding:15px;margin-bottom:25px;box-shadow:0 4px 12px rgba(0,0,0,0.08)}
.card-box h3{margin:0 0 15px 0;color:#6b2c1a;border-bottom:2px solid #f0e0d0;padding-bottom:8px}
.item{display:flex;align-items:center;gap:12px;padding:12px;border-bottom:1px solid #eee;flex-wrap:wrap}
.item:last-child{border:none}
.item img{width:60px;height:60px;border-radius:10px;object-fit:cover;border:1px solid #ddd}
.info{flex:1;min-width:140px}
.info b{font-size:14px}
.badge{font-size:10px;color:#fff;padding:3px 8px;border-radius:12px;display:inline-block;margin-top:4px}
.eco{background:#2e7d32}.pop{background:#ef6c00}
.stock-form{display:flex;align-items:center;gap:6px}
.stock-form input{width:60px;padding:8px;border:1px solid #ccc;border-radius:8px;text-align:center}
.btn{padding:7px 12px;border-radius:20px;text-decoration:none;color:#fff;font-size:12px;font-weight:bold;display:inline-block;border:none;cursor:pointer}
.edit{background:#ff9800}.delete{background:#d32f2f}.save{background:#6b2c1a}
.price{font-weight:bold;color:#6b2c1a;min-width:60px;text-align:right}
</style></head><body>
<div class="header">
<div><a href="dashboard.php">← DASHBOARD</a> Stock Manager</div>
<div><a href="admin_add.php">+ ADD</a> <a href="index.php" target="_blank">HOME</a></div>
</div>

<div class="container">

<div class="card-box">
<h3>🙏 Murti Stock - Edit / Delete (<?php echo mysqli_num_rows($products); ?>)</h3>
<?php while($r=mysqli_fetch_assoc($products)){ ?>
<div class="item">
<img src="uploads/<?php echo $r['image']; ?>">
<div class="info">
<b><?php echo $r['name']; ?></b><br>
<span class="badge <?php echo $r['murti_type']=='Eco-Friendly'?'eco':'pop'; ?>"><?php echo $r['murti_type']; ?></span>
</div>
<form method="POST" class="stock-form">
<input type="hidden" name="type" value="murti">
<input type="hidden" name="id" value="<?php echo $r['id']; ?>">
<input type="number" name="stock" value="<?php echo $r['stock']; ?>">
<button name="update" class="btn save">Save</button>
</form>
<div class="price">₹<?php echo $r['price']; ?></div>
<a href="admin_edit.php?type=murti&id=<?php echo $r['id']; ?>" class="btn edit">✏️ Edit</a>
<a href="?delete=<?php echo $r['id']; ?>&type=murti" class="btn delete" onclick="return confirm('Delete?')">🗑️ Delete</a>
</div>
<?php } ?>
</div>

<div class="card-box">
<h3>✨ Accessories Stock (<?php echo mysqli_num_rows($acc); ?>)</h3>
<?php while($r=mysqli_fetch_assoc($acc)){ ?>
<div class="item">
<img src="uploads/<?php echo $r['image']; ?>">
<div class="info"><b><?php echo $r['name']; ?></b></div>
<form method="POST" class="stock-form">
<input type="hidden" name="type" value="acc">
<input type="hidden" name="id" value="<?php echo $r['id']; ?>">
<input type="number" name="stock" value="<?php echo $r['stock']; ?>">
<button name="update" class="btn save">Save</button>
</form>
<div class="price">₹<?php echo $r['price']; ?></div>
<a href="admin_edit.php?type=acc&id=<?php echo $r['id']; ?>" class="btn edit">✏️ Edit</a>
<a href="?delete=<?php echo $r['id']; ?>&type=acc" class="btn delete" onclick="return confirm('Delete?')">🗑️ Delete</a>
</div>
<?php } ?>
</div>

</div>
</body></html>