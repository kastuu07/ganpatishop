<?php session_start(); include("db.php");

// Allow BOTH Admin and Customer to see receipt
if(!isset($_SESSION['user_id']) && !isset($_SESSION['admin'])){
 header("Location: login.php"); exit;
}

$id=(int)$_GET['order_id'];

// If Admin - can see ANY order receipt
if(isset($_SESSION['admin'])){
 $order=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM orders WHERE id=$id"));
} else {
 // If Customer - can see only OWN order
 $uid=$_SESSION['user_id'];
 $order=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM orders WHERE id=$id AND user_id=$uid"));
}

if(!$order){ die("<h3 style='text-align:center;margin-top:50px'>❌ Receipt not found or not your order!</h3>"); }

$user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id=".$order['user_id']));
$items=mysqli_query($con,"SELECT * FROM order_items WHERE order_id=$id");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Receipt #<?php echo $id; ?></title>
<style>
body{margin:0;font-family:Arial;background:#f0eeea}
.receipt{max-width:600px;margin:20px auto;background:#fff;padding:25px;border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,.1)}
.head{text-align:center;border-bottom:2px dashed #6b2c1a;padding-bottom:15px;margin-bottom:15px}
table{width:100%;border-collapse:collapse;margin:15px 0}th,td{border-bottom:1px solid #eee;padding:8px;text-align:left;font-size:13px}
th{background:#f9f5f2}
.paid{background:#d4edda;color:#155724;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:bold}
.cod{background:#fff3cd;color:#664d03;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:bold}
.btn{padding:10px 18px;border-radius:20px;text-decoration:none;font-weight:bold;display:inline-block;margin:5px;font-size:13px}
.btn-print{background:#6b2c1a;color:#fff;border:none;cursor:pointer}
.btn-home{background:#000;color:#fff}
@media print{ .no-print{display:none} body{background:#fff} .receipt{box-shadow:none;margin:0} }
</style></head><body>
<div class="receipt" id="receipt">
<div class="head">
<h2 style="color:#6b2c1a;margin:0">🙏 Ganpati Shop Kolhapur</h2>
<p style="margin:5px 0;font-size:12px">Payment Receipt</p>
<h3>Order #<?php echo $order['id']; ?></h3>
<?php if($order['payment_status']=='Paid'){ ?>
<span class="paid">✅ PAID - <?php echo $order['payment_method']; ?> (<?php echo $order['payment_status']; ?>)</span>
<?php } else { ?>
<span class="cod">💵 <?php echo $order['payment_method']; ?> - <?php echo $order['payment_status']; ?></span>
<?php } ?>
</div>

<p><b>Customer:</b> <?php echo $user['name']; ?> (<?php echo $user['email']; ?>)</p>
<p><b>Phone:</b> <?php echo $order['phone']; ?></p>
<p><b>Address:</b> <?php echo $order['address']; ?></p>
<p><b>Date:</b> <?php echo $order['created_at']; ?></p>
<p><b>Payment Method:</b> <?php echo $order['payment_method']; ?> 
<?php if($order['transaction_id']) echo "| <b>Txn ID / UTR:</b> ".$order['transaction_id']; ?>
<br><b>Order Status:</b> <?php echo $order['status']; ?>
</p>

<table>
<tr><th>Item</th><th>Size</th><th>Price</th></tr>
<?php while($it=mysqli_fetch_assoc($items)){ ?>
<tr><td><?php echo $it['name']; ?><br><small><?php echo $it['item_type']; ?></small></td><td><?php echo $it['size']; ?></td><td>₹<?php echo $it['price']; ?></td></tr>
<?php } ?>
<tr><th colspan="2" style="text-align:right">Total Paid</th><th>₹<?php echo $order['total']; ?></th></tr>
</table>

<p style="font-size:11px;color:#666;text-align:center;margin-top:20px">Thank you for shopping with Ganpati Shop! 🙏<br>This is computer generated receipt.</p>

<div class="no-print" style="text-align:center;margin-top:20px">
<button onclick="window.print()" class="btn btn-print">🖨️ Print Receipt</button>
<?php if(isset($_SESSION['admin'])){ ?>
<a href="admin_orders.php" class="btn btn-home">← Back to Orders</a>
<a href="dashboard.php" class="btn btn-home" style="background:#6b2c1a">Dashboard</a>
<?php } else { ?>
<a href="my_orders.php" class="btn btn-home">Go to My Orders</a>
<a href="products.php" class="btn btn-home" style="background:#6b2c1a">Continue Shopping</a>
<?php } ?>
</div>
</div>
</body></html>