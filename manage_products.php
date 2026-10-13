<?php session_start(); include("../db.php");
if(!isset($_SESSION['admin'])){ header("Location: ../admin_login.php"); exit; }

// Delete Product
if(isset($_GET['delete'])){
 $id=$_GET['delete'];
 mysqli_query($con,"DELETE FROM products WHERE id=$id");
 header("Location: manage_products.php");
}

$res=mysqli_query($con,"SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Arial;background:#f0eeea;padding:15px}
table{width:100%;background:#fff;border-radius:10px;overflow:hidden;border-collapse:collapse;box-shadow:0 2px 10px rgba(0,0,0,.1)}
th{background:#6b2c1a;color:#fff;padding:12px;text-align:left}
td{padding:10px;border-bottom:1px solid #eee;font-size:13px}
img{width:60px;height:60px;object-fit:cover;border-radius:5px}
.btn{padding:6px 10px;border-radius:5px;text-decoration:none;font-size:12px;font-weight:bold;display:inline-block;margin:2px}
.edit{background:#ff9800;color:#fff} .del{background:#d32f2f;color:#fff}
.top{display:flex;justify-content:space-between;align-items:center;max-width:1100px;margin:auto;margin-bottom:15px}
</style></head><body>
<div class="top">
<h2 style="color:#6b2c1a">Manage Ganesh Murtis - Admin Only</h2>
<a href="dashboard.php" style="background:#6b2c1a;color:#fff;padding:8px 15px;border-radius:20px;text-decoration:none">← Dashboard</a>
</div>

<table>
<tr><th>Image</th><th>Name</th><th>Price</th><th>Type</th><th>Size</th><th>Action</th></tr>
<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><img src="../uploads/<?php echo $row['image']; ?>" onerror="this.src='https://via.placeholder.com/60'"></td>
<td><b><?php echo $row['name']; ?></b><br><small style="color:#666"><?php echo substr($row['description'],0,50); ?>...</small></td>
<td>₹<?php echo $row['price']; ?></td>
<td><?php echo $row['murti_type']; ?></td>
<td><?php echo $row['size']; ?></td>
<td>
<a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
<a href="manage_products.php?delete=<?php echo $row['id']; ?>" class="btn del" onclick="return confirm('Delete this murti?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</body></html>