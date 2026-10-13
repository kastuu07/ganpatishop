<?php session_start(); include("db.php");
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }
$uid=$_SESSION['user_id'];
$id=(int)$_GET['id'];
$order=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM orders WHERE id=$id AND user_id=$uid"));
if(!$order){ die("Order not found!"); }
$items=mysqli_query($con,"SELECT * FROM order_items WHERE order_id=$id");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.box{max-width:700px;margin:20px auto;background:#fff;padding:20px;border-radius:14px}.item{display:flex;gap:12px;border-bottom:1px solid #eee;padding:12px 0;align-items:center}.item img{width:60px;height:60px;object-fit:cover;border-radius:8px;background:#f5f5f5}.btn{padding:8px 14px;border-radius:20px;text-decoration:none;font-weight:bold;font-size:12px;display:inline-block}.btn-back{background:#e0e0e0;color:#333}.btn-cancel{background:#d32f2f;color:#fff}</style></head><body>
<div class="box">
<a href="my_orders.php" class="btn btn-back">← Back to Orders</a>
<h2 style="color:#6b2c1a">Order #<?php echo $order['id']; ?> Details</h2>
<p><b>Status:</b> <span style="background:#fff3cd;padding:4px 10px;border-radius:10px"><?php echo $order['status']; ?></span></p>
<p><b>Total Amount:</b> ₹<?php echo $order['total']; ?></p>
<p><b>Phone:</b> <?php echo $order['phone']; ?></p>
<p><b>Address:</b> <?php echo $order['address']; ?></p>
<p><b>Date:</b> <?php echo $order['created_at']; ?></p>
<hr>
<h3>Items:</h3>
<?php $total=0; while($it=mysqli_fetch_assoc($items)){ $total+=$it['price']; 
 // get image
 $img=''; 
 if($it['item_type']=='murti'){ $p=mysqli_fetch_assoc(mysqli_query($con,"SELECT image FROM products WHERE id=".$it['item_id'])); $img=$p['image'] ?? ''; }
 else { $p=mysqli_fetch_assoc(mysqli_query($con,"SELECT image FROM accessories WHERE id=".$it['item_id'])); $img=$p['image'] ?? ''; }
?>
<div class="item">
<img src="uploads/<?php echo $img; ?>" onerror="this.src='https://via.placeholder.com/60'">
<div>
<b><?php echo $it['name']; ?></b><br>
<small>₹<?php echo $it['price']; ?> | 📏 <?php echo $it['size']; ?> | <?php echo $it['item_type']; ?></small>
</div>
</div>
<?php } ?>
<h3 style="text-align:right">Total Paid: ₹<?php echo $total; ?></h3>

<?php if($order['status']=='Pending'){ ?>
<a href="my_orders.php?cancel_id=<?php echo $order['id']; ?>" class="btn btn-cancel" onclick="return confirm('Cancel this order?')">❌ Cancel This Order</a>
<?php } ?>
</div>
</body></html>